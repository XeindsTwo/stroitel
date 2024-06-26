@include('fragments/head', ['title' => 'Поиск товаров'])
<link href="https://cdn.jsdelivr.net/npm/toastify-js@1.12.0/src/toastify.min.css" rel="stylesheet">
<body class="body">
@include('fragments.meta')
@include('fragments.header')
<div class="container">
  <div class="breadcrumbs">
    <div class="breadcrumbs__top">
      <div class="breadcrumbs__item">
        <a class="breadcrumbs__link" href="{{route('index')}}">Главная</a>
      </div>
      <div class="breadcrumbs__item">
        <span>Поиск товаров</span>
      </div>
    </div>
  </div>
</div>
<section class="search">
  <div class="container">
    @if(count($categories) > 0)
      <h1 class="title">Результаты поиска</h1>
      <p class="search__text">По вашему запросу «{{$searchQuery}}» мы нашли следующие товары:</p>
      <ul class="search__chapters">
        @foreach($categories as $category)
          <li class="search__chapter">
            <h2 class="search__subtitle">{{ $category->name }}</h2>
            <ul class="catalog__products">
              @foreach($category->products as $product)
                <li class="catalog__product">
                  <div class="catalog__head">
                    @if(isset($product->new_price))
                      <span class="catalog__rebate">Акция</span>
                    @endif
                    <button class="catalog__like like" type="button" id="favorite_btn" data-product-id="{{ $product->id }}">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="21" viewBox="0 0 24 21" fill="none">
                        <g clip-path="url(#clip0_11_5)">
                          <path
                              d="M2.64825 11.7848L10.9445 19.5791C11.2308 19.8477 11.374 19.9825 11.541 20.016C11.6171 20.0309 11.6953 20.0309 11.7713 20.016C11.9407 19.9825 12.0828 19.8489 12.3679 19.5791L20.6642 11.786C21.791 10.7278 22.4826 9.28718 22.6037 7.74593C22.7249 6.20468 22.2669 4.67365 21.3192 3.45229L20.9493 2.97611C18.6012 -0.0504357 13.8881 0.456774 12.2378 3.91534C12.1854 4.02495 12.103 4.11747 12.0002 4.18223C11.8973 4.247 11.7783 4.28136 11.6568 4.28136C11.5353 4.28136 11.4162 4.247 11.3134 4.18223C11.2106 4.11747 11.1282 4.02495 11.0758 3.91534C9.42555 0.456774 4.71247 -0.0516296 2.36427 2.97611L1.99439 3.45349C1.04743 4.67468 0.589792 6.20519 0.71093 7.74588C0.832072 9.2866 1.52327 10.7267 2.64945 11.7848H2.64825Z"
                              fill="white" stroke="#079AFF" stroke-width="1.15862"/>
                        </g>
                        <defs>
                          <clipPath id="clip0_11_5">
                            <rect width="24" height="20.7" fill="white" transform="translate(0 0.155172)"/>
                          </clipPath>
                        </defs>
                      </svg>
                    </button>
                  </div>
                  <a class="catalog__image" href="{{ route('show_product', ['id' => $product->id]) }}">
                    <img src="{{ asset('storage/products/' . $product->image_path) }}" loading="lazy"
                         alt="{{ $product->name }}">
                  </a>
                  <div class="catalog__info">
                    <p class="catalog__article">Артикул: {{ $product->article }}</p>
                    <p class="catalog__name">{{ $product->name }}</p>
                    <div class="catalog__price">
                      <p>Цена за шт</p>
                      @if(isset($product->new_price))
                        <span
                            class="catalog__price-discount">{{ number_format($product->price, 0, '.', ' ') }} &#8381;</span>
                        <span
                            class="catalog__price-new">{{ number_format($product->new_price, 0, '.', ' ') }} &#8381;</span>
                      @else
                        <span
                            class="catalog__price-new one">{{ number_format($product->price, 0, '.', ' ') }} &#8381;</span>
                      @endif
                    </div>
                    <form class="catalog__form form {{$product->availability ? '' : 'not-available'}}" action="">
                      <input type="hidden" name="product_id" value="{{$product->id}}">
                      <div class="catalog__input">
                        <input class="catalog__value quantity" type="number" name="quantity" id="quantity">
                        <div class="catalog__actions">
                          <button class="catalog__action plus" type="button">
                            <svg viewBox="0 0 9 8" xmlns="http://www.w3.org/2000/svg">
                              <rect x="4" width="2" height="8" rx="1"></rect>
                              <rect x="1" y="5.00488" width="2" height="8" rx="1"
                                    transform="rotate(-90.0355 1 5.00488)"></rect>
                            </svg>
                          </button>
                          <button class="catalog__action minus" type="button">
                            <svg viewBox="0 0 9 3" xmlns="http://www.w3.org/2000/svg">
                              <rect x="1" y="2.00488" width="2" height="8" rx="1"
                                    transform="rotate(-90.0355 1 2.00488)"></rect>
                            </svg>
                          </button>
                        </div>
                      </div>
                      <button class="catalog__card btn" type="submit">В корзину</button>
                    </form>
                  </div>
                </li>
              @endforeach
            </ul>
          </li>
        @endforeach
      </ul>
    @else
      <h1 class="title">По вашему запросу «{{$searchQuery}}» мы не нашли ничего</h1>
      <p class="search__text">Начните с главной и вы все найдете</p>
      <a class="search__main btn" href="{{route('index')}}">На главную</a>
    @endif
  </div>
</section>
@include('fragments.footer')
</body>
@vite(['resources/js/components/add-to-cart.js'])
<script src="https://cdn.jsdelivr.net/npm/toastify-js@1.12.0/src/toastify.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const forms = document.querySelectorAll('.catalog__form');

    forms.forEach(form => {
      const valueInput = form.querySelector('.catalog__value');
      const plusBtn = form.querySelector('.catalog__action.plus');
      const minusBtn = form.querySelector('.catalog__action.minus');

      let counterValue = 1;
      valueInput.value = counterValue;

      plusBtn.addEventListener('click', () => {
        counterValue++;
        valueInput.value = counterValue;
      });

      minusBtn.addEventListener('click', () => {
        if (counterValue > 1) {
          counterValue--;
          valueInput.value = counterValue;
        }
      });

      form.addEventListener('submit', (event) => {
        if (valueInput.value.trim() === '' || valueInput.value.trim() < 1) {
          event.preventDefault();
          Toastify({
            text: 'Минимальное количество товара в корзину - 1',
            duration: 3000,
            gravity: 'top',
            position: 'right',
          }).showToast();
        }
      });
    });
  });
</script>