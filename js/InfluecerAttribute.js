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
        $('#AttributepopupModal').modal('show');
    });

   // "Kaydet" butonuna tıklama işlemini yakala
    $('#saveAttributeButton').on('click', function(event) {
      
        event.preventDefault(); // Formun kendi kendine submit olmasını engelle


        // Form alanlarından verileri al
        var AttributeTypeCode2 = $('#AttributeTypeCode2').val();
        var AttributeCode = $('#AttributeCode').val();
        var AttributeName = $('#AttributeName').val();
        var Attribute = $('#Attribute').val();

        // Gerekli alanların dolu olup olmadığını kontrol et
        if (!AttributeTypeCode2 || !AttributeName || !AttributeCode || !Attribute) {
            toastr.warning('Lütfen tüm alanları doldurunuz.');
        
            return;
        }

        console.log("Veriler alındı:", { AttributeTypeCode2, AttributeName }); // Alınan verileri kontrol edin

        // Verileri JSON formatına dönüştür
        var data = {
            AttributeTypeCode2: AttributeTypeCode2,
            AttributeCode: AttributeCode,
            AttributeName: AttributeName,
            Attribute: Attribute
        };

        //AJAX isteği gönder
        $.ajax({
            url: '../query/InfluecerAttribute.php',
            type: 'POST',
            contentType: 'application/json; charset=UTF-8',
            data: JSON.stringify(data),
            success: function(response) {
                console.log("AJAX başarıyla tamamlandı", response); // Başarılı AJAX yanıtını kontrol edin
                if (response.status === 'success') {
                    toastr.success('Veri başarıyla eklendi.');
                    updateGrid(); // Grid'i güncelle
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
    function updateGrid() {
        $.ajax({
            url: '../DataGetAttributeType.php', // Bu URL'yi sunucunuzdaki doğru endpoint ile değiştirin
            type: 'GET',
            success: function(response) {
                // Grid'inizi güncelleyin, örneğin:
                var grid = $('#attributeTypeGrid');
                grid.empty(); // Mevcut içeriği temizleyin
                
                response.data.forEach(function(item) {
                    // Grid'e yeni verileri ekleyin, örneğin:
                    grid.append('<tr><td>' + item.AttributeTypeCode + '</td><td>' + item.AttributeTypeName + '</td></tr>');
                });
                
                console.log("Grid başarıyla güncellendi", response);
            },
            error: function(xhr, status, error) {
                console.log("Grid güncelleme hatası", error);
                toastr.error('Grid güncellenirken bir hata oluştu: ' + error);
            }
        });
    }
});
