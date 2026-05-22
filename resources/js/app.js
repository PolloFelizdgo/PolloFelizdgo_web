const themeToggle = document.getElementById('themeToggle');
const themeToggleMobile = document.getElementById('themeToggleMobile');
const themeIcon = document.getElementById('themeIcon');
const themeIconMobile = document.getElementById('themeIconMobile');
const menuThemeToggle = document.getElementById('menuThemeToggle');
const menuThemeIcon = document.getElementById('menuThemeIcon');

const updateThemeIcons = () => {
    const isDark = document.documentElement.classList.contains('dark');
    const icon = isDark ? '☀️' : '🌙';

    if (themeIcon) themeIcon.textContent = icon;
    if (themeIconMobile) themeIconMobile.textContent = icon;
    if (menuThemeIcon) menuThemeIcon.textContent = icon;
};

const toggleTheme = () => {
    const isDark = document.documentElement.classList.contains('dark');

    if (isDark) {
        document.documentElement.classList.remove('dark');
        localStorage.setItem('theme', 'light');
    } else {
        document.documentElement.classList.add('dark');
        localStorage.setItem('theme', 'dark');
    }

    updateThemeIcons();
};

if (themeToggle) {
    themeToggle.addEventListener('click', toggleTheme);
}

if (themeToggleMobile) {
    themeToggleMobile.addEventListener('click', toggleTheme);
}

if (menuThemeToggle) {
    menuThemeToggle.addEventListener('click', toggleTheme);
}

updateThemeIcons();