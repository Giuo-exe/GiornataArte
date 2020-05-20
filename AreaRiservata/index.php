<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Navbar</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <header>
      <nav>
        <div class="logo">
          <h4>Sala Stampa</h4>
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
    <div class="container">
      <div class="box">
        <a href="EventList.php">
          <h2>Prenota una Stampa</h2>
          <br>
          <p>In questa sezione puoi prenotare la sua stampa e allegare il file di conseguenda</pack>
        </a>
      </div>
      <div class="box">
        <a href="operator/manage.php">
          <h2>Lista Prenotazioni</h2>
          <br>
          <p>In questa sezione è possibile gestire le tue prenotazioni o se sei un operatore anche quelle degli altri </pack>
        </a>
      </div>
      <div class="box">
        <a href="operator/viewstamp.php">
          <h2>Cronologia Stampe</h2>
          <br>
          <p>Sezione per vedere la cronologia delle stampe effettuate</pack>
        </a>
      </div>
      <div class="box">
        <a href="">
          <br>
          <h2>Quadrato di simmetria</h2>
          <br>
          <p>Bottom text</pack>
        </a>
      </div>
    </div>
  </body>
</html>
