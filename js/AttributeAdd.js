$(document).ready(function() {
    // Global değişkenler
    var tableDetails = $('#detailsTable').DataTable();
    var editRow, deleteRow;

    // Düzenle butonuna tıklama olayını dinleyin
    $(document).on('click', '.btn-edit', function() {
        editRow = $(this).closest('tr'); // Satırı seç
        var data = tableDetails.row(editRow).data(); // Veriyi al

        console.log("Edit Data: ", data); // Debugging için veri loglama

        // Veriyi inputlara doldur
        if (data) {
            $('#editAttributeType').val(data.AttributeTypeCode);
            $('#editAttributeValue').val(data.AttributeCode);
            $('#editAttributeModal').modal('show');
        } else {
            console.error("Veri alınamadı.");
        }
    });

    // Güncelleme butonuna tıklama olayını dinleyin
    $(document).on('click', '#EditAttributeBtn', function(event) {
        event.preventDefault(); // Sayfanın yenilenmesini engelle
        var data = tableDetails.row(editRow).data();
        if (data) {
            var infCode = data.InfluencerCode; // Doğru yazım
            console.log("inf code :" + infCode);

            var attributeType = document.getElementById('editAttributeType').value;
            var attributeValue = document.getElementById('editAttributeValue').value;

            // AJAX isteği ile güncelleme işlemini yap
            fetch('../query/UpdatePrInfluencer.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    infCode: infCode,
                    attributeType: attributeType,
                    attributeValue: attributeValue
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    toastr.success('Kayıt başarıyla güncellendi.');
                    console.log("Updated Data: ", data); // Debugging için veri loglama

                    // Mevcut satırı güncelle
                    tableDetails.row(editRow).data({
                        InfluencerCode: infCode,
                        FirstName: data.FirstName,
                        LastName: data.LastName,
                        AttributeTypeCode: attributeType,
                        AttributeCode: attributeValue
                    }).draw(false);
                } else {
                    toastr.error('Kayıt güncellenirken bir hata oluştu: ' + (data.error || 'Bilinmeyen hata'));
                }
                $('#editAttributeModal').modal('hide');
            })
            .catch(error => {
                console.error('Fetch error:', error);
                toastr.error('Kayıt güncellenirken bir hata oluştu.');
                $('#editAttributeModal').modal('hide');
            });
        } else {
            console.error("Güncelleme işlemi için veri bulunamadı.");
        }
    });

    // Sil butonuna tıklama olayını dinleyin
    $(document).on('click', '.btn-delete', function() {
        deleteRow = $(this).closest('tr');
        $('#deleteConfirmModal').modal('show');
    });

    // Silme işlemini onayla
    document.getElementById('confirmDelete').addEventListener('click', function(event) {
        event.preventDefault(); // Sayfanın yenilenmesini engelle
        var data = tableDetails.row(deleteRow).data();
        if (data) {
            var infCode = data.InfluencerCode; // Doğru yazım
            var attributeType = data.AttributeTypeCode;
            var attributeValue = data.AttributeCode;

            // AJAX isteği ile silme işlemini yap
            fetch('../query/DeletePrInfluencerAtt.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    infCode: infCode,
                    attributeType: attributeType,
                    attributeValue: attributeValue
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    toastr.success('Kayıt başarıyla silindi.');
                    tableDetails.row(deleteRow).remove().draw(false);
                } else {
                    console.log(data.error);
                    console.log(data);
                    toastr.error('Kayıt silinirken bir hata oluştu: ' + (data.error || 'Bilinmeyen hata'));
                }
                $('#deleteConfirmModal').modal('hide');
            })
            .catch(error => {
                console.error('Fetch error:', error);
                toastr.error('Kayıt silinirken bir hata oluştu.');
                $('#deleteConfirmModal').modal('hide');
            });
        } else {
            console.error("Silme işlemi için veri bulunamadı.");
        }
    });
});
