$(document).ready(function () {
  getSurveys();
  $("#formSurvey_edit").hide();
});

function getSurveys() {
  let url = "?route=Survey&action=getSurveys";
  let data = {};
  getAjax(url, data, createSurveyDataTable);
}
let arrayOfSurvey = [];

/**
 * Create DataTable display on page load
 * @param {*} response
 */
function createSurveyDataTable(response) {
  $("#table_survey thead").empty();
  arrayOfSurvey = response.data;

  let thead = $("#table_survey").find("thead");
  let tbody = $("#table_survey").find("tbody");
  let tr = $("<tr>");
  let td = $("<td>");
  thead.append(tr);
  tbody.append(td);


  survey = arrayOfSurvey[0];
  let keysToChange = {
    name: strings["NomDeLenquete"],
    typeSurvey: strings["TypeDenquetes"],
  };

  Utils.replaceKeysfromArrayIntoTheOtherArray(arrayOfSurvey, keysToChange);

  for (let item in survey) {
    $(tr).append("<th>" + item + "</th>");
  }
  $(tr).append("<th>Action</th>");

  arrayOfSurvey = arrayOfSurvey.map(function (survey) {
    let actionImg =
      '<a class="actionImg"><img onclick="buildUpdateSurveyForm(' +
      survey.idSurvey +
      ')" src="assets/Images/thumbnail_Edit-Bleu.png"</a>&nbsp;' +
      '<a onclick="removeSurvey(' +
      survey.idSurvey +
      ')" class="actionImg"><img src="assets/Images/thumbnail_Corbeille-rouge.png"></a>'+

      '<a class="actionImg" href='+baseUrl+"route=Feedback&action=index&idSurvey="+ survey.idSurvey+'><img src="assets/Images/eye.png"></a>' +
      '<a class="actionImg" href='+baseUrl+"route=Feedback&action=index&idSurvey="+ survey.idSurvey+"&showResult=true"+'><img src="assets/Images/chart.png"></a>'
     
     
    survey.action = actionImg;
    return Object.values(survey);
  });

  table = $("#table_survey").DataTable({
    language: {
      info: strings['Enquete_START_a_END_sur_TOTAL'],
      emptyTable: strings['AucuneEnquete'],
      lengthMenu: strings['MENU_EnquetesParPage'],
      search: strings['Rechercher'],
      zeroRecords: strings['AucunResultatdeRecherche'],
      paginate: {
        previous: strings['Precedent'],
        next: strings['Suivant'],
      },
      sInfoFiltered: strings['Question0A0Sur0Selectionnee'],
      sInfoEmpty: strings['Question0A0Sur0Selectionnee'],
    }
  });


  table.columns(0).header().to$().text(strings["NumeroDeLenquete"]);

  table.rows.add(arrayOfSurvey).draw();
}

/**
 * Pops a form on survey click edit button to modify survey object
 *
 * @param {int} idSurvey
 */
function buildUpdateSurveyForm(idSurvey) {
  $("#btn-validate").on("click", function () {
    updateSurvey(idSurvey);
    $(this).unbind();
  });

  $("#formSurvey_edit").fadeIn();
  let url = "?route=Survey&action=editSurvey";
  let data = {
    idSurvey,
  };
  getAjax(url, data, buildUpdateSurveyFormSuccess);
}

/**
 * Sucess callback function from editSurveys()
 * @param {*} response
 */
function buildUpdateSurveyFormSuccess(response) {
  scrollToElementAfterClick($("#formSurvey_edit"));
  $("#btn-validate").text(strings['Modifier']);
  let currentSurvey = response.data[0];
  $("#survey_name").val(currentSurvey.name);

  buildQuestionSelectForm(response);
  buildTypeSurveySelectForm(response);
}

function buildAddSurveyForm() {
  $("#btn-validate").text(strings['Ajouter']);
  $("#btn-validate").on("click", function () {
    addSurvey();
    $(this).unbind();
  });
  clearInputs();

  $("#formSurvey_edit").fadeIn();
  scrollToElementAfterClick($("#formSurvey_edit"));
  let url = "?route=Survey&action=editSurvey";
  let data = {};
  getAjax(url, data, buildAddSurveyFormSuccess);
}

function buildAddSurveyFormSuccess(response) {
  buildQuestionSelectForm(response);
  buildTypeSurveySelectForm(response);
}

function buildQuestionSelectForm(response) {
  let arrayOfQuestions = response.questions;
  let questionOptionToSelect = $("#question_select option").first();

  $("#question_select").empty();

  for (let question of arrayOfQuestions) {
    let option =
      '<option id="optionQuestionId_' +
      question.idQuestion +
      '"    value=' +
      question.idQuestion +
      ">" +
      question.idQuestion +
      " - " +
      question.content +
      "</option>";
    $("#question_select").append(option);
  }

  if (response.data != null) {
    let currentSurvey = response.data[0];
    questionOptionToSelect = $("#optionQuestionId_" + currentSurvey.idQuestion.idQuestion);
  }
  questionOptionToSelect.attr("selected", true);
}

function buildTypeSurveySelectForm(response) {
  let arrayOfTypeSurvey = response.typeSurvey;
  let typeSurveyOptionToSelect = $("#typeSurvey_select option").first();
  $("#typeSurvey_select").empty();

  for (let typeSurvey of arrayOfTypeSurvey) {
    let option =
      '<option id="optionTypeSurveyId_' +
      typeSurvey.idTypeSurvey +
      '" value=' +
      typeSurvey.idTypeSurvey +
      ">" +
      typeSurvey.idTypeSurvey +
      " - " +
      typeSurvey.name +
      "</option>";
    $("#typeSurvey_select").append(option);
  }

  if (response.data != null) {
    let currentSurvey = response.data[0];
    typeSurveyOptionToSelect = $(
      "#optionTypeSurveyId_" + currentSurvey.idTypeSurvey.idTypeSurvey
    );
    typeSurveyOptionToSelect.attr("selected", true);
  }
}
//-------------------------------------- GET SECTION -----------------------------

/* --------------------- UPDATE SECTION --------------- */

function updateSurvey(id) {
  let url = "?route=Survey&action=saveUpdateSurvey";
  let data = {
    idSurvey: id,
    surveyContent: $("#survey_name").val(),
    idQuestion: $("#question_select").val(),
    idTypeSurvey: $("#typeSurvey_select").val(),
  };
  addAjax(url, data, updateSurveySuccess, updateSurveyError);

  $("#survey_edit").fadeOut();
}

function updateSurveySuccess() {
  reloadDataTableAfterSuccessCallback();
  ModalInfoMessage.showSuccess(strings['TraitementReussi']);
}
function updateSurveyError(response) {
  ModalInfoMessage.showError(response);
}

// ------------------------------- SAVE SECTION --------------------------------

function addSurvey() {
  let url = "?route=Survey&action=saveUpdateSurvey";
  let data = {
    surveyContent: $("#survey_name").val(),
    idQuestion: $("#question_select").val(),
    idTypeSurvey: $("#typeSurvey_select").val(),
  };
  addAjax(url, data, addSurveySuccess, addSurveyError);

  $("#survey_edit").fadeOut();
}

function addSurveySuccess() {
  ModalInfoMessage.showSuccess("Traitement réussi !");
  reloadDataTableAfterSuccessCallback();
}

function addSurveyError(response) {
  ModalInfoMessage.showError(response);
}

// --------------------------- REMOVE SECTION ------------------------
function removeSurvey(idSurvey) {
  ModalInfoMessage.confirmActionSurvey(idSurvey)

}

function removeSurveySuccess() {
  reloadDataTableAfterSuccessCallback();
}

// ------------------------------- MISC SECTION ------------------------

function reloadDataTableAfterSuccessCallback() {
  hideFormSurvey();
  clearInputs();
  $("#table_survey").DataTable().clear();
  $("#table_survey").DataTable().destroy();
  $("#table_survey thead").empty();
  getSurveys();
}
function hideFormSurvey() {
  $("#formSurvey_edit").fadeOut();
  clearInputs();
}

function clearInputs() {
  $("#survey_name").val("");
  $("#question_select").empty();
  $("#typeSurvey_select").empty();
}
