function confirmaRecuperarSenha(){
        var validar = true;
        let senha = document.getElementById("senha");
        let c_senha = document.getElementById("c_senha");     
        if (senha.length < 8) {
        document.getElementById('alert-senha').className = "alert";
        validar = false;

        if (validar == false) {
        return validar;
        } else {
        return validar;
        window.location.href = 'forgot.php';
    }
    }
}

function senhaCadastro() {
    var senha = document.getElementById("senha");
    var c_senha = document.getElementById("c_senha");

    if (senha.type == "password" || c_senha.type == "password") {
        senha.type = "text";
        c_senha.type = "text";
    } else {
        senha.type = "password";
        c_senha.type = "password";
    }
}



function senhaLogin() {
    var senha = document.getElementById("senha");

    if (senha.type == "password") {
        senha.type = "text";
    } else {
        senha.type = "password";
    }
}

/*signup.php.php*/

function verificaCadastro() {
    var validar = true;
    var nome = document.getElementById("nome").value;
    var email = document.getElementById("email").value;
    var data = document.getElementById("data").value;
    var senha = document.getElementById("senha").value;
    var c_senha = document.getElementById("c_senha").value;
    var concordar_termos = document.getElementById('check_termos');
    var anoAtual = new Date().getFullYear();
    var ano = data.split('/')[2];
    var idade = anoAtual - ano;

    if (nome == "") {
        document.getElementById('alert-nome').className = "alert";
        validar = false;
    }

    if (nome.length < 2) {
        document.getElementById('alert-nome').className = "alert";
        validar = false;
    }

    if (nome != "" & nome.length > 2) {
        document.getElementById('alert-nome').className = "to-hide";
    }

    if (data == "") {
        document.getElementById('alert-data').className = "alert";
        validar = false;
    }

    if (data != "") {
        document.getElementById('alert-data').className = "to-hide";
    }

    if (idade < 16) {
        document.getElementById('alert-idade').className = "alert";
        validar = false;
    }

    if (idade >= 16) {
        document.getElementById('alert-idade').className = "to-hide";
    }

    if (idade > 105) {
        document.getElementById('alert-idade1').className = "alert";
        validar = false;
    }

    if (idade <= 105) {
        document.getElementById('alert-idade1').className = "to-hide";
    }

    if (email == "") {
        document.getElementById('alert-email').className = "alert";
        validar = false;
    }

    if (email.indexOf('@') == -1) {
        document.getElementById('alert-email').className = "alert";
        validar = false;
    }

    if (email.indexOf('.com') == -1) {
        document.getElementById('alert-email').className = "alert";
        validar = false;
    }

    if (email != "" & email.indexOf('@') != -1 & email.indexOf('.com') != -1) {
        document.getElementById('alert-email').className = "to-hide";
    }

    if (senha == "") {
        document.getElementById('alert-senha').className = "alert";
        validar = false;
    }

    if (senha.length < 8) {
        document.getElementById('alert-senha').className = "alert";
        validar = false;
    }

    if (senha != "" & senha.length >= 8) {
        document.getElementById('alert-senha').className = "to-hide";
    }

    if (senha != c_senha) {
        document.getElementById('alert-c_senha1').className = "to-hide";
        document.getElementById('alert-c_senha2').className = "alert";
        validar = false;
    }

    if (c_senha == "") {
        document.getElementById('alert-c_senha1').className = "alert";
        document.getElementById('alert-c_senha2').className = "to-hide";
        validar = false;
    }

    if (senha == c_senha & c_senha != "") {
        document.getElementById('alert-c_senha1').className = "to-hide";
        document.getElementById('alert-c_senha2').className = "to-hide";
    }

    if(concordar_termos.checked == false) {
        document.getElementById('alert-termos').className = "alert";
        validar = false;
    }

    if(concordar_termos.checked == true) {
        document.getElementById('alert-termos').className = "to-hide";
    }
    
    if (validar == false) {
        return validar;
    } else {
        return validar;
        window.location.href = 'painel.php';
    }
}

/*login.php*/

function verificaLogin() {
    var validar = true;
    var email = document.getElementById("email").value;
    var senha = document.getElementById("senha").value;


    if (email == "") {
        document.getElementById('alert-email').className = "alert";
        validar = false;
    }

    if (email.indexOf('@') == -1 & email.indexOf('.com') == -1) {
        document.getElementById('alert-email').className = "alert";
        validar = false;
    }

    if (email != "" & email.indexOf('@') != -1 & email.indexOf('.com') != -1) {
        document.getElementById('alert-email').className = "to-hide";
    }

    if (senha == "") {
        document.getElementById('alert-senha').className = "alert";
        validar = false;
    }

    if (senha.length < 8) {
        document.getElementById('alert-senha').className = "alert";
        validar = false;
    }

    if (senha != "" & senha.length >= 8) {
        document.getElementById('alert-senha').className = "to-hide";
    }
    
    if (validar == false) {
        return validar;
    } else {
        return validar;
        window.location.href = 'painel.php';
    }
}

/*update.php*/

function editarNome() {
    var validar = true;
    var nome = document.getElementById("nome").value;

    if (nome == "") {
        document.getElementById('alert-nome').className = "alert";
        validar = false;
    }

    if (nome.length <= 2) {
        document.getElementById('alert-nome').className = "alert";
        validar = false;
    }

    if (nome != "" & nome.length > 2) {
        document.getElementById('alert-nome').className = "to-hide";
    }

    if (validar == false) {
        return validar;
    } else {
        return validar;
    }
}

function editarData_nasc() {
    var validar = true;
    var data = document.getElementById("data").value;
    var anoAtual = new Date().getFullYear();
    var ano = data.split('/')[2];
    var idade = anoAtual - ano;

    if (data == "") {
        document.getElementById('alert-data').className = "alert";
        validar = false;
    }

    if (data != "") {
        document.getElementById('alert-data').className = "to-hide";
    }

    if (idade < 16) {
        document.getElementById('alert-idade').className = "alert";
        validar = false;
    }

    if (idade >= 16) {
        document.getElementById('alert-idade').className = "to-hide";
    }

    if (idade > 105) {
        document.getElementById('alert-idade1').className = "alert";
        validar = false;
    }

    if (idade <= 105) {
        document.getElementById('alert-idade1').className = "to-hide";
    }
    
    if (validar == false) {
        return validar;
    } else {
        return validar;
    }
}

function editarSenha() {
    var validar = true;
    var senha = document.getElementById("senha").value;
    var c_senha = document.getElementById("c_senha").value;

    if (senha == "") {
        document.getElementById('alert-senha').className = "alert";
        validar = false;
    }

    if (senha.length < 8) {
        document.getElementById('alert-senha').className = "alert";
        validar = false;
    }

    if (senha != "" & senha.length >= 8) {
        document.getElementById('alert-senha').className = "to-hide";
    }

    if (senha != c_senha) {
        document.getElementById('alert-c_senha1').className = "to-hide";
        document.getElementById('alert-c_senha2').className = "alert";
        validar = false;
    }

    if (c_senha == "") {
        document.getElementById('alert-c_senha1').className = "alert";
        document.getElementById('alert-c_senha2').className = "to-hide";
        validar = false;
    }

    if (senha == c_senha & c_senha != "") {
        document.getElementById('alert-c_senha1').className = "to-hide";
        document.getElementById('alert-c_senha2').className = "to-hide";
    }

    if (validar == false) {
        return validar;
    } else {
        return validar;
    }
}

function editarBio() {
    var validar = true;
    var bio = document.getElementById("bio").value;

    if (bio.length > 100) {
        document.getElementById('alert-bio').className = "alert";
        validar = false;
    }

    if (bio.length <= 100) {
        document.getElementById('alert-bio').className = "to-hide";
    }

    if (validar == false) {
        return validar;
    } else {
        return validar;
    }
}

/*deleta.php*/

function verificaExclusao() {
    var validar = true;
    var email = document.getElementById("email").value;
    var senha = document.getElementById("senha").value;


    if (email == "") {
        document.getElementById('alerta-email').className = "alert";
        validar = false;
    }

    if (email.indexOf('@') == -1) {
        document.getElementById('alerta-email').className = "alert";
        validar = false;
    }

    if (email.indexOf('.com') == -1) {
        document.getElementById('alerta-email').className = "alert";
        validar = false;
    }

    if (email != "" & email.indexOf('@') != -1 & email.indexOf('.com') != -1) {
        document.getElementById('alerta-email').className = "to-hide";
    }

    if (senha == "") {
        document.getElementById('alerta-senha').className = "alert";
        validar = false;
    }

    if (senha.length < 8) {
        document.getElementById('alerta-senha').className = "alert";
        validar = false;
    }

    if (senha != "" & senha.length >= 8) {
        document.getElementById('alerta-senha').className = "to-hide";
    }
    
    if (validar == false) {
        return validar;
    } else {
        return validar;
    }
}

/*menu_esquerdo.php*/

function verificaPostagem() {
    var validar = true;
    var titulo = document.getElementById("txTitulo").value;
    var postagem = document.getElementById("txPost").value;

    if (titulo == "") {
        document.getElementById('alert-titulo1').className = "alert";
        validar = false;
    }

    if (titulo.length > 50) {
        document.getElementById('alert-titulo2').className = "alert";
        validar = false;
    }

    if (titulo != "") {
        document.getElementById('alert-titulo1').className = "to-hide";
    }

    if (titulo.length <= 50) {
        document.getElementById('alert-titulo2').className = "to-hide";
    }

    if (postagem == "") {
        document.getElementById('alert-postagem').className = "alert";
        validar = false;
    }

    if (postagem != "") {
        document.getElementById('alert-postagem').className = "to-hide";
    }

    if (validar == false) {
        return validar;
    } else {
        return validar;
        window.location.href = 'posts.php';
    }
}

/*posts.php*/

/*function verificaComentario() {
    var validar = true;
    var comentario = document.getElementById("txcom").value;

    if (comentario == "") {
        document.getElementById('alert-com').className = "alert";
        validar = false;
    }

    if (comentario != "") {
        document.getElementById('alert-com').className = "to-hide";
    }

    if (validar == false) {
        return validar;
    } else {
        return validar;
    }
}*/

/*grupos.php*/

/*function verificaGrupo() {
    var validar = true;
    var nomeGrupo = document.getElementById("txNomeGrupo").value;
    var descricaoGrupo = document.getElementById("txDescricaoGrupo").value;
    var tipoGrupo = document.getElementById('optTipoGrupo').value;

    if (nomeGrupo == "") {
        document.getElementById('alert-nomeGrupo').className = "alert";
        validar = false;
    }

    if (nomeGrupo != "") {
        document.getElementById('alert-nomeGrupo').className = "to-hide";
    }
    if (descricaoGrupo == "") {
        document.getElementById('alert-descricaoGrupo').className = "alert";
        validar = false;
    }

    if (descricaoGrupo != "") {
        document.getElementById('alert-descricaoGrupo').className = "to-hide";
    }

    if (tipoGrupo = undefined) {
        document.getElementById('alert-optTipoGrupo').className = "alert";
    }

    if (tipoGrupo != "") {
        document.getElementById('alert-optTipoGrupo').className = "to-hide";
    }

    if (validar == false) {
        return validar;
    } else {
        return validar;
    }
}*/

function hiddenPop(){
    document.getElementById('pop-up').className = "pop-up-hidden";
}









