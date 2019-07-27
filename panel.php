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

if(! $conn ) {
    die('Não foi possível se conectar: ' . mysqli_error());
}

$sql = 'SELECT * FROM resolved WHERE id_user LIKE "%'. $_SESSION['usuarioId'] .'%"';

if ($result = mysqli_query($conn, $sql)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $correct = $correct + $row['corrects'];
        $wrong = $wrong + $row['wrong'];
    }
    
    if($correct == 0) {
      $correct = 0;
    }
    
    if($wrong == 0) {
      $wrong = 0;
    }

    $all = $correct + $wrong;
    mysqli_free_result($result);
}
?>

<!DOCTYPE html>
<html>
<title>Noot - Painel</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="scripts/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<style>
html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
</style>
<body class="w3-theme-l5">
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
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
      <div class="w3-card w3-round w3-white">
        <div class="w3-container">
         <h4 class="w3-center"><?php echo $_SESSION['usuarioNome']; ?></h4>
         <p class="w3-center"><img src="images/<?php echo $_SESSION['usuarioGenero']; ?>.png" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
         <hr>
         <p onclick="myFunction('Demo1')" title="Detalhe de Questões" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fas fa-file-alt fa-fw"></i> Questões:</p>
         <div id="Demo1" class="w3-hide w3-show">
           <p title="Questões Resolvidas"><i class="fas fa-pencil-alt fa-fw w3-margin-right w3-margin-left w3-text-theme"></i><?php echo $all; ?> Resolvidas</p>
           <p title="Questões Corretas"><i class="fas fa-check fa-fw w3-margin-right w3-margin-left w3-text-theme"></i><?php echo $correct; ?> Corretas</p>
           <p title="Questões Erradas"><i class="fas fa-times fa-fw w3-margin-right w3-margin-left w3-text-theme"></i><?php echo $wrong; ?> Erradas</p>
         </div>
        </div>
      </div>
      <br>
  
      <!-- Interests --> 
      <div class="w3-card w3-round w3-white w3-hide-small">
        <div class="w3-container">
          <p>ADS</p>
          <p>
            <span class="w3-tag w3-small w3-theme-d5">News</span>
            <span class="w3-tag w3-small w3-theme-d4">W3Schools</span>
            <span class="w3-tag w3-small w3-theme-d3">Labels</span>
            <span class="w3-tag w3-small w3-theme-d2">Games</span>
            <span class="w3-tag w3-small w3-theme-d1">Friends</span>
            <span class="w3-tag w3-small w3-theme">Games</span>
            <span class="w3-tag w3-small w3-theme-l1">Friends</span>
            <span class="w3-tag w3-small w3-theme-l2">Food</span>
            <span class="w3-tag w3-small w3-theme-l3">Design</span>
            <span class="w3-tag w3-small w3-theme-l4">Art</span>
            <span class="w3-tag w3-small w3-theme-l5">Photos</span>
          </p>
        </div>
      </div>
      <br>
    <!-- End Left Column -->
    </div>
    
    <!-- Middle Column -->
    <div class="w3-col m7">

      
      <?php 
      $xr = 1;
      if ($result = mysqli_query($conn, $sql)) {
          while ($row = mysqli_fetch_assoc($result)) {
          $xn++;
          
          if ($xn == 1) {
            $class = "w3-container w3-card w3-white w3-round w3-margin-left w3-margin-right";
          } else {
            $class = "w3-container w3-card w3-white w3-round w3-margin";
          }
          

          $all = $row["corrects"] + $row["wrong"];
          $corrects = $row["corrects"];
          $wrongs = $row["wrong"];
          
          echo '<div class="'.$class.'"><br>';
          echo '<span class="w3-right w3-opacity">'.$row["date"].'</span>';
          echo '<h4>Resultado do '.$xr++.'º Simulado</h4>';
          echo '<hr class="w3-border-top">';
          //Parte escrita
          echo '<div class="w3-half">';
          echo '<p><i class="fas fa-pencil-alt w3-text-theme w3-margin-right"></i>Quantidade de Questões: '.$all.'</p>';
          echo '<p><i class="fas fa-check w3-text-theme w3-margin-right"></i>Questões Corretas: '.$corrects.'</p>';
          echo '<p><i class="fas fa-times w3-text-theme w3-margin-right"></i>Questões Erradas: '.$wrongs.'</p>';
          echo '</div>';
          //Parte Grafico
          $porcetCorrect = (($corrects / $all) * 100);
          $porcetWrong = (($wrongs / $all) * 100);
          echo '<div class="w3-half">';
          echo '<h4><i class="w3-text-theme fas fa-chart-pie w3-margin-right"></i>Gráfico:</h4>';
          echo '<span class="w3-green w3-margin-top w3-center" style="height: 20px; width: '.$porcetCorrect.'%; display: block;">'.$porcetCorrect.'%</span>';
          echo '<span class="w3-red w3-margin-top w3-margin-bottom w3-center" style="height: 20px; width: '.$porcetWrong.'%; display: block;">'.$porcetWrong.'%</span>';
          echo '</div>';
          echo '</div>';
          }
      
          $all = $correct + $wrong;
          mysqli_free_result($result);
      }
        mysqli_close($conn);
      
        if ($all == 0) {
          echo '<div class="w3-container w3-margin-left w3-margin-right w3-card w3-round w3-white">';
          echo '<h4 class="w3-margin-top">Leia-me</h4>';
          echo '<hr class="w3-border-top">';
          echo '<p>Seja muito bem-vindo <b>' . $_SESSION['usuarioNome'] . '</b>!</p>';
          echo '<p>Aqui você verá seu historico de questões!<br />';
          echo 'Mas ainda não temos nada para mostrar! Para que você veja seu historico, é so clicar no botão Simulador presente no menu acima!</p>';
          echo '<br />Use e desfrute do <b>Noot</b>! Temos certeza que ele irá ajudar muito em seus estudos!</p>';
          echo '<p><b>Ass. Equipe de desenvolvimento Noot.</b></p>';
          echo '</div>';
        }
        

      ?>
      
    <!-- End Middle Column -->
    </div>
    
    <!-- Right Column -->
    <div class="w3-col m2">
      <div class="w3-card w3-round w3-white w3-center">
        <div class="w3-container">
          <p>Upcoming Events:</p>
          <img src="/w3images/forest.jpg" alt="Forest" style="width:100%;">
          <p><strong>Holiday</strong></p>
          <p>Friday 15:00</p>
          <p><button class="w3-button w3-block w3-theme-l4">Info</button></p>
        </div>
      </div>
      <br>
      
      <div class="w3-card w3-round w3-white w3-center">
        <div class="w3-container">
          <p>Friend Request</p>
          <img src="/w3images/avatar6.png" alt="Avatar" style="width:50%"><br>
          <span>Jane Doe</span>
          <div class="w3-row w3-opacity">
            <div class="w3-half">
              <button class="w3-button w3-block w3-green w3-section" title="Accept"><i class="fa fa-check"></i></button>
            </div>
            <div class="w3-half">
              <button class="w3-button w3-block w3-red w3-section" title="Decline"><i class="fa fa-remove"></i></button>
            </div>
          </div>
        </div>
      </div>
      <br>
      
      <div class="w3-card w3-round w3-white w3-padding-16 w3-center">
        <p>ADS</p>
      </div>
      <br>
      
      <div class="w3-card w3-round w3-white w3-padding-32 w3-center">
        <p><i class="fa fa-bug w3-xxlarge"></i></p>
      </div>
      
    <!-- End Right Column -->
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
