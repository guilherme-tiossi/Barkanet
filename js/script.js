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

function checkPasswordStrength() {
	var number = /([0-9])/;
	var alphabets = /([a-zA-Z])/;
	var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
	var password = $('#password').val().trim();
	if (password.length < 6) {
		$('#password-strength-status').removeClass();
		$('#password-strength-status').addClass('weak-password');
		$('#password-strength-status').html("Weak (should be atleast 6 characters.)");
	} else {
		if (password.match(number) && password.match(alphabets) && password.match(special_characters)) {
			$('#password-strength-status').removeClass();
			$('#password-strength-status').addClass('strong-password');
			$('#password-strength-status').html("Strong");
		}
		else {
			$('#password-strength-status').removeClass();
			$('#password-strength-status').addClass('medium-password');
			$('#password-strength-status').html("Medium (should include alphabets, numbers and special characters.)");
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
        document.getElementById('alert-titulo1').className = "alert m-0 p-0";
        validar = false;
    }

    if (titulo.length > 50) {
        document.getElementById('alert-titulo2').className = "alert m-0 p-0";
        validar = false;
    }

    if (titulo != "") {
        document.getElementById('alert-titulo1').className = "to-hide";
    }

    if (titulo.length <= 50) {
        document.getElementById('alert-titulo2').className = "to-hide";
    }

    if (postagem == "") {
        document.getElementById('alert-postagem').className = "alert m-0 p-0";
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

function hiddenPop(){
    document.getElementById('pop-up').className = "pop-up-hidden";
}


function cronometro(segs) {
    min = 0;
    hr = 0;
    segs_c = 0;
    min_c = 0;
    hr_c = 0;
    min_a = 30;

    while (segs >= 60) {
        if (segs >= 60) {
            segs = segs - 60;
            min = min + 1;
        }
    }


    while (min >= 60) {
        if (min >= 60) {
            min = min - 60;
            hr = hr + 1;
        }
    }

    if(min_a == min && segs == 0){
        min_a = min_a - 1;
        $(document).ready(function(){
            $('#modal-cronometro').modal('show');
        });
    }

    if(hr == 1 && min == 0 && segs == 0){
        $(document).ready(function(){
            //$('#modal-cronometro').modal('show');
        });
    }

    if(hr_a < hr && hr != 1){
        $(document).ready(function(){
            //$('#modal-cronometro').modal('show');
        });
        hr_a = hr
    }

    if (hr < 10) {
        hr_c = "0" + hr
    }
    if (hr >= 10) {
        hr_c = hr
        fin = hr_c + ":" + min_c + ":" + segs_c
    }
    if (min < 10) {
        min_c = "0" + min
    }
    if (min >= 10) {
        min_c = min
        fin = hr_c + ":" + min_c + ":" + segs_c
    }
    if (segs < 10) {
        segs_c = "0" + segs
        fin = hr_c + ":" + min_c + ":" + segs_c
    }
    if (segs >= 10) {
        segs_c = segs
        fin = hr_c + ":" + min_c + ":" + segs_c
    }

    total = (hr * 3600) + (min * 60) + segs

    return fin;
}

var segundos = 0;
var hr_a = 1;

if (localStorage.getItem('tempo') == null) {
    segundos = 0;
} else {
    segundos = localStorage.getItem('tempo');
}

function conta() {
    segundos++;

    document.getElementById("cronometro").innerHTML = cronometro(segundos);
    document.getElementById("cronometro-modal").innerHTML = cronometro(segundos);
    localStorage.setItem("tempo", total);
}

function inicia() {
    interval = setInterval("conta();", 1000);
}

inicia()

function reset() {
    localStorage.setItem("tempo", 0);
}

function grupos(){
    document.getElementById('meusgrupos').className = "to-hide";
    document.getElementById('grupos').className = "";
}

function meusgrupos(){
    document.getElementById('grupos').className = "to-hide";
    document.getElementById('meusgrupos').className = "";
}

function mostraropcoesgrupos() {
    document.getElementById('editgrupo').className = "card-fundo pt-1";
    document.getElementById('infogrupo').className = "to-hide";
}

function mostraropcoesperfil() {
    document.getElementById('edituser').className = "card-fundo pt-1";
    document.getElementById('infouser').className = "to-hide";
}

function fecharAlerta(){
    document.getElementById('modal-cronometro').className = "to-hide";
}

document.addEventListener('click', function handleClickOutsideBox(event) {
    const box = document.getElementById('searchresult');  
    if (!box.contains(event.target)) {
      box.style.display = 'none';
    }
  });
  
document.addEventListener('click', function handleClickOutsideBox(event) {
    const boxx = document.getElementById('live_search');
    const box = document.getElementById('searchresult');
    if (boxx.contains(event.target)) {
      box.style.display = '';
    }
  });
