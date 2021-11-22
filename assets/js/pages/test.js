function addEntity(){
    let email = $('#exampleInputEmail1').val();
    let password = $('#exampleInputPassword1').val();

    if (email == '' || password == '') {
        errorFunction('data vide');
    }else{
        let url = '?route=Test&action=ajoutTest';
        let data = {
            'email': email,
            'password': password
        };
        addAjax(url, data, successFunction, errorFunction);
    }
}