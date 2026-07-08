import Alpine from "alpinejs";
import "./sidebar";
import "./navbar";
import "./sweetalert";
import "./datatables";

window.Alpine = Alpine;

Alpine.start();

import { createIcons, icons } from "lucide";

createIcons({
    icons,
});

/* ========================================
   DARK MODE
======================================== */

const themeToggle = document.getElementById("themeToggle");

const savedTheme = localStorage.getItem("theme");

if (savedTheme) {
    document.documentElement.classList.toggle("dark", savedTheme === "dark");
} else {
    const systemDarkMode = window.matchMedia(
        "(prefers-color-scheme: dark)",
    ).matches;

    document.documentElement.classList.toggle("dark", systemDarkMode);
}

updateThemeIcon();

themeToggle?.addEventListener("click", () => {
    document.documentElement.classList.toggle("dark");

    const isDark = document.documentElement.classList.contains("dark");

    localStorage.setItem("theme", isDark ? "dark" : "light");

    updateThemeIcon();
});

function updateThemeIcon() {
    const isDark = document.documentElement.classList.contains("dark");

    if (themeToggle) {
        themeToggle.textContent = isDark ? "☀️" : "🌙";
    }
}

/* ========================================
   TOGGLE PASSWORD
======================================== */

window.initializePasswordToggles = function () {
    document.querySelectorAll(".password-toggle").forEach((button) => {
        if (button.dataset.initialized) {
            return;
        }

        button.dataset.initialized = "true";

        button.addEventListener("click", () => {
            const targetId = button.dataset.togglePassword;

            if (!targetId) return;

            const input = document.getElementById(targetId);

            if (!input) return;

            const isPassword = input.type === "password";

            input.type = isPassword ? "text" : "password";

            button.innerHTML = isPassword
                ? '<i data-lucide="eye-off"></i>'
                : '<i data-lucide="eye"></i>';

            createIcons({
                icons,
            });
        });
    });
}

initializePasswordToggles();

function enableLoading(formId, buttonId, loadingText) {
    const form = document.getElementById(formId);

    const button = document.getElementById(buttonId);

    if (!form || !button) return;

    form.addEventListener("submit", () => {
        button.disabled = true;

        button.textContent = loadingText;
    });
}

enableLoading("loginForm", "loginButton", "Entrando...");

enableLoading("registerForm", "registerButton", "Criando conta...");

enableLoading("forgotForm", "forgotButton", "Enviando...");

/* ========================================
   ALERTS
======================================== */

document.querySelectorAll('.alert-component')
    .forEach(alert => {

        const closeButton =
            alert.querySelector('.alert-close');

        closeButton?.addEventListener(
            'click',
            () => {

                alert.classList.add(
                    'alert-hide'
                );

                setTimeout(
                    () => alert.remove(),
                    300
                );

            }
        );

        setTimeout(() => {

            if (!document.body.contains(alert)) {
                return;
            }

            alert.classList.add(
                'alert-hide'
            );

            setTimeout(
                () => alert.remove(),
                300
            );

        }, 5000);

    });
