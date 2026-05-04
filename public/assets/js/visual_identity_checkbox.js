window.addEventListener("load", function () {

    let viCustomerBrief = document.querySelectorAll(".vi-customer-brief")
    for (button of viCustomerBrief) {
        button.addEventListener("click", function () {
            let xmhttp = new XMLHttpRequest;
            xmhttp.open("get", `/identite-visuelle/brief-client/${this.dataset.viCustomerBrief}`)
            xmhttp.send()
        })
    }

    let viAppointment = document.querySelectorAll(".vi-appointment")
    for (button of viAppointment) {
        button.addEventListener("click", function () {
            let xmhttp = new XMLHttpRequest;
            xmhttp.open("get", `/identite-visuelle/prise-de-rdv/${this.dataset.viAppointment}`)
            xmhttp.send()
        })
    }

    let viPresentation = document.querySelectorAll(".vi-presentation")
    for (button of viPresentation) {
        button.addEventListener("click", function () {
            let xmhttp = new XMLHttpRequest;
            xmhttp.open("get", `/identite-visuelle/presentation/${this.dataset.viPresentation}`)
            xmhttp.send()
        })
    }

    let viRework = document.querySelectorAll(".vi-rework")
    for (button of viRework) {
        button.addEventListener("click", function () {
            let xmhttp = new XMLHttpRequest;
            xmhttp.open("get", `/identite-visuelle/retravail/${this.dataset.viRework}`)
            xmhttp.send()
        })
    }

    let viValidated = document.querySelectorAll(".vi-validated")
    for (button of viValidated) {
        button.addEventListener("click", function () {
            let xmhttp = new XMLHttpRequest;
            xmhttp.open("get", `/identite-visuelle/validation/${this.dataset.viValidated}`)
            xmhttp.send()
        })
    }

    let viDeclinations = document.querySelectorAll(".vi-declinations")
    for (button of viDeclinations) {
        button.addEventListener("click", function () {
            let xmhttp = new XMLHttpRequest;
            xmhttp.open("get", `/identite-visuelle/declinaisons/${this.dataset.viDeclinations}`)
            xmhttp.send()
        })
    }

    let viFilesDelivered = document.querySelectorAll(".vi-files-delivered")
    for (button of viFilesDelivered) {
        button.addEventListener("click", function () {
            let xmhttp = new XMLHttpRequest;
            xmhttp.open("get", `/identite-visuelle/fichiers-livres/${this.dataset.viFilesDelivered}`)
            xmhttp.send()
        })
    }

})
