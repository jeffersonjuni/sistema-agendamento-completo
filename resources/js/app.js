const menuToggle = document.getElementById('menuToggle');
const sidebar = document.getElementById('sidebar');

if (menuToggle && sidebar) {

    menuToggle.addEventListener('click', () => {
        sidebar.classList.toggle('active');
    });

}

/* ========================================
   DARK MODE
======================================== */

const themeToggle = document.getElementById('themeToggle');

const savedTheme = localStorage.getItem('theme');

if (savedTheme) {

    document.documentElement.classList.toggle(
        'dark',
        savedTheme === 'dark'
    );

} else {

    const systemDarkMode = window.matchMedia(
        '(prefers-color-scheme: dark)'
    ).matches;

    document.documentElement.classList.toggle(
        'dark',
        systemDarkMode
    );

}

updateThemeIcon();

themeToggle?.addEventListener('click', () => {

    document.documentElement.classList.toggle('dark');

    const isDark =
        document.documentElement.classList.contains('dark');

    localStorage.setItem(
        'theme',
        isDark ? 'dark' : 'light'
    );

    updateThemeIcon();

});

function updateThemeIcon() {

    const isDark =
        document.documentElement.classList.contains('dark');

    if (themeToggle) {
        themeToggle.textContent = isDark ? '☀️' : '🌙';
    }

}
