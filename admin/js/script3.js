function loadDoc() {
    var optione = document.getElementById('optioni');
    var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
          optione.innerHTML = xhttp.responseText;
        }
      };
      xhttp.open("GET", "ajax/Gru.php", true);
      xhttp.send();
    }