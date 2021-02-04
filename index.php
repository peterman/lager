<html lang="de">
<head>
    <title>Bestellungen</title>
    <meta charset="utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <?php 
        echo '<link href="css/style.css?"'.time().' rel="stylesheet" type="text/css" />';
    ?>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="js/scripts.js" type="text/javascript"></script>
	


</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <header>
   
                <?php $page = basename($_SERVER['PHP_SELF']); ?>
                <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-static-top">
                  <a class="navbar-brand" href="index.php"><img class="logo" src="images/logo_verein.svg" href="index.php" alt="logo" ></a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse navigation text-right" id="navbarSupportedContent">
                      <ul class="navbar-nav ml-auto">
                        <li class="nav-item navli <?php echo ($page == "index.php" ? "active" : "");?>">
                          <a class="nav-link" href="index.php">Home<span class="sr-only"></span></a>
                        </li>
                        <li class="nav-item navli  <?php echo ($page == "anfrage.php" ? "active" : "");?>">
                          <a class="nav-link" href="anfrage.php">Anfrage</a>
                        </li>
                        <li class="nav-item navli  <?php echo ($page == "liste.php" ? "active" : "");?>">
                          <a class="nav-link" href="liste.php">Liste</a>
                        </li>
                        <li class="nav-item navli  <?php echo ($page == "test2.php" ? "active" : "");?>">
                          <a class="nav-link" href="test2.php">Veranstaltungen</a>
                        </li>
                        <li class="nav-item navli  <?php echo ($page == "kalender.php" ? "active" : "");?>">
                          <a class="nav-link" href="kalender.php">Kalender</a>
                        </li>
                        <li class="nav-item navli  <?php echo ($page == "contact.php" ? "active" : "");?>">
                          <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                      </ul>
                  </div>
                  </nav>
              </header>
            <div class="bg-image-home">
                <div class="jumbotron" id="bestinfo">
                    <h1>Bestellungen Vereinshaus</h1>
                        <p>Hier k&ouml;nnen die Bestellungen f&uuml;r das Vereinshaus ausgel&ouml;st werden.</p> 
                            <p>Bitte in nachfolgender Liste den Bestand aufnehmen und </p>
                            <p>am Ende den "Bestellen-Button" dr&uuml;cken. Der Rest geht dann automatisch.</p>
                        <p>Im Moment wird nur eine PDF erstellt, sp&auml;ter dann diese direkt per Mail </p>
                        <p>an den Lieferanten versendet und gespeichert.</p>
                    <a class="btn btn-primary btn-sm " id="besthide" href="#">Weiter</a>
                </div>
            </div>    
            <div id="besttable">
                <table id="myTable">
                    <tr class="spaceUnder">
                        <th>Sorte</th>
                        <th>Soll</th>
                        <th></th>
                        <th>Ist</th>
                    </tr>
		    	
                    <?php
                        $filename = 'lager.json';
                        $json = file_get_contents($filename);
                        $data = json_decode($json);

                        foreach($data as $item) {
                            echo '<tr>';
                            echo '<td><input type="text" id="artikel" name="artikel" value="'.$item->artikel.'" readonly size="30"></td>'."\n";
                            echo '<td><input type="text" id="soll" name="soll" value="'.$item->soll.'" readonly size="1"></td>';
                            echo '<td><input type="hidden" id="einheit" name="einheit" value="'.$item->einheit.'" readonly></td>';
                            echo '<td><select name="ist" id="ist" value="'.$item->ist.'">."\n";';
                            $start = $item->soll;
                            echo '<option selected>'.$start.'</option>'."\n";
                            for ( $i = $start-1; $i >= 0; $i--) {
                                        echo '<option>'. $i .'</option>';
                            }
                            echo '</select>';
                            echo '</td>';
                            echo '</tr>';
                        }
                    ?>

                </table>

            	<hr>
                <input type="button" value="Bestellen" id="MyButton" >
            </div>
	</div><!-- /content -->
    </div><!-- /page -->
</div>
</body>
</html>
