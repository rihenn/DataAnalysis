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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <title>Gifting</title>
</head>

<body style="height: 100vh;width:auto ;padding: 0!important;">
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
        <div class="text1">Bütçe</div>
        <div class="container">
            <div class="row">
                <div class="container mt-5">
                    <h2>Bütçe Dürümü</h2>
                    <h2 class="text-end"></h2>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50"
                            aria-valuemin="0" aria-valuemax="100">50%</div>
                    </div>
                    <div class="container mt-5">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
                <div class="flex justify-content-end"><button class="btn btn-primary " id="insertDataButton">Verileri
                        Ekle</button></div>
            </div>
        </div>
    </section>

    <script src="../js/app.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-2.0.7/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        function updateProgressBar(percentage) {
            var progressBar = document.querySelector('.progress-bar');
            progressBar.style.width = percentage + '%';
            progressBar.setAttribute('aria-valuenow', percentage);
            progressBar.textContent = percentage + '%';
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

                    // Update the progress bar with the calculated percentage
                    updateProgressBar(percentage.toFixed(2)); // toFixed(2) to show percentage up to 2 decimal places
                } else {
                    console.error('Budget data not found');
                }
            })
            .catch(error => console.error('Error fetching budget data:', error));

    </script>
    <script>
        fetch('../DataGetBudgetGrafik.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Grafik verilerini saklamak için boş bir dizi oluştur
                var chartData = [];

                // Her bir veri için işlem yap
                data.forEach(monthData => {
                    // Her bir ay için toplam bütçe ve harcanan bütçe verilerini al
                    var totalBudget = parseFloat(monthData.TotalBudget);
                    var spentBudget = parseFloat(monthData.SpentBudget);
                    var month = new Date(monthData.StartDate.date).getMonth() + 1; // Ayın sırasını al

                    // Ayın sırasıyla veriyi diziye ekle
                    chartData.push({
                        month: month,
                        totalBudget: totalBudget,
                        spentBudget: spentBudget
                    });
                });

                // Burada alınan verilere göre grafikleri oluşturabilirsiniz
                // Örneğin, Chart.js gibi bir kütüphane kullanarak
                drawBarChart(chartData);
            })
            .catch(error => console.error('Error fetching budget data:', error));

        // Sütun grafiği oluşturmak için fonksiyon
        function drawBarChart(data) {
            const labels = data.map(item => item.month); // Ay sıralarını etiket olarak kullan
            const totalBudget = data.map(item => item.totalBudget); // Her ayın toplam bütçe verisini al
            const spentBudget = data.map(item => item.spentBudget); // Her ayın harcanan bütçe verisini al

            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Toplam Bütçe',
                            data: totalBudget,
                            backgroundColor: ['rgba(75, 192, 192, 0.2)'],
                            borderColor: ['rgba(75, 192, 192, 1)'],
                            borderWidth: 1
                        },
                        {
                            label: 'Harcanan Bütçe',
                            data: spentBudget,
                            backgroundColor: ['rgba(255, 99, 132, 0.2)'],
                            borderColor: ['rgba(255, 99, 132, 1)'],
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
        function getMonthName(month) {
            const monthNames = ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'];
            return monthNames[month];
        }

    </script>
    <script>
        document.getElementById("insertDataButton").addEventListener("click", function () {
            console.log("Button clicked!"); // Butona tıklanınca log yazdır
            fetch('../query/budgetYearInsert.php', {
                method: 'GET'
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }


                })
                .catch(error => console.error('Error inserting data:', error));
        });


    </script>
</body>

</html>