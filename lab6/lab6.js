let figure;
let figcaption;
let featuredImg;
let thumbnailImgs;

(function ()
{
    insertKeyframes();

    window.onload = () =>
    {
        figure = document.querySelector("figure");
        figcaption = document.querySelector("figure figcaption");
        featuredImg = document.querySelector("#featured img");
        thumbnailImgs = document.querySelectorAll("#thumbnails img");
        for (let thumbnail of thumbnailImgs)
        {
            thumbnail.onclick = (event) => {changeImg(event.target);};
        }

        figure.onmouseenter = () => {setFadeIn();changeFigcaption();};
        figure.onmouseleave = () => {setFadeOut()};
    };
})();

function insertKeyframes()
{
    let style = document.createElement("style");
    style.setAttribute('type', 'text/css');
    document.head.appendChild(style);
    style.sheet.insertRule(
        "@keyframes fadeIn" +
        "{" +
        "   from" +
        "   {" +
        "       opacity: 0" +
        "   }" +
        "   to" +
        "   {" +
        "       opacity: 0.8" +
        "   }" +
        "}", 0);
    style.sheet.insertRule(
        "@keyframes fadeOut" +
        "{" +
        "   from" +
        "   {" +
        "       opacity: 0.8" +
        "   }" +
        "   to" +
        "   {" +
        "       opacity: 0" +
        "   }" +
        "}", 1);
}

function changeImg(target)
{
    featuredImg.src = target.src.replace(/small/, "medium");
    featuredImg.title = target.title;
}

function setFadeIn()
{
    figcaption.style.animation = "fadeIn 1s linear forwards";
}

function setFadeOut()
{
    figcaption.style.animation = "fadeOut 1s linear forwards";
}

function changeFigcaption()
{
    figcaption.innerHTML = featuredImg.title;
}