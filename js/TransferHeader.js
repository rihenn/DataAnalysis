$(document).ready(function() {
    // DataTable'ı başlat
    var table = $('#MyTable').DataTable({
        ajax: {
            url: '../DataGetSendingHeader.php',
            dataSrc: '' // Sunucudan gelen JSON verilerinin doğrudan kullanılacağını belirtir
        },
        columns: [
            { data: 'SendInfCode', title: 'Inf Kodu' },
            { data: 'SendInfName', title: 'Inf Adı' },
            { data: 'TransferNumber', title: 'Transfer Numarası' },
            { data: 'ShippingCostPrice', title: 'Gönderim Ücreti' },
            { data: 'TotalItemCostPrice', title: 'Ürün Maliyeti' },
            { 
                data: 'SendDate', 
                title: 'Gönderim Tarihi',
                render: function (data, type, row) {
                    if (!data) return '';
    
                    // Tarih verisini doğru formatta parse et
                    var date = moment(data.date, 'YYYY-MM-DD HH:mm:ss.SSSSSS');
                    if (!date.isValid()) {
                        return 'Geçersiz tarih';
                    }
    
                    // Sadece tarih kısmını 'YYYY-MM-DD' formatında döndür
                    return date.format('YYYY-MM-DD');
                }
            },
            { data: 'ProcessCode', title: 'Süreç Kodu' }
        ],
            scrollY: '35rem',
            scrollCollapse: true,
            scrollX: true,
           
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
        });
       // DataTable'daki herhangi bir hücreye çift tıklandığında popup oluştur
    // DataTable'daki herhangi bir hücreye çift tıklandığında popup oluştur
    $(document).ready(function() {
        $('#MyTable').on('click', 'td', function() {
            // Tıklanan hücrenin bulunduğu satırı al
            var row = $(this).closest('tr');
            
            // Satırdaki transfer numarasını al (örneğin, 3. sütundaki veri)
            var transferNumber = row.find('td').eq(2).text();
            
            // Transfer numarasını al ve popup modal'de göstermek için
            $('#popupModalLabel').text('Transfer Numarası: ' + transferNumber);
            
            // Popup modal'i aç
            $('#popupModal').modal('show');
        });
    });
});
    
       
    

