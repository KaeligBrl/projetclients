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

    function enforceWebsiteChain(row) {
        const deposit = row.querySelector(".billing-deposit");
        const mockupSent = row.querySelector(".billing-mockup-sent");
        const onboardingTraining = row.querySelector(".billing-onboarding-training");

        if (!deposit || !mockupSent || !onboardingTraining) {
            return;
        }

        const chain = [
            {
                previous: deposit,
                current: mockupSent,
                endpoint: `/facturation-sites-web/maquette-envoyee/${mockupSent.dataset.billingMockupSent}`,
            },
            {
                previous: mockupSent,
                current: onboardingTraining,
                endpoint: `/facturation-sites-web/formation/${onboardingTraining.dataset.billingOnboardingTraining}`,
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

    const rows = document.querySelectorAll("tbody tr");
    rows.forEach(function (row) {
        const deposit = row.querySelector(".billing-deposit");
        const mockupSent = row.querySelector(".billing-mockup-sent");
        const onboardingTraining = row.querySelector(".billing-onboarding-training");

        if (!deposit || !mockupSent || !onboardingTraining) {
            return;
        }

        deposit.addEventListener("click", function () {
            if (!isMailEnabled(deposit)) {
                return;
            }
            toggleOnServer(`/facturation-sites-web/acompte/${deposit.dataset.billingDeposit}`);
            enforceWebsiteChain(row);
            enforceInvoicedState();
        });

        mockupSent.addEventListener("click", function () {
            if (!isMailEnabled(mockupSent)) {
                return;
            }
            toggleOnServer(`/facturation-sites-web/maquette-envoyee/${mockupSent.dataset.billingMockupSent}`);
            enforceWebsiteChain(row);
            enforceInvoicedState();
        });

        onboardingTraining.addEventListener("click", function () {
            if (!isMailEnabled(onboardingTraining)) {
                return;
            }
            toggleOnServer(`/facturation-sites-web/formation/${onboardingTraining.dataset.billingOnboardingTraining}`);
            enforceWebsiteChain(row);
            enforceInvoicedState();
        });

        const depositInvoiced = row.querySelector(".billing-deposit-invoiced");
        const mockupInvoiced = row.querySelector(".billing-mockup-invoiced");
        const trainingInvoiced = row.querySelector(".billing-training-invoiced");
        const depositPaid = row.querySelector(".billing-deposit-paid");
        const mockupPaid = row.querySelector(".billing-mockup-paid");
        const trainingPaid = row.querySelector(".billing-training-paid");

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
            setInvoicedLocked(mockupInvoiced, !mockupSent.checked);
            setInvoicedLocked(trainingInvoiced, !onboardingTraining.checked);
            setPaidLocked(depositPaid, !depositInvoiced || !depositInvoiced.checked);
            setPaidLocked(mockupPaid, !mockupInvoiced || !mockupInvoiced.checked);
            setPaidLocked(trainingPaid, !trainingInvoiced || !trainingInvoiced.checked);
        }

        if (depositInvoiced) {
            depositInvoiced.addEventListener("click", function () {
                toggleOnServer(`/admin/facturation-sites-web/acompte-facture/${depositInvoiced.dataset.billingDepositInvoiced}`);
            });
        }
        if (mockupInvoiced) {
            mockupInvoiced.addEventListener("click", function () {
                toggleOnServer(`/admin/facturation-sites-web/maquette-facturee/${mockupInvoiced.dataset.billingMockupInvoiced}`);
            });
        }
        if (trainingInvoiced) {
            trainingInvoiced.addEventListener("click", function () {
                toggleOnServer(`/admin/facturation-sites-web/formation-facturee/${trainingInvoiced.dataset.billingTrainingInvoiced}`);
            });
        }
        if (depositPaid) {
            depositPaid.addEventListener("click", function () {
                toggleOnServer(`/admin/facturation-sites-web/acompte-paye/${depositPaid.dataset.billingDepositPaid}`);
            });
        }
        if (mockupPaid) {
            mockupPaid.addEventListener("click", function () {
                toggleOnServer(`/admin/facturation-sites-web/maquette-payee/${mockupPaid.dataset.billingMockupPaid}`);
            });
        }
        if (trainingPaid) {
            trainingPaid.addEventListener("click", function () {
                toggleOnServer(`/admin/facturation-sites-web/formation-payee/${trainingPaid.dataset.billingTrainingPaid}`);
            });
        }

        deposit._adminOnly = deposit.disabled;
        mockupSent._adminOnly = mockupSent.disabled;
        onboardingTraining._adminOnly = onboardingTraining.disabled;
        if (depositPaid) {
            depositPaid._adminOnly = depositPaid.dataset.roleRequired === "admin" && depositPaid.disabled;
        }
        if (mockupPaid) {
            mockupPaid._adminOnly = mockupPaid.dataset.roleRequired === "admin" && mockupPaid.disabled;
        }
        if (trainingPaid) {
            trainingPaid._adminOnly = trainingPaid.dataset.roleRequired === "admin" && trainingPaid.disabled;
        }

        setLockedStyle(deposit, false);
        enforceWebsiteChain(row);
        enforceInvoicedState();
    });
});

