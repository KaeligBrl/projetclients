window.onload = () => {
    let customerbrief = document.querySelectorAll(".customerbrief")
    for (button of customerbrief) {
        button.addEventListener("click", function () {
            let xmhttp = new XMLHttpRequest;
            xmhttp.open("get", `/projet-en-cours/brief-client/${this.dataset.customerbrief}`)
            xmhttp.send()
        })
    }
    let comingsoon = document.querySelectorAll(".comingsoon")
    for (button of comingsoon) {
        button.addEventListener("click", function () {
            let xmhttp = new XMLHttpRequest;
            xmhttp.open("get", `/projet-en-cours/coming-soon/${this.dataset.comingsoon}`)
            xmhttp.send()
        })
    }

    let customercontentreception = document.querySelectorAll(".customercontentreception")
    for (button of customercontentreception) {
        button.addEventListener("click", function () {
            let xmhttp = new XMLHttpRequest;
            xmhttp.open("get", `/projet-en-cours/reception-contenu-client/${this.dataset.customercontentreception}`)
            xmhttp.send()
        })
    }

    let webdesignwait = document.querySelectorAll(".webdesignsend")
    for (button of webdesignwait) {
        button.addEventListener("click", function () {
            let xmhttp = new XMLHttpRequest;
            xmhttp.open("get", `/projet-en-cours/maquette-envoyee/${this.dataset.webdesignsend}`)
            xmhttp.send()
        })
    }

    let webdesignvalidated = document.querySelectorAll(".webdesignvalidated")
    for (button of webdesignvalidated) {
        button.addEventListener("click", function () {
            let xmhttp = new XMLHttpRequest;
            xmhttp.open("get", `/projet-en-cours/maquette-validee/${this.dataset.webdesignvalidated}`)
            xmhttp.send()
        })
    }

    let domainname = document.querySelectorAll(".domainname")
    for (button of domainname) {
        button.addEventListener("click", function () {
            let xmhttp = new XMLHttpRequest;
            xmhttp.open("get", `/projet-en-cours/nom-de-domaine/${this.dataset.domainname}`)
            xmhttp.send()
        })
    }

    let webintegration = document.querySelectorAll(".webintegration")
    for (button of webintegration) {
        button.addEventListener("click", function () {
            let xmhttp = new XMLHttpRequest;
            xmhttp.open("get", `/projet-en-cours/integration/${this.dataset.webintegration}`)
            xmhttp.send()
        })
    }

    let webtraining = document.querySelectorAll(".webtraining")
    for (button of webtraining) {
        button.addEventListener("click", function () {
            let xmhttp = new XMLHttpRequest;
            xmhttp.open("get", `/projet-en-cours/formation/${this.dataset.webtraining}`)
            xmhttp.send()
        })
    }
}