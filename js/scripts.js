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
                            xhr.open('POST','make_pdf.php',true);
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
