<?php include_once 'konfiguracija.php'; ?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>OSC Svašta nešto o IT-ju</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
  </head>
  <body>
    
    <div class="row">
      <div class="large-12 columns">
        <h1>Pregled računanja</h1>
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
      	<div class="panel callout radius">
			
			<form method="post" action="">
  		<fieldset>
  			<legend>Pretraživanje</legend>
  			<label for="uvjet">Uvjet</label>
  			<input type="text" id="uvjet" />
  		</fieldset>
  </form>
    		
    		<table style="width: 100%">
    			<thead>
    				<tr>
    					<th>Tko</th>
    					<th>Od kuda</th>
    					<th>Kada</th>
    					<th>Prvi broj</th>
    					<th>Drugi broj</th>
    				</tr>
    			</thead>
    			<tbody id="podaci">
    			</tbody>
    		</table>
		</div>
    </div>

    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
      
      
      $(function(){
      	
			
			ucitajPodatke();
			
			
			
			
			
			$("#uvjet").keypress(function (e) {
				//kada stisnemo enter
  				if (e.which == 13) {
    				ucitajPodatke();
    				//i ne radi više ništa
    				e.preventDefault();
  					return false;
  				}});});
  				
      function ucitajPodatke(){
			$.ajax({
				type: "POST",
				url: "dohvatiPodatke.php",
				data: "uvjet=" + $("#uvjet").val(),
				success: function(vratioServer){
					$("#podaci").html("");
					
					var rezultati = $.parseJSON(vratioServer);
					$.each( rezultati, function( key, objekt ) {
						$("#podaci").append("<tr>" + 
						"<td>" + objekt.tko + "</td>" +
						"<td>" + objekt.odkuda + "</td>" +
						"<td><span title=\"" + objekt.kada + "\">" + parsirajDatum(new Date(objekt.kada)) + "</span></td>" +
						"<td>" + objekt.prvibroj + "</td>" +
						"<td>" + objekt.drugibroj + "</td></tr>"
						);
					});
				}
			});
		}
		
		function parsirajDatum(datum){
			var dan = datum.getDate();
 			var mjesec = datum.getMonth() + 1;
 			//alert(dan + "  == "   + dan.length);
			if(dan<10){
				dan="0"+dan;
			}
			if(mjesec<10){
				mjesec="0"+mjesec;
			}
			return dan + ". " + mjesec + ". " + datum.getFullYear();
		}
    </script>
  </body>
</html>
