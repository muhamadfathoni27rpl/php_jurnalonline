
// ambil elemen
var keyword = document.getElementById('keyword');
var tombolCari = document.getElementById('tombol-cari');
var container = document.getElementById('container');

// tambah event ketika keywortiond ditukis
keyword.addEventListener('keyup', function(){
    

    // objek ajax
    var xhr = new XMLHttpRequest();

    // mengecek kesiapan ajax
    xhr.onreadystatechange = function() {
        if( xhr.readyState == 4 && xhr.status == 200){
            container.innerHTML = xhr.responseText;
        }
    }


    // exekusi
    xhr.open('GET', 'ajax/user.php?keyword=' + keyword.value, true);
    xhr.send();
});