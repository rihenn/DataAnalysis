$(document).ready(function() {
    // Hücre tıklama olayı
    $('#detailsTable').on('click', 'td', function() {
        var row = $(this).closest('tr'); // En yakın tr elemanını seç
        var transferNumber = row.find('td').eq(1).text(); // 2. td elemanındaki TransferNumber
        var barcode = row.find('td').eq(2).text(); // 3. td elemanındaki Barcode

        // Seçilen transferNumber ve barcode değerlerini console'a yazdır
        console.log("Seçilen TransferNumber: " + transferNumber);
        console.log("Seçilen Barcode: " + barcode);

        // AJAX isteği gönder
        $.ajax({
            url: '../query/CheckPrSendingAttribute.php', // PHP dosyanızın yolu
            type: 'POST',
            data: {
                transferNumber: transferNumber,
                barcode: barcode
            },
            dataType: 'json',
            success: function(response) {
                console.log(response); // Yanıtı kontrol edin

                if (response.post === 0) {
                    // Alanları ve butonu pasif yap
                    $('#editPlatformCode, #editPlatformName, #editContentCode, #editContentName, #editShareDate, #editLikeCount, #editViewCount').prop('disabled', true);
                    $('#shareSaveButton').prop('disabled', true); // Paylaşım Kaydet butonu
                } else {
                    // Alanları ve butonu aktif yap
                    $('#editPlatformCode, #editPlatformName, #editContentCode, #editContentName, #editShareDate, #editLikeCount, #editViewCount').prop('disabled', false);
                    $('#shareSaveButton').prop('disabled', false); // Paylaşım Kaydet butonu
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr);
                console.log("Response Text:", xhr.responseText); // Yanıt metnini kontrol edin
                alert('Bir hata oluştu: ' + error);
            }
        });
    });

    // Düzenle butonuna tıklama olayı
    $('#detailsTable').on('click', '.btn-düzenle', function() {
        var tr = $(this).closest('tr'); // En yakın tr elemanını seç
        var row = $('#detailsTable').DataTable().row(tr).data(); // DataTable'daki satır verilerini al

        var transferNumber = row.TransferNumber; // Satırdaki TransferNumber
        var barcode = row.Barcode; // Satırdaki Barcode

        // Seçilen transferNumber ve barcode değerlerini console'a yazdır
        console.log("Seçilen TransferNumber: " + transferNumber);
        console.log("Seçilen Barcode: " + barcode);

        // İlk AJAX isteği: trSendingLine tablosundan verileri almak
        $.ajax({
            url: '../query/DataGetSendingLineBarcode.php', // PHP dosyanızın doğru yolunu buraya yazın
            type: 'POST',
            data: {
                transferNumber: transferNumber,
                barcode: barcode
            },
            dataType: 'json',
            success: function(response) {
                console.log(response); // Yanıtı kontrol edin

                if (response.error) {
                    console.error("Hata: ", response.details);
                    toastr.error(response.error);
                } else if (response.data.length > 0) {
                    var record = response.data[0];

                    // Modal içindeki form alanlarını doldur
                    $('#editBarcode').val(record.Barcode);
                    $('#editItemCode').val(record.ItemCode);
                    $('#editColorCode').val(record.ColorCode);
                    $('#editItemDim1Code').val(record.ItemDim1Code);
                    $('#editItemDescription').val(record.ItemDescription);
                    $('#editColorCatalogDescription').val(record.ColorCatalogDescription); // Burada değişiklik yapıldı
                    $('#editItemCostPrice').val(record.ItemCostPrice);
                    $('#editShippingCostPrice').val(record.ShippingCostPrice);
                    $('#editQty1').val(record.Qty1);
                    $('#editPost').val(record.Post);
                    $('#editInfCode').val(record.InfCode);
                    $('#editInfName').val(record.InfName);
                    $('#editSendDate').val(moment(record.SendDate.date).format('YYYY-MM-DD'));

                    // İkinci AJAX isteği: prSendingAttribute tablosundan paylaşım bilgilerini almak
                    $.ajax({
                        url: '../query/DataGetPrSendingAttribute.php', // PHP dosyanızın doğru yolunu buraya yazın
                        type: 'POST',
                        data: {
                            transferNumber: transferNumber,
                            barcode: barcode
                        },
                        dataType: 'json',
                        success: function(response) {
                            console.log(response); // Yanıtı kontrol edin

                            if (response.error) {
                                console.error("Hata: ", response.details);
                                toastr.error(response.error);
                            } else if (response.data.length > 0) {
                                var record = response.data[0];

                                // Paylaşım bilgilerini modal içindeki form alanlarına doldur
                                $('#editPlatformCode').val(record.PlatformCode);
                                $('#editPlatformName').val(record.PlatformName);
                                $('#editContentCode').val(record.ContentCode);
                                $('#editContentName').val(record.ContentName);
                                $('#editShareDate').val(moment(record.ShareDate.date).format('YYYY-MM-DD'));
                                $('#editLikeCount').val(record.LikeCount);
                                $('#editViewCount').val(record.ViewCount);
                                toastr.info('Paylaşım bilgisi vardır.');
                                // Modal'i aç
                                $('#editModal').modal('show');
                            } else {
                                toastr.info('Paylaşım Bilgileri Olmadığından Başlık Kapalıdır.');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Veri çekme hatası: ", status, error);
                            alert('Bir hata oluştu: ' + error);
                        }
                    });

                } else {
                    toastr.error('Veri bulunamadı.');
                }
            },
            error: function(xhr, status, error) {
                console.error("Veri çekme hatası: ", status, error);
                console.log("Response Text:", xhr.responseText); // Yanıt metnini kontrol edin
                alert('Bir hata oluştu: ' + error);
            }
        });
    });

    // Modal kapandığında formu sıfırlama
    $('#editModal').on('hidden.bs.modal', function () {
        $('#editForm')[0].reset(); // Formu sıfırlama
        $('#editPlatformCode, #editPlatformName, #editContentCode, #editContentName, #editShareDate, #editLikeCount, #editViewCount').prop('disabled', true); // Alanları pasif yap
        $('#shareSaveButton').prop('disabled', true); // Paylaşım Kaydet butonu
    });
});
