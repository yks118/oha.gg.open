// set thema color
const thema = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
document.querySelector('html').setAttribute('data-bs-theme', thema);
