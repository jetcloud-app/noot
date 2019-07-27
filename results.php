<?php
session_start();
if((!isset ($_SESSION['usuarioEmail']) == true) and (!isset ($_SESSION['usuarioSenha']) == true)) {
  header('location:index.php');
}

$dbhost = '127.0.0.1';
$dbuser = 'blacksoul';
$dbpass = '';
$dbname = 'provas';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
   
$xs = $_POST['total'];

if(! $conn ) {
    die('Não foi possível se conectar: ' . mysqli_error());
}

$data = date('d/m/Y H:i');
$idUser =  $_SESSION['usuarioId'];
$correct = 0;
$wrong = 0;

for($x = 1; $x <= $xs; $x++) {
    $item = $_POST['question' . $x];
                    
    $alternative =
    $question = substr($item, 0, -1);
                    
    $sql = 'SELECT * FROM questions WHERE question LIKE "%'. $question .'%"';
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                   
    if ($row["alternative"] == $alternative) {
        $correct ++;
    } else {
        $wrong ++;
    }
            
}

$sql2 = "INSERT INTO resolved (id, id_user, corrects, wrong, date)
                VALUES (NULL, '$idUser', '$correct', '$wrong', '$data')";
if(mysqli_query($conn, $sql2)){
    header('location: panel');
} else{
    echo "ERROR: Could not able to execute $sql2. " . mysqli_error($conn);
}
mysqli_close($conn);


