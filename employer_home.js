function loadRecords() 
{ 
	var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("para").innerHTML = this.responseText;
            }
        };
	xmlhttp.open("GET", "employer_home.php?writeMsg", true);
    xmlhttp.send();
}