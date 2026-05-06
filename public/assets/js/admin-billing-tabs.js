(function () {
    function switchTab(tabName) {
        document.querySelectorAll('.admin-billing-panel').forEach(function (panel) {
            panel.classList.toggle('is-hidden', panel.id !== 'tab-' + tabName);
        });

        document.querySelectorAll('.admin-billing-tab-btn').forEach(function (button) {
            var isActive = button.dataset.tab === tabName;
            button.classList.toggle('admin-billing-tab-btn--active', isActive);
            var badge = button.querySelector('.admin-billing-badge');
            if (badge) {
                badge.classList.toggle('admin-billing-badge--active', isActive);
            }
        });

        var url = new URL(window.location);
        url.searchParams.set('tab', tabName);
        history.replaceState(null, '', url);
    }

    document.addEventListener('DOMContentLoaded', function () {
        var initialTab = new URLSearchParams(window.location.search).get('tab') || 'website';
        switchTab(initialTab);

        document.querySelectorAll('.admin-billing-tab-btn').forEach(function (button) {
            button.addEventListener('click', function () {
                switchTab(button.dataset.tab);
            });
        });

        document.querySelectorAll('.admin-toggle').forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                var url = checkbox.dataset.url;
                if (!url) {
                    return;
                }

                fetch(url, { method: 'GET' })
                    .then(function () {
                        var selector = checkbox.dataset.nextCbSelector;
                        if (selector) {
                            var nextCheckbox = document.querySelector(selector);
                            if (nextCheckbox) {
                                nextCheckbox.disabled = !checkbox.checked;
                                if (!checkbox.checked) {
                                    nextCheckbox.checked = false;
                                }
                            }
                        }
                    })
                    .catch(function () {
                        checkbox.checked = !checkbox.checked;
                    });
            });
        });
    });
})();
