window.addEventListener("load", function () {

    let billingDeposit = document.querySelectorAll(".billing-deposit")
    for (button of billingDeposit) {
        button.addEventListener("click", function () {
            let xmhttp = new XMLHttpRequest;
            xmhttp.open("get", `/facturation-sites-web/acompte/${this.dataset.billingDeposit}`)
            xmhttp.send()
        })
    }

    let billingMockupSent = document.querySelectorAll(".billing-mockup-sent")
    for (button of billingMockupSent) {
        button.addEventListener("click", function () {
            let xmhttp = new XMLHttpRequest;
            xmhttp.open("get", `/facturation-sites-web/maquette-envoyee/${this.dataset.billingMockupSent}`)
            xmhttp.send()
        })
    }

    let billingOnboardingTraining = document.querySelectorAll(".billing-onboarding-training")
    for (button of billingOnboardingTraining) {
        button.addEventListener("click", function () {
            let xmhttp = new XMLHttpRequest;
            xmhttp.open("get", `/facturation-sites-web/formation/${this.dataset.billingOnboardingTraining}`)
            xmhttp.send()
        })
    }

    let billingStatus = document.querySelectorAll(".billing-status")
    for (button of billingStatus) {
        button.addEventListener("click", function () {
            let xmhttp = new XMLHttpRequest;
            xmhttp.open("get", `/facturation-sites-web/envoi-administratif/${this.dataset.billingStatus}`)
            xmhttp.send()
        })
    }

})
