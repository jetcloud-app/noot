<?php
session_start();
if((!isset ($_SESSION['usuarioEmail']) == true) and (!isset ($_SESSION['usuarioSenha']) == true)) {
  header('location:index.php');
}

include_once('scripts/functions.php');

function geraNumeros($quantidade, $minimo, $maximo) {
	$listaDeNumeros = range($minimo, $maximo);
	$numeros = array_rand(array_flip($listaDeNumeros), $quantidade);
 
	return $numeros;
}

$xs = $_POST['questionInput']; 
                
if($xs >= 1) {
    $caixaQuestion = 'hide';
    $submitQuestion = 'show';
    $mensagem = "Simulado Criado Com Sucesso!";
    $type = "Mensagem";
} else {
   $caixaQuestion = 'show';
   $submitQuestion = 'hide';
    $mensagem = "Erro ao Criar Simulado!";
    $type = "Erro";
}
                
?>

<!DOCTYPE html>
<html>
<title>Noot - Simulador</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="scripts/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="scripts/other.css">
<script type="text/javascript" src="scripts/functions.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<style>
html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
</style>
<body class="w3-theme-l5">
          <?php
            if ($_GET['op'] >= 1) {
                caixaMensagem ($mensagem, $type);
            }
        ?>
<!-- Navbar -->
<div class="w3-top">
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
  <a target="_blank" href="http://www.noot.rf.gd/" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fas fa-infinity"></i> Noot</a>
  <a href="panel" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Inicio"><i class="fa fa-home"></i> Início</a>
  <a href="simulator" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Simulador"><i class="fa fa-envelope-open-text"></i> Simulador</a>
  <a href="link" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Links"><i class="fas fa-link"></i> Links</a>
  <div class=" w3-right w3-dropdown-hover w3-hide-small">
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-xlarge w3-hover-white" title="Minha Conta">
      <img src="images/<?php echo $_SESSION['usuarioGenero']; ?>.png" class="w3-circle" style="height:23px;width:23px" alt="Avatar">
    </a>
    <div class="w3-dropdown-content w3-card-4 w3-bar-block w3-right" style="width:300px; margin-top: 50px;">
      <div class="w3-card w3-round w3-white">
        <div class="w3-container">
         <p class="w3-center"><img src="images/<?php echo $_SESSION['usuarioGenero']; ?>.png" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
         
          <p class="w3-center"><?php echo $_SESSION['usuarioNome']; ?></p>
          <hr class="w3-border-top">
          <a href="configuration" class="w3-bar-item w3-button"><i class="fa fa-cogs w3-margin-right w3-text-theme"></i> Configurações</a>
          <a href="statics" class="w3-bar-item w3-button"><i class="fas fa-chart-pie w3-margin-right w3-text-theme"></i> Estatísticas</a>
          <a href="relog" class="w3-bar-item w3-button w3-red-hover"><i class="fa fa-power-off w3-margin-right w3-text-theme"></i> Desconectar</a>
        </div>
      </div>
    </div>
  </div>
 </div>
</div>

<!-- Navbar on small screens -->
<div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
  <a href="http://www.noot.rf.gd/" class="w3-bar-item w3-button w3-padding-large"><i class="fas fa-infinity"></i> Noot</a>
  <a href="panel" class="w3-bar-item w3-button w3-padding-large"><i class="fa fa-home"></i> Início</a>
  <a href="simulator" class="w3-bar-item w3-button w3-padding-large"><i class="fa fa-envelope-open-text"></i> Simulador</a>
  <a href="link" class="w3-bar-item w3-button w3-padding-large"><i class="fas fa-link"></i> Links</a>
</div>

<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">    
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Middle Column -->
    <div class="w3-col">
    
      <div class="w3-row-padding w3-magin-bottom w3-<?php echo $caixaQuestion; ?>">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <form class="w3-container w3-padding" method="POST" action="simulator?op=2163c56625ddfae982e5e91ba154592f">
              <h6 class="w3-opacity">Quantas questões você quer fazer?</h6>
              <input name="questionInput" type="text" class="w3-input w3-border" placeholder="Ex: 20"/>
              <button type="submit" class="w3-button w3-theme w3-margin-top"><i class="fas fa-sync-alt"></i> Gerar Simulado</button> 
            </form>
          </div>
        </div>
      </div>
      
      <div class="w3-row-padding w3-magin-bottom w3-<?php echo $submitQuestion; ?>">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding" method="POST" action="simulator">
              <h4><i class="fas fa-file-alt fa-fw w3-text-theme w3-margin-right"></i>Simulado de <?php echo $xs; ?> Questões:</h4>
            </div>
          </div>
        </div>
      </div>
      
      <form method="post" action="results.php">
            <?php
                for($x = 1; $x <= $xs; $x++) {
                    $year = geraNumeros(1, 2009, 2009);
                    $question = geraNumeros(1, 1, 90);
                    
                    $file = "questions/" . $year . '/question.' . $question . 'b.jpg';
                    echo '<input type="hidden" name="total" value="'.$xs.'"/>';
                    
                    if (file_exists($file)) {
                        echo '<div class="w3-container w3-card w3-white w3-round w3-margin"><br>';
                        echo '<span class="w3-opacity">Questão'.$x.'</span><br>';
                        echo '<img style="width: 100%;" src="questions/' . $year . '/question.' . $question . '.jpg" />';
                        echo '<img style="width: 100%;" src="questions/' . $year . '/question.' . $question . 'b.jpg" />';
                        echo '<div class=""><hr>';
                        echo '<input class="w3-margin-left" type="radio" name="question'.$x.'" value="' . $year . $question . 'a"> Alternativa A<hr class="w3-border-top">';
                        echo '<input class="w3-margin-left" type="radio" name="question'.$x.'" value="' . $year . $question . 'b"> Alternativa B<hr class="w3-border-top">';
                        echo '<input class="w3-margin-left" type="radio" name="question'.$x.'" value="' . $year . $question . 'c"> Alternativa C<hr class="w3-border-top">';
                        echo '<input class="w3-margin-left" type="radio" name="question'.$x.'" value="' . $year . $question . 'd"> Alternativa D<hr class="w3-border-top">';
                        echo '<input class="w3-margin-left" type="radio" name="question'.$x.'" value="' . $year . $question . 'e"> Alternativa E<hr class="w3-border-white">';
                        echo '</div>';
                        echo '</div>';
                    } else {
                        echo '<div class="w3-container w3-card w3-white w3-round w3-margin"><br>';
                        echo '<span class="w3-opacity">Questão '.$x.'</span><br>';
                        echo '<img style="width: 100%;" src="questions/' . $year . '/question.' . $question . '.jpg" />';
                        
                        echo '<div class=""><hr>';
                        echo '<input class="w3-margin-left" type="radio" name="question'.$x.'" value="' . $year . $question . 'a"> Alternativa A<hr class="w3-border-top">';
                        echo '<input class="w3-margin-left" type="radio" name="question'.$x.'" value="' . $year . $question . 'b"> Alternativa B<hr class="w3-border-top">';
                        echo '<input class="w3-margin-left" type="radio" name="question'.$x.'" value="' . $year . $question . 'c"> Alternativa C<hr class="w3-border-top">';
                        echo '<input class="w3-margin-left" type="radio" name="question'.$x.'" value="' . $year . $question . 'd"> Alternativa D<hr class="w3-border-top">';
                        echo '<input class="w3-margin-left" type="radio" name="question'.$x.'" value="' . $year . $question . 'e"> Alternativa E<hr class="w3-border-white">';
                        echo '</div>';
                        echo '</div>';;
                    }
                    
                    $year = null;
                    $question = null;
                } 
            ?>

          
    
          <div class="w3-container w3-card w3-white w3-round w3-margin w3-<?php echo $submitQuestion; ?>"><br>
            <button style="width: 100%;" type="submit" class="w3-button w3-theme w3-margin-bottom"><i class="fas fa-asterisk"></i> Corrigir Questões</button>
          </div> 
        </form>
      
    <!-- End Middle Column -->
    </div>
  <!-- End Grid -->
  </div>
  
<!-- End Page Container -->
</div>
<br>
 
<script>
// Accordion
function myFunction(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-theme-d1";
  } else { 
    x.className = x.className.replace("w3-show", "");
    x.previousElementSibling.className = 
    x.previousElementSibling.className.replace(" w3-theme-d1", "");
  }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>

</body>
</html> 
