<html>
<head>
    <title>Bestellungen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	
	<script>
	    $(document).ready(function(){
			$('#MyButton').click(function(){
                            event.preventDefault();
                            var data = $('tr').map(function(){
                                var obj={};
                                $(this).find('td').each(function(){
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
                        $.ajax({
                            url: 'lager.json',
                            dataType: 'json',
                            type: 'get',
                            cache: false,
                            success: function(data){
                                var list_data = '';
                                $.each(data, function(index, value){
                                    list_data += '<tr>';
                                    list_data += '<td>'+value.id+'</td>';
                                    list_data += '<td>'+value.artikel+'</td>';
                                    list_data += '<td><select name="soll" id="soll" value="'+value.soll+'">';
                                    var start = value.soll;
                                    console.log(start);
                                    for (var i= start; i < 1; i--) {
                                            list_data += '<option>'+ i +'</option>';
                                            }
                                    list_data += '<option selected>0</option></select>';
                                    list_data += '</td>';
                                    list_data += '</tr>';
                                });
                                console.log(list_data);
                                $('#list_table').append(list_data);
                            }
                        });
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
		
	

	<div role="main" class="container-fluid">
		
                    <table id="list_table">
                        <thead>
                            <tr>
                            <th>Nr</th>
                            <th>Sorte</th>
                            <th>ist</th>
                            </tr>
                        </thead>
                    </table>
			<input type="button" value="send" id="MyButton" >
	</div><!-- /content -->

	
</div><!-- /page -->

</body>
</html>
