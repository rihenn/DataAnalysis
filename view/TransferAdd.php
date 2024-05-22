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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <title>Gifting</title>
</head>

<body style="height: 100vh;width:auto ;padding: 0!important;">



    <div class="modal fade" id="popupModal" tabindex="-1" aria-labelledby="popupModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content justify-content-center" style="width: 800px !important;height: auto !important; ">
                <div class="modal-header">
                    <h5 class="modal-title" id="popupModalLabel">Kart Ekle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <table id="MyTable" style="margin: 0.2rem;border:0.1px solid;" class="table  table-striped ">
                            <thead class="text-center">
                                <tr>
                                    <!-- Add more columns if needed -->
                                </tr>
                            </thead>
                            <tbody class="text-center">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="popupModal1" tabindex="-1" aria-labelledby="popupModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content justify-content-center" style="width: 800px !important;height: auto !important; ">
                <div class="modal-header">
                    <h5 class="modal-title" id="popupModalLabel">Kart Ekle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div id="tableContainer" class=" text-center">
                        <table id="Influecer" style="margin: 0.2rem;border:0.1px solid;"
                            class="table  table-striped text-center">
                            <thead class="text-center">
                         
                            </thead>
                            <tbody class="text-center">
                            </tbody>
                        </table>
                    </div>

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
                        <a href="#">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="transfer.php">
                            <i class='bx bx-bell icon'></i>
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
            <div class="col-md-12" style="max-height: 30rem; overflow: auto;">
                <form id="myForm">
                    <div class="row justify-content-start w-100">
                        <div class="offset-md-2 col-md-1">
                            <label for="ProcessCode" class="form-label">ProcessCode:</label>
                            <select class="form-select form-select-sm" id="ProcessCode" name="ProcessCode[]">
                                <option value="Gifting">Gifting</option>
                                <option value="Seeding">Seeding</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <label for="SendInfCode" class="form-label">Inf Kodu:</label>
                            <input type="text" class="form-control form-control-sm SendInfCode"
                                onkeyup="veriGetirInf(this.value)" name="SendInfCode[]">
                        </div>
                        <div class="col-md-1">
                            <label for="SendInfName" class="form-label">Inf Adı:</label>
                            <input type="text" class="form-control form-control-sm SendInfName" id="SendInfName"
                                name="SendInfName[]">
                        </div>
                        <div class="col-md-1 mb-4">
                            <label for="shippingcost" class="form-label">Gönderim:</label>
                            <input type="text" class="form-control form-control-sm shippingcost" id="shippingcost"
                                name="shippingcost[]">
                        </div>
                        <div class="col-md-1 mt-4">
                            <input type="button" class="btn btn-primary mt-2 toggle-button2 aling-item-center"
                                value="Influecer" id="InfluecerBtn">
                        </div>
                        <div class="col-md-1 mt-4" id="barcodeSection" style="display: block;">
                            <input type="button" class="btn btn-primary mt-2 toggle-button aling-item-center"
                                value="Barcode" id="BtnBarcode">
                        </div>
                        <div class="col-md-1 mt-4">
                            <input type="button" class="btn btn-success mt-2" value="İşlem Başlat" id="startProcessBtn">
                        </div>
                    </div>
                    <div id="dataRows" style="display: none;"></div>
                    <div class="row justify-content-center mt-3" id="addRowSection" style="display: none;">
                        <div class="col-md-1">
                            <button type="button" class="btn btn-success" id="addRowBtn">Satır Ekle</button>
                        </div>
                        <div class="col-md-1">
                            <button type="submit" id="Submit" class="btn btn-primary">Gönder</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="container">
            <div class="flex justify-content-center">
                <table class="table" id="SeedingLine"></table>
            </div>
        </div>
    </section>
    <!-- JavaScript dosyası -->
    <script src="../js/app.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-2.0.7/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="../js/TransferAddInfluecerDatatable.js"></script>
    <script src="../js/TransferDataTableSeedingLine.js"></script>
    <script src="../js/TransferAddDatatable.js"></script>
    <script src="../js/TransferAddInputAction.js"></script>
    <script>
        // Kart ekle butonuna tıklama olayı ekle
        $('#BtnBarcode').on('click', function () {
            // Popup modal'i aç
            $('#popupModal').modal('show');
        });
    </script>
    <script>
        // Kart ekle butonuna tıklama olayı ekle
        $('#InfluecerBtn').on('click', function () {
            // Popup modal'i aç
            $('#popupModal').modal('show');
        });
    </script>



</body>

</html>