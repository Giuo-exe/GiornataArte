<?php
  session_start();

  include "connection.php";
 ?>


<html>
<body>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Lista Eventi</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/style2.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  </head>
  <body>
    <header>
      <nav>
        <div class="logo">
          <h4>Giornata Dell'Arte</h4>
        </div>
        <a href="logout.php">
          <div class="group">
            <div class="avatar">
              <h2 id="firstWord"></h2>
            </div>

            <div class="info">
              <h4><?php echo $_SESSION['nome'];?></h4>
              <h3>LogOut</h3>
            </div>
          </div>
        </a>
      </nav>
    </header>

    <div class="contenitore">
      <div class="w3-container">
        <h2>Lista Eventi</h2>
        <ul class="w3-ul w3-card-4">
          <?php PrendiDati(); ?>
        </ul>
      </div>
    </div>


    <p id="demo"></p>

  <script>
    function myFunction() {
      var txt;
      if (confirm("Press a button!")) {
        txt = "You pressed OK!";
      } else {
        txt = "You pressed Cancel!";
      }
      document.getElementById("demo").innerHTML = txt;
  }
      function Conferma(id,tema){
        var r = confirm("Sei sicuro di voler partecipare a "+tema+"?");
        if (r == true) {
          document.location.href="prenota.php?&id="+id;
        }
      }
    </script>

</body>
</html>

<?php

  function PrendiDati(){


    $lista="";

    $sql = "SELECT * FROM eventi";
    $conn = connect();
    $records=$conn->query($sql);

    if ( $records == TRUE) {
        //echo "<br>Query eseguita!";
    } else {
      die("Errore nella query: " . $conn->error);
    }
    //gestisco gli eventuali dati estratti dalla query
    if($records->num_rows == 0){
      echo "";
    }else{
      while($tupla=$records-> fetch_assoc()){
        $id=$tupla['id'];
        $tema=$tupla['tema'];
        $luogo=$tupla['luogo'];
        $professori=$tupla['professori'];
        $giorno=$tupla['giorno'];
        $ora=$tupla['ora'];
        $foto=$tupla['foto'];
        //creazione lista in modo dinamico
        $lista.=createEvents($id, $tema, $luogo, $professori , $giorno, $ora, $foto);
      }
      echo $lista;
    }
  }

  function createEvents($id, $tema, $luogo, $professori , $giorno, $ora, $foto){
    return "<li class='w3-bar'>
              <a href='prenota.php?id=$id'>
              <span class='w3-bar-item w3-button w3-white w3-xlarge w3-right'>✅</span>
                </a>
                <img src='img/$foto' class='w3-bar-item w3-circle w3-hide-small' style='width:85px'>
                <div class='w3-bar-item'>
                  <span class='w3-large'>$tema - $professori</span><br>
                  <span>$luogo    -     $giorno, $ora</span>
                </div>
              </span>
            </li>";
  }


?>
