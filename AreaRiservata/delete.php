<?php
  session_start();

  include "connection.php";

  if(isset($_GET["id"])){
    $id=$_GET["id"];
    $matricola=$_SESSION["matricola"];


    $ris = eliminaPrenotazione($id,$matricola) ? "<h1> Eliminazione riuscita </h1>" : "<h1> Eliminazione non riuscita </h1>";

    echo $ris;

    header("refresh:3 url=index.php");
  }


  function eliminaPrenotazione($id,$matricola){
    $sql="DELETE from prenotazioni WHERE id_eventi='$id' and matricola='$matricola'";
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
