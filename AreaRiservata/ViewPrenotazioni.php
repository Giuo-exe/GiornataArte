<?php
session_start();

function prendidati(){
    $ownuser= $_SESSION['username'];
    $sql = "SELECT e.tema,e.luogo,e.professori,e.gioro,e.ora from prenotazioni p join eventi e on p.matricola=e.matricola where p.matricola=$ownuser";
    $conn=connect();
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
      if($records){
        while($tupla=$records-> fetch_assoc()){
          $id=$tupla['id_stampa'];
          $copie=$tupla['n_copie'];
          $pagine=$tupla['pagine'];
          $tipo=$tupla['tipo'];
          $costo=$tupla['costo'];
          $richiedente=$tupla['richiedente'];
          $operatore=$tupla['operatore'];
          $data=$tupla['date'];
          $oggetto = new stampa($id,$copie,$pagine,$tipo,$costo,$richiedente,$operatore,$data);
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
      $Attributi = Array("Richiedente","Copie","Pagine","Formati","Costo","Operatore","Data");


      $tabella = "<table class='content-table'>";

      $tabella.= "<thead><tr>";

      foreach($Attributi as $a) {
        $tabella .= "<th class='header'><h4>$a</h4></th>";
      }

      $tabella.= "</tr></thead>";

      $tabella.="<tbody>";

      foreach($prenotazioni as $a){

        $now = $a -> get_data();
        $nowbutdate = date("Y-m-d", strtotime($now));
        $or="";

        if(strtotime(date($nowbutdate)) < strtotime(date("Y-m-d"))){
          $or = "<h4 id='passato'>Giorni passati</h4>";
        }else if(strtotime(date($nowbutdate)) == strtotime(date("Y-m-d"))){
          $or = "<h4 id='oggi'>".date("H:i", strtotime($now))."</h4>";
        }

        $id = $a -> get_id();

        // $or = date("Y-m-d", strtotime($now) < date("Y-m-d") ? "<h4 id: '#passato' >Giorni passati</h4>" : (date("Y-m-d", strtotime($now) == date("Y-m-d")) ? "<h4 id='oggi'>".date("h:i:sa", strtotime($now))."</h4>" : "<h4 id='futuro'>Prossimamente</h4>"));

        $tabella.= $_SESSION['ruolo']=="operatore" ? "<tr data-href='operation.php?id=$id&stamp=si'>" : "<tr>";

        $tabella.= "<td>".$a -> get_richiedente()."</td>".
          "<td>".$a -> get_copie()."</td>".
          "<td>".$a -> get_pagine()."</td>".
          "<td>".$a -> get_tipo()."</td>".
          "<td>".$a -> get_costo()." €</td>".
          "<td>".$a -> get_operatore()."</td>".
          "<td>".$or."</td>"; //.date("h:i", strtotime($a -> get_orario()))
        $tabella.="</tr>";
      }

      $tabella.="</tbody>";
      $tabella.="</table>";

      echo $tabella;
    }else{

    }
  }

  if(check()){
    ?>
    <html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Cronologia Stampe</title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/styleStampa.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
    <body>
      <center><h1 id="oggi">Cronologia Stampa</h1></center>
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
  }else{
    echo "<html>
    <a href='../../index.php'>
    <h1>Non puoi accedere a questa pagina


    </html>";
  }




 ?>
