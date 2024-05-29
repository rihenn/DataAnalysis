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
 
            toastr.success('Platform başarıyla kaydedildi!');
        
    })
    .catch((error) => {
        console.error('Hata:', error);
        toastr.error('Bir hata oluştu.');
    });
});

$('#PlatformDataAddBtn').on('click', function(event) {
    event.preventDefault(); // Formun normal gönderimini engelle

    // Form verilerini al
    var PlatformCode = document.getElementById('PlatformCode').value;
    var PlatformName = document.getElementById('PlatformName').value;
    var ContentCode = document.getElementById('ContentCode').value;
    var ContentName = document.getElementById('ContentName').value;

    if (!PlatformCode || !PlatformName || !ContentCode || !ContentName) {
        toastr.error('Lütfen tüm alanları doldurunuz.');
        return;
    }

    // JSON nesnesi oluştur
    var data = {
        PlatformCode: PlatformCode,
        PlatformName: PlatformName,
        ContentCode: ContentCode,
        ContentName: ContentName
    };

    // Fetch API ile POST isteği gönder
    fetch('../query/PlatformAttribute.php', {
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
            toastr.error(data.message);
            console.error('Error details:', data.errors); // Detailed error logging
        }
    })
    .catch((error) => {
        console.error('Hata:', error);
        toastr.error('Bir hata oluştu.');
    });
});
