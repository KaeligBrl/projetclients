(function () {
    var createUrls = window.FILTER_CREATE_URLS || {};

    // ── Initialisation Tom Select ─────────────────────────────────
    document.querySelectorAll('.tom-select-field').forEach(function (el) {
        var createType = el.dataset.createType;
        var opts = {
            plugins: ['remove_button'],
            placeholder: 'Sélectionner…',
            create: false,
        };

        if (createType && createUrls[createType]) {
            // Stockage local uniquement, pas d'AJAX immédiat
            opts.create = function (input, callback) {
                callback({ value: 'new:' + input, text: input + ' (nouveau)' });
            };
            opts.render = {
                option_create: function (data) {
                    return '<div class="create">Ajouter "<strong>' + data.input + '</strong>"</div>';
                }
            };
        }

        new TomSelect(el, opts);
    });

    // ── Interception du submit ────────────────────────────────────
    var form = document.querySelector('form');
    if (!form) return;

    form.addEventListener('submit', function (e) {
        var newItems = [];

        document.querySelectorAll('.tom-select-field[data-create-type]').forEach(function (el) {
            var ts = el.tomselect;
            if (!ts) return;
            var type = el.dataset.createType;

            ts.getValue().forEach(function (val) {
                if (val.indexOf('new:') === 0) {
                    newItems.push({ ts: ts, el: el, type: type, val: val, name: val.slice(4) });
                }
            });
        });

        if (newItems.length === 0) return; // rien à créer, soumettre normalement

        e.preventDefault();

        // Créer chaque nouvel item en séquence puis soumettre
        var promises = newItems.map(function (item) {
            var body = new FormData();
            body.append('name', item.name);
            return fetch(createUrls[item.type], { method: 'POST', body: body })
                .then(function (r) { return r.json(); })
                .then(function (data) {
                    // Remplacer la valeur temporaire par le vrai ID
                    item.ts.removeItem(item.val, true);
                    item.ts.addOption({ value: String(data.id), text: data.name });
                    item.ts.addItem(String(data.id), true);
                });
        });

        Promise.all(promises).then(function () {
            form.submit();
        }).catch(function () {
            form.submit(); // soumettre quand même en cas d'erreur
        });
    });
})();
