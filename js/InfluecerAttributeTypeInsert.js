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
    console.log("Document ready");

    $('#AttributeTypepopupBtn').on('click', function() {
        $('#AttributeTypepopupModal').modal('show');
    });

    $('#saveAttributeTypeButton').on('click', function(event) {
        event.preventDefault();

        var attributeTypeCode = $('#AttributeTypeCode').val();
        var attributeTypeName = $('#AttributeTypeName').val();

        if (!attributeTypeCode || !attributeTypeName) {
            toastr.warning('Lütfen tüm alanları doldurunuz.');
            return;
        }

        console.log("Veriler alındı:", { attributeTypeCode, attributeTypeName });

        var data = {
            AttributeTypeCode: attributeTypeCode,
            AttributeTypeName: attributeTypeName
        };

        $.ajax({
            url: '../query/InsertAttributeType.php',
            type: 'POST',
            contentType: 'application/json; charset=UTF-8',
            data: JSON.stringify(data),
            success: function(response) {
                console.log("AJAX başarıyla tamamlandı", response);
                if (response.status === 'success') {
                    toastr.success('Veri başarıyla eklendi.');
                    $('#AttributeTypepopupModal').modal('hide');
                    $('#insertFormAttributeType')[0].reset();
                    updateGrid(); // Grid'i güncelle
                } else {
                    toastr.error('Veri eklenirken bir hata oluştu: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.log("AJAX hatası", error);
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
