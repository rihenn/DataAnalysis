<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS dosyası -->
    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <!-- Bootstrap ve diğer kütüphaneler -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.7/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


    <title>Gifting</title>

    <!-- Ek CSS -->
    <style>
        /* Scroll Picker için CSS */
        .scroll-picker {
            width: 200px;
            height: 150px;
            overflow: hidden;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .scroll-picker ul {
            list-style: none;
            padding: 0;
            margin: 0;
            width: 100%;
            height: 100%;
            overflow-y: auto;
            /* Dikey kaydırma ekledik */
            scroll-snap-type: y mandatory;
        }

        .scroll-picker ul li {
            height: 50px;
            line-height: 50px;
            text-align: center;
            font-size: 16px;
            scroll-snap-align: center;
            border-bottom: 1px solid #ddd;
            /* Alt çizgi ekledik */
        }

        .scroll-picker ul li:last-child {
            border-bottom: none;
            /* Son öğenin alt çizgisini kaldırdık */
        }


        .scroll-picker ul li.active {
            font-weight: bold;
            color: #007bff;
            /* Aktif öğenin rengini değiştirdik */
            cursor: pointer;
            /* Mouse işaretçisini değiştirir */
        }
    </style>
</head>

<body style="height: 100vh;width:auto ;padding: 0!important;">
    <div class="modal fade" id="popupModal" tabindex="-1" aria-labelledby="popupModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="popupModalLabel">Detaylar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="d-flex justify-content-center col">
                                <div class="scroll-picker col-12">
                                    <ul>
                                        <!-- Yıllar dinamik olarak JavaScript ile eklenecek -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3"> <!-- mt-3 sınıfı ile üst kısımdan biraz boşluk ekleyebiliriz -->
                            <div class="d-flex justify-content-center col">
                                <div class="flex">
                                    <button class="btn btn-primary" id="yearGetButton">Yıl Getir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="BudgetAddpopupModal" tabindex="-1" aria-labelledby="popupModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="popupModalLabel">Detaylar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="d-flex justify-content-center col">
                                <div class="scroll-picker col-12" id="ScrollPicker">
                                    <ul>
                                        <!-- Yıllar dinamik olarak JavaScript ile eklenecek -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3"> <!-- mt-3 sınıfı ile üst kısımdan biraz boşluk ekleyebiliriz -->

                            <div class="d-flex justify-content-center col">
                                <div class="flex">
                                    <input type="text" id="budgetInput" class="form-control active">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3"> <!-- mt-3 sınıfı ile üst kısımdan biraz boşluk ekleyebiliriz -->

                            <div class="d-flex justify-content-center col">
                                <div class="flex">
                                    <button class="btn btn-primary" id="BudgetLimitAddBtn">Bütçe Ekle</button>
                                </div>
                            </div>
                        </div>
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
                        <a href="index.php">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="transfer.php">
                            <i class='bx icon'><img src="../images/transfer.png" alt=""></i>
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
                <li>
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
        <div class="text1">Bütçe</div>
        <div class="container">
            <div class="row">
                <div class="container mt-5">

                    <div class="d-flex justify-content-between">
                        <h2 class="text-start">Mevcut Ay Bütçe Dürümü</h2>
                        <h2 id="SpentBudgetSpan" class="text-end">SpentBudgetSpan</h2>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="50"
                            aria-valuemin="0" aria-valuemax="100">100%</div>
                    </div>
                    <div class="container mt-5">
                        <div class="chart-label">
                            <h4 style="display: inline;" id="yearIndicator"></h4>
                            <h4 style="display: inline;"> Yılı Verileri</h4>
                        </div>
                        <canvas id="myChart"></canvas>

                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary me-2" id="previousYear">Önceki Yıl</button>
                            <button class="btn btn-primary me-2" id="currentYear">Mevcut Yıl</button>
                            <button class="btn btn-primary" id="nextYear">Sonraki Yıl</button>
                        </div>
                        <div class="d-flex justify-content-start">
                            <button class="btn btn-primary me-2" id="YearAddBtn">Yıl Ekle</button>
                            <button class="btn btn-primary" id="BudgetAddBtn">Bütçe Ekle</button>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <script src="../js/app.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-2.0.7/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        toastr.options.timeOut = 5000;
        function updateProgressBar(percentage, SpentBudget) {
            var progressBar = document.querySelector('.progress-bar');
            progressBar.style.width = percentage + '%';
            progressBar.setAttribute('aria-valuenow', percentage);
            progressBar.textContent = percentage + '%';
            if (percentage < 10 && percentage > 0) {
                toastr.warning("Bütçeniz %10'dan Az Kaldı!");
            } if (percentage == 0) {
                toastr.error("Bütçenizin Bitmiştir!");
            } if (percentage < 0) {
                toastr.error("Bütçeniz Eksiye Düşmüştür!");
            }
        }


        // Fetch budget data from PHP script
        fetch('../DataGetBudgetprogress.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.length > 0) {
                    var totalBudget = parseFloat(data[0].TotalBudget);
                    var spentBudget = parseFloat(data[0].SpentBudget);
                    var percentage = (spentBudget / totalBudget) * 100;
                    $('#SpentBudgetSpan').text(spentBudget);
                    // Update the progress bar with the calculated percentage
                    updateProgressBar(percentage.toFixed(2)); // toFixed(2) to show percentage up to 2 decimal places
                } else {
                    console.error('Budget data not found');
                }
            })
            .catch(error => console.error('Error fetching budget data:', error));

    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let myChart; // Global scope'da tanımla

            // Fetch budget data from PHP script
            function fetchBudgetData(url) {
                return fetch(url)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .catch(error => console.error('Error fetching budget data:', error));
            }

            // Draw bar chart using Chart.js
            function drawBarChart(data) {
                const ctx = document.getElementById('myChart').getContext('2d');
                if (myChart) {

                    myChart.destroy(); // Existing chart must be destroyed
                    myChart = null; // Nullify myChart to ensure it is reset
                }

                // Chart data processing
                const labels = ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'];
                const totalBudget = data.map(item => item.TotalBudget);
                const spentBudget = data.map(item => item.SpentBudget);
                const budgetDifferences = [];

                // spentBudget ve totalBudget arasındaki farkları hesapla ve budgetDifferences dizisine ekle
                for (let i = 0; i < totalBudget.length; i++) {
                    const difference = totalBudget[i] - spentBudget[i];
                    budgetDifferences.push(difference);
                }

                const date = data.map(item => item.StartDate.date);
                if (date.length > 0) {
                    const year = new Date(date[0]).getFullYear();
                    document.getElementById('yearIndicator').textContent = year;

                }

                // Chart configuration
                myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: 'Toplam Bütçe',
                                data: totalBudget,
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Kalan Bütçe',
                                data: spentBudget,
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Harcanan Bütçe',
                                data: budgetDifferences,
                                backgroundColor: 'rgba(255, 255, 0, 0.5)',
                                borderColor: 'rgba(255, 255, 0, 1)',

                                borderWidth: 1
                            }

                        ]
                    },
                    options: {
                        indexAxis: 'x',
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

            }

            // Update UI with budget data
            function updateUIWithData(data) {
                if (data.length > 0) {

                    drawBarChart(data);
                } else {
                    console.error('Budget data not found');
                }
            }

            // Fetch budget data and update UI
            function fetchDataAndUpdateUI(url) {
                fetchBudgetData(url)
                    .then(data => {
                        updateUIWithData(data);
                    })
                    .catch(error => console.error('Error fetching budget data:', error));
            }

            // Event listeners for navigation buttons
            document.getElementById("previousYear").addEventListener("click", function () {
                event.preventDefault();
                const currentYearText = document.getElementById("yearIndicator").textContent;
                const currentYear = parseInt(currentYearText);
                if (!isNaN(currentYear)) {
                    var dateCurrent = currentYear - 1
                    fetchDataAndUpdateUI(`../DataGetBudgetGrafik.php?year=${dateCurrent}`);

                    toastr.info(`${dateCurrent} yılının verileri`);
                } else {
                    console.error('Invalid current year:', currentYearText);
                }
            });

            document.getElementById("currentYear").addEventListener("click", function () {
                event.preventDefault();
                const currentYear = new Date().getFullYear();
                fetchDataAndUpdateUI(`../DataGetBudgetGrafik.php?year=${currentYear}`);
                toastr.info(`${currentYear} yılının verileri`);

            });

            document.getElementById("nextYear").addEventListener("click", function () {
                event.preventDefault();
                const currentYearText = document.getElementById("yearIndicator").textContent;

                const currentYear = parseInt(currentYearText);
                if (!isNaN(currentYear)) {
                    var dateCurrent = currentYear + 1
                    fetchDataAndUpdateUI(`../DataGetBudgetGrafik.php?year=${dateCurrent}`);
                    toastr.info(`${dateCurrent} yılının verileri`);
                } else {
                    console.error('Invalid current year:', currentYearText);
                }
            });

            // Initial data fetch and UI update
            const currentYear = new Date().getFullYear();
            toastr.info(`${currentYear} yılının verileri`);
            fetchDataAndUpdateUI(`../DataGetBudgetGrafik.php?year=${currentYear}`);
        });

        document.addEventListener("DOMContentLoaded", function () {
            // Kart ekle butonuna tıklama olayı ekle
            $('#YearAddBtn').on('click', function () {
                // Popup modal'i aç
                $('#popupModal').modal('show');
            });
            $('#BudgetAddBtn').on('click', function () {
                // Popup modal'i aç
                $('#BudgetAddpopupModal').modal('show');
            });

            // JavaScript ile yılların dinamik olarak eklenmesi
            var currentYear = new Date().getFullYear();
            var yearList = document.querySelector('.scroll-picker ul');

            // 5 yıl geriye ve 5 yıl ileriye yılları ekleme
            for (var i = currentYear - 2; i <= currentYear + 2; i++) {
                var listItem = document.createElement('li');
                listItem.textContent = i;

                // Aktif yılı belirleme
                if (i === currentYear) {
                    listItem.classList.add('active');
                }

                yearList.appendChild(listItem);
            }

            // Ayların dinamik olarak eklenmesi
            var currentMonth = new Date().getMonth();
            var MonthList = document.querySelector('#ScrollPicker ul');
            var months = ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'];

            for (var i = 0; i < months.length; i++) {
                var listItem = document.createElement('li');
                listItem.textContent = months[i];

                // Aktif ayı belirleme
                if (i === currentMonth) {
                    listItem.classList.add('active');
                }

                MonthList.appendChild(listItem);
            }

            // Ortalanmış scroll'u gerçekleştirmek için işlev
            function scrollToMiddle(element) {
                var parent = element.parentNode;
                parent.scrollTop = element.offsetTop - (parent.offsetHeight / 2) + (element.offsetHeight / 2);
            }

            // Listeye tıklama olayı ekle (delegasyon yöntemiyle)
            $(document).on('click', '.scroll-picker ul li', function () {
                // Önce tüm öğelerden 'active' sınıfını kaldır
                $(this).siblings().removeClass('active');
                // Tıklanan öğeye 'active' sınıfını ekle
                $(this).addClass('active');
                // Ortalanmış scroll'u gerçekleştir
                scrollToMiddle(this);
            });
        });


        $(function () {
            $('#yearGetButton').on('click', function () {
                var activeYear = $('.scroll-picker ul li.active').text();


                $.ajax({
                    url: '../query/budgetYearInsert.php',
                    method: 'POST',
                    data: { year: activeYear },

                    success: function (response) {
                        // PHP'den gelen yanıtı işleyin
                        var responseData = JSON.parse(response);
                        if (responseData.success) {
                            // Başarılı yanıt
                            toastr.success(responseData.message);
                        } else {
                            // Başarısız yanıt
                            toastr.error(responseData.message);
                        }
                    },
                    error: function () {
                        toastr.error('Yıl gönderimi sırasında bir hata oluştu.');
                    }
                });
            });
        });
        $(function () {
            $('#BudgetLimitAddBtn').on('click', function () {
                var activeMonth = $('#ScrollPicker ul li.active').text(); // Doğru değişkeni al

                if (activeMonth == "Ocak") {
                    activeMonth = "01"
                }
                if (activeMonth == "Şubat") {
                    activeMonth = "02"
                }
                if (activeMonth == "Mart") {
                    activeMonth = "03"
                }
                if (activeMonth == "Nisan") {
                    activeMonth = "04"
                }
                if (activeMonth == "Mayıs") {
                    activeMonth = "05"
                }
                if (activeMonth == "Haziran") {
                    activeMonth = "06"
                }
                if (activeMonth == "Temmuz") {
                    activeMonth = "07"
                }
                if (activeMonth == "Ağustos") {
                    activeMonth = "08"
                }
                if (activeMonth == "Eylül") {
                    activeMonth = "09"
                }
                if (activeMonth == "Ekim") {
                    activeMonth = "10"
                }
                if (activeMonth == "Kasım") {
                    activeMonth = "11"
                }
                if (activeMonth == "Aralık") {
                    activeMonth = "12"
                }
                var budget = $('#budgetInput').val();


                $.ajax({
                    url: '../query/BudgetLimitUpdate.php',
                    method: 'POST',
                    data: { year: activeMonth, budget: budget },
                    success: function (response) {
                        // PHP'den gelen yanıtı işleyin
                        var responseData = JSON.parse(response);
                        if (responseData.success) {
                            // Başarılı yanıt
                            toastr.success(responseData.message);
                            location.reload();
                        } else {
                            // Başarısız yanıt
                            toastr.error(responseData.message);
                        }
                    },
                    error: function () {
                        toastr.error('Bütçe limiti güncelleme sırasında bir hata oluştu.');
                    }
                });
            });
        });
    </script>

</body>

</html>