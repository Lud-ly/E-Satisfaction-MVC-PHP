<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.css">
    <link rel="stylesheet" href="assets/webfonts/all.css">
    <link rel="stylesheet" href="assets/css/nav.css">
    <link rel="stylesheet" href="assets/css/commun.css">
    <link rel="stylesheet" href="assets/css/basicStyle.css">
    <link rel="stylesheet" href="assets/DatePicker/picker.css">
    <link rel="stylesheet" href="assets/boostrap-select/bootstrap-select.min.css">
    <link rel="stylesheet" href="assets/jQueryUi/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/jQueryUi/jquery-ui.structure.min.css">
    <link rel="stylesheet" href="assets/jQueryUi/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/animate-css/animate.min.css">
    <script>
        const strings = <?php echo json_encode(STRINGS); ?>;
        const baseUrl =  '<?php echo BASE_URL; ?>';
    </script>
    <?php $variableCssCompagny->setCompanyCssColor(); ?>
    <script src="assets/js/pages/utils.js"></script>
    <script src="assets/js/pages/configDatatables.js"></script>
    <script src="assets/js/pages/index.js"></script>
    <script src="assets/jQuery/jQuery.js"></script>
    <script src="assets/popper/popper.min.js"></script>
    <script src="assets/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="assets/js/modalInfoMessage.js"></script>
    <script src="assets/bootstrap/bootstrap.js"></script>
    <script src="assets/js/ajax.js"></script>
    <script src="assets/js/requestAjax.js"></script>
    <script src="assets/DataTables/datatables.js"></script>
    <script src="assets/DatePicker/picker.js"></script>
    <script src="assets/boostrap-select/bootstrap-select.min.js"></script>
    <script src="assets/jQueryUi/jquery-ui.min.js"></script>
    <script src="assets/jQueryUi/jquery.ui.datepicker-fr.js"></script>
    <script src="assets/ddslick/ddslick.js"></script>
    
</head>

<body>
    <div id="global">
        <div id="contenu">
            <?= $navbar ?>
            <?= $contenu ?>
        </div>
    </div>
</body>

</html>

<style>
    html,
    body,
    #global,
    #contenu {
        height: 100%;
    }
</style>