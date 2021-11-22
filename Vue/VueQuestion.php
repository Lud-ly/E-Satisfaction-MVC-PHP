<script src="assets/js/pages/question.js"></script>

<link rel="stylesheet" href="assets/css/question.css">

<div class="container-fluid mt-5">

  <h3 class="subtitle text-center m-5 mb-5 animate__animated animate__rollIn"><?= STRINGS["GererMesQuestions"] ?></h3>
  <!--END ADD-->

  <table id="table_question" class="table table-striped table-hover table-wrapper  dt-responsive w-100 nowrap mb-5">
    <thead></thead>
    <tbody></tbody>
  </table>

  <div class="buttonControl">
    <p class="text-center"><label class="add_question-text"><?= STRINGS["AjouterUneQuestion"] ?></label>
      <button class="add_form_field" onclick="showForm()"><img src="assets/Images/icons8-plus-50.png" alt="img plus"></button>
    </p>
  </div>

  <!--ADD OR UPDATE QUESTION-->
  <div class="form" id="formQuestion">
    <h3 class="subtitle mt-5"><?= STRINGS["FormulaireQuestion"] ?></h3>

    <div class="select-group mt-5">
      <p class="text-center"><label for="surveysList"><?= STRINGS["labelEnquetes"] ?></label></p>
      <select class="mt-2" data-width="100%" id="surveysList" data-live-search="true" multiple title="Selectionner une enquête"> </select>
    </div>

    <p class="text-center mt-5"><label for="questionContent"><?= STRINGS["labelQuestion"] ?></label></p>
    <div class="input-group mt-2">
      <input width="100%" name="questionContent" type="text" id="questionContent" class="form-control" placeholder="<?= STRINGS["placeholderQuestion"] ?>">
      <span id="error"></span>
    </div>

    <div class="container containerForm" id='containerForm'>
      <div class="buttonControl">
        <p class="text-center"><label class="add_question-text"><?= STRINGS["AjouterUneReponse"] ?></label>
          <button onclick="generateDynamicInputs()" class="add_form_field"><img src="assets/Images/icons8-plus-50.png" alt="img plus"></button>
        </p>
      </div>

      <div id="containerAnswers"></div>

    </div>

    <p class="text-center mt-5 mb-5">
      <button id="btn-cancel" onclick="cleanForm()" type="button"><?= STRINGS["Annule"] ?></button>
      <button id="btn-validate" type="button" onclick="addOrUpdateQuestion()"></button>
    </p>
  </div>

</div>