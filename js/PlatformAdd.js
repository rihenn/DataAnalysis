$('#PlatformAddBtn').on('click', function(event) {
    event.preventDefault(); // Formun normal gönderimini engelle

    // Form verilerini al
    var PlatformType = document.getElementById('PlatformType').value;
    var PlatformValue = document.getElementById('PlatformValue').value;

    // JSON nesnesi oluştur
    var data = {
        PlatformType: PlatformType,
        PlatformValue: PlatformValue
    };

    // Fetch API ile POST isteği gönder
    fetch('../query/PlatformAdd.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            toastr.success('Platform başarıyla kaydedildi!');
        } else {
            toastr.error('Platform kaydedilirken bir hata oluştu: ' + data.error);
        }
    })
    .catch((error) => {
        console.error('Hata:', error);
        toastr.error('Bir hata oluştu.');
    });
});
