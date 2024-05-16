function veriGetir(barkod, index) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var veri = JSON.parse(this.responseText);

            // Veriyi işleme
            // İlgili satırdaki input alanlarına verileri doldurma
            document.getElementById(`ItemCode${index}`).value = veri[0].ItemCode;
            document.getElementById(`ColorCode${index}`).value = veri[0].ColorCode;
            document.getElementById(`ItemDim1Code${index}`).value = veri[0].ItemDim1Code;
            document.getElementById(`ItemName${index}`).value = veri[0].ItemDescription + " " + veri[0].ColorThemeDescription;
            // document.getElementById(`MLY_EUR${index}`).value = veri[0].MLY_EUR;
        }
    };
    xhr.open("GET", "../DataGetTransfer.php?barcode=" + barkod, true);
    xhr.send();
}

function addRow() {
    var dataRows = document.getElementsByClassName('dataRow');
    var index = dataRows.length + 1;

    var newRow = document.createElement('div');
    newRow.classList.add('row', 'dataRow', 'mb-3', 'justify-content-start');
    newRow.id = `focus${index}`;
    newRow.innerHTML = `

<div class="w-100"></div> <!-- Yeni satıra geçiş için boş bir div -->
<div class="offset-md-2 col-md-1">
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
    <label for="MLY_EUR${index}" class="form-label">Euro Maliyeti:</label>
    <input type="text" class="form-control form-control-sm MLY_EUR" id="MLY_EUR${index}" name="MLY_EUR[]">
</div>
<div class="col-md-1">
    <label for="Qty1${index}" class="form-label">Adet:</label>
    <input type="text" class="form-control form-control-sm" id="Qty1${index}" name="Qty1[]">
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
            }
        }
    };
    xhr.open("GET", "../DataGetTransfer.php?barcode=" + barkod, true);
    xhr.send();
}

// Silme buttonu
function removeRow(index) {
    var rowToRemove = document.getElementById(`focus${index}`);
    rowToRemove.parentNode.removeChild(rowToRemove);
}

// Sayfa yüklenir yüklenmez otomatik olarak bir satır ekle
window.onload = function () {
    addRow();
}

// "Add Row" düğmesine tıklama olayı
document.getElementById('addRowBtn').addEventListener('click', function () {
    addRow();
});

document.getElementById('myForm').addEventListener('submit', function (event) {
    event.preventDefault();
    var formData = new FormData(this);
    var formObject = {};
    var dataArray = [];
    formData.forEach(function (value, key) {
        dataArray.push({ [key]: value });
    });
    console.log(dataArray);
});

