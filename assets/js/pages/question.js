$(document).ready(function () {
  getQuestions();

  $(".form").hide();
  $("select").addClass("selectpicker");
});

let answers = [];
let currentQuestion = "";
let answerValue;
let noteAnswers;
let mode = "";

function getQuestions() {
  let url = "?route=Question&action=getQuestions";
  let data = {};
  getAjax(url, data, createQuestionDataTable);
}

function getSurveys() {
  let url = "?route=Question&action=getSurveys";
  let data = {};
  getAjax(url, data, getSurveysSuccess);
}

function getSurveysSuccess(response) {
  $("#surveysList").selectpicker("destroy");
  $("#surveysList").empty();
  let surveys = response.data;
  let arrayOfSelectedSurvey = [];

  for (survey of surveys) {
    let option =
      '<option id="optionSurveyId_' +
      survey.idSurvey +
      '"    value=' +
      survey.idSurvey +
      ">" +
      survey.idSurvey +
      " - " +
      survey.name +
      "</option>";

    $("#surveysList").append(option);

    if (
      survey["idQuestion"] != undefined &&
      survey["idQuestion"]["idQuestion"] == currentQuestion
    ) {
      arrayOfSelectedSurvey.push(survey.idSurvey);
    }
  }

  $("#surveysList").selectpicker();
  $("#surveysList").selectpicker("val", arrayOfSelectedSurvey);
  $("#surveysList").selectpicker("refresh");
}

function getPictures() {
  let url = "?route=Question&action=getPictures";
  let data = {};
  getAjax(url, data, getPicturesSuccess, getPicturesError);
}

function getPicturesSuccess(response) {
  let pictures = response.pictures;
  localStorage.setItem("pictures", JSON.stringify(pictures));
}

function buildSelectPictures() {
  let pictures = localStorage.getItem("pictures");
  pictures = JSON.parse(pictures);

  let select = $("<select>").addClass("selectpicker");
  for (let picture of pictures) {
    let optionContent =
      "<img src='" + picture.url + "' class='img-fluid h-30'>";
    let option = $("<option>").attr({
      "data-content": optionContent,
      value: picture.id,
    });
    select.append(option);
  }
  return select;
}

function getPicturesError(response) {}

function getActive(isActive) {
  return isActive
    ? '<img src="assets/Images/active.png" class="imgTable">'
    : '<img src="assets/Images/notActive.png" class="imgTable">';
}

function createQuestionDataTable(response) {
  let arrayOfQuestion = response.data;

  var thead = $("#table_question").find("thead");
  var tbody = $("#table_question").find("tbody");
  var tr = $("<tr>");
  var td = $("<td>");
  thead.append(tr);
  tbody.append(td);

  question = arrayOfQuestion[0];

  let keysToChange = {
    content: strings["ContenuDeLaQuestion"],
  };

  Utils.replaceKeysfromArrayIntoTheOtherArray(arrayOfQuestion, keysToChange);

  for (let item in question) {
    $(tr).append("<th>" + item + "</th>");
  }
  $(tr).append("<th>Action</th>");
  arrayOfQuestion = arrayOfQuestion.map(function (question) {
    let actionImg =
      '<a class="actionImg"><img onclick="editQuestions(' +
      question.idQuestion +
      ')" src="assets/Images/thumbnail_Edit-Bleu.png"</a>&nbsp;' +
      '<a class="actionImg"><img onclick="removeQuestion(' +
      question.idQuestion +
      ')" src="assets/Images/thumbnail_Corbeille-rouge.png"></a>';
    question.active = getActive(question.active);
    question.action = actionImg;
    $("question_content").val(question.content);
    return Object.values(question);
  });

  table = $("#table_question").DataTable({
    language: {
      info: strings['QuestionStartEnd'],
      emptyTable: strings['AucuneQuestion'],
      lengthMenu: strings['MENU_ Questions par page'],
      search: strings['Rechercher'],
      zeroRecords: strings['AucunResultatdeRecherche'],
      paginate: {
        previous: strings['Precedent'],
        next: strings['Suivant'],
      },
      sInfoFiltered:
       strings['FilteredFrom_MAX_totalRecords'],
      sInfoEmpty: strings['Question0A0Sur0Selectionnee'],
    },
  });

  table.columns(0).header().to$().text(strings["NumeroDeLaQuestion"]);

  table.rows.add(arrayOfQuestion).draw();
}

function reloadDataTableAfterSuccess() {
  $("#table_question").DataTable().clear();
  $("#table_question").DataTable().destroy();
  $("#table_question thead").empty();
  getQuestions();
}

function formIsValid() {
  let formValidation = Utils.questionFormIsValid();
  if (formValidation) {
    ModalInfoMessage.showSuccess(strings["TraitementReussi"]);
    addOrUpdateQuestion();
  } else {
    ModalInfoMessage.showError(strings["CheckError"]);
  }
}

function addOrUpdateQuestion() {
  let arrayOfSelectedSurvey = $("#surveysList").val();
  let selectedSurveysObjectToSend = [];

  for (let survey of arrayOfSelectedSurvey) {
    let surveyObject = {
      idSurvey: survey,
    };
    selectedSurveysObjectToSend.push(surveyObject);
  }
  let arrayOfAnswers = [];
  for (let answer of $("#containerAnswers .answer")) {
    answerId = answer.id;
    let answerObject = {
      idAnswerType: $("#" + answerId + " input").attr("id-answer"),
      typeName: $("#" + answerId + " input").val(),
      idPicture: $("#" + answerId + " .selectpicker").val(),
    };
    arrayOfAnswers.push(answerObject);
  }

  let url = "?route=Question&action=addOrUpdateQuestion";
  let data = {
    idQuestion: $("#questionContent").attr("id-question"),
    questionContent: $("#questionContent").val(),
    arrayOfAnswers: arrayOfAnswers,
    arrayOfSurveys: selectedSurveysObjectToSend,
  };

  addAjax(url, data, addOrUpdateQuestionSuccess, addOrUpdateQuestionError);
}

function addOrUpdateQuestionError(response) {
  ModalInfoMessage.showError(response);
}
function addOrUpdateQuestionSuccess() {
  ModalInfoMessage.showSuccess(strings["TraitementReussi"]);
  cleanForm();
  reloadDataTableAfterSuccess();
}

function editQuestions(idQuestion) {
  mode = "edit";
  currentQuestion = idQuestion;
  $(".buttonDeleteAnswer").trigger("click");
  $(".form").fadeIn();
  $("#btn-validate").text(strings["Modifier"]);
  let url = "?route=Question&action=editQuestions";
  let data = {
    idQuestion,
  };
  addAjax(url, data, editedQuestionSuccess);
  getSurveys();
}

function editedQuestionSuccess(response) {
  let answerResults;
  $("#containerAnswers").empty();

  answerResults = response.data;
  questionContent = answerResults[0].idQuestion["content"];
  idQuestion = answerResults[0].idQuestion["idQuestion"];
  scrollToElementAfterClick($("#formQuestion"));
  $("#questionContent").val(questionContent);
  $("#questionContent").attr("id-question", idQuestion);

  for (var i = 0; i < answerResults.length; i++) {
    answer = answerResults[i];
    answerValue = answerResults[i].answerValue;
    appendInputsInDivHtml(answer);
  }
}

function updateSurvey() {
  let url = "?route=Question&action=updateSurvey";
  let data = {
    arrayOfSurveys: selectedSurveysObjectToSend,
  };
  addAjax(url, data);
}

function removeQuestion(idQuestion) {
  ModalInfoMessage.confirmActionQuestion(idQuestion);
}

function removeQuestionSuccess() {
  reloadDataTableAfterSuccess();
}

function generateDynamicInputs() {
  let maxInputs = 5;
  let numberOfInputsInContainerForm = $("#containerAnswers .answer").length;

  if (numberOfInputsInContainerForm < maxInputs) {
    appendInputsInDivHtml(answers);
  } else {
    ModalInfoMessage.showError(strings["limiteMaxDeReponsePossible"]);
  }
  numberOfInputsInContainerForm = $("#containerForm input").length;
}

function appendInputsInDivHtml(answers) {
  let numberOfDivAnswers = $("#containerAnswers .answer").length + 1;
  getPictures();
  let select = buildSelectPictures();
  let inputValue = "";
  let inputId = "";

  if (answers) {
    inputValue = answers.typeName;
    inputId = answers.idAnswerType;
    answerPicture = answers.idPicture;
  }

  let buttonDeleteAnswer =
    '<a class="buttonDeleteAnswer" class="delete"><img class="trashImg" src="assets/Images/thumbnail_Corbeille-rouge.png"></a>';

  if (!(inputValue && inputId)) {
    inputValue = "";
    inputId = "";
  }

  $("#containerAnswers").append(
    "<div class='answer' id='answer_" +
      numberOfDivAnswers +
      "'>" +
      "<label>" +
      "</label>" +
      '<input value="' +
      inputValue +
      '" id-answer="' +
      inputId +
      '" type="text" />' +
      buttonDeleteAnswer +
      "</div>"
  );
  $("#containerAnswers #answer_" + numberOfDivAnswers + "").append(select);
  $(".selectpicker:last").selectpicker();

  if (answers.length != 0) {
    $(".selectpicker:last").selectpicker("val", answers.idPicture.id);
  }

  $(".buttonDeleteAnswer").on("click", function () {
    $(this).parent("div").remove();
    recalculateAnswerValue();
  });

  recalculateAnswerValue();
}

function recalculateAnswerValue() {
  let answerCounter = 1;

  for (let label of $("#containerAnswers div label")) {
    $(label).text(strings["NoteDeLaReponse"] + answerCounter);
    answerCounter++;
  }
}

function showForm() {

  $("#btn-validate").text(strings["Ajouter"]);
  $("#btn-add").show();
  $("#btn-update").hide();
  cleanForm();
  $(".form").fadeIn();
  scrollToElementAfterClick($("#formQuestion"));
  generatorInputsMinimum();
  getSurveys();
}

function generatorInputsMinimum(){
  
  let numberMinimumInput = 2;
  for (let i = 0; i < numberMinimumInput; i++) {
    generateDynamicInputs();
  }
}

function cleanForm() {
  $("#questionContent").val("");
  $(".buttonDeleteAnswer").trigger("click");
  $(".form").fadeOut();
}
