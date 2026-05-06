(function () {
    document.addEventListener('click', function (event) {
        var link = event.target.closest('a[data-confirm]');
        if (!link) {
            return;
        }

        var message = link.dataset.confirm;
        if (!message) {
            return;
        }

        if (!window.confirm(message)) {
            event.preventDefault();
        }
    });
})();
