<html>
<head>
    <title>Bestellungen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	
	<script>
	        $(document).on('click', '#save',function(event){
                    event.preventDefault();
                    var data = $('tr').map(function(){
                        var obj={};
                        $(this).find('input, select').each(function(){
                            obj[this.name]=$(this).val();
                        });
                        return obj;
                    }).get();
                    console.log(json.stringify(data));
                });
				
			$('button').click(function() {
    
				event.preventDefault();
                    var data = $('tr').map(function(){
                        var obj={};
                        $(this).find('input, select').each(function(){
                            obj[this.name]=$(this).val();
                        });
                        return obj;
                    }).get();
                    alert(json.stringify(data));
			});
	</script>
</head>
<body>



    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">Getr&auml;nke Bestellung</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
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
		
	

	<div role="main" class="ui-content">
		<form>
                    <table id="myTable">
                        <tr>
                            <th>Nr</th>
                            <th>Sorte</th>
                            <th>ist</th>
                        </tr>
                        <?php
                            $filename = 'lager.json';
                            $json = file_get_contents($filename);
                            $data = json_decode($json);

                            foreach($data as $item) {
                                echo '<tr>';
                                echo '<td><div class="ui-field-contain"><input type="text" id="id" name="id" value="'.$item->id.'" readonly size="2"></div></td>'."\n";
                                echo '<td><input type="text" id="artikel" name="artikel" value="'.$item->artikel.'" readonly size="35"</td>'."\n";
                                echo '<td><select name="call" id="call" value="'.$item->soll.'">."\n";';
                                        echo '<option>0</option>'."\n";
                                        echo '<option>1</option>'."\n";
                                        echo '<option>2</option>'."\n";
                                        echo '<option>3</option>'."\n";
                                        echo '<option>4</option>'."\n";
                                        echo '<option>5</option>'."\n";
                                        echo '<option>6</option>'."\n";
                                        echo '<option>7</option>'."\n";
                                        echo '</select>';
                                echo '</td>';
                                echo '</tr>';
                            }
                        ?>

                    </table>
		</form>	
	</div><!-- /content -->

	<button>klick here</button>
</div><!-- /page -->

</body>
</html>
