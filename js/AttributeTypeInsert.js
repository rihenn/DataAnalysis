toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": true,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

$(document).ready(function() {
    console.log("Document ready"); // Sayfa yüklendiğinde bu mesajı kontrol edin

    // "Özellik Tipi Ekle" butonuna tıklama işlemini yakala ve modalı aç
    $('#AttributepopupBtn').on('click', function() {
        console.log("Modal açılıyor"); // Butona tıklanıldığını kontrol edin
        $('#AttributepopupModal').modal('show');
    });

    // "Kaydet" butonuna tıklama işlemini yakala
    $('#insertForm').on('submit', function(event) {
        event.preventDefault(); // Formun kendi kendine submit olmasını engelle
        console.log("Form submit edildi"); // Formun submit edildiğini kontrol edin

        // Form alanlarından verileri al
        var attributeTypeCode = $('#AttributeTypeCode').val();
        var attributeTypeName = $('#AttributeTypeName').val();

        // Gerekli alanların dolu olup olmadığını kontrol et
        if (!attributeTypeCode || !attributeTypeName) {
            toastr.warning('Lütfen tüm alanları doldurunuz.');
            console.log("Boş alanlar var"); // Boş alanların kontrolü
            return;
        }

        console.log("Veriler alındı:", { attributeTypeCode, attributeTypeName }); // Alınan verileri kontrol edin

        // Verileri JSON formatına dönüştür
        var data = {
            AttributeTypeCode: attributeTypeCode,
            AttributeTypeName: attributeTypeName
        };

        // AJAX isteği gönder
        $.ajax({
            url: '../query/InsertAttributeType.php',
            type: 'POST',
            contentType: 'application/json; charset=UTF-8',
            data: JSON.stringify(data),
            success: function(response) {
                console.log("AJAX başarıyla tamamlandı", response); // Başarılı AJAX yanıtını kontrol edin
                if (response.status === 'success') {
                    toastr.success('Veri başarıyla eklendi.');
                    $('#AttributepopupModal').modal('hide'); // Modalı kapat
                    $('#insertForm')[0].reset(); // Formu sıfırla
                } else {
                    toastr.error('Veri eklenirken bir hata oluştu: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.log("AJAX hatası", error); // AJAX hatasını kontrol edin
                toastr.error('Bir hata oluştu: ' + error);
            }
        });
    });
});
