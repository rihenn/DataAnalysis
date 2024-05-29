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

document.getElementById('startProcessBtn').addEventListener('click', function() {
    var processCode = document.querySelector('[name="ProcessCode[]"]').value;
    var sendInfCode = document.querySelector('[name="SendInfCode[]"]').value;
    var sendInfName = document.querySelector('[name="SendInfName[]"]').value;
    var shippingCost = document.querySelector('[name="shippingcost[]"]').value;
    var sendDate = document.getElementById('SendDate').value; // Tarih alanını al

    if (processCode && sendInfCode && sendInfName && shippingCost) {
        var actualProcessCode = processCode === 'Gifting' ? 'GF' : 'SD';

        var data = {
            ProcessCode: actualProcessCode,
            SendInfCode: sendInfCode,
            SendInfName: sendInfName,
            ShippingCost: shippingCost,
            SendDate: sendDate
        };

        console.log("Gönderilen veri: ", data); // JSON verisini konsola yazdır

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../query/TransferAddInsert.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    console.log(xhr.responseText); // Yanıtı konsola yazdır
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
                        window.sendDate = response.sendDate; // sendDate'i sakla
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

document.getElementById('Submit').addEventListener('click', function(event) {
    event.preventDefault();

    var formData = new FormData(document.getElementById('myForm'));
    var totalQty = 0;
    document.querySelectorAll('.dataRow').forEach(function(row) {
        var qty1 = parseFloat(row.querySelector(`[name="Qty1[]"]`).value);
        totalQty += qty1;
    });

    var shippingCost = parseFloat(formData.get('shippingcost[]'));
    var shippingCostPerItem = shippingCost / totalQty;

    var lineDataArray = [];
    document.querySelectorAll('.dataRow').forEach(function(row) {
        var itemBarcode = row.querySelector(`[name="ItemBarcode[]"]`).value;
        var itemCode = row.querySelector(`[name="ItemCode[]"]`).value;
        var colorCode = row.querySelector(`[name="ColorCode[]"]`).value;
        var itemDim1Code = row.querySelector(`[name="ItemDim1Code[]"]`).value;
        var itemName = row.querySelector(`[name="ItemName[]"]`).value;
        var mlyEur = row.querySelector(`[name="MLY_EUR[]"]`).value;
        var qty1 = row.querySelector(`[name="Qty1[]"]`).value;
        var colorCatalogDescription = row.querySelector(`[name="ColorCatalogDescription[]"]`).value;

        lineDataArray.push({
            SendingHeaderID: window.headerID,
            ProcessCode: window.actualProcessCode,
            TransferNumber: window.transferNumber,
            Barcode: itemBarcode,
            ItemCode: itemCode,
            ColorCode: colorCode,
            ItemDim1Code: itemDim1Code,
            ItemDescription: itemName,
            ColorCatalogDescription: colorCatalogDescription,
            ItemCostPrice: mlyEur,
            ShippingCostPrice: shippingCostPerItem,
            Qty1: qty1,
            Post: 1,
            InfCode: document.querySelector('[name="SendInfCode[]"]').value,
            InfName: document.querySelector('[name="SendInfName[]"]').value,
            SendDate: document.getElementById('SendDate').value // SendDate değerini al
        });
    });

    console.log("Gönderilen lineDataArray:", lineDataArray); // Gönderilen lineDataArray içeriğini kontrol et

    var xhrLine = new XMLHttpRequest();
    xhrLine.open('POST', '../query/TransferAddLineInsert.php', true);
    xhrLine.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
    xhrLine.onreadystatechange = function () {
        if (xhrLine.readyState === 4) {
            console.log(xhrLine.responseText); // Yanıtı konsola yazdır
            try {
                var responseLine = JSON.parse(xhrLine.responseText);
                if (responseLine.status === 'success') {
                    toastr.success('Ürünler başarıyla eklendi');
                    ilkHalineDon(); // Sayfayı ilk haline döndür
                } else {
                    toastr.error('Ürün ekleme başarısız: ' + responseLine.message);
                }
            } catch (e) {
                console.error('JSON parse hatası:', e);
                toastr.error('Yanıt işlenirken bir hata oluştu');
            }
        } else if (xhrLine.readyState === 4) {
            toastr.error('Ürün eklenirken bir hata oluştu');
        }
    };
    xhrLine.send(JSON.stringify({ lines: lineDataArray }));
});

function addRow() {
    var dataRows = document.getElementsByClassName('dataRow');
    var index = dataRows.length + 1;

    var newRow = document.createElement('div');
    newRow.classList.add('row', 'dataRow', 'mb-3', 'justify-content-center');
    newRow.id = `focus${index}`;
    newRow.innerHTML = `
        <div class="col-md-1">
            <label for="ItemBarcode${index}" class="form-label">Barkod:</label>
            <input type="text" class="form-control form-control-sm barcode" id="ItemBarcode${index}" name="ItemBarcode[]" onkeyup="veriGetir(this.value, ${index})">
        </div>
        <div class="col-md-1">
            <label for="ItemCode${index}" class="form-label">Ürün Kodu:</label>
            <input type="text" class="form-control form-control-sm ItemCode" id="ItemCode${index}" name="ItemCode[]">
        </div>
        <div class="col-md-1">
            <label for="ColorCode${index}" class="form-label">Renk Kodu:</label>
            <input type="text" class="form-control form-control-sm ColorCode" id="ColorCode${index}" name="ColorCode[]">
        </div>
        <div class="col-md-1">
            <label for="ItemDim1Code${index}" class="form-label">Beden:</label>
            <input type="text" class="form-control form-control-sm ItemDim1Code" id="ItemDim1Code${index}" name="ItemDim1Code[]">
        </div>
        <div class="col-md-1">
            <label for="ItemName${index}" class="form-label">Ürün Adı:</label>
            <input type="text" class="form-control form-control-sm name" id="ItemName${index}" name="ItemName[]">
        </div>
        <div class="col-md-1">
            <label for="ColorCatalogDescription${index}" class="form-label">Renk Adı:</label>
            <input type="text" class="form-control form-control-sm ColorCatalogDescription" id="ColorCatalogDescription${index}" name="ColorCatalogDescription[]">
        </div>
        <div class="col-md-1">
            <label for="MLY_EUR${index}" class="form-label">Euro Maliyeti:</label>
            <input type="text" class="form-control form-control-sm MLY_EUR" id="MLY_EUR${index}" name="MLY_EUR[]">
        </div>
        <div class="col-md-1">
            <label for="Qty1${index}" class="form-label">Adet:</label>
            <input type="text" class="form-control form-control-sm Qty1" id="Qty1${index}" name="Qty1[]" value="1">
        </div>
        <div class="col-md-1 justify-content-center mt-2">
            <button type="button" class="btn btn-danger btn-sm mt-4" onclick="removeRow(${index})">Kaldır</button>
        </div>
    `;
    document.getElementById('dataRows').appendChild(newRow);
}

function veriGetir(barkod, index) {
    if (!barkod) return;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var veri = JSON.parse(this.responseText);
            if (veri && veri.length > 0) {
                var item = veri[0];
                document.getElementById(`ItemCode${index}`).value = item.ItemCode;
                document.getElementById(`ColorCode${index}`).value = item.ColorCode;
                document.getElementById(`ItemDim1Code${index}`).value = item.ItemDim1Code;
                document.getElementById(`ItemName${index}`).value = item.ItemDescription + " " + item.ColorThemeDescription;
                document.getElementById(`MLY_EUR${index}`).value = item.MLY_EUR;
                document.getElementById(`Qty1${index}`).value = "1";
            }
        }
    };
    xhr.open("GET", "../DataGetTransfer.php?barcode=" + barkod, true);
    xhr.send();
}

function removeRow(index) {
    var rowToRemove = document.getElementById(`focus${index}`);
    rowToRemove.parentNode.removeChild(rowToRemove);
    var dataRows = document.getElementsByClassName('dataRow');
    if (dataRows.length === 0) {
        document.getElementById('dataRows').style.display = 'none';
        document.getElementById('addRowSection').style.display = 'none';
        document.getElementById('barcodeSection').style.display = 'none';
        
        // AJAX isteği ile headerID'yi silme
        if (window.headerID) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../query/TransferAddDelete.php', true);
            xhr.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        toastr.success('İşlem Başarı İle Durduruldu.');
                        window.headerID = null; // headerID'yi sıfırlayın
                        document.getElementById('startProcessBtn').disabled = false; // "İşlem Başlat" butonunu tekrar etkinleştir
                    } else {
                        toastr.error('Silme işlemi başarısız: ' + response.message);
                    }
                } else if (xhr.readyState === 4) {
                    console.error('İşlem Durdurma Başarısız Oldu.:', xhr.responseText);
                    toastr.error('İşlem Durdurma Başarısız Oldu.');
                }
            };
            xhr.send(JSON.stringify({ headerID: window.headerID }));
        }
    }
}

function ilkHalineDon() {
    document.getElementById('startProcessBtn').disabled = false;
    document.getElementById('dataRows').style.display = 'none';
    document.getElementById('addRowSection').style.display = 'none';
    document.getElementById('barcodeSection').style.display = 'none';
    document.getElementById('dataRows').innerHTML = ''; // Tüm satırları temizle
    document.getElementById('myForm').reset(); // Formu sıfırla
}

window.onload = function () {
    document.getElementById('dataRows').style.display = 'none';
    document.getElementById('addRowSection').style.display = 'none';
    document.getElementById('barcodeSection').style.display = 'none';
}

document.getElementById('addRowBtn').addEventListener('click', function () {
    addRow();
});
