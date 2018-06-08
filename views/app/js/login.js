function goLogin() {
    var connect, form, response, result, user, pass, session;
    user = __('user_login').value;
    pass = __('pass_login').value;
    session = __('session').checked ? true : false;
    form = 'username=' + user + '&password=' + pass + '&remember=' + session;
    connect = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    connect.onreadystatechange = function(){
        if (connect.readyState == 4 && connect.status == 200) {
            if (connect.responseText == 1) {
                result = '<div class="alert alert-dismissible alert-success">';
                result += '<button class="close" type="button" data-dismiss="alert">&times;</button>';
                result += '<h4 class="alert-heading">Conectado!</h4>';
                result += '<p class="mb-0"><strong>Estamos redireccionando...</strong></p>';
                result += '</div>';
                __('_AJAX_LOGIN_').innerHTML = result;
                window.location = 'index.php?view=index';
            }else {
                __('_AJAX_LOGIN_').innerHTML = connect.responseText;
            }
            
        } else if(connect.readyState != 4 ){
            result = '<div class="alert alert-dismissible alert-warning">';
            result += '<button class="close" type="button" data-dismiss="alert">&times;</button>';
            result += '<h4 class="alert-heading">Procesando...</h4>';
            result += '<p class="mb-0"><strong>Estamos intentando logearte...</strong></p>';
            result += '</div>';
            __('_AJAX_LOGIN_').innerHTML = result;
        }
    }  

    connect.open('POST', 'ajax.php?mode=login', true);
    connect.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    connect.send(form);
    
}

function runScriptLogin(e) {
    if (e.keyCode == 13) {
        goLogin();
    }
}