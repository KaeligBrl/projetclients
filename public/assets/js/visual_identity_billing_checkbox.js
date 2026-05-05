window.addEventListener("load", function () {
    function toggleOnServer(url) {
        const xmhttp = new XMLHttpRequest();
        xmhttp.open("get", url);
        xmhttp.send();
    }

    function isMailEnabled(checkbox) {
        return checkbox.dataset.mailEnabled === "1";
    }

    function setLockedStyle(checkbox, isLockedByChain) {
        const isLockedByMail = !isMailEnabled(checkbox);
        const isLocked = isLockedByChain || isLockedByMail;

        checkbox.disabled = isLocked;
        checkbox.style.opacity = isLocked ? "0.35" : "1";
        checkbox.style.cursor = isLocked ? "not-allowed" : "pointer";
        checkbox.title = isLockedByMail
            ? "Aucun email configuré pour cette étape."
            : "";
    }

    const rows = document.querySelectorAll("tbody tr");
    rows.forEach(function (row) {
        const deposit = row.querySelector(".vi-billing-deposit");
        const status = row.querySelector(".vi-billing-status");

        if (!deposit || !status) {
            return;
        }

        function enforceVisualIdentityChain() {
            const chain = [
                {
                    previous: deposit,
                    current: status,
                    endpoint: `/facturation-identite-visuelle/envoi-administratif/${status.dataset.viBillingStatus}`,
                },
            ];

            chain.forEach(function (step) {
                const shouldLock = !step.previous.checked;

                if (shouldLock && step.current.checked) {
                    step.current.checked = false;
                    toggleOnServer(step.endpoint);
                }

                setLockedStyle(step.current, shouldLock);
            });
        }

        deposit.addEventListener("click", function () {
            if (!isMailEnabled(deposit)) {
                return;
            }
            toggleOnServer(`/facturation-identite-visuelle/acompte/${deposit.dataset.viBillingDeposit}`);
            enforceVisualIdentityChain();
        });

        status.addEventListener("click", function () {
            if (!isMailEnabled(status)) {
                return;
            }
            toggleOnServer(`/facturation-identite-visuelle/envoi-administratif/${status.dataset.viBillingStatus}`);
            enforceVisualIdentityChain();
        });

        setLockedStyle(deposit, false);
        enforceVisualIdentityChain();
    });
});

});
