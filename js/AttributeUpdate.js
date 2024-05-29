// Güncelleme formu gönderildiğinde
document.getElementById('editAttributeForm').addEventListener('submit', function(event) {
    event.preventDefault();
    var data = $('#detailsTable').DataTable().row(editRow).data();
    var infCode = data.InfluecerCode;
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
            var table = $('#detailsTable').DataTable();
            // Mevcut satırı güncelle
            table.row(editRow).data({
                InfluecerCode: infCode,
                FirstName: data.FirstName,
                LastName: data.LastName,
                AttributeTypeCode: attributeType,
                AttributeCode: attributeValue,
                AttributeName: data.AttributeName,
                Attribute: data.Attribute
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
});