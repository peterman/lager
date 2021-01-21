<html>
<head>
	<title>Page Title</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
        <link rel="stylesheet" href="style.css" /> 
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
		<h1>Page Title</h1>
	</div><!-- /header -->

	<div role="main" class="ui-content">
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
                            echo '<td>'.$item->id.'</td>';
                            echo '<td>'.$item->artikel.'</td>';
                            echo '<td>'.$item->soll.'</td>';
                            echo'</tr>';
                        }
                    ?>
                        
		</table>
	</div><!-- /content -->

	<div data-role="footer">
		<h4>Page Footer</h4>
	</div><!-- /footer -->
</div><!-- /page -->

</body>
</html>
