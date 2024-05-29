$(document).ready(function() {
    // Ana tabloyu başlatın
   
   var table = $('#MyTable').DataTable({
        scrollX: true,
        ajax: {
            url: '../DataGetCdInfluecer.php',
            dataSrc: '' // Sunucudan gelen JSON verilerinin doğrudan kullanılacağını belirtir
        },
        columns: [{
            data: 'Code',
            title: 'Inf Kodu',
            width: '150px',
            className: 'dt-center'
        },
        {
            data: 'FirstName',
            title: 'Adı',
            width: '150px',
            className: 'dt-center'
        },
        {
            data: 'LastName',
            title: 'Soyadı',
            width: '150px',
            className: 'dt-center'
        },
        {
            data: 'CountryCode',
            title: 'Ülke Kodu',
            width: '150px',
            className: 'dt-center'
        },
        {
            data: 'Country',
            title: 'Ülke',
            width: '150px',
            className: 'dt-center'
        },
        {
            data: 'City',
            title: 'Şehir',
            width: '150px',
            className: 'dt-center'
        },
        {
            data: 'Address',
            title: 'Adres',
            width: '200px',
            className: 'dt-center'
        }
        ],
        "columnDefs": [{
            "targets": 6, // Address sütunu
            "render": function (data, type, row, meta) {
                if (type === 'display') {
                    var truncatedData = '<span class="truncate">' + data + '</span>';
                    var moreLink = ' <span class="more-link link-dark">...</span>';
                    return truncatedData + moreLink;
                }
                return data;
            }
        }],
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
    $('#MyTable tbody').on('click', 'span.more-link', function () {
        var $this = $(this);
        var $cell = $this.closest('td');
        var fullText = $cell.text().replace('...', ''); // "..." kısmını çıkar
        $cell.html(fullText); // Tam metni hücreye yerleştir
    });
    // DataTable'ı modal içinde oluştur
    var detailsTable = $('#detailsTable').DataTable({
     
        columns: [
            { data: 'InfluecerCode', title: 'Influencer Kodu' },
            { data: 'FirstName', title: 'Ad' },
            { data: 'LastName', title: 'Soyad' },
            { data: 'AttributeTypeCode', title: 'Özellik Tip Kodu' },
            { data: 'AttributeName', title: 'Özellik Adı' },
            { data: 'AttributeCode', title: 'Özellik Kodu' },
            { data: 'Attribute', title: 'Özellik Değeri' },
            { 
                data: null, 
                title: 'Düzenle', 
                render: function(data, type, row) {
                    return '<button class="btn btn-primary edit-btn" data-id="' + row.InfluecerCode + '">Düzenle</button>';
                }
            },
            { 
                data: null, 
                title: 'Kaldır', 
                render: function(data, type, row) {
                    return '<button class="btn btn-danger btn-delete" data-id="' + row.InfluecerCode + '">Kaldır</button>';
                }
            }
        ],
        scrollY: "20rem", // Dikey kaydırma
        scrollX: true,    // Yatay kaydırma
        autoWidth: false, // Otomatik genişlik ayarı
        
        
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
    )

// Düzenle düğmesine tıklama olayı
$('#detailsTable').on('click', '.edit-btn', function() {
    var rowData = detailsTable.row($(this).parents('tr')).data();
    
    // Verileri konsola logla
    console.log("Seçilen Satır Verileri:", rowData);
    
    // Modal formunu doldur
    infcode =rowData.InfluecerCode;
    $('#editAttributeType').val(rowData.AttributeTypeCode);
    attributeType = (rowData.AttributeTypeCode);
    $('#editAttributeValue').val(rowData.AttributeCode); 
    attributeValue = (rowData.AttributeCode); 

    // Modalı göster
    $('#editAttributeModal').modal('show');
});

// Düzenleme formunu gönderme olayı
$('#editAttributeForm').on('submit', function(e) {
    e.preventDefault();
    // Düzenleme işlemi için AJAX isteği
    var formData = {
        infcode,
        attributeType,
        attributeValue,
        newAttributeType: $('#editAttributeType').val(),
        newAttributeValue: $('#editAttributeValue').val()
    };

    console.log("Gönderilen Form Verileri:", formData);

    $.ajax({
        url: '../query/UpdateInfAttribute.php', // Güncelleme işlemi yapan PHP dosyası
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(formData),
        success: function(response) {
            var result = JSON.parse(response);
            if (result.success) {
                toastr.success('Kayıt başarıyla güncellendi.');
                $('#editAttributeModal').modal('hide');
                $('#infCodeModal').modal('hide');
                $('#infCodeModal').modal('show');
            
            } else {
                toastr.error(result.message);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            toastr.error('Güncelleme sırasında bir hata oluştu.');
            console.error('AJAX hatası:', textStatus, errorThrown);
        }
    });
});



 // Kaldır düğmesine tıklama olayı
 $('#detailsTable').on('click', '.btn-delete', function() {
    var row = $(this).closest('tr');
    var rowData = detailsTable.row(row).data();
    console.log('Silinecek satır verisi:', rowData); // Konsola logla
    deleteRow = row; // Silinecek satırı kaydet
    $('#deleteConfirmModal').modal('show'); // Silme onay modalını göster
});

// Silme işlemini onayla
$('#confirmDelete').on('click', function() {
    var data = detailsTable.row(deleteRow).data();
    var infCode = data.InfluecerCode; // Doğru yazım
    var attributeType = data.AttributeTypeCode;
    var attributeValue = data.AttributeCode;
    console.log("Silinecek veri - Influencer Kodu: " + infCode + ", Özellik Tipi: " + attributeType + ", Özellik Değeri: " + attributeValue);

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
            detailsTable.row(deleteRow).remove().draw(false);
        } else {
            toastr.error('Kayıt silinirken bir hata oluştu: ' + (data.error || 'Bilinmeyen hata'));
        }
        $('#deleteConfirmModal').modal('hide');
    })
    .catch(error => {
        console.error('Fetch error:', error);
        toastr.error('Kayıt silinirken bir hata oluştu.');
        $('#deleteConfirmModal').modal('hide');
    });
});



// Ana tabloda çift tıklama olayını dinleyin
$('#MyTable tbody').on('dblclick', 'tr', function() {
    var data = table.row(this).data();
    console.log('Ana tablo verisi:', data); // Ana tablo verisi
    var infCode = data.Code; // Verinizdeki infCode alanını güncelleyin
    console.log('Inf Kodu:', infCode); // Inf Kodu

    $('#infCode').val(infCode);
    $('#firstName').val(data.FirstName);
    $('#lastName').val(data.LastName);

    $('#infCodeModalLabel').text('Inf Kodu: ' + infCode);

    // AJAX isteği ile infCode bilgilerini al ve DataTable'a ekle
    $.ajax({
        url: '../DataGetPrInfluencerAtt.php', // Veriyi getirecek PHP dosyası
        type: 'GET',
        data: { infCode: infCode },
        dataType: 'json',
        success: function(data) {
            console.log('Alınan veri:', data); // Alınan veri
            detailsTable.clear().rows.add(data).draw(); // Veriyi DataTable'a ekle
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('AJAX hatası:', textStatus, errorThrown); // AJAX hatası
            toastr.error('Veriler getirilirken bir hata oluştu.');
        }
    });

    // Modalı gösterin
    $('#infCodeModal').modal('show');
});

// Modal kapandığında tablodaki veriyi temizle
$('#infCodeModal').on('hidden.bs.modal', function() {
    detailsTable.clear().draw();
});

// Formu gönderme işlemi
$('#attributeForm').on('submit', function(e) {
    e.preventDefault();

    // Form verilerini topla
    var formData = {
        infCode: $('#infCode').val(),
        firstName: $('#firstName').val(),
        lastName: $('#lastName').val(),
        attributeType: $('#attributeType').val(),
        attributeValue: $('#attributeValue').val()
    };

    // Tüm alanların doldurulup doldurulmadığını kontrol et
    if (!formData.infCode || !formData.firstName || !formData.lastName || !formData.attributeType || !formData.attributeValue) {
        toastr.warning('Lütfen Tüm Alanları Doldurunuz.');
        return;
    }

    // AJAX ile verileri PHP scriptine gönder
    $.ajax({
        url: '../query/InsertAttributeInf.php',  // PHP scriptinizin yolunu buraya girin
        type: 'POST',
        data: formData,
        success: function(response) {
            var result = JSON.parse(response);
            if (result.success) {
                // Başarılı mesajı göster
                toastr.success(result.message);
                $('#infCodeModal').modal('hide');
                detailsTable.ajax.reload(null, false); // detailsTable verilerini yeniden yükle
            } else {
                // Hata mesajı göster
                if (result.message === 'Aynı kayıttan bir daha girilemez') {
                    toastr.warning('Aynı Kayıttan Bir Daha Girilemez!');
                } else {
                    toastr.error(result.message);
                }
            }
        },
        error: function(xhr, status, error) {
            // Hata mesajı göster
            toastr.error('Veriler kaydedilirken bir hata oluştu');
            console.error(error);
        }
    });
});


});