<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS dosyası -->
    <link rel="stylesheet" type="text/css" href="../css/styles.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <!-- Boxicons CSS dosyası -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.7/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<style>

.dataTables_wrapper .dataTables_scrollHead th {
    text-align: center;
    vertical-align: middle;
}
.dt-center {
            text-align: center;
        }
.flex1 {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
</style>
    <title>Gifting</title>
</head>

<body>
<div class="modal fade" id="BarcodepopupModal" tabindex="-1" aria-labelledby="popupModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="--bs-modal-width: %25 !important">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="popupModalLabel">İçerik</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped" id="BarcodeTable" style="width:100% !important"></table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Popup -->
    <div class="modal fade" id="popupModal" tabindex="-1" aria-labelledby="popupModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="--bs-modal-width: 95% !important">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="popupModalLabel">İçerik</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <table class="table table-striped justify-content-center" id="detailsTable">
                   
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Popup -->
    <div class="modal fade" id="PlatformAddpopupModal" tabindex="-1" aria-labelledby="popupModalLabel" aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="popupModalLabel">Platform</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form id="PlatformForm">
                    <input type="hidden" id="infCode" name="infCode">
                    <div class="mb-3">
                        <label for="PlatformType" class="form-label">Platform Tipi</label>
                        <input type="text" class="form-control" id="PlatformType" name="PlatformType">
                    </div>
                    <div class="mb-3">
                        <label for="PlatformValue" class="form-label">Platform Adı</label>
                        <input type="text" class="form-control" id="PlatformValue" name="PlatformValue">
                    </div>
                    <button  class="btn btn-primary" id="PlatformAddBtn">Kaydet</button>
                </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="popupModal1" tabindex="-1" aria-labelledby="popupModalLabel" aria-hidden="true">
        <div class="modal-dialog shadow-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="popupModalLabel">Paylaşım</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="insertForm">
                        <input type="hidden" name="TransferNumber">
                        <input type="hidden" name="Barcode">
                        <input class="border form-control mb-3" type="text" name="PlatformCode"
                            placeholder="Platform Code">
                        <input class="border form-control mb-3" type="text" name="PlatformName"
                            placeholder="Platform Name">
                        <input class="border form-control mb-3" type="text" name="ContentCode"
                            placeholder="Content Code">
                        <input class="border form-control mb-3" type="text" name="ContentName"
                            placeholder="Content Name">
                        <input class="border form-control mb-3" type="date" name="ShareDate" placeholder="Share Date">
                        <input class="border form-control mb-3" type="text" name="LikeCount" placeholder="Like Count">
                        <input class="border form-control mb-3" type="text" name="WievCount" placeholder="View Count">
                        <button class="btn btn-dark" type="button" id="saveButton">Kaydet</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Düzenle Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg shadow-lg">
            <!-- modal-lg sınıfı genişliği arttırır, shadow-lg gölgelendirme ekler -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Düzenle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <!-- Ürün Bilgileri -->
                        <div class="mb-3">
                            <h6 class="p-2">Ürün Bilgileri</h6>
                            <hr>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="editBarcode" class="form-label">Barkod</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control editBarcode" id="editBarcode" placeholder="Recipient's username"
                                            aria-label="Recipient's username" aria-describedby="basic-addon2"
                                            name="Barcode">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-primary btn-sm" id="BarcodeTableBtn"
                                                type="button">...</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="editItemCode" class="form-label">Ürün Kodu</label>
                                    <input type="text" class="form-control ItemCode" id="editItemCode" name="ItemCode">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="editColorCode" class="form-label">Renk Kodu</label>
                                    <input type="text" class="form-control ColorCode" id="editColorCode" name="ColorCode">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="editItemDim1Code" class="form-label">Beden</label>
                                    <input type="text" class="form-control ItemDim1Code" id="editItemDim1Code" name="ItemDim1Code">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="editItemDescription" class="form-label">Ürün Açıklaması</label>
                                    <input type="text" class="form-control ItemDescription" id="editItemDescription"
                                        name="ItemDescription">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="editColorCatalogDescription" class="form-label">Renk Açıklaması</label>
                                    
                                    <input type="text" class="form-control ColorCatalogDescription" id="editColorCatalogDescription"
                                        name="ColorCatalogDescription">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="editItemCostPrice" class="form-label">Ürün Maliyet Fiyatı</label>
                                    <input type="text" class="form-control ItemCostPrice" id="editItemCostPrice" name="ItemCostPrice">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="editShippingCostPrice" class="form-label">Gönderim Bedeli</label>
                                    <input type="text" class="form-control" id="editShippingCostPrice"
                                        name="ShippingCostPrice">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="editQty1" class="form-label">Adet</label>
                                    <input type="text" class="form-control" id="editQty1" name="Qty1">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="editSendDate" class="form-label">Gönderim Tarihi</label>
                                    <input type="date" class="form-control" id="editSendDate" name="SendDate">
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Kaydet</button>
                            </div>
                        </div>
                      
                        <!-- Paylaşım Bilgileri -->
                        <div class="mb-3">
                            <h6 class="p-2">Paylaşım Bilgileri</h6>
                            <hr>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="editPlatformCode" class="form-label">Platform Kodu</label>
                                    <input type="text" class="form-control" id="editPlatformCode" name="PlatformCode">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="editPlatformName" class="form-label">Platform Adı</label>
                                    <input type="text" class="form-control" id="editPlatformName" name="PlatformName">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="editContentCode" class="form-label">İçerik Kodu</label>
                                    <input type="text" class="form-control" id="editContentCode" name="ContentCode">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="editContentName" class="form-label">İçerik Adı</label>
                                    <input type="text" class="form-control" id="editContentName" name="ContentName">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="editShareDate" class="form-label">Paylaşım Tarihi</label>
                                    <input type="date" class="form-control" id="editShareDate" name="ShareDate">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="editLikeCount" class="form-label">Beğeni Sayısı</label>
                                    <input type="text" class="form-control" id="editLikeCount" name="LikeCount">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="editViewCount" class="form-label">Görüntüleme Sayısı</label>
                                    <input type="text" class="form-control" id="editViewCount" name="ViewCount">
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="button" id="shareSaveButton" class="btn btn-primary">Paylaşım
                                    Kaydet</button>
                            </div>
                        </div>
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
                            <i class='bx  icon'><img src="../images/transfer.png" alt="" srcset=""></i>
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
        <div class="text1">Transfer</div>

        <div class="container ml-5">
            <div id="" class="flex1">
                <table id="MyTable" style="border:0.1px solid;" class="table  table-striped">

                </table>
                
            </div>
            <a href="./TransferAdd.php" class="btn btn-primary">Transfer Ekle</a>
            <button class="btn btn-primary" id="PlatformTypeAddBtn">Platform Ekle</button>
        </div>
    </section>



    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-2.0.7/datatables.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="../js/app.js"></script>
    <script src="../js/TransferHeader.js"></script>
    <script src="../js/TransferDataTableSeedingLine.js"></script>
    <script src="../js/TransferPostLine.js"></script>
    <script src="../js/TransferLinePlatform.js"></script>
    <script src="../js/TransferUpdate.js"></script>
    <script src="../js/TransferBarcodeDatatable.js"></script>
    <script src="../js/PlatformAdd.js"></script>
<script>
    $("#PlatformTypeAddBtn").on("click",function () {
        $("#PlatformAddpopupModal").modal("show")
    })
</script>

</body>

</html>