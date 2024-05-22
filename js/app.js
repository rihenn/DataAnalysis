// HTML elementleri tanımla
// HTML elementleri tanımla
const body = document.querySelector('body');
const table = document.querySelector('table');
const sidebar = body.querySelector('nav');
const toggle = body.querySelector(".toggle");
const searchBtn = body.querySelector(".search-box");
const modeSwitch = body.querySelector(".toggle-switch");
const modeText = body.querySelector(".mode-text");
const tableContainer = document.getElementById("tableContainer");

// Margin animasyonu için fonksiyon
function animateMargin(target, start, end, duration) {
    let startTimestamp = null;
    const step = (timestamp) => {
        if (!startTimestamp) startTimestamp = timestamp;
        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
        target.style.marginLeft = `${start + progress * (end - start)}rem`;
        if (progress < 1) {
            window.requestAnimationFrame(step);
        }
    };
    window.requestAnimationFrame(step);
}

// Tablonun genişliğini ayarlayan fonksiyon
function adjustTableWidth() {
    if (sidebar.classList.contains("close")) {
        animateMargin(tableContainer, 18, 0, 200); // 9rem'den 0rem'e 500ms içinde animasyon
    } else {
        animateMargin(tableContainer, 0, 18, 200); // 0rem'den 9rem'e 500ms içinde animasyon
    }
}

// Sayfa yüklendiğinde tabloyu ayarla
document.addEventListener("DOMContentLoaded", adjustTableWidth);

// Sidebar durumu değiştiğinde tabloyu ayarla
toggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    adjustTableWidth();
});

// Search butonuna tıklandığında sidebar'ı aç ve tabloyu ayarla
searchBtn.addEventListener("click", () => {
    sidebar.classList.remove("close");
    adjustTableWidth();
});

modeSwitch.addEventListener("click", () => {
    console.log("Mode switch clicked");
    body.classList.toggle("dark");
    console.log("Dark mode active: ", body.classList.contains("dark")); // Dark modun durumunu kontrol et
    if (body.classList.contains("dark")) {
        table.classList.add("table-dark");
    } else {
        table.classList.remove("table-dark");
    }
    modeText.innerText = body.classList.contains("dark") ? "Light mode" : "Dark mode";
});

// Pencere yeniden boyutlandığında tabloyu ayarla
window.addEventListener("resize", adjustTableWidth);

