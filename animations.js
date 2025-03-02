document.addEventListener("DOMContentLoaded", function () {
    const gameCards = document.querySelectorAll(".game");

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add("animated");
            }
        });
    }, { threshold: 0.2 });

    gameCards.forEach((card) => {
        observer.observe(card);
    });
});