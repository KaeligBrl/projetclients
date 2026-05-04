window.addEventListener("load", function () {

    let viBillingDeposit = document.querySelectorAll(".vi-billing-deposit")
    for (button of viBillingDeposit) {
        button.addEventListener("click", function () {
            let xmhttp = new XMLHttpRequest;
            xmhttp.open("get", `/facturation-identite-visuelle/acompte/${this.dataset.viBillingDeposit}`)
            xmhttp.send()
        })
    }

    let viBillingStatus = document.querySelectorAll(".vi-billing-status")
    for (button of viBillingStatus) {
        button.addEventListener("click", function () {
            let xmhttp = new XMLHttpRequest;
            xmhttp.open("get", `/facturation-identite-visuelle/envoi-administratif/${this.dataset.viBillingStatus}`)
            xmhttp.send()
        })
    }

})
