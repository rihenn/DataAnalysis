
document.getElementById("insertForm").addEventListener("submit", function(event) {
    var firstName = document.getElementById("firstName").value.trim();
    var lastName = document.getElementById("lastName").value.trim();
    var countryCode = document.getElementById("countryCode").value.trim();
    var country = document.getElementById("country").value.trim();
    var city = document.getElementById("city").value.trim();
    var address = document.getElementById("address").value.trim();


});


document.getElementById("insertForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Formun varsayılan gönderimini engelle
    var form = document.getElementById("insertForm"); // Formu al
    var formData = new FormData(form); // Form verilerini FormData nesnesine al
    var xhr = new XMLHttpRequest(); // XMLHttpRequest nesnesi oluştur
    xhr.open("POST", "../query/insert.php", true); // POST isteği oluştur ve insert.php'ye gönder
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            toastr.success(xhr.responseText); // Sunucudan gelen cevabı göster
            // Burada başka bir işlem yapabilirsiniz, örneğin popup'ı kapatmak
        }
    };
    xhr.send(formData); // Form verilerini sunucuya gönder
});