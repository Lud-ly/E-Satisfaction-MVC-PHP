class Dialog {

    /**
     * alertSwal() => alert avec sweetalert
     * @param {*} message 
     * @returns 
     */
    static alertDialog(message){
        if(message != ""){
            return swal(message)
        }
    }

    /**
     * promptSwal() => prompt avec sweetalert
     * @param {*} message 
     * @param {*} data 
     * @returns 
     */
    static promptDialog(message, data){
        return swal(message, {
            content: {
                element: "input",
                attributes: {
                    value: data,
                },
            }
        })
    }

    /**
     * confirmSwal() => confirm avec sweetalert
     * @param {*} message 
     * @returns 
     */
    static confirmDialog(message, parametre){
        let alerte = {
            title: message,
            buttons: [
                strings.retour,
                strings.valider
            ],
        }
        if(parametre){
            alerte.icon = parametre
        }
        return swal(alerte)
    }

    static adminModalPasElement(message){
        const Toast = Swal.mixin({  
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 1000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        Toast.fire({
            icon: 'error',
            title: message
        })
    }

    static adminModal(data){
        return Swal.fire({
            icon: data.iconDialog,
            title: data.titleDialog,
            html: data.textDialog,              
        })
    }
}
