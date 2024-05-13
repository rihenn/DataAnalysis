<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS dosyası -->
    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <!-- Boxicons CSS dosyası -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.7/datatables.min.css" rel="stylesheet">
    <title>Gifting</title>
</head>

<body style="height: 100vh;width:auto ;padding: 0!important;">
   


    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="../images/icon.jpg" alt="">
                </span>

                <div class="text logo-text">
                    <span class="name">Gifting</span>
                    <span class="profession">Admin</span>
                </div>
            </div>

            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">
                <li class="search-box">
                    <i class='bx bx-search icon'></i>
                    <input type="text" placeholder="Search...">
                </li>

                <ul class="menu-links p-0">
                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="transfer.php">
                            <i class='bx bx-bell icon'></i>
                            <span class="text nav-text">Transfer Gir</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-bar-chart-alt-2 icon'></i>
                            <span class="text nav-text">Revenue</span>
                        </a>
                    </li>


                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-pie-chart-alt icon'></i>
                            <span class="text nav-text">Analytics</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-heart icon'></i>
                            <span class="text nav-text">Likes</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-wallet icon'></i>
                            <span class="text nav-text">Wallets</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="#">
                        <i class='bx bx-log-out icon'></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>

                <li class="mode">
                    <div class="sun-moon">
                        <i class='bx bx-moon icon moon'></i>
                        <i class='bx bx-sun icon sun'></i>
                    </div>
                    <span class="mode-text text">Dark mode</span>

                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>
            </div>
        </div>
    </nav>
    <section class="home">
        <div class="text1">Transfer Add</div>
        <div id="sonuc"></div>
        <div class="row justify-content-center">
    <div class="col-md-12">
        <form>

            <div id="dataRows">
                <div id="focus" class="row mb-3 justify-content-center">
              
                    <div class="col-md-1">
                        <label for="ProcessCode" class="form-label">ProcessCode:</label>
                        <select class="form-select" id="ProcessCode" name="ProcessCode">
                            <option value="GF">Gifting</option>
                            <option value="SD">Seeding</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <label for="ItemBarcode" class="form-label">ItemBarcode:</label>
                        <input type="text" class="form-control" id="ItemBarcode" onkeyup="veriGetir(this.value)" name="ItemBarcode[]">
                    </div>
                    <div class="col-md-1">
                        <label for="ItemCode" class="form-label">ItemCode:</label>
                        <input type="text" class="form-control" id="ItemCode" name="ItemCode[]">
                    </div>
                    <div class="col-md-1">
                        <label for="ColorCode" class="form-label">ColorCode:</label>
                        <input type="text" class="form-control" id="ColorCode" name="ColorCode[]">
                    </div>
                    <div class="col-md-1">
                        <label for="ItemDim1Code" class="form-label">ItemDim1Code:</label>
                        <input type="text" class="form-control" id="ItemDim1Code" name="ItemDim1Code[]">
                    </div>
                    <div class="col-md-1">
                        <label for="Qty1" class="form-label">Qty1:</label>
                        <input type="text" class="form-control" id="Qty1" name="Qty1[]">
                    </div>
                    <div class="col-md-1">
                        <label for="SendInfCode" class="form-label">SendInfCode:</label>
                        <input type="text" class="form-control" id="SendInfCode" name="SendInfCode[]">
                    </div>
                    <div class="col-md-1">
                        <label for="SendInfName" class="form-label">SendInfName:</label>
                        <input type="text" class="form-control" id="SendInfName" name="SendInfName[]">
                    </div>
                    <div class="col-md-1">
                        <label for="Post" class="form-label">Post:</label>
                        <input type="text" class="form-control" id="Post" name="Post[]">
                    </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-1">
        <button type="button" class="btn btn-success" id="addRowBtn">Satır Ekle</button>
    </div>
    <div class="col-md-1">
        <button type="button" class="btn btn-primary">Gönder</button>
    </div>
</div>

>



        <div class="container ml-5">
            <div id="tableContainer" class="table-response text-center">
                <table id="MyTable" style="margin: 0.2rem;border:0.1px solid;" class="table  table-striped text-center">
                    <thead class="text-center">
                        <tr>
                            <th>ItemCode</th>
                            <th>Username</th>
                            <th>Ülke Kodu</th>
                            <th>Ülke</th>
                            <th>City</th>
                            <th>Address</th>
                            <th>CreatedUserName</th>
                            <th>CreatedDate</th>
                            <th>LastUpdatedUserName</th>
                            <th>LastUpdatedDate</th>
                            <th>IsActive</th>
                            <!-- Add more columns if needed -->
                        </tr>
                    </thead>
                    <tbody class="text-center">

                    </tbody>
                </table>

            </div>
        </div>
  
    </section>
    <!-- JavaScript dosyası -->
    <script src="../js/app.js"></script>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/v/bs5/dt-2.0.7/datatables.min.js"></script>
    <script>
        // DataTable başlatma ve tablo nesnesini bir değişkene atama
        var dataTable = $('#MyTable').DataTable({
            ajax: {
                url: '../DataGetProduct.php',
                dataSrc: '' // Sunucudan gelen JSON verilerinin doğrudan kullanılacağını belirtir
            },
            columns: [
                { data: 'ItemCode', title: 'Ürün Kodu' },
                { data: 'ItemDescription', title: 'Ürün Açıklaması' },
                { data: 'ColorCode', title: 'Renk Kodu' },
                { data: 'ItemDim1Code', title: 'Ürün Boyut Kodu' },
                { data: 'Barcode', title: 'Barkod' },
                { data: 'ColorThemeCode', title: 'Renk Tema Kodu' },
                { data: 'ColorThemeDescription', title: 'Renk Tema Açıklaması' },
                { data: 'ColorCatalogCode', title: 'Renk Katalog Kodu' },
                { data: 'ProductHierarchyLevel01', title: 'Ürün Hiyerarşisi Seviye 01' },
                { data: 'ProductHierarchyLevel02', title: 'Ürün Hiyerarşisi Seviye 02' },
                { data: 'ProductHierarchyLevel03', title: 'Ürün Hiyerarşisi Seviye 03' },
                { data: 'ProductHierarchyLevel04', title: 'Ürün Hiyerarşisi Seviye 04' },
                { data: 'ProductHierarchyLevel05', title: 'Ürün Hiyerarşisi Seviye 05' }
            ],
            scrollX: true,
            scrollY: "20rem",
            language: {
                "info": "_TOTAL_ kayıttan _START_ - _END_ arasındaki kayıtlar gösteriliyor",
                "infoEmpty": "Kayıt yok",
                "infoFiltered": "(_MAX_ kayıt içerisinden bulunan)",
                "infoThousands": ".",
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
                },
                "select": {
                    "rows": {
                        "_": "%d kayıt seçildi",
                        "1": "1 kayıt seçildi"
                    },
                    "cells": {
                        "1": "1 hücre seçildi",
                        "_": "%d hücre seçildi"
                    },
                    "columns": {
                        "1": "1 sütun seçildi",
                        "_": "%d sütun seçildi"
                    }
                },
                "autoFill": {
                    "cancel": "İptal",
                    "fillHorizontal": "Hücreleri yatay olarak doldur",
                    "fillVertical": "Hücreleri dikey olarak doldur",
                    "fill": "Bütün hücreleri <i>%d<\/i> ile doldur",
                    "info": "Detayı"
                },
                "buttons": {
                    "collection": "Koleksiyon <span class=\"ui-button-icon-primary ui-icon ui-icon-triangle-1-s\"><\/span>",
                    "colvis": "Sütun görünürlüğü",
                    "colvisRestore": "Görünürlüğü eski haline getir",
                    "copySuccess": {
                        "1": "1 satır panoya kopyalandı",
                        "_": "%ds satır panoya kopyalandı"
                    },
                    "copyTitle": "Panoya kopyala",
                    "csv": "CSV",
                    "excel": "Excel",
                    "pageLength": {
                        "-1": "Bütün satırları göster",
                        "_": "%d satır göster",
                        "1": "1 Satır Göster"
                    },
                    "pdf": "PDF",
                    "print": "Yazdır",
                    "copy": "Kopyala",
                    "copyKeys": "Tablodaki veriyi kopyalamak için CTRL veya u2318 + C tuşlarına basınız. İptal etmek için bu mesaja tıklayın veya escape tuşuna basın.",
                    "createState": "Şuanki Görünümü Kaydet",
                    "removeAllStates": "Tüm Görünümleri Sil",
                    "removeState": "Aktif Görünümü Sil",
                    "renameState": "Aktif Görünümün Adını Değiştir",
                    "savedStates": "Kaydedilmiş Görünümler",
                    "stateRestore": "Görünüm -&gt; %d",
                    "updateState": "Aktif Görünümün Güncelle"
                },
                "searchBuilder": {
                    "add": "Koşul Ekle",
                    "button": {
                        "0": "Arama Oluşturucu",
                        "_": "Arama Oluşturucu (%d)"
                    },
                    "condition": "Koşul",
                    "conditions": {
                        "date": {
                            "after": "Sonra",
                            "before": "Önce",
                            "between": "Arasında",
                            "empty": "Boş",
                            "equals": "Eşittir",
                            "not": "Değildir",
                            "notBetween": "Dışında",
                            "notEmpty": "Dolu"
                        },
                        "number": {
                            "between": "Arasında",
                            "empty": "Boş",
                            "equals": "Eşittir",
                            "gt": "Büyüktür",
                            "gte": "Büyük eşittir",
                            "lt": "Küçüktür",
                            "lte": "Küçük eşittir",
                            "not": "Değildir",
                            "notBetween": "Dışında",
                            "notEmpty": "Dolu"
                        },
                        "string": {
                            "contains": "İçerir",
                            "empty": "Boş",
                            "endsWith": "İle biter",
                            "equals": "Eşittir",
                            "not": "Değildir",
                            "notEmpty": "Dolu",
                            "startsWith": "İle başlar",
                            "notContains": "İçermeyen",
                            "notStartsWith": "Başlamayan",
                            "notEndsWith": "Bitmeyen"
                        },
                        "array": {
                            "contains": "İçerir",
                            "empty": "Boş",
                            "equals": "Eşittir",
                            "not": "Değildir",
                            "notEmpty": "Dolu",
                            "without": "Hariç"
                        }
                    },
                    "data": "Veri",
                    "deleteTitle": "Filtreleme kuralını silin",
                    "leftTitle": "Kriteri dışarı çıkart",
                    "logicAnd": "ve",
                    "logicOr": "veya",
                    "rightTitle": "Kriteri içeri al",
                    "title": {
                        "0": "Arama Oluşturucu",
                        "_": "Arama Oluşturucu (%d)"
                    },
                    "value": "Değer",
                    "clearAll": "Filtreleri Temizle"
                },
                "searchPanes": {
                    "clearMessage": "Hepsini Temizle",
                    "collapse": {
                        "0": "Arama Bölmesi",
                        "_": "Arama Bölmesi (%d)"
                    },
                    "count": "{total}",
                    "countFiltered": "{shown}\/{total}",
                    "emptyPanes": "Arama Bölmesi yok",
                    "loadMessage": "Arama Bölmeleri yükleniyor ...",
                    "title": "Etkin filtreler - %d",
                    "showMessage": "Tümünü Göster",
                    "collapseMessage": "Tümünü Gizle"
                },
                "thousands": ".",
                "datetime": {
                    "amPm": [
                        "öö",
                        "ös"
                    ],
                    "hours": "Saat",
                    "minutes": "Dakika",
                    "next": "Sonraki",
                    "previous": "Önceki",
                    "seconds": "Saniye",
                    "unknown": "Bilinmeyen",
                    "weekdays": {
                        "6": "Paz",
                        "5": "Cmt",
                        "4": "Cum",
                        "3": "Per",
                        "2": "Çar",
                        "1": "Sal",
                        "0": "Pzt"
                    },
                    "months": {
                        "9": "Ekim",
                        "8": "Eylül",
                        "7": "Ağustos",
                        "6": "Temmuz",
                        "5": "Haziran",
                        "4": "Mayıs",
                        "3": "Nisan",
                        "2": "Mart",
                        "11": "Aralık",
                        "10": "Kasım",
                        "1": "Şubat",
                        "0": "Ocak"
                    }
                },
                "decimal": ",",
                "editor": {
                    "close": "Kapat",
                    "create": {
                        "button": "Yeni",
                        "submit": "Kaydet",
                        "title": "Yeni kayıt oluştur"
                    },
                    "edit": {
                        "button": "Düzenle",
                        "submit": "Güncelle",
                        "title": "Kaydı düzenle"
                    },
                    "error": {
                        "system": "Bir sistem hatası oluştu (Ayrıntılı bilgi)"
                    },
                    "multi": {
                        "info": "Seçili kayıtlar bu alanda farklı değerler içeriyor. Seçili kayıtların hepsinde bu alana aynı değeri atamak için buraya tıklayın; aksi halde her kayıt bu alanda kendi değerini koruyacak.",
                        "noMulti": "Bu alan bir grup olarak değil ancak tekil olarak düzenlenebilir.",
                        "restore": "Değişiklikleri geri al",
                        "title": "Çoklu değer"
                    },
                    "remove": {
                        "button": "Sil",
                        "confirm": {
                            "_": "%d adet kaydı silmek istediğinize emin misiniz?",
                            "1": "Bu kaydı silmek istediğinizden emin misiniz?"
                        },
                        "submit": "Sil",
                        "title": "Kayıtları sil"
                    }
                },
                "stateRestore": {
                    "creationModal": {
                        "button": "Kaydet",
                        "columns": {
                            "search": "Kolon Araması",
                            "visible": "Kolon Görünümü"
                        },
                        "name": "Görünüm İsmi",
                        "order": "Sıralama",
                        "paging": "Sayfalama",
                        "scroller": "Kaydırma (Scrool)",
                        "search": "Arama",
                        "searchBuilder": "Arama Oluşturucu",
                        "select": "Seçimler",
                        "title": "Yeni Görünüm Oluştur",
                        "toggleLabel": "Kaydedilecek Olanlar"
                    },
                    "duplicateError": "Bu Görünüm Daha Önce Tanımlanmış",
                    "emptyError": "Görünüm Boş Olamaz",
                    "emptyStates": "Herhangi Bir Görünüm Yok",
                    "removeJoiner": "ve",
                    "removeSubmit": "Sil",
                    "removeTitle": "Görünüm Sil",
                    "renameButton": "Değiştir",
                    "renameLabel": "Görünüme Yeni İsim Ver -&gt; %s:",
                    "renameTitle": "Görünüm İsmini Değiştir",
                    "removeConfirm": "Görünümü silmek istediğinize emin misiniz?",
                    "removeError": "Görünüm silinemedi"
                },
                "emptyTable": "Tabloda veri bulunmuyor",
                "searchPlaceholder": "Arayın...",
                "infoPostFix": " "

            },
        }


        );
//    // Satır tıklama olayı ekleme
// $('#MyTable tbody').on('click', 'tr', function () {
//     // Tıklanan satırdaki verileri alın
//     var rowData = dataTable.row(this).data();

//     // Alınan verileri istediğiniz yere yazın
//     // Örneğin, bir div içine yazdırmak için:
//     document.getElementById("ItemBarcode").value = rowData.Barcode;

// });

// // Inputlara focus olduğunda işlem yapma
// $('#MyTable tbody').on('focus', 'input', function () {
//     // Input'un içinde olduğu div'in id'sini alın
//     var parentDivId = $(this).closest('div[id^="focus"]').attr('id');
//     console.log("Focus olan inputun bulunduğu div id'si: ", parentDivId);

//     // Eğer parentDivId değişkeni boş değilse
//     if (parentDivId) {
//         // Div içindeki Barcode id'li input alanına bir değer yazın
//         $('#' + parentDivId + ' input#Barcode').val("Yazılacak Değer");
//     }
// });


       
    </script>



<script>

function veriGetir(barkod) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var veri = JSON.parse(this.responseText);
            // Veriyi işleme


            // Item code input alanına veriyi yazdırma
            document.getElementById("ItemCode").value = veri[0].ItemCode;
            document.getElementById("ColorCode").value = veri[0].ColorCode;
            document.getElementById("ItemDim1Code").value = veri[0].ItemDim1Code;

        }
    };
    xhr.open("GET", "../DataGetTransfer.php?barcode=" + barkod, true);
    xhr.send();
}

</script>
<script>
   document.getElementById('addRowBtn').addEventListener('click', function () {
    var dataRows = document.getElementsByClassName('dataRow');
    var index = dataRows.length + 1;

    var newRow = document.createElement('div');
    newRow.classList.add('row', 'dataRow','mb-3','justify-content-center');
    newRow.id = `focus${index}`;
    newRow.innerHTML = `
 
        <div class="col-md-1 ">
            <label for="ProcessCode${index}" class="form-label">ProcessCode:</label>
            <select class="form-select" id="ProcessCode${index}" name="ProcessCode[]">
                <option value="GF">Gifting</option>
                <option value="SD">Seeding</option>
            </select>
        </div>
        <div class="col-md-1">
            <label for="ItemBarcode${index}" class="form-label">ItemBarcode:</label>
            <input type="text" class="form-control" id="ItemBarcode${index}" name="ItemBarcode[]">
        </div>
        <div class="col-md-1">
            <label for="ItemCode${index}" class="form-label">ItemCode:</label>
            <input type="text" class="form-control" id="ItemCode${index}" name="ItemCode[]">
        </div>
        <div class="col-md-1">
            <label for="ColorCode${index}" class="form-label">ColorCode:</label>
            <input type="text" class="form-control" id="ColorCode${index}" name="ColorCode[]">
        </div>
        <div class="col-md-1">
            <label for="ItemDim1Code${index}" class="form-label">ItemDim1Code:</label>
            <input type="text" class="form-control" id="ItemDim1Code${index}" name="ItemDim1Code[]">
        </div>
        <div class="col-md-1">
            <label for="Qty1${index}" class="form-label">Qty1:</label>
            <input type="text" class="form-control" id="Qty1${index}" name="Qty1[]">
        </div>
        <div class="col-md-1">
            <label for="SendInfCode${index}" class="form-label">SendInfCode:</label>
            <input type="text" class="form-control" id="SendInfCode${index}" name="SendInfCode[]">
        </div>
        <div class="col-md-1">
            <label for="SendInfName${index}" class="form-label">SendInfName:</label>
            <input type="text" class="form-control" id="SendInfName${index}" name="SendInfName[]">
        </div>
        <div class="col-md-1">
            <label for="Post${index}" class="form-label">Post:</label>
            <input type="text" class="form-control" id="Post${index}" name="Post[]">
        </div>
        
    `;
    document.getElementById('dataRows').appendChild(newRow);
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

</script>

</body>

</html>