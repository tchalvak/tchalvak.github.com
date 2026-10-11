(function () {
    // Theme changing functionality
    const STORAGE_KEY = 'site-theme';


    const applyTheme = function (theme) {
        const toggle = document.querySelector('.theme-toggle');
        const resolvedTheme = theme === 'light' ? 'light' : 'dark';
        const body = document.body;
        body.setAttribute('data-theme', resolvedTheme);
        localStorage.setItem(STORAGE_KEY, resolvedTheme);

        if (toggle && toggle.textContent && toggle.setAttribute) {
            toggle.textContent = resolvedTheme === 'dark' ? '☀️' : '🌙';
            toggle.setAttribute('aria-label', resolvedTheme === 'dark'
                ? 'Switch to light mode'
                : 'Switch to dark mode');
            toggle.setAttribute('aria-pressed', String(resolvedTheme === 'light'));
        }
    };


    document.addEventListener('DOMContentLoaded', (event) => {
        // defaultify the theme
        const savedTheme = localStorage.getItem(STORAGE_KEY);
        const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
        applyTheme(savedTheme || (prefersDark ? 'dark' : 'light'));

        // where the toggle is, add it's clickability
        const toggle = document.querySelector('.theme-toggle');
        if (toggle) {
            toggle.addEventListener('click', function () {
                const currentTheme = document.body.getAttribute('data-theme') === 'light' ? 'light' : 'dark';
                // Here is the applied theme
                applyTheme(currentTheme === 'dark' ? 'light' : 'dark');
            });
        }
    });


})();