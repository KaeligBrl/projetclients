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
        const isLockedByRole = !!checkbox._adminOnly;
        const isLocked = isLockedByChain || isLockedByMail || isLockedByRole;

        checkbox.disabled = isLocked;
        checkbox.style.opacity = isLocked ? "0.35" : "1";
        checkbox.style.cursor = isLocked ? "not-allowed" : "pointer";
        checkbox.title = isLockedByRole
            ? "Réservé au service administratif."
            : isLockedByMail
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
            enforceInvoicedState();
        });

        status.addEventListener("click", function () {
            if (!isMailEnabled(status)) {
                return;
            }
            toggleOnServer(`/facturation-identite-visuelle/envoi-administratif/${status.dataset.viBillingStatus}`);
            enforceVisualIdentityChain();
            enforceInvoicedState();
        });

        const depositInvoiced = row.querySelector(".vi-billing-deposit-invoiced");
        const depositPaid     = row.querySelector(".vi-billing-deposit-paid");
        const statusInvoiced  = row.querySelector(".vi-billing-status-invoiced");
        const statusPaid      = row.querySelector(".vi-billing-status-paid");

        function setInvoicedLocked(checkbox, isLocked) {
            if (!checkbox) return;
            checkbox.disabled = isLocked;
            checkbox.style.opacity = isLocked ? "0.35" : "1";
            checkbox.style.cursor = isLocked ? "not-allowed" : "pointer";
            checkbox.title = isLocked ? "Demande de facturation non effectuée." : "";
        }

        function enforceInvoicedState() {
            setInvoicedLocked(depositInvoiced, !deposit.checked);
            setInvoicedLocked(statusInvoiced, !status.checked);
        }

        if (depositInvoiced) {
            depositInvoiced.addEventListener("click", function () {
                toggleOnServer(`/admin/facturation-identite-visuelle/acompte-facture/${depositInvoiced.dataset.viBillingDepositInvoiced}`);
            });
        }
        if (depositPaid) {
            depositPaid.addEventListener("click", function () {
                toggleOnServer(`/admin/facturation-identite-visuelle/acompte-paye/${depositPaid.dataset.viBillingDepositPaid}`);
            });
        }
        if (statusInvoiced) {
            statusInvoiced.addEventListener("click", function () {
                toggleOnServer(`/admin/facturation-identite-visuelle/admin-facture/${statusInvoiced.dataset.viBillingStatusInvoiced}`);
            });
        }
        if (statusPaid) {
            statusPaid.addEventListener("click", function () {
                toggleOnServer(`/admin/facturation-identite-visuelle/admin-paye/${statusPaid.dataset.viBillingStatusPaid}`);
            });
        }

        deposit._adminOnly = deposit.disabled;
        status._adminOnly = status.disabled;

        setLockedStyle(deposit, false);
        enforceVisualIdentityChain();
        enforceInvoicedState();
    });
});
