document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll(".care__btn");
    const tabs = document.querySelectorAll(".care__tab");
    tabs.forEach(function (tab, index) {
        if (index !== 0) {
            tab.style.display = "none";
        }
    });
    buttons.forEach(function (button) {
        button.addEventListener("click", function () {
            buttons.forEach(function (btn) {
                btn.classList.remove("care__btn--active");
            });

            button.classList.add("care__btn--active");
            const tabIndex = parseInt(button.getAttribute("data-tab-index"));
            tabs.forEach(function (tab) {
                tab.style.display = "none";
            });
            tabs[tabIndex].style.display = "block";
        });
    });
});