<script src="assets/js/pages/survey.js"></script>
<link rel="stylesheet" href="assets/css/survey.css">

<div class="container-fluid my-5">

    <h3 class="subtitle text-center m-5 mt-5 animate__animated animate__rollIn"><?= STRINGS['gererMesEnquetes'] ?></h3>

    <table id="table_survey" class="table-striped table_hover table_commandes dt-responsive w-100 nowrap mb-5">
        <thead></thead>
        <tbody></tbody>
    </table>
    <div class="buttonControl">
        <p class="text-center"><label class="add_question-text"><?= STRINGS['AjouterUneEnquete'] ?></label>
            <button class="add_form_field" onclick="buildAddSurveyForm()"><img src="assets/Images/icons8-plus-50.png" alt="img plus"></button>
        </p>
    </div>

    <div class="form" id="formSurvey_edit">
        <h3 class="mt-5 text-center"><?= STRINGS['addOrUpdateSurvey'] ?></h3>
        <div class="form-group mt-5">
            <label for="survey_name"><?= STRINGS['Enquetes'] ?></label>
            <input name="survey_name" type="text" id="survey_name" class="form-control mb-3" placeholder="<?= STRINGS["placeholderSurvey"] ?>">
            <p class="selectBox text-center">
                <label><?= STRINGS['labelQuestion'] ?></label>
                <select id="question_select" class="mb-3"></select>
                <label><?= STRINGS['selectTypeSupport'] ?></label>
                <select id="typeSurvey_select" class="mb-3"></select>
            </p>
        </div>
        <p class="text-center mt-5 mb-5">
            <button id="btn-cancel" onclick="hideFormSurvey()" type="button"><?= STRINGS["Annule"] ?></button>
            <button id="btn-validate" type="button"><?= STRINGS["Ajouter"] ?></button>
        </p>
    </div>

</div>