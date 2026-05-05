window.onload = () => {
    let customerbrief = document.querySelectorAll(".customerbrief")
    for (button of customerbrief) {
        button.addEventListener("click", function () {
            let xmhttp = new XMLHttpRequest;
            xmhttp.open("get", `/projet-sites-web/brief-client/${this.dataset.customerbrief}`)
            xmhttp.send()
        })
    }
    let comingsoon = document.querySelectorAll(".comingsoon")
    for (button of comingsoon) {
        button.addEventListener("click", function () {
            let xmhttp = new XMLHttpRequest;
            xmhttp.open("get", `/projet-sites-web/coming-soon/${this.dataset.comingsoon}`)
            xmhttp.send()
        })
    }

    let customercontentreception = document.querySelectorAll(".customercontentreception")
    for (button of customercontentreception) {
        button.addEventListener("click", function () {
            let xmhttp = new XMLHttpRequest;
            xmhttp.open("get", `/projet-sites-web/reception-contenu-client/${this.dataset.customercontentreception}`)
            xmhttp.send()
        })
    }

    let webdesignwait = document.querySelectorAll(".webdesignsend")
    for (button of webdesignwait) {
        button.addEventListener("click", function () {
            let xmhttp = new XMLHttpRequest;
            xmhttp.open("get", `/projet-sites-web/maquette-envoyee/${this.dataset.webdesignsend}`)
            xmhttp.send()
        })
    }

    let webdesignvalidated = document.querySelectorAll(".webdesignvalidated")
    for (button of webdesignvalidated) {
        button.addEventListener("click", function () {
            let xmhttp = new XMLHttpRequest;
            xmhttp.open("get", `/projet-sites-web/maquette-validee/${this.dataset.webdesignvalidated}`)
            xmhttp.send()
        })
    }

    let domainname = document.querySelectorAll(".domainname")
    for (button of domainname) {
        button.addEventListener("click", function () {
            let xmhttp = new XMLHttpRequest;
            xmhttp.open("get", `/projet-sites-web/nom-de-domaine/${this.dataset.domainname}`)
            xmhttp.send()
        })
    }

    let webintegration = document.querySelectorAll(".webintegration")
    for (button of webintegration) {
        button.addEventListener("click", function () {
            let xmhttp = new XMLHttpRequest;
            xmhttp.open("get", `/projet-sites-web/integration/${this.dataset.webintegration}`)
            xmhttp.send()
        })
    }

    let webtraining = document.querySelectorAll(".webtraining")
    for (button of webtraining) {
        button.addEventListener("click", function () {
            let xmhttp = new XMLHttpRequest;
            xmhttp.open("get", `/projet-sites-web/formation/${this.dataset.webtraining}`)
            xmhttp.send()
        })
    }

}