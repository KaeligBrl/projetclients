(function () {
    function switchTab(tabName) {
        document.querySelectorAll('.settings-tab-panel').forEach(function (panel) {
            panel.classList.toggle('is-hidden', panel.id !== 'tab-' + tabName);
        });

        document.querySelectorAll('.settings-tab-btn').forEach(function (btn) {
            btn.classList.toggle('settings-tab-btn--active', btn.dataset.tab === tabName);
        });

        var url = new URL(window.location);
        url.searchParams.set('tab', tabName);
        history.replaceState(null, '', url);
    }

    function switchMailTab(parent, mailTabName) {
        document.querySelectorAll('.settings-mail-tab-panel').forEach(function (panel) {
            if (panel.dataset.parent === parent) {
                panel.classList.toggle('is-hidden', panel.dataset.mailTab !== mailTabName);
            }
        });

        document.querySelectorAll('.settings-mail-tab-btn').forEach(function (btn) {
            if (btn.dataset.parent === parent) {
                btn.classList.toggle('settings-mail-tab-btn--active', btn.dataset.mailTab === mailTabName);
            }
        });

        document.querySelectorAll('#tab-' + parent + ' input[name="mailTab"]').forEach(function (input) {
            input.value = mailTabName;
        });

        var url = new URL(window.location);
        url.searchParams.set('mailTab', mailTabName);
        history.replaceState(null, '', url);
    }

    document.addEventListener('DOMContentLoaded', function () {
        var params = new URLSearchParams(window.location.search);
        var initial = params.get('tab') || 'website';

        var tabNav = document.getElementById('settingsTabNav');
        var fallbackMail = tabNav && tabNav.dataset.initialMailTab ? tabNav.dataset.initialMailTab : 'compta';
        var initialMail = params.get('mailTab') || fallbackMail;

        switchTab(initial);
        switchMailTab('website', initialMail);
        switchMailTab('visual_identity', initialMail);

        document.querySelectorAll('.settings-tab-btn').forEach(function (btn) {
            btn.addEventListener('click', function () {
                switchTab(btn.dataset.tab);
            });
        });

        document.querySelectorAll('.settings-mail-tab-btn').forEach(function (btn) {
            btn.addEventListener('click', function () {
                switchMailTab(btn.dataset.parent, btn.dataset.mailTab);
            });
        });
    });
})();
