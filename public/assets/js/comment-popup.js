var customerbriefpopup = document.getElementById('popup-customerbrief')
customerbriefpopup.addEventListener('show.bs.modal', function (event) {

    var button = event.relatedTarget
    var recipient = button.getAttribute('data-bs-id')

    var commentcustomerbrief = "Commentaire: " + button.getAttribute('data-bs-commentcustomerbrief')
    var commentcustomerbriefempty = "Aucun Commentaire"
    var datecustomerbrief = "Date du brief: " + button.getAttribute('data-bs-datecustomerbrief')
    var datecustomerbriefempty = "Date du brief inconnue"

    var modalTitle = customerbriefpopup.querySelector('.modal-title')
    var modalBody = customerbriefpopup.querySelector('.modal-body')
    var modalBody2 = customerbriefpopup.querySelector('.modal-body2')


    modalTitle.textContent = 'Information(s)'

    if (datecustomerbrief === "") {
        modalBody2.textContent = datecustomerbriefempty
    } else {
        modalBody2.textContent = datecustomerbrief
    }
    if (commentcustomerbrief === "") {
        modalBody.textContent = commentcustomerbriefempty
    } else {
        modalBody.textContent = commentcustomerbrief
    }
})

var domainnamepopup = document.getElementById('popup-domainname')
domainnamepopup.addEventListener('show.bs.modal', function (event) {

    var button = event.relatedTarget
    var recipient = button.getAttribute('data-bs-id')

    var commentdomainname = "Commentaire: " + button.getAttribute('data-bs-commentdomainname')
    var commentdomainnameempty = "Aucun Commentaire"
    var datedomainname = "Date d'achat: " + button.getAttribute('data-bs-datedomainname')
    var datedomainnameempty = "Date d'achat inconnue"

    var modalTitle = domainnamepopup.querySelector('.modal-title')
    var modalBody = domainnamepopup.querySelector('.modal-body')
    var modalBody2 = domainnamepopup.querySelector('.modal-body2')


    modalTitle.textContent = 'Information(s)'

    if (datedomainname === "") {
        modalBody2.textContent = datedomainnameempty
    } else {
        modalBody2.textContent = datedomainname
    }
    if (commentdomainname === "") {
        modalBody.textContent = commentdomainnameempty
    } else {
        modalBody.textContent = commentdomainname
    }
})

var comingsoonpopup = document.getElementById('popup-comingsoon')
comingsoonpopup.addEventListener('show.bs.modal', function (event) {

    var button = event.relatedTarget
    var recipient = button.getAttribute('data-bs-id')

    var commentcomingsoon = "Commentaire: " + button.getAttribute('data-bs-commentcomingsoon')
    var commentcomingsoonempty = "Aucun Commentaire"
    var datecomingsoon = "Date de la mise en ligne: " + button.getAttribute('data-bs-datecomingsoon')
    var datecomingsoonempty = "Date de la mise en ligne inconnue"

    var modalTitle = comingsoonpopup.querySelector('.modal-title')
    var modalBody = comingsoonpopup.querySelector('.modal-body')
    var modalBody2 = comingsoonpopup.querySelector('.modal-body2')


    modalTitle.textContent = 'Information(s)'

    if (datecomingsoon === "") {
        modalBody2.textContent = datecomingsoonempty
    } else {
        modalBody2.textContent = datecomingsoon
    }
    if (commentcomingsoon === "") {
        modalBody.textContent = commentcomingsoonempty
    } else {
        modalBody.textContent = commentcomingsoon
    }
})

var customercontentreceptionpopup = document.getElementById('popup-customercontentreception')
customercontentreceptionpopup.addEventListener('show.bs.modal', function (event) {

    var button = event.relatedTarget
    var recipient = button.getAttribute('data-bs-id')

    var commentcustomercontentreception = "Commentaire: " + button.getAttribute('data-bs-commentcustomercontentreception')
    var commentcustomercontentreceptionempty = "Aucun Commentaire"
    var datecustomercontentreception = "Date de reception: " + button.getAttribute('data-bs-datecustomercontentreception')
    var datecustomercontentreceptionempty = "Date de reception inconnue"

    var modalTitle = customercontentreceptionpopup.querySelector('.modal-title')
    var modalBody = customercontentreceptionpopup.querySelector('.modal-body')
    var modalBody2 = customercontentreceptionpopup.querySelector('.modal-body2')


    modalTitle.textContent = 'Information(s)'

    if (datecustomercontentreception === "") {
        modalBody2.textContent = datecustomercontentreceptionempty
    } else {
        modalBody2.textContent = datecustomercontentreception
    }
    if (commentcustomercontentreception === "") {
        modalBody.textContent = commentcustomercontentreceptionempty
    } else {
        modalBody.textContent = commentcustomercontentreception
    }
})


var picturesreceptionpopup = document.getElementById('popup-picturesreception')
picturesreceptionpopup.addEventListener('show.bs.modal', function (event) {

    var button = event.relatedTarget
    var recipient = button.getAttribute('data-bs-id')

    var commentpicturesreception = "Commentaire: " + button.getAttribute('data-bs-commentpicturesreception')
    var commentpicturesreceptionempty = "Aucun Commentaire"
    var datepicturesreception = "Date de reception: " + button.getAttribute('data-bs-datepicturesreception')
    var datepicturesreceptionempty = "Date de reception inconnue"

    var modalTitle = picturesreceptionpopup.querySelector('.modal-title')
    var modalBody = picturesreceptionpopup.querySelector('.modal-body')
    var modalBody2 = picturesreceptionpopup.querySelector('.modal-body2')

    modalTitle.textContent = 'Information(s)'

    if (datepicturesreception === "") {
        modalBody2.textContent = datepicturesreceptionempty
    } else {
        modalBody2.textContent = datepicturesreception
    }
    if (commentpicturesreception === "") {
        modalBody.textContent = commentpicturesreceptionempty
    } else {
        modalBody.textContent = commentpicturesreception
    }
})

var webdesignprogresspopup = document.getElementById('popup-webdesignprogress')
webdesignprogresspopup.addEventListener('show.bs.modal', function (event) {

    var button = event.relatedTarget
    var recipient = button.getAttribute('data-bs-id')

    var commentwebdesignprogress = "Commentaire: " + button.getAttribute('data-bs-commentwebdesignprogress')
    var commentwebdesignprogressempty = "Aucun Commentaire"
    var datewebdesignprogress = "Date de début: " + button.getAttribute('data-bs-datewebdesignprogress')
    var datewebdesignprogressempty = "Date de début inconnue"

    var modalTitle = webdesignprogresspopup.querySelector('.modal-title')
    var modalBody = webdesignprogresspopup.querySelector('.modal-body')
    var modalBody2 = webdesignprogresspopup.querySelector('.modal-body2')

    modalTitle.textContent = 'Information(s)'

    if (datewebdesignprogress === "") {
        modalBody2.textContent = datewebdesignprogressempty
    } else {
        modalBody2.textContent = datewebdesignprogress
    }
    if (commentwebdesignprogress === "") {
        modalBody.textContent = commentwebdesignprogressempty
    } else {
        modalBody.textContent = commentwebdesignprogress
    }
})

var webdesignsendpopup = document.getElementById('popup-webdesignsend')
webdesignsendpopup.addEventListener('show.bs.modal', function (event) {

    var button = event.relatedTarget
    var recipient = button.getAttribute('data-bs-id')

    var commentwebdesignsend = "Commentaire: " + button.getAttribute('data-bs-commentwebdesignsend')
    var commentwebdesignsendempty = "Aucun Commentaire"
    var datewebdesignsend = "Date d'envoie: " + button.getAttribute('data-bs-datewebdesignsend')
    var datewebdesignsendempty = "Date d'envoie inconnue"

    var modalTitle = webdesignsendpopup.querySelector('.modal-title')
    var modalBody = webdesignsendpopup.querySelector('.modal-body')
    var modalBody2 = webdesignsendpopup.querySelector('.modal-body2')

    modalTitle.textContent = 'Information(s)'

    if (datewebdesignsend === "") {
        modalBody2.textContent = datewebdesignsendempty
    } else {
        modalBody2.textContent = datewebdesignsend
    }
    if (commentwebdesignsend === "") {
        modalBody.textContent = commentwebdesignsendempty
    } else {
        modalBody.textContent = commentwebdesignsend
    }
})

var webdesignvalidatedpopup = document.getElementById('popup-webdesignvalidated')
webdesignvalidatedpopup.addEventListener('show.bs.modal', function (event) {

    var button = event.relatedTarget
    var recipient = button.getAttribute('data-bs-id')

    var commentwebdesignvalidated = "Commentaire: " + button.getAttribute('data-bs-commentwebdesignvalidated')
    var commentwebdesignvalidatedempty = "Aucun Commentaire"
    var datewebdesignvalidated = "Date de validation: " + button.getAttribute('data-bs-datewebdesignvalidated')
    var datewebdesignvalidatedempty = "Date de validation inconnue"

    var modalTitle = webdesignvalidatedpopup.querySelector('.modal-title')
    var modalBody = webdesignvalidatedpopup.querySelector('.modal-body')
    var modalBody2 = webdesignvalidatedpopup.querySelector('.modal-body2')

    modalTitle.textContent = 'Information(s)'

    if (datewebdesignvalidated === "") {
        modalBody2.textContent = datewebdesignvalidatedempty
    } else {
        modalBody2.textContent = datewebdesignvalidated
    }
    if (commentwebdesignvalidated === "") {
        modalBody.textContent = commentwebdesignvalidatedempty
    } else {
        modalBody.textContent = commentwebdesignvalidated
    }
})

var webintegrationpopup = document.getElementById('popup-webintegration')
webintegrationpopup.addEventListener('show.bs.modal', function (event) {

    var button = event.relatedTarget
    var recipient = button.getAttribute('data-bs-id')

    var commentwebintegration = "Commentaire: " + button.getAttribute('data-bs-commentwebintegration')
    var commentwebintegrationempty = "Aucun Commentaire"
    var datewebintegration = "Date prévue: " + button.getAttribute('data-bs-datewebintegration')
    var datewebintegrationempty = "Date prévue inconnue"

    var modalTitle = webintegrationpopup.querySelector('.modal-title')
    var modalBody = webintegrationpopup.querySelector('.modal-body')
    var modalBody2 = webintegrationpopup.querySelector('.modal-body2')

    modalTitle.textContent = 'Information(s)'

    if (datewebintegration === "") {
        modalBody2.textContent = datewebintegrationempty
    } else {
        modalBody2.textContent = datewebintegration
    }
    if (commentwebintegration === "") {
        modalBody.textContent = commentwebintegrationempty
    } else {
        modalBody.textContent = commentwebintegration
    }
})

var webtrainingpopup = document.getElementById('popup-webtraining')
webtrainingpopup.addEventListener('show.bs.modal', function (event) {

    var button = event.relatedTarget
    var recipient = button.getAttribute('data-bs-id')

    var commentwebtraining = "Commentaire: " + button.getAttribute('data-bs-commentwebtraining')
    var commentwebtrainingempty = "Aucun Commentaire"
    var datewebtraining = "Date prévue: " + button.getAttribute('data-bs-datewebtraining')
    var datewebtrainingempty = "Date prévue inconnue"

    var modalTitle = webtrainingpopup.querySelector('.modal-title')
    var modalBody = webtrainingpopup.querySelector('.modal-body')
    var modalBody2 = webtrainingpopup.querySelector('.modal-body2')

    modalTitle.textContent = 'Information(s)'

    if (datewebtraining === "") {
        modalBody2.textContent = datewebtrainingempty
    } else {
        modalBody2.textContent = datewebtraining
    }
    if (commentwebtraining === "") {
        modalBody.textContent = commentwebtrainingempty
    } else {
        modalBody.textContent = commentwebtraining
    }
})