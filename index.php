<html>
<head>
	<title>Bestellungen</title>

	<meta name="viewport" content="width=device-width, initial-scale=0.8">
   
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
         
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
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
	</script>
</head>
<body>

<div data-role="page">

	<div data-role="header">
		<h1>Getr&auml;nke Bestellung</h1>
	</div><!-- /header -->

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

	<div data-role="footer">
		<h4>Page Footer</h4>
	</div><!-- /footer -->
</div><!-- /page -->

</body>
</html>
