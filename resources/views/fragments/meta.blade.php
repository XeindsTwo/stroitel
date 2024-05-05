@vite(['resources/js/components/feedback-modal.js'])
<div class="meta">
  <div class="container">
    <div class="meta__inner">
      <div class="meta__links">
        <button class="meta__link" type="button" id="feedback-open">Заказать звонок</button>
        <a class="meta__link" href="https://aridal.ru/pdf/buklet_2019.pdf" target="_blank">Каталог PDF</a>
      </div>
      <form class="meta__form" action="{{ route('search') }}" method="GET">
        <label for="search">
          <input class="meta__input" id="search" name="search" required type="text" placeholder="Поиск товаров по названию...">
        </label>
        <button class="btn" type="submit">Поиск</button>
      </form>
      <div class="meta__actions">
        <a class="meta__btn btn" href="{{route('card.favorites')}}">
          <svg class="meta__icon" width="18" height="18" viewBox="0 -28 512.00002 512"
               xmlns="http://www.w3.org/2000/svg">
            <path
                d="m471.382812 44.578125c-26.503906-28.746094-62.871093-44.578125-102.410156-44.578125-29.554687 0-56.621094 9.34375-80.449218 27.769531-12.023438 9.300781-22.917969 20.679688-32.523438 33.960938-9.601562-13.277344-20.5-24.660157-32.527344-33.960938-23.824218-18.425781-50.890625-27.769531-80.445312-27.769531-39.539063 0-75.910156 15.832031-102.414063 44.578125-26.1875 28.410156-40.613281 67.222656-40.613281 109.292969 0 43.300781 16.136719 82.9375 50.78125 124.742187 30.992188 37.394531 75.535156 75.355469 127.117188 119.3125 17.613281 15.011719 37.578124 32.027344 58.308593 50.152344 5.476563 4.796875 12.503907 7.4375 19.792969 7.4375 7.285156 0 14.316406-2.640625 19.785156-7.429687 20.730469-18.128907 40.707032-35.152344 58.328125-50.171876 51.574219-43.949218 96.117188-81.90625 127.109375-119.304687 34.644532-41.800781 50.777344-81.4375 50.777344-124.742187 0-42.066407-14.425781-80.878907-40.617188-109.289063zm0 0"></path>
          </svg>
          Избранное
          <span class="meta__favorite">(<span id="favtotal">0</span>)</span>
        </a>
        <a class="meta__btn btn" href="">
          <svg class="meta__icon" width="18" height="18" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M5.4 14.4C4.41 14.4 3.6 15.21 3.6 16.2C3.6 17.19 4.41 18 5.4 18C6.39 18 7.2 17.19 7.2 16.2C7.2 15.21 6.39 14.4 5.4 14.4ZM0 0V1.8H1.8L5.04 8.64L3.78 10.8C3.69 11.07 3.6 11.43 3.6 11.7C3.6 12.69 4.41 13.5 5.4 13.5H16.2V11.7H5.76C5.67 11.7 5.58 11.61 5.58 11.52V11.43L6.39 9.89997H13.05C13.77 9.89997 14.31 9.53996 14.58 8.99996L17.82 3.15C18 2.97 18 2.88 18 2.7C18 2.16 17.64 1.8 17.1 1.8H3.78L2.97 0H0ZM14.4 14.4C13.41 14.4 12.6 15.21 12.6 16.2C12.6 17.19 13.41 18 14.4 18C15.39 18 16.2 17.19 16.2 16.2C16.2 15.21 15.39 14.4 14.4 14.4Z"></path>
          </svg>
          Корзина
        </a>
      </div>
    </div>
  </div>
</div>
@include('fragments.feedback-modal')
@vite(['resources/js/components/favtotal.js'])