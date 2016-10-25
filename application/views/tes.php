<div id="demo"><h2>Let AJAX change this text</h2></div>

<button type="button" onclick="loadDoc()">Change Content</button>
<input type="text" onkeyup="loadDoc()">

<script>
function loadDoc() {
	
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      document.getElementById("demo").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET", "<?php echo base_url(); ?>"+"borrower/perhitungan/", true);
  xhttp.send();
}
</script>