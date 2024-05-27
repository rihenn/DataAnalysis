$(document).ready(function() {
    var transferNumber;
    var barcode;

    // "Düzenle" butonuna tıklama işlemini yakala ve modalı aç
    $('#detailsTable').on('click', '.btn-düzenle', function() {
        var row = $(this).closest('tr');
        transferNumber = row.find('td').eq(1).text(); // 2. sütundan TransferNumber değerini al
        barcode = row.find('td').eq(2).text(); // 3. sütundan Barkod değerini al

        console.log('Seçilen TransferNumber:', transferNumber);
        console.log('Seçilen Barcode:', barcode);

        // Modalı aç
        $('#editModal').modal('show');
    });

    // "Kaydet" butonuna tıklama işlemini yakala
    $('#editForm').on('submit', function(event) {
        event.preventDefault(); // Formun kendi kendine submit olmasını engelle

        // Form alanlarından verileri al
        var itemCode = $('#editForm input[name="ItemCode"]').val();
        var colorCode = $('#editForm input[name="ColorCode"]').val();
        var itemDim1Code = $('#editForm input[name="ItemDim1Code"]').val();
        var itemDescription = $('#editForm input[name="ItemDescription"]').val();
        var colorCatalogDescription = $('#editForm input[name="ColorCatalogDescription"]').val();
        var itemCostPrice = parseFloat($('#editForm input[name="ItemCostPrice"]').val());
        var shippingCostPrice = parseFloat($('#editForm input[name="ShippingCostPrice"]').val());
        var qty1 = parseInt($('#editForm input[name="Qty1"]').val());
        var sendDate = $('#editForm input[name="SendDate"]').val();

        // Konsola yazdırarak verileri kontrol et
        console.log({
            transferNumber: transferNumber,
            barcode: barcode,
            itemCode: itemCode,
            colorCode: colorCode,
            itemDim1Code: itemDim1Code,
            itemDescription: itemDescription,
            colorCatalogDescription: colorCatalogDescription,
            itemCostPrice: itemCostPrice,
            shippingCostPrice: shippingCostPrice,
            qty1: qty1,
            sendDate: sendDate
        });

        // Gerekli alanların dolu olup olmadığını kontrol et
        if (!itemCode || !colorCode || !itemDim1Code || !itemDescription || !colorCatalogDescription || !sendDate) {
            toastr.warning('Lütfen tüm alanları doldurunuz.');
            return;
        }

        // Verileri JSON formatına dönüştür
        var data = {
            transferNumber: transferNumber,
            barcode: barcode,
            itemCode: itemCode,
            colorCode: colorCode,
            itemDim1Code: itemDim1Code,
            itemDescription: itemDescription,
            colorCatalogDescription: colorCatalogDescription,
            itemCostPrice: isNaN(itemCostPrice) ? 0 : itemCostPrice,
            shippingCostPrice: isNaN(shippingCostPrice) ? 0 : shippingCostPrice,
            qty1: isNaN(qty1) ? 0 : qty1,
            sendDate: sendDate
        };

        // AJAX isteği gönder
        $.ajax({
            url: '../query/TransferLineUpdate.php',
            type: 'POST',
            contentType: 'application/json; charset=UTF-8',
            data: JSON.stringify(data),
            success: function(response) {
                console.log("AJAX Başarılı Yanıt:", response); // Başarılı yanıtı konsola yazdır
                if (response.status === 'success') {
                    toastr.success('Veri başarıyla güncellendi.');
                    $('#editModal').modal('hide'); // Modal'i kapat
                    $('#detailsTable').DataTable().ajax.reload(); // DataTable'ı yeniden yükle
                } else {
                    toastr.error('Veri güncellenirken bir hata oluştu: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error("Veri gönderme hatası: ", status, error);
                console.log("Response Text:", xhr.responseText); // Yanıt metnini kontrol edin
                alert('Bir hata oluştu: ' + error);
            }
        });
    });

    // "Paylaşım Kaydet" butonuna tıklama işlemini yakala
    $('#shareSaveButton').on('click', function(event) {
        event.preventDefault(); // Butonun kendi kendine submit olmasını engelle

        console.log("Butona tıklanıldı"); // Butona tıklanıldığını konsola yazdır

        // Platform ve Paylaşım Bilgileri
        var platformCode = $('#editForm input[name="PlatformCode"]').val();
        var platformName = $('#editForm input[name="PlatformName"]').val();
        var contentCode = $('#editForm input[name="ContentCode"]').val();
        var contentName = $('#editForm input[name="ContentName"]').val();
        var shareDate = $('#editForm input[name="ShareDate"]').val();
        var likeCount = $('#editForm input[name="LikeCount"]').val();
        var viewCount = $('#editForm input[name="ViewCount"]').val();

        // Konsola yazdırarak verileri kontrol et
        console.log({
            transferNumber: transferNumber,
            barcode: barcode,
            platformCode: platformCode,
            platformName: platformName,
            contentCode: contentCode,
            contentName: contentName,
            shareDate: shareDate,
            likeCount: likeCount,
            viewCount: viewCount
        });

        // Gerekli alanların dolu olup olmadığını kontrol et
        if (!platformCode || !platformName || !contentCode || !contentName || !shareDate) {
            toastr.warning('Lütfen tüm alanları doldurunuz.');
            return;
        }

        // Verileri JSON formatına dönüştür
        var data = {
            transferNumber: transferNumber,
            barcode: barcode,
            platformCode: platformCode,
            platformName: platformName,
            contentCode: contentCode,
            contentName: contentName,
            shareDate: shareDate,
            likeCount: isNaN(parseInt(likeCount)) ? 0 : parseInt(likeCount),
            viewCount: isNaN(parseInt(viewCount)) ? 0 : parseInt(viewCount)
        };

        // AJAX isteği gönder
        $.ajax({
            url: '../query/TransferPostUpdate.php',
            type: 'POST',
            contentType: 'application/json; charset=UTF-8',
            data: JSON.stringify(data),
            success: function(response) {
                console.log("AJAX Başarılı Yanıt:", response); // Başarılı yanıtı konsola yazdır
                if (response.status === 'success') {
                    toastr.success('Paylaşım bilgileri başarıyla güncellendi.');
                    $('#editModal').modal('hide'); // Modal'i kapat
                    $('#detailsTable').DataTable().ajax.reload(); // DataTable'ı yeniden yükle
                } else {
                    toastr.error('Paylaşım bilgileri güncellenirken bir hata oluştu: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error("Veri gönderme hatası: ", status, error);
                console.log("Response Text:", xhr.responseText); // Yanıt metnini kontrol edin
                alert('Bir hata oluştu: ' + error);
            }
        });
    });

    // Modal kapandığında formu sıfırlama
    $('#editModal').on('hidden.bs.modal', function () {
        $('#editForm')[0].reset(); // Formu sıfırlama
    });
});
