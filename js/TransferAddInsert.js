document.getElementById('Submit').addEventListener('click', function(event) {
    event.preventDefault(); // Formun varsayılan gönderim işlemini durdurur

    // Form verilerini toplama
    var form = document.getElementById('myForm');
    var formData = new FormData(form);

    // AJAX isteğiyle form verilerini gönderme
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../query/TransferAddInsert.php', true); // PHP dosyanızın yolu
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText); // Sunucudan gelen yanıt
        }
    };
    xhr.send(formData); // Form verilerini gönderme
});