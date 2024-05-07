@include('fragments.head', ['title' => $product->name])
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
        <a class="breadcrumbs__link" href="{{route('catalog')}}">Каталог компании</a>
      </div>
      @if($subcategory)
        <div class="breadcrumbs__item">
          <a class="breadcrumbs__link"
             href="{{ route('category.subcategories', ['categoryId' => $subcategory->category->id]) }}">
            {{ $subcategory->category->name }}
          </a>
        </div>
      @elseif($category)
        <div class="breadcrumbs__item">
          <a class="breadcrumbs__link" href="{{ route('category.products', ['categoryId' => $category->id]) }}">
            {{ $category->name }}
          </a>
        </div>
      @endif
      @if($subcategoryName)
        <div class="breadcrumbs__item">
          <a class="breadcrumbs__link"
             href="{{ route('category.subcategory.products', ['categoryId' => $category->id, 'subcategoryId' => $subcategory->id]) }}">
            {{ $subcategoryName }}
          </a>
        </div>
      @endif
      <div class="breadcrumbs__item">
        <span>{{$product->name}}</span>
      </div>
    </div>
  </div>
</div>
<div class="product">
  <div class="container">
    <h1 class="product__title">
      {{$product->name}}
    </h1>
    <div class="product__top">
      @if($product->availability)
        <p class="product__available">
        <span class="product__checkbox">
          <svg xmlns="http://www.w3.org/2000/svg" width="11" height="8" viewBox="0 0 11 8" fill="none">
            <path d="M9.5 1L4 6.5L1.5 4" stroke="white" stroke-width="1.6666" stroke-linecap="round"
                  stroke-linejoin="round"/>
          </svg>
        </span>
          <span class="product__available-text">В наличии</span>
        </p>
      @else
        <p class="product__available non">
        <span class="product__checkbox non">
          <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
            <g clip-path="url(#clip0_4_2)">
              <path d="M0 22L22 0" stroke="black" stroke-width="2"/>
              <path d="M0 0L22 22" stroke="black" stroke-width="2"/>
            </g>
            <defs>
              <clipPath id="clip0_4_2">
                <rect width="22" height="22" fill="white"/>
              </clipPath>
            </defs>
          </svg>
        </span>
          <span class="product__available-text">Нет в наличии</span>
        </p>
      @endif
      |
      <span>Артикул : {{$product->article}}</span>
    </div>
  </div>
</div>
<div class="product__info">
  <div class="container">
    <div class="product__inner">
      <div class="product__image">
        <button class="product__like like" data-product-id="{{ $product->id }}" type="button" id="favorite_btn">
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
        <img class="product__img" width="360" height="360" src="{{asset('storage/products/' . $product->image_path)}}"
             alt="">
      </div>
      <div class="product__content">
        <div class="product__description">
          <span>Описание</span>
          <pre>{{$product->description}}</pre>
        </div>
        <div class="product__right">
          @if(isset($product->new_price))
            <div class="product__discount">Акционный товар</div>
          @endif
          <div class="product__panel{{ isset($product->new_price) ? ' discount' : '' }}">
            <div class="product__price">
              <p class="product__price-name">Цена за шт</p>
              @if(isset($product->new_price))
                <span class="product__price-discount">{{ number_format($product->price, 0, '.', ' ') }} &#8381;</span>
                <span class="product__price-new">{{ number_format($product->new_price, 0, '.', ' ') }} &#8381;</span>
              @else
                <span class="product__price-new one">{{ number_format($product->price, 0, '.', ' ') }} &#8381;</span>
              @endif
            </div>
            <form class="product__form form {{$product->availability ? '' : 'not-available'}}">
              <input type="hidden" name="product_id" value="{{$product->id}}">
              <div class="product__input">
                <input class="product__value quantity" type="number" name="quantity" id="quantity">
                <div class="product__actions">
                  <button class="product__action plus" type="button">
                    <svg viewBox="0 0 9 8" xmlns="http://www.w3.org/2000/svg">
                      <rect x="4" width="2" height="8" rx="1"></rect>
                      <rect x="1" y="5.00488" width="2" height="8" rx="1" transform="rotate(-90.0355 1 5.00488)"></rect>
                    </svg>
                  </button>
                  <button class="product__action minus" type="button">
                    <svg viewBox="0 0 9 3" xmlns="http://www.w3.org/2000/svg">
                      <rect x="1" y="2.00488" width="2" height="8" rx="1" transform="rotate(-90.0355 1 2.00488)"></rect>
                    </svg>
                  </button>
                </div>
              </div>
              <button class="product__card btn" type="submit">В корзину</button>
            </form>
          </div>
          <ul class="product__benefits">
            <li>
              <p>Доставка: <br>доставим сегодня</p>
              <span class="product__icon">
              <svg viewBox="0 0 35 35" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M9.47786 27.7083H6.5612C6.1587 27.7083 5.83203 27.3817 5.83203 26.9792C5.83203 26.5767 6.1587 26.25 6.5612 26.25H9.47786C9.88036 26.25 10.207 26.5767 10.207 26.9792C10.207 27.3817 9.88036 27.7083 9.47786 27.7083Z"></path>
                <path
                    d="M33.1779 27.7082H31.355C30.9525 27.7082 30.6258 27.3815 30.6258 26.979C30.6258 26.5765 30.9525 26.2499 31.355 26.2499H32.5727L33.5556 21.0115C33.5425 18.3311 31.2529 16.0415 28.4383 16.0415H23.6506L21.3304 26.2499H25.5216C25.9241 26.2499 26.2508 26.5765 26.2508 26.979C26.2508 27.3815 25.9241 27.7082 25.5216 27.7082H20.4175C20.1958 27.7082 19.9858 27.6076 19.8473 27.434C19.7087 27.2619 19.6562 27.0344 19.7058 26.8186L22.357 15.1519C22.4329 14.818 22.7275 14.5832 23.0687 14.5832H28.4383C32.0564 14.5832 35.0008 17.5276 35.0008 21.1457L33.8939 27.1132C33.8298 27.4588 33.5293 27.7082 33.1779 27.7082Z"></path>
                <path
                    d="M28.4388 30.6248C26.4292 30.6248 24.793 28.9901 24.793 26.979C24.793 24.968 26.4292 23.3332 28.4388 23.3332C30.4484 23.3332 32.0846 24.968 32.0846 26.979C32.0846 28.9901 30.4484 30.6248 28.4388 30.6248ZM28.4388 24.7915C27.2328 24.7915 26.2513 25.773 26.2513 26.979C26.2513 28.1851 27.2328 29.1665 28.4388 29.1665C29.6448 29.1665 30.6263 28.1851 30.6263 26.979C30.6263 25.773 29.6448 24.7915 28.4388 24.7915Z"></path>
                <path
                    d="M12.3958 30.6248C10.3863 30.6248 8.75 28.9901 8.75 26.979C8.75 24.968 10.3863 23.3332 12.3958 23.3332C14.4054 23.3332 16.0417 24.968 16.0417 26.979C16.0417 28.9901 14.4054 30.6248 12.3958 30.6248ZM12.3958 24.7915C11.1898 24.7915 10.2083 25.773 10.2083 26.979C10.2083 28.1851 11.1898 29.1665 12.3958 29.1665C13.6019 29.1665 14.5833 28.1851 14.5833 26.979C14.5833 25.773 13.6019 24.7915 12.3958 24.7915Z"></path>
                <path
                    d="M9.48047 14.5833H3.64714C3.24464 14.5833 2.91797 14.2567 2.91797 13.8542C2.91797 13.4517 3.24464 13.125 3.64714 13.125H9.48047C9.88297 13.125 10.2096 13.4517 10.2096 13.8542C10.2096 14.2567 9.88297 14.5833 9.48047 14.5833Z"></path>
                <path
                    d="M9.47787 18.9583H2.1862C1.7837 18.9583 1.45703 18.6317 1.45703 18.2292C1.45703 17.8267 1.7837 17.5 2.1862 17.5H9.47787C9.88036 17.5 10.207 17.8267 10.207 18.2292C10.207 18.6317 9.88036 18.9583 9.47787 18.9583Z"></path>
                <path
                    d="M9.47917 23.3333H0.729167C0.326667 23.3333 0 23.0067 0 22.6042C0 22.2017 0.326667 21.875 0.729167 21.875H9.47917C9.88167 21.875 10.2083 22.2017 10.2083 22.6042C10.2083 23.0067 9.88167 23.3333 9.47917 23.3333Z"></path>
                <path
                    d="M20.4154 27.7082H15.3112C14.9087 27.7082 14.582 27.3815 14.582 26.979C14.582 26.5765 14.9087 26.2499 15.3112 26.2499H19.8335L23.1468 11.6665H6.5612C6.1587 11.6665 5.83203 11.3399 5.83203 10.9374C5.83203 10.5349 6.1587 10.2082 6.5612 10.2082H24.0612C24.2829 10.2082 24.4929 10.3088 24.6314 10.4824C24.7699 10.6544 24.8224 10.8819 24.7729 11.0978L21.127 27.1394C21.0512 27.4734 20.7552 27.7082 20.4154 27.7082Z"></path>
              </svg>
            </span>
            </li>
            <li>
              <p>Самовывоз со склада: <br>сегодня до 18:00</p>
              <span class="product__icon">
              <svg viewBox="0 0 35 35" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M34.6456 10.4371L22.8878 3.98086C22.683 3.86844 22.4347 3.86844 22.2299 3.98086L17.8084 6.40869C17.7085 6.43646 17.6153 6.48746 17.5363 6.55795L10.472 10.4371C10.2533 10.5572 10.1174 10.7869 10.1174 11.0363V12.4339H2.23047C1.85289 12.4339 1.54688 12.7402 1.54688 13.1175C1.54688 13.4951 1.85289 13.8011 2.23047 13.8011H10.1174V16.262H6.19825C5.82067 16.262 5.51466 16.5683 5.51466 16.9456C5.51466 17.3232 5.82067 17.6292 6.19825 17.6292H10.1174V21.1839H4.37524C3.99767 21.1839 3.69165 21.4902 3.69165 21.8675C3.69165 22.2451 3.99767 22.5511 4.37524 22.5511H10.1174V23.949C10.1174 24.1984 10.2533 24.4281 10.472 24.5482L22.2299 31.0044C22.3324 31.0608 22.4456 31.0888 22.5588 31.0888C22.6721 31.0888 22.7853 31.0608 22.8878 31.0044L34.6456 24.5482C34.8643 24.4281 35.0002 24.1984 35.0002 23.949V20.8878C35.0002 20.5105 34.6942 20.2042 34.3167 20.2042C33.9391 20.2042 33.6331 20.5105 33.6331 20.8878V23.5445L23.2424 29.2501V17.8971L26.5469 16.0826V18.9622C26.5469 19.2042 26.6746 19.4279 26.8826 19.5508C26.9896 19.6141 27.1101 19.6458 27.2305 19.6458C27.3437 19.6458 27.4572 19.6178 27.56 19.5612L30.0797 18.1745C30.2979 18.0543 30.4335 17.825 30.4335 17.5756V13.9485L33.6331 12.1917V15.419C33.6331 15.7966 33.9391 16.1026 34.3167 16.1026C34.6942 16.1026 35.0002 15.7966 35.0002 15.419V11.0363C35.0002 10.7869 34.8643 10.5572 34.6456 10.4371ZM21.8752 29.2501L11.4846 23.5445V12.1917L21.8752 17.8971V29.2501ZM22.5588 16.7128L12.2214 11.0363L15.4703 9.25228L25.808 14.9288L22.5588 16.7128ZM27.2284 14.1488L16.8906 8.47228L18.0113 7.85705L28.3488 13.5335L27.2284 14.1488ZM29.0663 17.1715L27.9141 17.8057V15.332L29.0663 14.6991V17.1715ZM29.7691 12.7536L19.4317 7.07706L22.5588 5.36006L32.8963 11.0363L29.7691 12.7536Z"></path>
                <path
                    d="M34.3164 17.4701C34.1367 17.4701 33.9602 17.5425 33.8331 17.6704C33.706 17.7975 33.6328 17.9732 33.6328 18.1537C33.6328 18.3334 33.706 18.5099 33.8331 18.637C33.9602 18.7641 34.1367 18.8373 34.3164 18.8373C34.4961 18.8373 34.6726 18.7641 34.7997 18.637C34.9268 18.5099 35 18.3334 35 18.1537C35 17.9732 34.9268 17.7975 34.7997 17.6704C34.6726 17.5425 34.4961 17.4701 34.3164 17.4701Z"></path>
                <path
                    d="M1.66332 21.184H0.683594C0.306015 21.184 0 21.4902 0 21.8676C0 22.2451 0.306015 22.5511 0.683594 22.5511H1.66332C2.0409 22.5511 2.34692 22.2451 2.34692 21.8676C2.34692 21.4902 2.0409 21.184 1.66332 21.184Z"></path>
                <path
                    d="M4.14844 16.9457C4.14844 16.766 4.07527 16.5897 3.9479 16.4626C3.82079 16.3353 3.64455 16.2621 3.46484 16.2621C3.28487 16.2621 3.10863 16.3353 2.98152 16.4626C2.85361 16.5897 2.78125 16.766 2.78125 16.9457C2.78125 17.1257 2.85361 17.3019 2.98152 17.429C3.10863 17.5561 3.28487 17.6293 3.46484 17.6293C3.64455 17.6293 3.82079 17.5564 3.9479 17.429C4.07527 17.3019 4.14844 17.1257 4.14844 16.9457Z"></path>
              </svg>
            </span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<section class="product__characteristics">
  <div class="container">
    <h2 class="product__title">Характеристики</h2>
    <ul class="product__list">
      @foreach($product->compositions as $composition)
        <li class="product__item">
          <p class="product__parameter">{{ $composition->property_name }}</p>
          <p class="product__meaning">{{ $composition->property_value }}</p>
        </li>
      @endforeach
    </ul>
  </div>
</section>
@include('fragments.footer')
</body>
<script src="https://cdn.jsdelivr.net/npm/toastify-js@1.12.0/src/toastify.min.js"></script>
@vite(['resources/js/components/add-to-cart.js'])