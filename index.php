<!doctype html>
<?php
include 'Functions.php';
session_start();
?>
<html lang="ita">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" type="text/css" href="forms.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">



	<!-- code -->

	<div align=center >
	</br>
	</br>
	<img src="Striscione_Transp.png" alt="Smiley face" height="50%" width="50%">
	</br>
	</br>
	<font size="7">ISCRIZIONE FORUM</font>
	</br>
	</br>

	<form action="autentication.php" method=post class="w-75 mx-auto" align=center>
	  <div class="form-group ">
		<input name="matricola" placeholder="inserisci la tua matricola" type="text" class="form-control" id="exampleInput" >
	  </div>
	  <button type="submit" class="btn btn-primary">CONFERMA</button>
	</form>

	<?php

	//  database_connection();

	$name;
	$surname;

	$forum;

	if(isset($_POST["surname"]) && isset($_POST["surname"])){
		$name=$_POST["name"];
		$surname=$_POST["surname"];

		$_SESSION["name"] = $name;
		$_SESSION["surname"] = $surname;
	}

	if(isset($_POST["forum"])){
		$forum=$_POST["forum"];

		$_SESSION["forum"] = $forum;
	}

	if(isset($_SESSION["name"]) && isset($_SESSION["surname"]) && $_SESSION["name"]!="" && $_SESSION["surname"]!=""){



		echo('
		</br>
		</br>
		<div class="w-75 bg-light rounded-lg">

		</br>
		</br>
		<font size="5">'.strtoupper($_SESSION["name"]).' '.strtoupper($_SESSION["surname"]).'</br> SCEGLI UN FORUM</font>
		</br>
		</br>

		<form action="index.php?recoverscroll" method=post class="w-75">
				<select name="forum" class="form-control form-control-lg w-100">
			  ');
			  get_forums($_SESSION["forum"]);
		echo('
			</select>
			</br>
			<button type="submit" class="btn btn-primary ">CAMBIA FORUM</button>
      		</br>
			</br>

  		</form>

		');

		if(isset($_SESSION["forum"])){

		$results=get_forum_data($_SESSION["forum"]);
		$_SESSION["results"]=$results;


		if(isset($_SESSION["results"]) && $results!="not set"){
			echo('
		<form action="index.php" method=post class="w-75">
		<div class="container border border-light rounded bg-primary p-4 text-light" >
		  <div class="row" >
			<div class="col-sm">
			  <font size="4" align=center> CLASSE </font>
			</div>
			<div class="col-sm">
				<font size="4" align=center> GIORNO </font>
			</div>
			<div class="col-sm">
			  	<font size="4" align=center> ORA </font>
			</div>
			<div class="col-sm">
			  	<font size="4" align=center> RESPONSABILE </font>
			</div>
		  </div>
		  <div class="row">
			<div class="col-sm">
				<font size="2" align=center>
				'.$results['classe'].'
				</font>
			</div>
			<div class="col-sm text-center">
				<font size="2" align=center>
				'.$results['data'].'
				</font>
			</div>
			<div class="col-sm">
				<font size="2" align=center>
				'.$results['ora'].'
				</font>
			</div>
			<div class="col-sm">
				<font size="2" align=center>
				'.$results['handlers'].'
				</font>
			</div>
		  </div>
		</div>
		');

		if($_SESSION["results"]["data"]=="Entrambi"){
			echo('
			</br>
			<font size="5"> SCEGLI LA DATA </font>
			</br>
			<select name="data_scelta" class="form-control form-control-lg w-75">
			<option> venerdi 6 marzo </option>
			<option> sabato 7 marzo </option>
			</select>
			</br>

			');
		}

		echo('
		</br>

		<button type="submit" name="subscribed" value="true" class="btn btn-primary p-4">ISCRIVITI A '.strtoupper($_SESSION["forum"]).'</button>

		</form>
		');

		if(isset($_POST["subscribed"]) && $_POST["subscribed"]=="true"){
			echo("</br>");
			if(isset($_POST["data_scelta"])){
				set_forum_subscription($_SESSION["name"],$_SESSION["surname"],$_SESSION["results"]["id"],$_POST["data_scelta"]);
			}
			else{
				set_forum_subscription($_SESSION["name"],$_SESSION["surname"],$_SESSION["results"]["id"],"");
			}
			$_SESSION["results"]="";
		}

		}

	}

		echo('


		</br>
		</br>
		</div>

		');
	}






	?>

	</br>
	</br>
	</br>

    <font size=2 color=white> per favore inserire negli spazi solamente il vostro nome e cognome</font></br>
    <font size=2 color=white> tutti i dati vuoti o sbagliati verranno rimossi</font>
	</br>
    </br>
	</br>
	<img src="Instagram.png" alt="instagram icon" height="42" width="42">
	<a href="https://instagram.com/studenti_buzzi?igshid=ds3kxai4dqjb" style="text-decoration:none" target="_top"><font color=black>pagina instagram Studenti Buzzi</font></a>
	</br><img src="chrome.png" alt="chrome icon" height="21" width="21">
	<a href="http://www.itistulliobuzzi.it/buzziwebsite/home/index.asp" style="text-decoration:none" target="_top"><font color=black>  pagina web ITS Tullio Buzzi</font></a>
	</br>
	</br>
	<hr size="1">
	</div>


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
