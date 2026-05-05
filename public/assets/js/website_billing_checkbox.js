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
        });

        mockupSent.addEventListener("click", function () {
            if (!isMailEnabled(mockupSent)) {
                return;
            }
            toggleOnServer(`/facturation-sites-web/maquette-envoyee/${mockupSent.dataset.billingMockupSent}`);
            enforceWebsiteChain(row);
        });

        onboardingTraining.addEventListener("click", function () {
            if (!isMailEnabled(onboardingTraining)) {
                return;
            }
            toggleOnServer(`/facturation-sites-web/formation/${onboardingTraining.dataset.billingOnboardingTraining}`);
            enforceWebsiteChain(row);
        });

        setLockedStyle(deposit, false);
        enforceWebsiteChain(row);
    });
});

