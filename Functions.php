<?php

function database_connection(){
	$servername = "localhost";
	$username = "iscrizioneforumbuzzi";
	$password = "Studentibuzzi2020";
	$dbName="my_iscrizioneforumbuzzi";

	// Create connection
	$conn = new mysqli($servername, $username, $password,$dbName);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
		return $conn;
	}

function get_forums($selectedForum){

	$database=database_connection();

	//2. creo la query
	$sql="select nome
			from forum";

	//3. eseguo la query
	$records=$database->query($sql);
	if ( $records!= TRUE)
    	die ("Errore nella query: " . $sql . "<br>" . $conn->error);

    //4. gestisco gli eventuali records estratti dalla query

	    //4a. verifico se ha estratto dei dati
	if ($records->num_rows != 0)
	    {
	    	//4b. visualizzo i dati estratti
	    	while($tupla = $records->fetch_assoc()) {
				if($selectedForum==$tupla['nome']){
					echo "<option selected>".$tupla['nome']. "</option>";
				}else{
					echo "<option>".$tupla['nome']. "</option>";
				}
	    	}

	    }

}

function get_forum_data($forum){

	$database=database_connection();
	$tupla="not set";

	//2. creo la query
	$sql='select f.id,f.classe,f.data,f.handlers,f.ora
			from forum f where f.nome="'.$forum.'";';

	//3. eseguo la query
	$records=$database->query($sql);
	if ( $records!= TRUE)
    	die ("Errore nella query: " . $sql . "<br>" . $database->error);

    //4. gestisco gli eventuali records estratti dalla query

	    //4a. verifico se ha estratto dei dati
	if ($records->num_rows != 0)
	    {
	    	$tupla = $records->fetch_assoc();
	    }
	return $tupla;
}

function set_forum_subscription($name,$surname,$IDForum,$data_scelta){

	$database=database_connection();

	if(check_max_subscription($IDForum,$data_scelta)){
      //2. creo la query
      if($data_scelta!=" "){
          $sql='INSERT INTO `iscrizione`(`nome_alunno`, `cognome_alunno`, `id_forum`,data_scelta) VALUES ("'.strtoupper($name).'","'.strtoupper($surname).'","'.$IDForum.'","'.$data_scelta.'")';
      }else{
          $sql='INSERT INTO `iscrizione`(`nome_alunno`, `cognome_alunno`, `id_forum`) VALUES ("'.strtoupper($name).'","'.strtoupper($surname).'","'.$IDForum.'")';
      }

      //3. eseguo la query
      $records=$database->query($sql);
      if ( $records!= TRUE)
          echo ("<font size=3 color=red> ALUNNO GIA' ISCRITTO AL FORUM </font></br>");
      else{
          echo('<font size=3 color=green> ISCRIZIONE COMPLETATA </font>');
      	}
   }
   else {
		echo("<font size=3 color=red>NUMERO MASSIMO DI ISCRITTI SUPERATO</font>");
		}
}

function check_max_subscription($forum,$data_scelta){
	$database=database_connection();
	$tupla="not set";
	$output=true;

	//2. creo la query
	$sql='SELECT f.nome,iscrizioni.data_scelta,Count(*) as n,f.portata
    FROM ( SELECT DISTINCT id_forum , nome_alunno , cognome_alunno,data_scelta FROM iscrizione ) as iscrizioni
    join forum f on iscrizioni.id_forum=f.id
    where f.id="'.$forum.'" and iscrizioni.data_scelta="'.$data_scelta.'"
    group by iscrizioni.id_forum,iscrizioni.data_scelta
    ;';

	//3. eseguo la query
	$records=$database->query($sql);
	if ( $records!= TRUE)
    	die ("Errore nella query: " . $sql . "<br>" . $database->error);

    //4. gestisco gli eventuali records estratti dalla query

	    //4a. verifico se ha estratto dei dati
	if ($records->num_rows != 0)
	    {
	    	$tupla = $records->fetch_assoc();
            if($tupla["n"]+1>$tupla["portata"]) $output=false;
	    }


	return $output;
}

?>
