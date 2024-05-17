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

    <!-- Popup -->
    <div id="popup" class="popup">
        <div class="popup-content">
            <button id="closeButton" class="close-button"><i class="fa-solid fa-xmark"></i></button>
            <div class="container ml-5">
                <div id="tableContainer" class="table-response text-center">
                    <table id="MyTable" style="margin: 0.2rem;border:0.1px solid;"
                        class="table  table-striped text-center">
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
            <div class="col-md-12" style="max-height: 30rem;overflow: auto;">
                <form id="myForm">

                    <div id="dataRows">
                        <div class="row justify-content-start w-100">
                            <div class="offset-md-2 col-md-1">
                                <label for="ProcessCode${index}" class="form-label">ProcessCode:</label>
                                <select class="form-select form-select-sm" id="ProcessCode${index}"
                                    name="ProcessCode[]">
                                    <option value="GF">Gifting</option>
                                    <option value="SD">Seeding</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <label for="SendInfCode${index}" class="form-label">Inf Kodu:</label>
                                <input type="text" class="form-control form-control-sm" id="SendInfCode${index}"
                                    name="SendInfCode[]">
                            </div>
                            <div class="col-md-1">
                                <label for="SendInfName${index}" class="form-label">Inf Adı:</label>
                                <input type="text" class="form-control form-control-sm" id="SendInfName${index}"
                                    name="SendInfName[]">
                            </div>
                            <div class="col-md-1">
                                <label for="Post${index}" class="form-label d-block">Paylaşıldı mı?:</label>
                                <input type="checkbox" class="form-check-input mt-2" id="Post${index}" name="Post">
                            </div>
                            <div class="col-md-1">
                         
                                <input type="button" class="btn btn-primary mt-2 toggle-button aling-item-center" 
                                    value="...">
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
                <button type="button" id="Submit" class="btn btn-primary">Gönder</button>
            </div>
        </div>







    </section>
    <!-- JavaScript dosyası -->
    <script src="../js/app.js"></script>
    <script src="../js/popup.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/v/bs5/dt-2.0.7/datatables.min.js"></script>
   <script src="../js/TransferAddDatatable.js"></script>
   <script src="../js/TransferAddInputAction.js"></script>
   <script src="../js/TransferAddInsert.js"></script>

</body>

</html>