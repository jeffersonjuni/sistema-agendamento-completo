const menuToggle = document.getElementById("menuToggle");
const sidebar = document.getElementById("sidebar");
const overlay = document.getElementById("mobileOverlay");

menuToggle?.addEventListener("click", () => {

    if (window.innerWidth <= 768) {

        sidebar?.classList.toggle("active");

        overlay?.classList.toggle("active");

    } else {

        sidebar?.classList.toggle("collapsed");

    }

});

overlay?.addEventListener("click", () => {

    sidebar?.classList.remove("active");

    overlay?.classList.remove("active");

});
