document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('form-kedatangan');
    const inputs = form.querySelectorAll('input, select');

    inputs.forEach(function (input) {
        input.addEventListener('blur', function () {
            if (!input.checkValidity()) {
                input.classList.add('invalid');
                input.nextElementSibling.style.display = 'block';
            } else {
                input.classList.remove('invalid');
                input.nextElementSibling.style.display = 'none';
            }
        });

        input.addEventListener('input', function () {
            if (input.checkValidity()) {
                input.classList.remove('invalid');
                input.nextElementSibling.style.display = 'none';
            }
        });
    });

    form.addEventListener('submit', function (event) {
        let valid = true;
        inputs.forEach(function (input) {
            if (!input.checkValidity()) {
                valid = false;
                input.classList.add('invalid');
                input.nextElementSibling.style.display = 'block';
            }
        });

        if (!valid) {
            event.preventDefault();
        }
    });
});
