$(document).ready(function () {

    let feedback = new Feedback()
});
class Feedback {

    constructor(idSurvey = this.idSurvey, showResult = this.showResult) {
        const urlParams = new URLSearchParams(window.location.search);
        this.idSurvey = urlParams.get('idSurvey');
        this.showResult = urlParams.get('showResult');
        this.getSurvey();
        let that = this;
        setInterval(function () {
            that.refreshStats();
        }, 30000);
    }

    refreshStats() {
        if (this.showResult == 'true') {
            this.getSurvey();
        }
    }

    getSurvey() {

        let url = "?route=Feedback&action=getSurveyAndAnswer";
        let data = {
            idSurvey: this.idSurvey,
            showResult: this.showResult
        };
        addAjax(url, data, this.getSurveySuccess, this.getSurveyError, { advice: this });
    }


    getSurveySuccess(response, optionalParameters) {


        $("#answers").empty();
        let advice = optionalParameters.advice;
        let questionContent = response.data.idQuestion.content;
        let answers = response.answers
        let activateFeedback = advice.showResult != 'true';
        let answerCircle, answerPicture, answerNotation, answerPictureWrapper;
        $("#questionContent").text(questionContent);

        for (let answer of answers) {
            let answerWrapper = $("<div>").addClass("col-md-2 d-flex flex-column mx-2 align-items-center mx-auto");

            if (activateFeedback) {
                answerWrapper = answerWrapper.on('click', function () {
                    advice.sendAdvice(answer);
                }).attr('id', 'answerWrapper_' + answer.idAnswerType);
            }

            answerPictureWrapper = $("<div>");
            let answerPictureWrapperCssClass = "circle";
            let answerPictureWrapperChildElement = $("<div>").text(answer.answerValue);
            let answerPictureWrapperChildElementCssClass = "answerNotation";

            if (answer.idPicture != null) {
                answerPictureWrapperCssClass = "answerPictureWrapper"
                answerPictureWrapperChildElement = $("<img>").attr('src', answer.idPicture?.url);
                answerPictureWrapperChildElementCssClass = "answerPicture";
            }
            answerPictureWrapperChildElement.addClass(answerPictureWrapperChildElementCssClass);
            answerPictureWrapper.addClass(answerPictureWrapperCssClass);
            answerPictureWrapper.append(answerPictureWrapperChildElement);

            let answerContent = $("<div>").text(answer.typeName)
                .addClass("text-center answerNotation mb-0");
            let answerStats = $("<div>").attr("id", "stats_" + answer.idAnswerType)
                .addClass("text-center");

            answerWrapper.append(answerPictureWrapper)
            answerWrapper.append(answerContent);
            answerWrapper.append(answerStats);

            $("#answers").append(answerWrapper);
        }
        if (advice.showResult == 'true') {
            advice.displayStats(response);
        }
    }

    displayStats(response) {
        $("#feedbackResult").empty();
        let answers = response.answers;
        for (let answer of answers) {
            let answerStats = $("<div>").html("0% (0)").addClass("answerNotation");
            $("#stats_" + answer.idAnswerType).append(answerStats).addClass("answerNotation");
        }
        let countVote = $("<div>").html(strings['feedbackCount'] + " : 0").addClass("statsDisplay");
        let averageNotation = $("<div>").html(strings['averageNotation'] + " N/A").addClass("statsDisplay");
        $("#feedbackResult").append(countVote);
        $("#feedbackResult").append(averageNotation);

        if (response.stats.answers) {
            let statsAnswers = response.stats.answers;
            let stats = response.stats;

            for (let statAnswer of statsAnswers) {
                $("#stats_" + statAnswer.idAnswerType + "").html(statAnswer.percent + "% (" + statAnswer.count + ")");
            }
            $("#feedbackResult .statsDisplay").first().html(strings['feedbackCount'] + " " + stats.countData);
            $("#feedbackResult .statsDisplay").last().html(strings['averageNotation'] + " : " + stats.averageNotation + "/" + statsAnswers.length);
        }
    }

    getSurveyError(response) {
        ModalInfoMessage.throwError(response);
    }

    sendAdvice(answer) {
        let url = "?route=Feedback&action=voteNotification";
        let data = {
            idSurvey: this.idSurvey,
            answer: answer
        };
        addAjax(url, data, this.sendAdviceSuccess, this.sendAdviceError, { advice: this });
        this.showMessageAfterVote();
        setTimeout(this.showAdvice, 2000)
    }

    sendAdviceSuccess(response) {
        ModalInfoMessage.successFunction(response);
    }

    sendAdviceError(response) {
        ModalInfoMessage.throwError(response);
    }

    showAdvice() {
        $("#answers").fadeIn();
        $("#showMessage").removeClass("d-flex");
        $("#showMessage").fadeOut();
    }

    showMessageAfterVote() {
        $("#showMessage").fadeIn();
        $("#showMessage").addClass("d-flex");
        $("#answers").removeClass("d-flex");
        $("#answers").hide();
    }

}

