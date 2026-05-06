(function () {
    document.addEventListener('DOMContentLoaded', function () {
        var source = document.getElementById('listing-filter-create-urls');
        if (!source) {
            return;
        }

        window.FILTER_CREATE_URLS = {
            activity: source.dataset.activityUrl || '',
            website: source.dataset.websiteUrl || '',
            enterprise: source.dataset.enterpriseUrl || ''
        };
    });
})();
