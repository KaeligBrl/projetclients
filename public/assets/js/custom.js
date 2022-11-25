const buttons = document.querySelectorAll(".tab-button");
const contents = document.querySelectorAll(".content .tabstable");

contents.forEach((e, i) => {
    if (i > 0) e.classList.add("content-hide");
});

function deactivateText(arg) {
    buttons.forEach((e, i) => {
        if (e.classList.contains("active")) {
            e.classList.toggle("active");
        }
        contents[i].classList.add("content-hide");
    });
    activatetext(arg);
}

function activatetext(arg) {
    const contentData = arg.dataset.content;
    arg.classList.toggle("active");
    contents[contentData].classList.toggle("content-hide");
}

