(function () {
    document.addEventListener('click', function (event) {
        var toggle = event.target.closest('.showHiddenPassword-toggle');
        if (!toggle) {
            return;
        }

        var targetSelector = toggle.dataset.target;
        if (!targetSelector) {
            return;
        }

        var passwordField = document.querySelector(targetSelector);
        var icon = toggle.querySelector('i');
        if (!passwordField || !icon) {
            return;
        }

        var isHidden = passwordField.type === 'password';
        passwordField.type = isHidden ? 'text' : 'password';

        icon.classList.toggle('fa-eye-slash', !isHidden);
        icon.classList.toggle('fa-eye', isHidden);
    });
})();
