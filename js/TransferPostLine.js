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

        console.log('Paylaşım Modülü açıldı');
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

        // Konsola yazdırarak form verilerini kontrol et
        console.log('TransferNumber:', transferNumber);
        console.log('Barcode:', barcode);
        console.log('PlatformCode:', PlatformCode);
        console.log('PlatformName:', PlatformName);
        console.log('ContentName:', ContentName);
        console.log('ShareDate:', ShareDate);
        console.log('LikeCount:', LikeCount);
        console.log('WievCount:', WievCount);
        console.log('ContentCode:', ContentCode);

        // ShareDate formatını kontrol et ve dönüştür
        var formattedShareDate = moment(ShareDate, 'YYYY-MM-DD').format('YYYY-MM-DD');

        // Eksik alanları kontrol et ve konsola yazdır
        var missingFields = [];
        if (!PlatformCode) missingFields.push('PlatformCode');
        if (!PlatformName) missingFields.push('PlatformName');
        if (!ContentName) missingFields.push('ContentName');
        if (!formattedShareDate) missingFields.push('ShareDate');
        if (!LikeCount) missingFields.push('LikeCount');
        if (!WievCount) missingFields.push('WievCount');
        if (!ContentCode) missingFields.push('ContentCode');

        if (missingFields.length > 0) {
            console.log('Eksik alanlar: ', missingFields.join(', '));
            toastr.warning('Lütfen Eksik Bilgileri Giriniz.');
            return;
        }

        if (PlatformCode && PlatformName && ContentName && formattedShareDate && LikeCount && WievCount && ContentCode) {
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
                            toastr.success('Paylaşım Tamamlandı!');
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

    // Modal kapandığında form alanlarını sıfırla
    $('#popupModal1').on('hidden.bs.modal', function () {
        // Modal içindeki formu resetle
        $(this).find('form')[0].reset();
        // Eğer form yoksa inputları resetle
        $(this).find('input').val('');
        $(this).find('textarea').val('');
        $(this).find('select').val('');
    });
});
