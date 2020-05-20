<?php
  session_start();

  include "connection.php";

  if(isset($_GET["id"])){
    $id=$_GET["id"];

    $matricola=$_SESSION["matricola"];

    $sql = "SELECT * FROM prenotazioni p WHERE p.matricola=$matricola and p.id_eventi=$id";
    $conn = connect();
    $records=$conn->query($sql);

    if ( $records == TRUE) {
        //echo "<br>Query eseguita!";
        if(empty($records)){
          echo "sdasdasd";
          if(InserisciPrenotazione($id,$matricola)){
            echo "<h1>Prenotazione Effettuata</h1>";
            header("refresh:2; url=index.php");
          }
        }else{
          echo "<h1>Prenotazione non Effettuata</h1>";
          header("refresh:2; url=index.php");
        }
    } else {
      die("Errore nella query: " . $conn->error);
    }
    //gestisco gli eventuali dati estratti dalla query
    if($records->num_rows == 0){
      echo "";
    }else{
      while($tupla=$records-> fetch_assoc()){
        $matricola=$tupla['matricola'];
        $id=$tupla['id_prenotazione'];
      }
    }
  }


  function InserisciPrenotazione($id,$matricola){
    $sql="INSERT INTO prenotazione ('matricola','id_prenotazione') VALUES ('$matricola','$id')";
      $conn=connect();
          if ($conn->query($sql) === TRUE) {
            $conn->close();
            return true;
          } else {
            echo "Errore nella query: " . $conn->error;
          }

      $conn->close();
      return false;
    }

 ?>
