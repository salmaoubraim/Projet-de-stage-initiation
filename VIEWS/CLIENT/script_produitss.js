
    document.addEventListener("DOMContentLoaded", function () {
        const showMoreBtn = document.getElementById("showMoreBtn");
        const hiddenCards = document.querySelectorAll(".product-card.hidden");

        showMoreBtn.addEventListener("click", function () {
            hiddenCards.forEach(card => card.style.display = "block");
            showMoreBtn.style.display = "none"; // cache le bouton
        });
    });
