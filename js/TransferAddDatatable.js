
// DataTable başlatma ve tablo nesnesini bir değişkene atama
var dataTable = $('#MyTable').DataTable({
    ajax: {
        url: '../DataGetProduct.php',
        dataSrc: '' // Sunucudan gelen JSON verilerinin doğrudan kullanılacağını belirtir
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
$('#MyTable tbody').on('dblclick', 'tr', function () {
    var data = dataTable.row(this).data(); // dataTable.row kullanıldı
    var barcode = data.Barcode;
    var ColorCode = data.ColorCode;
    var ItemDim1Code = data.ItemDim1Code;
    var name = data.ItemDescription + " " + data.ColorThemeDescription;
    var MLY_EUR = data.MLY_EUR;
    var ItemCode = data.ItemCode;
    var ColorCatalogDescription = data.ColorCatalogDescription; // ColorCatalogDescription bilgisini al

    // Barkodu panoya kopyalamak için bir textarea oluşturun ve içine barkodu yazın
    var tempTextarea = document.createElement('textarea');
    tempTextarea.value = barcode;
    tempTextarea.setAttribute('readonly', ''); // Yazılamaz hale getir
    tempTextarea.style.position = 'absolute';
    tempTextarea.style.left = '-9999px'; // Ekran dışında konumlandır
    document.body.appendChild(tempTextarea);

    // Barkodu seçip kopyalama işlemi
    tempTextarea.select();
    document.execCommand('copy');

    // Geçici textarea'yı kaldır
    document.body.removeChild(tempTextarea);

    // Kullanıcıya kopyalandı mesajını göstermek için bir div oluşturun
    var messageDiv = document.createElement('div');
    messageDiv.textContent = 'Barcode kopyalandı: ' + barcode;
    messageDiv.style.position = 'fixed';
    messageDiv.style.top = '50%'; // Yukarıdan yarıya konumlandır
    messageDiv.style.right = '20px'; // Sağdan 20 piksel mesafede
    messageDiv.style.transform = 'translateY(-50%)'; // Dikey hizalama
    messageDiv.style.padding = '10px';
    messageDiv.style.background = '#fff';
    messageDiv.style.border = '1px solid #ccc';
    messageDiv.style.borderRadius = '5px';
    messageDiv.style.boxShadow = '0 2px 5px rgba(0,0,0,0.2)';
    document.body.appendChild(messageDiv);

    // Yazının belirli bir süre sonra kaybolmasını sağlayın
    setTimeout(function () {
        document.body.removeChild(messageDiv);
    }, 2000); // 2 saniye sonra sil

    // Find the first empty input with class 'barcode' to write the barcode
    var Inputbarcode = document.querySelectorAll('input.barcode');
    var InputColorCode = document.querySelectorAll('input.ColorCode');
    var InputItemDim1Code = document.querySelectorAll('input.ItemDim1Code');
    var Inputname = document.querySelectorAll('input.name');
    var InputMLY_EUR = document.querySelectorAll('input.MLY_EUR');
    var InputItemCode = document.querySelectorAll('input.ItemCode');
    var InputColorCatalogDescription = document.querySelectorAll('input.ColorCatalogDescription'); // Yeni eklenen input alanı
    var Inputqty1 = document.querySelectorAll('input.Qty1');
    for (var i = 0; i < Inputbarcode.length; i++) {
        if (Inputbarcode[i].value === '') {
            Inputbarcode[i].value = barcode;
            InputItemDim1Code[i].value = ItemDim1Code;
            Inputname[i].value = name;
            InputMLY_EUR[i].value = MLY_EUR;
            InputItemCode[i].value = ItemCode;
            InputColorCode[i].value = ColorCode;
            InputColorCatalogDescription[i].value = ColorCatalogDescription; // Yeni eklenen alanı doldur
            var closeButton = document.getElementById('closeButton');
            closeButton.click();

            break;
        }
    }
});