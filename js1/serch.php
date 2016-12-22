
<script type="text/javascript" src="lib/jquery.js"></script>
<script type='text/javascript' src="lib/jquery.bgiframe.min.js"></script>
<script type='text/javascript' src='lib/jquery.ajaxQueue.js'></script>
<script type='text/javascript' src='lib/thickbox-compressed.js'></script>
<script type='text/javascript' src='jquery.autocomplete.js'></script>

<link rel="stylesheet" type="text/css" href="demo/main.css" />
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />
<link rel="stylesheet" type="text/css" href="lib/thickbox.css" />

<script type="text/javascript">
$().ready(function() {
	$.ajax({
		type:'POST',
		url:'drug_data.php',
		data:{action:'n_d'},
		success:function(rsp){
			var cities = rsp.split("|");
				function log(event, data, formatted) {
					$("<li>").html( !data ? "No match!" : "Selected: " + formatted).appendTo("#result");
				}
				
				function formatItem(row) {
					return row[0] + " (<strong>id: " + row[1] + "</strong>)";
				}
				function formatResult(row) {
					return row[0].replace(/(<.+?>)/gi, '');
				}
				$("#suggest1").focus().autocomplete(cities);
		}
	});
});

</script>
	
	
	<form autocomplete="off">
		<p>
			<label>Single City (local):</label>
			<input type="text" id="suggest1" />
		</p>
		</form>
