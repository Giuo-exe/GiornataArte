<?php
session_start();
  include "connection.php";

  $matricola;

  //da levare
  echo "ciao";

  if (!empty($_POST["matricola"])) {
      $matricola=$_POST["matricola"];
      //da levare
      echo $matricola;
      EstraiDati($matricola);
  }else if(isset($_COOKIE["matricola"])) {
      //da levare
      echo $matricola;
      $matricola=$_COOKIE["matricola"];
      EstraiDati($matricola);
  }

  function EstraiDati($matricola){
    $sql = "SELECT s.* FROM studente s WHERE s.matricola='$matricola'";
    $conn=connect();
    $records=$conn->query($sql);
    if ( $records == TRUE) {
        //echo "<br>Query eseguita!";
    } else {
      die("Errore nella query: " . $conn->error);
    }
		//gestisco gli eventuali dati estratti dalla query
		if($records->num_rows == 0){
			echo "la query non ha prodotto risultato";
    }else{
			while($tupla=$records-> fetch_assoc()){
				$m=$tupla['matricola'];
				$n=$tupla['nome'];
        $c=$tupla['cognome'];
        $cl=$tupla['classe'];
			}
      echo $matricola;
      auth($matricola,$m,$n,$c,$cl);
		}
  }

  function auth($matricola,$m,$n,$c,$cl){
    if($matricola==$m){
      settacookie($matricola);
      createToken($matricola);
      settasessione($matricola,$m,$n,$c,$cl);
      header("Location: AreaRiservata\index.php");
    }else{
      echo
      "<html>
        <head>
          <link rel='stylesheet' type='text/css' href='css/style.css'>
        </head>
        <body>
          <a href='index.php'>
            <h5>Matricola non corretta</h5>
          </a>
        </body>
      </html>";
    }
  }

  function settacookie($matricola){
    if(!isset($_COOKIE["matricola"])) {
      setcookie("matricola", $matricola, time() + (60 * 30), "/");
    }
  }

  function createToken($matricola){
    $random=rand(0,100000);
    $token=md5($matricola.$random);
    setcookie("token", $token, time() + (60 * 30), "/");
    $_SESSION["token"]=$_COOKIE["token"];
  }

  function settasessione($matricola,$m,$n,$c,$cl){
    $_SESSION["matricola"]=$m;
    $_SESSION["nome"]=$n;
    $_SESSION["cognome"]=$c;
    $_SESSION["classe"]=$cl;

  }


 ?>
