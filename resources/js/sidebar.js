const menuToggle = document.getElementById("menuToggle");
const sidebar = document.getElementById("sidebar");
const overlay = document.getElementById("mobileOverlay");

/* ========================================
   SIDEBAR DESKTOP
======================================== */

const SIDEBAR_KEY = "sidebar-collapsed";

if (window.innerWidth > 768) {

    const collapsed =
        localStorage.getItem(SIDEBAR_KEY) === "true";

    if (collapsed) {

        sidebar?.classList.add("collapsed");

    }

}

menuToggle?.addEventListener("click", () => {

    if (window.innerWidth <= 768) {

        sidebar?.classList.toggle("active");

        overlay?.classList.toggle("active");

    } else {

        sidebar?.classList.toggle("collapsed");

        localStorage.setItem(
            SIDEBAR_KEY,
            sidebar?.classList.contains("collapsed")
        );

    }

});

/* ========================================
   SIDEBAR MOBILE
======================================== */

overlay?.addEventListener("click", () => {

    sidebar?.classList.remove("active");

    overlay?.classList.remove("active");

});
