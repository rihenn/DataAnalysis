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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.7/datatables.min.css" rel="stylesheet">
    <style>
        .truncate {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 150px;
            /* Sütun genişliği ayarlanabilir */
            display: inline-block;
            vertical-align: auto;
        }

        .more-link {
            cursor: pointer;
            color: blue;
            text-decoration: underline;
        }
    </style>
    <title>Gifting</title>
</head>

<body style="height: 100vh;width:auto ;padding: 0!important;">




<!-- Modal Popup -->
<div class="modal fade" id="infCodeModal" tabindex="-1" aria-labelledby="infCodeModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="--bs-modal-width: 50% !important">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infCodeModalLabel">Inf Kodu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped justify-content-center" id="detailsTable">
                            <!-- Tablo içeriği burada olacak -->
                        </table>
                        <!-- Özellikler için metin alanları ve kaydet butonu -->
                        <form id="attributeForm">
                            <input type="hidden" id="infCode" name="infCode">
                            <input type="hidden" id="firstName" name="firstName">
                            <input type="hidden" id="lastName" name="lastName">
                            <div class="mb-3">
                                <label for="attributeType" class="form-label">Özellik Tipi</label>
                                <input type="text" class="form-control" id="attributeType" name="attributeType">
                            </div>
                            <div class="mb-3">
                                <label for="attributeValue" class="form-label">Özellik Değeri</label>
                                <input type="text" class="form-control" id="attributeValue" name="attributeValue">
                            </div>
                            <button type="submit" class="btn btn-primary">Kaydet</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  
<!-- Silme Onay Modali -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteConfirmModalLabel">Onayla</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Bu kaydı silmek istediğinize emin misiniz?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
        <button type="button" class="btn btn-danger" id="confirmDelete">Sil</button>
      </div>
    </div>
  </div>
</div>


 
<!-- Düzenleme Modali -->
<div class="modal fade" id="editAttributeModal" tabindex="-1" aria-labelledby="editAttributeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editAttributeModalLabel">Özelliği Düzenle</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editAttributeForm">
          <div class="mb-3">
            <label for="editAttributeType" class="form-label">Özellik Tipi</label>
            <input type="text" class="form-control" id="editAttributeType" name="editAttributeType" required>
          </div>
          <div class="mb-3">
            <label for="editAttributeValue" class="form-label">Özellik Değeri</label>
            <input type="text" class="form-control" id="editAttributeValue" name="editAttributeValue" required>
          </div>
          <button type="submit" class="btn btn-primary">Kaydet</button>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="popupModal" tabindex="-1" aria-labelledby="popupModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="popupModalLabel">Kart Ekle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="insertForm" action="../query/insert.php" method="post">
                        <input class="border form-control mb-3" type="text" id="firstName" name="firstName"
                            placeholder="İsim">
                        <input class="border form-control mb-3" type="text" id="lastName" name="lastName"
                            placeholder="Soyisim">
                        <input class="border form-control mb-3" type="text" id="countryCode" name="countryCode"
                            placeholder="Ülke Kodu">
                        <input class="border form-control mb-3" type="text" id="country" name="country"
                            placeholder="Ülke">
                        <input class="border form-control mb-3" type="text" id="city" name="city" placeholder="Şehir">
                        <input class="border form-control mb-3" type="text" id="address" name="address"
                            placeholder="Adres"> 
                        <button class="btn btn-primary" type="submit" id="saveButton">Kaydet</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

    <div class="modal fade" id="AttributeTypepopupModal" tabindex="-1" aria-labelledby="popupModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="popupModalLabel">Özellik Tipi Ekle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="insertFormAttributeType" action="javascript:void(0);">
                        <input class="border form-control mb-3" type="text" id="AttributeTypeCode"
                            name="AttributeTypeCode" placeholder="Özellik Tip Kodu">
                        <input class="border form-control mb-3" type="text" id="AttributeTypeName"
                            name="AttributeTypeName" placeholder="Özellik Tip Adı">
                        <button class="btn btn-primary w-100" id="saveAttributeTypeButton">Kaydet</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="AttributepopupModal" tabindex="-1" aria-labelledby="popupModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="--bs-modal-width: 30% !important">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="popupModalLabel">Özellik Ekle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="table-container">
                                <table id="AttributetypeTable" class="table table-response">
                                </table>
                            </div>
                        </div>
                    </div>
                    <form id="insertFormAttribute" action="javascript:void(0);">
                        <input class="border form-control mb-3 AttributeTypeCode2" type="text" id="AttributeTypeCode2"
                            name="AttributeTypeCode2" placeholder="Özellik Tip Kodu" disabled>
                            <input class="border form-control mb-3 AttributeName" type="text" id="AttributeName" name="AttributeName"
                            placeholder="Özellik Tip Adı" disabled>
                        <input class="border form-control mb-3" type="text" id="AttributeCode" name="AttributeCode"
                            placeholder="Özellik Kodu">
                        <input class="border form-control mb-3" type="text" id="Attribute" name="Attribute"
                            placeholder="Özellik Adı ">
                        <button class="btn btn-primary w-100" id="saveAttributeButton">Kaydet</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="../images/amblem copy.png" alt="">
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
                        <a href="index.php">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="transfer.php">
                            <i class='bx  icon'>
                                <img class="hover" src="../images/transferWhite.png" alt="" srcset="">
                                <img class="normal" src="../images/transfer.png" alt="" srcset=""></i>
                            <span class="text nav-text">Transfer</span>
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
                        <a href="budget.php">
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
        <div class="text1">Dashboard</div>

        <div class="container ml-5">
            <div id="tableContainer" class="table-response">
                <table id="MyTable" style="border:0.1px solid;" class="table  table-striped">
                </table>
                <button class="btn btn-primary toggle-button toggle-button1 me-2" data-bs-toggle="modal"
                    data-bs-target="#popupModal">Kart Ekle</button>
                <button class="btn btn-primary" id="AttributeTypepopupBtn">Özellik Tipi Ekle</button>
                <button class="btn btn-primary" id="AttributepopupBtn">Özellik Ekle</button>
            </div>
        </div>
    </section>
    <!-- JavaScript dosyası -->

    <script src="../js/app.js"></script>
    <script src="../js/insertinf.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-2.0.7/datatables.min.js"></script>
    <script src="../js/InfluecerAttribute.js"></script>
    <script src="../js/InfluecerAttributeTypeDatatable.js"></script>
    <script src="../js/InfluecerAttributeTypeInsert.js"></script>
    <script src="../js/InfJoinAttribute.js"></script>
    <script src="../js/AddInf.js"></script>

</body>

</html> 