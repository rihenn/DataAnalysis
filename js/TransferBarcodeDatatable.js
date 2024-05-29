$(document).ready(function () {
    // Show Barcode Modal when button is clicked
    $('#BarcodeTableBtn').on('click', function () {
        $('#BarcodepopupModal').modal('show');
    });

    // Initialize DataTable
    var dataTable = $('#BarcodeTable').DataTable({
        ajax: {
            url: '../DataGetProduct.php',
            dataSrc: '' // Directly use JSON data from the server
        },
        columns: [
            { data: 'Barcode', title: 'Barkod' },
            { data: 'ItemCode', title: 'Ürün Kodu' },
            { data: 'ItemDescription', title: 'Ürün Açıklaması' },
            { data: 'ColorCode', title: 'Renk Kodu' },
            { data: 'ItemDim1Code', title: 'Ürün Boyut Kodu' },
            { data: 'MLY_EUR', title: 'Euro Bazlı Maliyet' },
            { data: 'ColorThemeCode', title: 'Renk Tema Kodu' },
            { data: 'ColorThemeDescription', title: 'Renk Tema Açıklaması' },
            { data: 'ColorCatalogCode', title: 'Renk Katalog Kodu' },
            { data: 'ColorCatalogDescription', title: 'Renk Katalog Açıklaması' }
        ],
        scrollY: "30rem",
        language: {
            "info": "_TOTAL_ kayıttan _START_ - _END_ arasındaki kayıtlar gösteriliyor",
            "infoEmpty": "Kayıt yok",
            "infoFiltered": "(_MAX_ kayıt içerisinden bulunan)",
            "lengthMenu": "Sayfada _MENU_ kayıt göster",
            "loadingRecords": "Yükleniyor...",
            "processing": "İşleniyor...",
            "search": "Ara:",
            "zeroRecords": "Eşleşen kayıt bulunamadı",
            "paginate": {
                "first": "İlk",
                "last": "Son",
                "next": "Sonraki",
                "previous": "Önceki"
            },
            "aria": {
                "sortAscending": ": artan sütun sıralamasını aktifleştir",
                "sortDescending": ": azalan sütun sıralamasını aktifleştir"
            }
        }
    });

    // Wait for the DataTable to be fully loaded
    dataTable.on('xhr', function () {
        console.log('DataTable loaded:', dataTable.data());
    });

    // Handle double-click event on table rows
    $('#BarcodeTable tbody').on('dblclick', 'tr', function () {
        var data = dataTable.row(this).data(); // Get data for the clicked row

        console.log('Row data:', data); // Log the data for debugging

        if (!data) {
            console.error('No data found for the selected row');
            return;
        }

        var barcode = data.Barcode || '';
        var ColorCode = data.ColorCode || '';
        var ItemDim1Code = data.ItemDim1Code || '';
        var MLY_EUR = data.MLY_EUR || '';
        var ItemCode = data.ItemCode || '';
        var ColorCatalogDescription = data.ColorCatalogDescription || ''; // ColorCatalogDescription bilgisini al

        var Inputbarcode = document.querySelectorAll('input.editBarcode');
        var InputColorCode = document.querySelectorAll('input.ColorCode');
        var InputItemDim1Code = document.querySelectorAll('input.ItemDim1Code');
        var InputMLY_EUR = document.querySelectorAll('input.ItemCostPrice');
        var InputItemCode = document.querySelectorAll('input.ItemCode');
        var InputColorCatalogDescription = document.querySelectorAll('input.ColorCatalogDescription'); // Yeni eklenen input alanı

        // Clear all input fields
        Inputbarcode.forEach(function (input) {
            input.value = '';
        });
        InputColorCode.forEach(function (input) {
            input.value = '';
        });
        InputItemDim1Code.forEach(function (input) {
            input.value = '';
        });
        InputMLY_EUR.forEach(function (input) {
            input.value = '';
        });
        InputItemCode.forEach(function (input) {
            input.value = '';
        });
        InputColorCatalogDescription.forEach(function (input) {
            input.value = '';
        });

        // Set new values
        Inputbarcode.forEach(function (input) {
            input.value = barcode;
        });
        InputColorCode.forEach(function (input) {
            input.value = ColorCode;
        });
        InputItemDim1Code.forEach(function (input) {
            input.value = ItemDim1Code;
        });
        InputMLY_EUR.forEach(function (input) {
            input.value = MLY_EUR;
        });
        InputItemCode.forEach(function (input) {
            input.value = ItemCode;
        });
        InputColorCatalogDescription.forEach(function (input) {
            input.value = ColorCatalogDescription;
        });

        // Hide the modal after setting the values
        $('#BarcodepopupModal').modal('hide');
    });
});
