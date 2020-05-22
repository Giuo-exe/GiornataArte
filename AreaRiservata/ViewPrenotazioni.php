<?php
session_start();

include "ClasseEvento.php";
include "connection.php";

function prendidati(){
    $ownuser= $_SESSION['matricola'];
    $sql = "SELECT * from prenotazioni p join eventi e on p.id_eventi=e.id where p.matricola=$ownuser";
    $conn=connect();
    $records=$conn->query($sql);

    if ( $records == TRUE) {
        //echo "<br>Query eseguita!";
    } else {
      die("Errore nella query: " . $conn->error);
    }
    //gestisco gli eventuali dati estratti dalla query
    if($records->num_rows == 0){
      echo "<h1 id='presente'>Non ti sei prenotato a niente</h1>";
    }else{
      if($records){
        while($tupla=$records-> fetch_assoc()){
          $id=$tupla['id'];
          $tema=$tupla['tema'];
          $luogo=$tupla['luogo'];
          $professori=$tupla['professori'];
          $giorno=$tupla['giorno'];
          $ora=$tupla['ora'];
          $foto=$tupla['foto'];
          $oggetto = new eventi($id,$tema,$luogo,$professori,$giorno,$ora,$foto);
          $preno[] = $oggetto;
        }
        return $preno;
      }else{
        echo "<h1>Non c'è niente da mostrare</h1>";
      }
    }
  }

  function tabella(){
    $prenotazioni=prendidati();
    $oggi = date("Y-m-d");     //date("h:i", strtotime(
    if(!empty($prenotazioni)){
      $Attributi = Array("Tema","Luogo","Professori","Giorno","Ora","Operazione");


      $tabella = "<table class='content-table'>";

      $tabella.= "<thead><tr>";

      foreach($Attributi as $a) {
        $tabella .= "<th class='header'><h4>$a</h4></th>";
      }

      $tabella.= "</tr></thead>";

      $tabella.="<tbody>";

      foreach($prenotazioni as $a){

        $id = $a -> getId();

        // $or = date("Y-m-d", strtotime($now) < date("Y-m-d") ? "<h4 id: '#passato' >Giorni passati</h4>" : (date("Y-m-d", strtotime($now) == date("Y-m-d")) ? "<h4 id='oggi'>".date("h:i:sa", strtotime($now))."</h4>" : "<h4 id='futuro'>Prossimamente</h4>"));
        //da rivedere
        $tabella.= "<tr>";

        $tabella.= "<td>".$a -> getTema()."</td>".
          "<td>".$a -> getLuogo()."</td>".
          "<td>".$a -> getProfessori()."</td>".
          "<td>".$a -> getGiorno()."</td>".
          "<td>".$a -> getOra()." </td>".
          "<td><a href='delete.php?id=$id'>❌</a></td>";
        $tabella.="</tr>";
      }

      $tabella.="</tbody>";
      $tabella.="</table>";

      echo $tabella;
    }else{

    }
  }
    ?>
    <html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Cronologia Stampe</title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/stylePrenotazioni.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
    <body>
      <div class='ripple-background'>
        <div class='circle xxlarge shade1'></div>
        <div class='circle xlarge shade2'></div>
        <div class='circle large shade3'></div>
        <div class='circle mediun shade4'></div>
        <div class='circle small shade5'></div>
      </div>

      <center><h1 id="oggi">Prenotazione</h1></center>
      <?php tabella();?>
      <script>
        document.addEventListener("DOMContentLoaded", () => {
          const rows = document.querySelectorAll("tr[data-href]");

          rows.forEach(row =>{
            row.addEventListener("click", () =>{
              window.location.href = row.dataset.href;
            });
          });
        });
      </script>
    <body>
    <html>
    <?php




 ?>
