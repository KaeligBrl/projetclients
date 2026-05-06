(function () {
    var initialized = false;

    function switchTab(tabName) {
        document.querySelectorAll('.settings-tab-panel').forEach(function (panel) {
            panel.classList.toggle('is-hidden', panel.id !== 'tab-' + tabName);
        });
        document.querySelectorAll('.settings-tab-btn').forEach(function (btn) {
            btn.classList.toggle('settings-tab-btn--active', btn.dataset.tab === tabName);
        });
        var url = new URL(window.location);
        url.searchParams.set('tab', tabName);
        url.searchParams.delete('step');
        history.replaceState(null, '', url);
    }

    function switchMetierTab(section, stepId) {
        document.querySelectorAll('.settings-metier-panel').forEach(function (panel) {
            if (panel.dataset.section === section) {
                panel.classList.toggle('is-hidden', panel.dataset.step !== stepId);
            }
        });
        document.querySelectorAll('.settings-metier-btn').forEach(function (btn) {
            if (btn.dataset.section === section) {
                btn.classList.toggle('settings-metier-btn--active', btn.dataset.step === stepId);
            }
        });

        var url = new URL(window.location);
        url.searchParams.set('step', stepId);
        history.replaceState(null, '', url);
    }

    function initSettingsTabs() {
        if (initialized) {
            return;
        }
        initialized = true;

        var params = new URLSearchParams(window.location.search);
        switchTab(params.get('tab') || 'website');
        var initialStep = params.get('step');
        if (initialStep) {
            switchMetierTab('website', initialStep);
            switchMetierTab('visual_identity', initialStep);
        }

        document.addEventListener('click', function (event) {
            var sectionBtn = event.target.closest('.settings-tab-btn');
            if (sectionBtn) {
                event.preventDefault();
                switchTab(sectionBtn.dataset.tab);
                return;
            }

            var metierBtn = event.target.closest('.settings-metier-btn');
            if (metierBtn) {
                event.preventDefault();
                switchMetierTab(metierBtn.dataset.section, metierBtn.dataset.step);
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initSettingsTabs);
    } else {
        initSettingsTabs();
    }
})();
