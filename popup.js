const toggleButton = document.querySelector('.toggle-button');
const popup = document.getElementById('popup');
const closeButton = document.getElementById('closeButton');

toggleButton.addEventListener('click', function() {
    popup.style.display = 'block';
});

closeButton.addEventListener('click', function() {
    popup.style.display = 'none';
});
