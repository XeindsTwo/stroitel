@include('fragments.head', ['title' => 'Акции на товары'])
<link href="https://cdn.jsdelivr.net/npm/toastify-js@1.12.0/src/toastify.min.css" rel="stylesheet">
<body class="body">
@include('fragments.meta')
@include('fragments.header')
<div class="container">
  <div class="breadcrumbs">
    <div class="breadcrumbs__top">
      <div class="breadcrumbs__item">
        <a class="breadcrumbs__link" href="{{ route('index') }}">Главная</a>
      </div>
      <div class="breadcrumbs__item">
        <span class="breadcrumbs__link breadcrumbs__link--inactive">Избранные товары</span>
      </div>
    </div>
  </div>
</div>
<section class="favorites">
  <div class="container">
    <h2 class="title title--long">Избранные товары</h2>
    <ul class="catalog__list" id="favoritesContent"></ul>
  </div>
</section>
@include('fragments.footer')
<script src="https://cdn.jsdelivr.net/npm/toastify-js@1.12.0/src/toastify.min.js"></script>
<script>
  const updateButtonState = (button, isFavorite) => {
    if (isFavorite) {
      button.classList.add('like_active');
    } else {
      button.classList.remove('like_active');
    }
  };
  const toggleFavorite = (productId) => {
    const favorites = JSON.parse(localStorage.getItem('favorites')) || [];
    const index = favorites.indexOf(productId);
    if (index === -1) {
      favorites.push(productId);
      Toastify({
        duration: 3000,
        gravity: 'bottom',
        position: 'right',
        text: 'Товар добавлен в избранное',
      }).showToast();
    } else {
      favorites.splice(index, 1);
      Toastify({
        duration: 3000,
        gravity: 'bottom',
        position: 'right',
        text: 'Товар удален из избранного',
      }).showToast();
    }

    localStorage.setItem('favorites', JSON.stringify(favorites));
    const favTotal = document.getElementById('favtotal');
    favTotal.textContent = favorites.length;
  };
  const fetchFavorites = async () => {
    const favoriteIds = JSON.parse(localStorage.getItem('favorites')) || [];
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    try {
      const response = await fetch('/favorites/products', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({productIds: favoriteIds}),
      });
      const data = await response.json();

      const favoritesContent = document.getElementById('favoritesContent');
      favoritesContent.innerHTML = '';

      if (data.length > 0) {
        data.forEach(product => {
          const li = document.createElement('li');
          li.classList.add('catalog__product');
          li.innerHTML = `
            <div class="catalog__head">
              ${product.new_price ? '<span class="catalog__rebate">Акция</span>' : ''}
              <button class="catalog__like like" type="button" id="favorite_btn" data-product-id="${product.id}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="21" viewBox="0 0 24 21" fill="none">
                  <g clip-path="url(#clip0_11_5)">
                    <path d="M2.64825 11.7848L10.9445 19.5791C11.2308 19.8477 11.374 19.9825 11.541 20.016C11.6171 20.0309 11.6953 20.0309 11.7713 20.016C11.9407 19.9825 12.0828 19.8489 12.3679 19.5791L20.6642 11.786C21.791 10.7278 22.4826 9.28718 22.6037 7.74593C22.7249 6.20468 22.2669 4.67365 21.3192 3.45229L20.9493 2.97611C18.6012 -0.0504357 13.8881 0.456774 12.2378 3.91534C12.1854 4.02495 12.103 4.11747 12.0002 4.18223C11.8973 4.247 11.7783 4.28136 11.6568 4.28136C11.5353 4.28136 11.4162 4.247 11.3134 4.18223C11.2106 4.11747 11.1282 4.02495 11.0758 3.91534C9.42555 0.456774 4.71247 -0.0516296 2.36427 2.97611L1.99439 3.45349C1.04743 4.67468 0.589792 6.20519 0.71093 7.74588C0.832072 9.2866 1.52327 10.7267 2.64945 11.7848H2.64825Z" fill="white" stroke="#079AFF" stroke-width="1.15862"></path>
                  </g>
                  <defs>
                    <clipPath id="clip0_11_5">
                      <rect width="24" height="20.7" fill="white" transform="translate(0 0.155172)"></rect>
                    </clipPath>
                  </defs>
                </svg>
              </button>
            </div>
            <a class="catalog__image" href="/products/${product.id}">
              <img src="/storage/products/${product.image_path}" loading="lazy" alt="${product.name}">
            </a>
            <div class="catalog__info">
              <p class="catalog__article">Артикул: ${product.article}</p>
              <p class="catalog__name">${product.name}</p>
              <div class="catalog__price">
                <p>Цена за шт</p>
                ${product.new_price ? `
                  <span class="catalog__price-discount">${product.price} &#8381;</span>
                  <span class="catalog__price-new">${product.new_price} &#8381;</span>
                ` : `
                  <span class="catalog__price-new one">${product.price} &#8381;</span>
                `}
              </div>
            </div>
          `;
          favoritesContent.appendChild(li);
        });

        const favoriteButtons = document.querySelectorAll('.like');
        favoriteButtons.forEach(button => {
          const productId = button.dataset.productId;
          const isFavorite = favoriteIds.includes(productId);
          updateButtonState(button, isFavorite);

          button.addEventListener('click', () => {
            toggleFavorite(productId);
            updateButtonState(button, !isFavorite);
          });
        });
      } else {
        const noFavoritesMessage = document.createElement('div');
        noFavoritesMessage.classList.add('favorites__non');
        noFavoritesMessage.innerHTML = '<span class="favorites__emoji">🥺</span> Вы ещё не добавляли товаров в избранное :(';
        document.querySelector('.container .title.title--long').after(noFavoritesMessage);
      }
    } catch (error) {
      console.error('Ошибка при получении избранных товаров:', error);
    }
  };

  document.addEventListener('DOMContentLoaded', async () => {
    await fetchFavorites();
  });
</script>
</body>