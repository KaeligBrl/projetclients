window.addEventListener('load', function () {
    const searchUrl    = window.LISTING_SEARCH_URL;
    const modifyPath   = window.LISTING_MODIFY_PATH;
    const deletePath   = window.LISTING_DELETE_PATH;
    const isAdmin      = window.IS_ADMIN;

    const tbody    = document.getElementById('listing-tbody');
    const noResults= document.getElementById('no-results');
    const resetBtn = document.getElementById('reset-filters');

    // ── Tom Select instances ───────────────────────────────
    function makeTomSelect(id) {
        return new TomSelect('#' + id, {
            plugins: ['remove_button'],
            persist: false,
            create: false,
            onItemAdd:    function () { fetchResults(); updateResetBtn(tsActivity, tsWebsite, tsEnterprise); },
            onItemRemove: function () { fetchResults(); updateResetBtn(tsActivity, tsWebsite, tsEnterprise); }
        });
    }

    const tsActivity   = makeTomSelect('ts-activity');
    const tsWebsite    = makeTomSelect('ts-website');
    const tsEnterprise = makeTomSelect('ts-enterprise');

    // ── Reset ─────────────────────────────────────────────────────
    resetBtn.addEventListener('click', function () {
        tsActivity.clear();
        tsWebsite.clear();
        tsEnterprise.clear();
        resetBtn.style.display = 'none';
        fetchResults();
    });

    function updateResetBtn(a, w, e) {
        const hasActive = a.getValue().length || w.getValue().length || e.getValue().length;
        resetBtn.style.display = hasActive ? 'inline-block' : 'none';
    }

    // ── Fetch ─────────────────────────────────────────────────────
    function fetchResults() {
        const params = new URLSearchParams();
        tsActivity.getValue().forEach(function (id)   { params.append('activity[]', id); });
        tsWebsite.getValue().forEach(function (id)    { params.append('website[]', id); });
        tsEnterprise.getValue().forEach(function (id) { params.append('enterprise[]', id); });

        tbody.innerHTML = '<tr><td colspan="6" class="text-center color-white py-4">'
            + '<i class="fas fa-spinner fa-spin me-2"></i> Chargement…</td></tr>';
        noResults.style.display = 'none';

        fetch(searchUrl + '?' + params.toString())
            .then(function (r) { return r.json(); })
            .then(function (rows) { renderRows(rows); })
            .catch(function () {
                tbody.innerHTML = '<tr><td colspan="6" class="text-center color-white py-3">'
                    + '<i class="fas fa-exclamation-triangle me-2 color-yellow"></i>Erreur de chargement.</td></tr>';
            });
    }

    // ── Render ────────────────────────────────────────────────────
    function renderRows(rows) {
        if (rows.length === 0) {
            tbody.innerHTML = '';
            noResults.style.display = 'block';
            return;
        }

        noResults.style.display = 'none';
        tbody.innerHTML = rows.map(function (row) {
            const domain = row.domain_name
                ? '<a class="color-white" href="' + escHtml(row.domain_name) + '" target="_blank" rel="noopener">'
                  + escHtml(row.domain_name) + '</a>'
                : '<span style="opacity:.5">Non renseigné</span>';

            const activity   = row.nameActivity      ? escHtml(row.nameActivity)      : '';
            const website    = row.nameWebsite        ? escHtml(row.nameWebsite)        : '';
            const enterprise = row.nameEnterpriseType ? escHtml(row.nameEnterpriseType) : '';

            const actionCell = isAdmin
                ? '<td>'
                  + '<a href="' + modifyPath.replace('__ID__', row.id) + '" title="Modifier"><i class="color-yellow fas fa-cog"></i></a>'
                  + '<span class="color-yellow mx-1">|</span>'
                  + '<a href="' + deletePath.replace('__ID__', row.id) + '" '
                  + 'onclick="return confirm(\'Supprimer ce projet ?\')" title="Supprimer">'
                  + '<i class="color-white fas fa-trash"></i></a>'
                  + '</td>'
                : '';

            return '<tr>'
                + '<td class="color-white fw-bold align-middle">' + escHtml(row.enterprise) + '</td>'
                + '<td class="color-white align-middle">' + domain + '</td>'
                + '<td class="color-white align-middle">' + activity + '</td>'
                + '<td class="color-white align-middle">' + website + '</td>'
                + '<td class="color-white align-middle">' + enterprise + '</td>'
                + actionCell
                + '</tr>';
        }).join('');
    }

    function escHtml(str) {
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;');
    }

    // Initial load
    fetchResults();
});

