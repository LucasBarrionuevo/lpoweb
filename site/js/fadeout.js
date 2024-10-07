document.addEventListener('DOMContentLoaded', () => {
  const spinnerContainer = document.querySelector('.spinner-container');

  setTimeout(() => {
      spinnerContainer.classList.add('fade-out');
      spinnerContainer.addEventListener('transitionend', () => {
          spinnerContainer.remove();
      }, { once: true });
  }, 1000); // Aumenta a 1000 ms para probar
});
