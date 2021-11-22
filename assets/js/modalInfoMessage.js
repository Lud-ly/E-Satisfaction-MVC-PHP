class ModalInfoMessage {
  
  static successFunction(response){
    var params = {
      icon : 'success',
      reload : true,
      message : response.messageReussite,
      };
      ModalInfoMessage.displayToastWithoutReload(params);
  }
  static showSuccess(successMessage) {
    Swal.fire(
      'Success',
      successMessage,
      'success'
    )
  }
  static showError(response) {
    if (typeof response === 'object') {
      response = response.responseJSON.messageErreur;
    }
    Swal.fire(
      'Error',
      response,
      'error'
    )

  }
  static confirmActionQuestion(idQuestion){
    
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false
    })
    
    swalWithBootstrapButtons.fire({
      title: strings['EtesVousSur?'],
      text: strings['CetteActionEstIrreversible'],
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: strings['OuiJeSupprime'],
      cancelButtonText: strings['NonAnnuler'],
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        swalWithBootstrapButtons.fire(
         strings['Supprime'],
          strings['VotreFichierABienEteSupprime'],
          'success'
        )
        let url = "?route=Question&action=removeQuestion";
        let data = {
          idQuestion: idQuestion,
        };
        addAjax(url, data, removeQuestionSuccess);
      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === Swal.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Cancelled',
          strings['SuppressionAnnule'],
          'error'
        )
      }
    })
  }

  static confirmActionSurvey(idSurvey){
    
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false
    })
    
    swalWithBootstrapButtons.fire({
      title: strings['EtesVousSur?'],
      text: strings['CetteActionEstIrreversible'],
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: strings['OuiJeSupprime'],
      cancelButtonText: strings['NonAnnuler'],
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        swalWithBootstrapButtons.fire(
          strings['Supprime'],
          strings['VotreFichierABienEteSupprime'],
          'success'
        )
        let url = "?route=Survey&action=removeSurvey";
        let data = {
          idSurvey: idSurvey,
        };
        addAjax(url, data, removeSurveySuccess);
      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === Swal.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Cancelled',
          strings['SuppressionAnnule'],
          'error'
        )
      }
    })
  }
  
  static errorFunction(response){
    if (typeof response === 'object') {
      response = response.responseJSON.messageErreur;
    }
    var params = {
      icon : 'error',
      reload : false,
      message : response.messageErreur
    };
    ModalInfoMessage.displayToastWithoutReload(params);
  }
  
  static displayToast(response){
    var Toast = Swal.mixin({
      toast: true,
      position: 'top',
      showConfirmButton: false,
      timer: 2000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      },
      didDestroy: () => { 
        if(response.reload){
          location.reload();
        }
      },
    })
    Toast.fire({
      icon: response.icon,
      title: response.message,
    })
  }

  static displayToastWithoutReload(response){
    var Toast = Swal.mixin({
      toast: true,
      position: 'top',
      showConfirmButton: false,
      timer: 2000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      },
      
    })
    Toast.fire({
      icon: response.icon,
      title: response.message,
    })
  }
}