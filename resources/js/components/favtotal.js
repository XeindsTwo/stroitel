const favoriteButtons = document.querySelectorAll('.like');
const favTotal = document.getElementById('favtotal');
const toastConfig = {
  duration: 3000,
  gravity: 'bottom',
  position: 'right',
};

let favorites = JSON.parse(localStorage.getItem('favorites')) || [];
favTotal.textContent = favorites.length;

const updateButtonState = (button, isFavorite) => {
  if (isFavorite) {
    button.classList.add('like_active');
  } else {
    button.classList.remove('like_active');
  }
};

const toggleFavorite = (productId) => {
  const index = favorites.indexOf(productId);
  if (index === -1) {
    favorites.push(productId);
    Toastify({
      ...toastConfig,
      text: 'Товар добавлен в избранное',
    }).showToast();
  } else {
    favorites.splice(index, 1);
    Toastify({
      ...toastConfig,
      text: 'Товар удален из избранного',
    }).showToast();
  }

  localStorage.setItem('favorites', JSON.stringify(favorites));
  favTotal.textContent = favorites.length;
};

favoriteButtons.forEach(button => {
  const productId = button.dataset.productId;
  let isFavorite = favorites.includes(productId);
  updateButtonState(button, isFavorite);

  button.addEventListener('click', () => {
    toggleFavorite(productId);
    isFavorite = !isFavorite;
    updateButtonState(button, isFavorite);
  });
});