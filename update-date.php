<?php
include_once 'conexao.php';

session_start();


if(isset($_POST['data_nasc'])) {
$data = $_POST['data_nasc'];
$data = date_create_from_format("d/m/Y", $data)->format("Y-m-d");
$stmt = $pdo->prepare("UPDATE usuarios SET data_nasc='" . $data . "' WHERE id='" . $_GET['id'] . "'");
$stmt ->execute();
header("Location: perfil.php");
}

$smt = $pdo->prepare("SELECT * FROM usuarios WHERE id='" . $_GET['id'] . "'");
$smt ->execute();
foreach($smt as $row){
        $data = $row['data_nasc'];
}
$data = date_create_from_format("Y-m-d", $data)->format("d/m/Y");
?>

<html>
<head>
<title>Alterar de data de nascimento</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js/jquery.mask.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
    $("#data").mask("00/00/0000")


});
</script>
</head>
<body>

        <form name="frmUser" method="post" action="" onsubmit="return editarData_nasc()">
        <a href="perfil.php">Voltar</a>
        <br>
        <label for="data_nasc">Alterar data de nascimento:</label>
        <br>
        <input type="text" name="data_nasc" id="data" value="<?php echo $data; ?>">
        <span id="alert-data" class="to-hide" role="alert">Preencha o campo data de nascimento</span>
        <span id="alert-idade" class="to-hide" role="alert">Voce não tem idade suficiente para usar essa rede social</span>
        <span id="alert-idade1" class="to-hide" role="alert">Insira uma data válida.</span>
        <br>
        <div>
        <input type="submit" name="submit" value="Salvar">
        </div>
        </form>
</body>
</html>