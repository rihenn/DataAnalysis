function createInputField() {
    var container = document.getElementById('container');
    var inputField = document.createElement('input');
    inputField.setAttribute('type', 'text');
    inputField.setAttribute('id', 'inputField');
    inputField.setAttribute('placeholder', 'Veri giriş alanı');
    container.appendChild(inputField);
}

var selectBox = document.getElementById('selectBox');
selectBox.addEventListener('change', createInputField);
