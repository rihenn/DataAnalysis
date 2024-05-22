// toastr.options = {
//     "closeButton": true,
//     "debug": false,
//     "newestOnTop": true,
//     "progressBar": true,
//     "positionClass": "toast-top-right",
//     "preventDuplicates": true,
//     "onclick": null,
//     "showDuration": "300",
//     "hideDuration": "1000",
//     "timeOut": "5000",
//     "extendedTimeOut": "1000",
//     "showEasing": "swing",
//     "hideEasing": "linear",
//     "showMethod": "fadeIn",
//     "hideMethod": "fadeOut"
// };

document.getElementById('saveButton').addEventListener('click', function() {
    var PlatformCode = document.querySelector('[name="PlatformCode"]').value;
    var PlatformName = document.querySelector('[name="PlatformName"]').value;
    var ContentName = document.querySelector('[name="ContentName"]').value;
    var ShareDate = document.querySelector('[name="ShareDate"]').value;
    var LikeCount = document.querySelector('[name="LikeCount"]').value;
    var WievCount = document.querySelector('[name="WievCount"]').value;

    if (PlatformCode && PlatformName && ContentName && ShareDate && LikeCount && WievCount) {
        var actualProcessCode = processCode === 'Gifting' ? 'GF' : 'SD';

        var data = {
            ProcessCode: actualProcessCode,
            SendInfCode: sendInfCode,
            SendInfName: sendInfName,
            ShippingCost: shippingCost
        };

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../query/TransferInsert.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        toastr.info('İşlem Başlatıldı Lütfen Gerekli Bilgileri Doldurunuz');
                        document.getElementById('dataRows').style.display = 'block';
                        document.getElementById('addRowSection').style.display = 'flex';
                        document.getElementById('barcodeSection').style.display = 'block';
                        addRow(); // İlk satırı ekleyin
                        document.getElementById('startProcessBtn').disabled = true; // "İşlem Başlat" butonunu devre dışı bırak
                        window.headerID = response.headerID; // headerID'yi sakla
                        window.transferNumber = response.transferNumber; // transferNumber'ı sakla
                        window.actualProcessCode = actualProcessCode; // process code'u sakla
                        window.shippingCost = parseFloat(shippingCost); // shippingCost'u sakla
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
