<html lang="de">
<head>
    <title>Bestellungen</title>
    <meta charset="utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <?php 
        echo '<link href="style.css?"'.time().' rel="stylesheet" type="text/css" />';
    ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	
	<script>
	    $(document).ready(function(){
			$('#MyButton').click(function(){
                            event.preventDefault();
                            var data = $('tr').map(function(){
                                var obj={};
                                $(this).find('input, select').each(function(){
                                   obj[this.name]=$(this).val();
                                });
                                return obj;
                            }).get();
                            var xhr = new XMLHttpRequest();
                            xhr.open('POST','rechnung.php',true);
                            xhr.setRequestHeader('Content-Type','application/json; charset=UTF-8');
                            xhr.onreadystatechange = function() {
                                if(xhr.readyState == 4 && xhr.status == 200) {
                                    window.location.assign(xhr.responseText);
                                }
                            }
                            xhr.send(JSON.stringify(data));
                            
			});
                        $('#besthide').click(function(){
                            $('#bestinfo').hide();
                            $('#besttable').show();
                        });
                        $('#besttable').hide();
                        
		  });
	</script>



</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-static-top">
                <a class="navbar-brand" href="index.php"><img class="logo" src="images/logo_verein.svg" href="index.php" alt="logo" ></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse text-right" id="navbarTogglerDemo02">
                  <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                      <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="rechnung.php">Rechnung</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link disabled" href="#">Disabled</a>
                    </li>
                  </ul>
                </div>
            </nav>
            <div class="jumbotron" id="bestinfo">
                <h1>Bestellungen Vereinshaus</h1>
                <p>
		<?php
			echo nl2br("Hier k&ouml;nnen die Bestellungen für das Vereinshaus ausgel&ouml;st werden. \n
                    Bitte in nachfolgender Liste den Bestand aufnehmen und \nam Ende den "Bestellen-Button" dr&uuml;cken. 
                    Der Rest geht dann automatisch.\n Im Moment wird nur eine PDF erstellt, sp&auml;ter dann diese direkt per Mail versendet.");
				?>
		    </p>
                <a class="btn btn-primary btn-sm " id="besthide" href="#">Weiter</a>
            </div>
            <div id="besttable">
                <table id="myTable">
                    <tr>
                        <th>Sorte</th>
                        <th>Soll</th>
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

            
                <input type="button" value="Bestellen" id="MyButton" >
            </div>
	</div><!-- /content -->
    </div><!-- /page -->
</div>
</body>
</html>
