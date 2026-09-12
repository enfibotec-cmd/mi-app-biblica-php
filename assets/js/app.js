
document.addEventListener('DOMContentLoaded', () => {
  const btnToggleTheme = document.getElementById('btnToggleTheme');
  const htmlElement = document.documentElement;

  // Persistencia de modo oscuro con localStorage
  const savedTheme = localStorage.getItem('theme') || 'light';
  htmlElement.setAttribute('data-bs-theme', savedTheme);
  updateThemeIcon(savedTheme);

  btnToggleTheme?.addEventListener('click', () => {
    const currentTheme = htmlElement.getAttribute('data-bs-theme');
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    
    htmlElement.setAttribute('data-bs-theme', newTheme);
    localStorage.setItem('theme', newTheme);
    updateThemeIcon(newTheme);
  });

  function updateThemeIcon(theme) {
    if (btnToggleTheme) {
      btnToggleTheme.textContent = theme === 'dark' ? '☀️' : '🌙';
    }
  }
});
