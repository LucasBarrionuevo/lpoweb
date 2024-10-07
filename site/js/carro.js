document.addEventListener("DOMContentLoaded", function () {
    const carousel = document.querySelector(".carousel");
    const newsItems = document.querySelectorAll(".news-item");

    let counter = 0;

    function slideNews() {
        if (counter === newsItems.length - 1) {
            counter = 0;
        } else {
            counter++;
        }

        carousel.style.transform = `translateX(-${counter * 100}%)`;

        newsItems.forEach((item) => {
            item.classList.remove("active");
        });

        newsItems[counter].classList.add("active");
    }

    setInterval(slideNews, 3000); // Cambiar de noticia cada 3.5 segundos
});
