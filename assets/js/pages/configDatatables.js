/**
 * Configuration Datatable
 */
class ConfigDatatables {

  static getConfigurationDatatable() {

    DatatableConfig = {
      stateSave: false,
      order: [[1, "asc"]],
      pagingType: "simple_numbers",
      searching: true,
      lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "Tous"],
      ],
      language: {
        info: "Question _START_ à _END_ sur _TOTAL_",
        emptyTable: "Aucune question",
        lengthMenu: "_MENU_ Questions par page",
        search: "Rechercher : ",
        zeroRecords: "Aucun résultat de recherche",
        paginate: {
          previous: "Précédent",
          next: "Suivant",
        },
        sInfoFiltered:
          "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
        sInfoEmpty: "Question 0 à 0 sur 0 sélectionnée",
      },
      columns: [
        {
          orderable: true,
        },
        {
          orderable: false,
        },
        {
          orderable: true /* Réponse */,
        },
        {
          orderable: false /* Rest */,
        },
      ],
      retrieve: true,
      responsive: true,
    };
    return DatatableConfig;

  }
  
}

