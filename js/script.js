function checkPasswordStrength() {
var alphabets = /([a-zA-Z])/;
var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
var password = $('#password').val().trim();
if (password.length < 6) {
    $('#password-strength-status').removeClass();
    $('#password-strength-status').addClass('weak-password');
    $('#password-strength-status').html("Weak (should be atleast 6 characters.)");
} else {
    if (password.match(alphabets) && password.match(special_characters)) {
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

/*signup.php*/

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
    document.getElementById('alert-nome').className = "alerta";
    validar = false;
}

if (nome.length < 2) {
    document.getElementById('alert-nome').className = "alerta";
    validar = false;
}

if (nome != "" & nome.length > 2) {
    document.getElementById('alert-nome').className = "to-hide";
}

if (data == "") {
    document.getElementById('alert-data').className = "alerta";
    validar = false;
}

if (data != "") {
    document.getElementById('alert-data').className = "to-hide";
}

if (idade < 16) {
    document.getElementById('alert-idade').className = "alerta";
    validar = false;
}

if (idade >= 16) {
    document.getElementById('alert-idade').className = "to-hide";
}

if (idade > 105) {
    document.getElementById('alert-idade1').className = "alerta";
    validar = false;
}

if (idade <= 105) {
    document.getElementById('alert-idade1').className = "to-hide";
}

if (email == "") {
    document.getElementById('alert-email').className = "alerta";
    validar = false;
}

if (email.indexOf('@') == -1) {
    document.getElementById('alert-email').className = "alerta";
    validar = false;
}

if (email.indexOf('.com') == -1) {
    document.getElementById('alert-email').className = "alerta";
    validar = false;
}

if (email != "" & email.indexOf('@') != -1 & email.indexOf('.com') != -1) {
    document.getElementById('alert-email').className = "to-hide";
}

if (senha == "") {
    document.getElementById('alert-senha').className = "alerta";
    validar = false;
}

if (senha.length < 8) {
    document.getElementById('alert-senha').className = "alerta";
    validar = false;
}

if (senha != "" & senha.length >= 8) {
    document.getElementById('alert-senha').className = "to-hide";
}

if (senha != c_senha) {
    document.getElementById('alert-c_senha1').className = "to-hide";
    document.getElementById('alert-c_senha2').className = "alerta";
    validar = false;
}

if (c_senha == "") {
    document.getElementById('alert-c_senha1').className = "alerta";
    document.getElementById('alert-c_senha2').className = "to-hide";
    validar = false;
}

if (senha == c_senha & c_senha != "") {
    document.getElementById('alert-c_senha1').className = "to-hide";
    document.getElementById('alert-c_senha2').className = "to-hide";
}

if(concordar_termos.checked == false) {
    document.getElementById('alert-termos').className = "alerta";
    validar = false;
}

if(concordar_termos.checked == true) {
    document.getElementById('alert-termos').className = "to-hide";
}

return validar;
}

/*login.php*/

function verificaLogin() {
var validar = true;
var email = document.getElementById("email").value;
var senha = document.getElementById("senha").value;


if (email == "") {
    document.getElementById('alert-email').className = "alerta";
    validar = false;
}

if (email.indexOf('@') == -1 & email.indexOf('.com') == -1) {
    document.getElementById('alert-email').className = "alerta";
    validar = false;
}

if (email != "" & email.indexOf('@') != -1 & email.indexOf('.com') != -1) {
    document.getElementById('alert-email').className = "to-hide";
}

if (senha == "") {
    document.getElementById('alert-senha').className = "alerta";
    validar = false;
}

if (senha.length < 8) {
    document.getElementById('alert-senha').className = "alerta";
    validar = false;
}

if (senha != "" & senha.length >= 8) {
    document.getElementById('alert-senha').className = "to-hide";
}

return validar;
}

/*update.php*/

function editarDados() {
var validar = true;
var nome = document.getElementById("nome").value;
var bio = document.getElementById("bio").value;
var data = document.getElementById("data").value;
var anoAtual = new Date().getFullYear();
var ano = data.split('/')[2];
var idade = anoAtual - ano;
var dia = data[0]+data[1];
var mes = data[3]+data[4];

if (nome == "") {
    document.getElementById('alert-nome').className = "alerta";
    validar = false;
}

if (nome.length <= 2) {
    document.getElementById('alert-nome').className = "alerta";
    validar = false;
}

if (nome != "" & nome.length > 2) {
    document.getElementById('alert-nome').className = "to-hide";
}

if (data == "") {
    document.getElementById('alert-data').className = "alerta";
    validar = false;
}

if (data != "") {
    document.getElementById('alert-data').className = "to-hide";
}

if (idade < 16) {
    document.getElementById('alert-idade').className = "alerta";
    validar = false;
}

if (idade >= 16) {
    document.getElementById('alert-idade').className = "to-hide";
}

if (idade > 105) {
    document.getElementById('alert-idade1').className = "alerta";
    validar = false;
}

if (idade <= 105) {
    document.getElementById('alert-idade1').className = "to-hide";
}

if(dia > 31 || mes > 12 || dia == 00 || mes == 00){
    document.getElementById('alert-idade1').className = "alerta";
    validar = false;
}

return validar;
}

function editarGrupo() {
    var validar = true;
    var nome_grupo = document.getElementById("nome_grupo").value;
    var descricao_grupo = document.getElementById("descricao_grupo").value;
    
    if (nome_grupo == "") {
        document.getElementById('alert-nome_grupo').className = "alerta";
        validar = false;
    }
    
    if (nome_grupo.length <= 2) {
        document.getElementById('alert-nome_grupo').className = "alerta";
        validar = false;
    }
    
    if (nome_grupo != "" & nome_grupo.length > 2) {
        document.getElementById('alert-nome_grupo').className = "to-hide";
    }

    if (descricao_grupo == "") {
        document.getElementById('alert-descricao_grupo').className = "alerta";
        validar = false;
    }
    
    if (descricao_grupo.length <= 2) {
        document.getElementById('alert-descricao_grupo').className = "alerta";
        validar = false;
    }
    
    if (descricao_grupo != "" & descricao_grupo.length > 2) {
        document.getElementById('alert-descricao_grupo').className = "to-hide";
    }

    return validar;
}

function editarSenha() {
var validar = true;
var senha = document.getElementById("senha").value;
var c_senha = document.getElementById("c_senha").value;

if (senha == "") {
    document.getElementById('alert-senha').className = "alerta";
    validar = false;
}

if (senha.length < 8) {
    document.getElementById('alert-senha').className = "alerta";
    validar = false;
}

if (senha != "" & senha.length >= 8) {
    document.getElementById('alert-senha').className = "to-hide";
}

if (senha != c_senha) {
    document.getElementById('alert-c_senha1').className = "to-hide";
    document.getElementById('alert-c_senha2').className = "alerta";
    validar = false;
}

if (c_senha == "") {
    document.getElementById('alert-c_senha1').className = "alerta";
    document.getElementById('alert-c_senha2').className = "to-hide";
    validar = false;
}

if (senha == c_senha & c_senha != "") {
    document.getElementById('alert-c_senha1').className = "to-hide";
    document.getElementById('alert-c_senha2').className = "to-hide";
}

return validar;
}

/*deleta.php*/

function verificaExclusao() {
var validar = true;
var email = document.getElementById("email").value;
var senha = document.getElementById("senha").value;


if (email == "") {
    document.getElementById('alerta-email').className = "alerta";
    validar = false;
}

if (email.indexOf('@') == -1) {
    document.getElementById('alerta-email').className = "alerta";
    validar = false;
}

if (email.indexOf('.com') == -1) {
    document.getElementById('alerta-email').className = "alerta";
    validar = false;
}

if (email != "" & email.indexOf('@') != -1 & email.indexOf('.com') != -1) {
    document.getElementById('alerta-email').className = "to-hide";
}

if (senha == "") {
    document.getElementById('alerta-senha').className = "alerta";
    validar = false;
}

if (senha.length < 8) {
    document.getElementById('alerta-senha').className = "alerta";
    validar = false;
}

if (senha != "" & senha.length >= 8) {
    document.getElementById('alerta-senha').className = "to-hide";
}
$('#ModalLongoExemplo').modal('hide');
return validar;
}

/*menu_esquerdo.php*/

function verificaPostagem() {
var validar = true;
var titulo = document.getElementById("txTitulo").value;
var postagem = document.getElementById("txPost").value;

if (titulo == "") {
    document.getElementById('alert-titulo1').className = "alerta-postagem";
    validar = false;
}

if (titulo.length > 50) {
    document.getElementById('alert-titulo2').className = "alerta-postagem";
    validar = false;
}

if (titulo != "") {
    document.getElementById('alert-titulo1').className = "to-hide";
}

if (titulo.length <= 50) {
    document.getElementById('alert-titulo2').className = "to-hide";
}

if (postagem == "") {
    document.getElementById('alert-post').className = "alerta-postagem";
    validar = false;
}

if (postagem != "") {
    document.getElementById('alert-post').className = "to-hide";
}

if (postagem.length > 500) {
    document.getElementById('alert-post2').className = "alerta-postagem";
    validar = false;
}

if (postagem.length <= 500) {
    document.getElementById('alert-post2').className = "to-hide";
}

return validar;
}

function cronometro(segs) {
min = 0;
hr = 0;
segs_c = 0;
min_c = 0;
hr_c = 0;
min_a = min;

while (segs >= 60) {
    if (segs >= 60) {
        segs = segs - 60;
        min = min + 1;
        min_a = min_a + 1;
    }
}

var verificar_tempo = min_a/30;

if(Number.isInteger(verificar_tempo) == true && segs == 0){
    $(document).ready(function(){
        $('#modal-cronometro').modal('show');
    });
}

while (min >= 60) {
    if (min >= 60) {
        min = min - 60;
        hr = hr + 1;
    }
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

function meusPosts(){
document.getElementById('meusamigos').className = "to-hide";
document.getElementById('meusposts').className = "";
}

function meusAmigos(){
document.getElementById('meusposts').className = "to-hide";
document.getElementById('meusamigos').className = "";
}

function grupoPosts(){
document.getElementById('grupomembros').className = "to-hide";
document.getElementById('grupoposts').className = "";
}
    
function grupoMembros(){
document.getElementById('grupoposts').className = "to-hide";
document.getElementById('grupomembros').className = "";
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

/*grupos.php*/

function verificaGrupo() {
var validar = true;
var nomeGrupo = document.getElementById("txNomeGrupo").value;
var descGrupo = document.getElementById("txDescricaoGrupo").value;
var tipo = document.getElementById("optTipoGrupo").value;

if (nomeGrupo == "") {
    document.getElementById('alert-nome1').className = "alerta";
    validar = false;
}

if (nomeGrupo.length > 50) {
    document.getElementById('alert-nome2').className = "alerta";
    validar = false;
}

if (nomeGrupo != "") {
    document.getElementById('alert-nome1').className = "to-hide";
}

if (nomeGrupo.length <= 50) {
    document.getElementById('alert-nome2').className = "to-hide";
}

if (descGrupo == "") {
    document.getElementById('alert-desc1').className = "alerta";
    validar = false;
}

if (descGrupo != "") {
    document.getElementById('alert-desc1').className = "to-hide";
}

if (descGrupo.length > 500) {
    document.getElementById('alert-desc2').className = "alerta";
    validar = false;
}

if (descGrupo.length <= 500) {
    document.getElementById('alert-desc2').className = "to-hide";
}

if(tipo == ""){
    document.getElementById('alert-tipo').className = "alerta";
    validar = false;
}

if(tipo != ""){
    document.getElementById('alert-tipo').className = "to-hide";
}

return validar;
}