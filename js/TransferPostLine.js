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
    // "Post" butonuna tıklama işlemini yakala ve ikinci modalı aç
    $('#detailsTable').on('click', '.btn-action', function() {
        var transferNumber = $(this).data('id');
        var row = $(this).closest('tr');
        var barcode = row.find('td').eq(2).text(); // Barkod sütununu bul ve değerini al

        // İkinci modal içindeki form alanlarını doldur
        $('#popupModal1 input[name="TransferNumber"]').val(transferNumber);
        $('#popupModal1 input[name="Barcode"]').val(barcode); // Barkod alanını doldur

        // İkinci modalı aç
        $('#popupModal1').modal('show');
    });

    // Formun gönderilmesi işlemi
    document.getElementById('saveButton').addEventListener('click', function() {
        var transferNumber = $('#popupModal1 input[name="TransferNumber"]').val();
        var barcode = $('#popupModal1 input[name="Barcode"]').val(); // Barkod alanını al
        var PlatformCode = document.querySelector('[name="PlatformCode"]').value;
        var PlatformName = document.querySelector('[name="PlatformName"]').value;
        var ContentName = document.querySelector('[name="ContentName"]').value;
        var ShareDate = document.querySelector('[name="ShareDate"]').value;
        var LikeCount = document.querySelector('[name="LikeCount"]').value;
        var WievCount = document.querySelector('[name="WievCount"]').value;
        var ContentCode = document.querySelector('[name="ContentCode"]').value;

        // ShareDate formatını kontrol et ve dönüştür
        var formattedShareDate = moment(ShareDate, 'YYYY-MM-DD').format('YYYY-MM-DD');

        if (PlatformCode && PlatformName && ContentName && formattedShareDate && LikeCount && WievCount) {
            var data = {
                transferNumber,
                barcode, // Barkod verisini ekle
                PlatformCode,
                PlatformName,
                ContentName,
                ShareDate: formattedShareDate, // Formatlanmış ShareDate
                LikeCount,
                WievCount,
                ContentCode
            };

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../query/TransferPostInsert.php', true);
            xhr.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        console.log(response); // Yanıtı kontrol etmek için konsola yazdırın
                        if (response.status === 'success') {
                            toastr.info('İşlem Başlatıldı Lütfen Gerekli Bilgileri Doldurunuz');
                            var dataRows = document.getElementById('dataRows');
                            if (dataRows) {
                                dataRows.style.display = 'block';
                            }
                        } else {
                            toastr.error('Kayıt ekleme başarısız: ' + response.message);
                        }
                    } else {
                        console.error('AJAX isteği başarısız oldu:', xhr.responseText);
                        toastr.error('Kayıt eklenirken bir hata oluştu');
                    }
                }
            };
            xhr.send(JSON.stringify(data));
        } else {
            toastr.warning('Lütfen Eksik Bilgileri Giriniz.');
        }
    });
});
