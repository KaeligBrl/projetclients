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
        if (!checkbox) {
            return;
        }

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
        const logo = row.querySelector(".vi-billing-logo");
        const status = row.querySelector(".vi-billing-status");

        if (!deposit || !logo || !status) {
            return;
        }

        function enforceVisualIdentityChain() {
            const chain = [
                {
                    previous: deposit,
                    current: logo,
                    endpoint: `/facturation-identite-visuelle/validation-logo/${logo.dataset.viBillingLogo}`,
                },
                {
                    previous: logo,
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

        logo.addEventListener("click", function () {
            if (!isMailEnabled(logo)) {
                return;
            }
            toggleOnServer(`/facturation-identite-visuelle/validation-logo/${logo.dataset.viBillingLogo}`);
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
        const logoInvoiced    = row.querySelector(".vi-billing-logo-invoiced");
        const logoPaid        = row.querySelector(".vi-billing-logo-paid");
        const statusInvoiced  = row.querySelector(".vi-billing-status-invoiced");
        const statusPaid      = row.querySelector(".vi-billing-status-paid");

        function setInvoicedLocked(checkbox, isLocked) {
            if (!checkbox) return;
            checkbox.disabled = isLocked;
            checkbox.style.opacity = isLocked ? "0.35" : "1";
            checkbox.style.cursor = isLocked ? "not-allowed" : "pointer";
            checkbox.title = isLocked ? "Demande de facturation non effectuée." : "";
        }

        function setPaidLocked(checkbox, isLocked) {
            if (!checkbox) return;

            const isLockedByRole = checkbox.dataset.roleRequired === "admin" && checkbox._adminOnly;
            const nextLocked = isLocked || isLockedByRole;

            checkbox.disabled = nextLocked;
            checkbox.style.opacity = nextLocked ? "0.35" : "1";
            checkbox.style.cursor = nextLocked ? "not-allowed" : "pointer";
            checkbox.title = isLockedByRole
                ? "Réservé au service administratif."
                : nextLocked
                    ? "Facturation non effectuée."
                    : "";
        }

        function enforceInvoicedState() {
            setInvoicedLocked(depositInvoiced, !deposit.checked);
            setInvoicedLocked(logoInvoiced, !logo.checked);
            setInvoicedLocked(statusInvoiced, !status.checked);
            setPaidLocked(depositPaid, !depositInvoiced || !depositInvoiced.checked);
            setPaidLocked(logoPaid, !logoInvoiced || !logoInvoiced.checked);
            setPaidLocked(statusPaid, !statusInvoiced || !statusInvoiced.checked);
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
        if (logoInvoiced) {
            logoInvoiced.addEventListener("click", function () {
                toggleOnServer(`/admin/facturation-identite-visuelle/logo-facture/${logoInvoiced.dataset.viBillingLogoInvoiced}`);
            });
        }
        if (logoPaid) {
            logoPaid.addEventListener("click", function () {
                toggleOnServer(`/admin/facturation-identite-visuelle/logo-paye/${logoPaid.dataset.viBillingLogoPaid}`);
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
        logo._adminOnly = logo.disabled;
        status._adminOnly = status.disabled;
        if (depositPaid) {
            depositPaid._adminOnly = depositPaid.dataset.roleRequired === "admin" && depositPaid.disabled;
        }
        if (logoPaid) {
            logoPaid._adminOnly = logoPaid.dataset.roleRequired === "admin" && logoPaid.disabled;
        }
        if (statusPaid) {
            statusPaid._adminOnly = statusPaid.dataset.roleRequired === "admin" && statusPaid.disabled;
        }

        setLockedStyle(deposit, false);
        enforceVisualIdentityChain();
        enforceInvoicedState();
    });
});
