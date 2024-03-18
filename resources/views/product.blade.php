@include('fragments/head', ['title' => $product->name])
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
        <a class="breadcrumbs__link" href="{{route('index')}}">Каталог компании</a>
      </div>
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
      <span>Товар в наличии</span>
      |
      <span>Артикул : {{$product->article}}</span>
    </div>
  </div>
</div>
<div class="product__info">
  <div class="container">
    <div class="product__inner">
      <div class="product__image">
        <img class="product__img" width="290" height="290" src="{{asset('storage/products/' . $product->image_path)}}"
             alt="">
      </div>
      <div class="product__content">
        <span class="product__price">
          Цена - {{ number_format($product->price, 0, '.', ' ') }} &#8381;
        </span>
        <p class="product__description">
          <span>Описание</span>
          {{$product->description}}
        </p>
        <button class="product__like" type="button" id="favorite_btn">
          <svg width="29" height="25" viewBox="0 0 29 25" fill="none"
               xmlns="http://www.w3.org/2000/svg">
            <path
                d="M3.19997 14.0455L13.2246 23.4589C13.5706 23.7832 13.7436 23.9461 13.9454 23.9865C14.0373 24.0045 14.1318 24.0045 14.2237 23.9865C14.4284 23.9461 14.6 23.7847 14.9446 23.4589L24.9692 14.0469C26.3308 12.7689 27.1665 11.029 27.3128 9.16758C27.4592 7.30617 26.9058 5.4571 25.7607 3.98203L25.3137 3.40693C22.4764 -0.248319 16.7814 0.364253 14.7874 4.54127C14.724 4.67364 14.6244 4.78538 14.5002 4.8636C14.3759 4.94182 14.2321 4.98332 14.0853 4.98332C13.9385 4.98332 13.7946 4.94182 13.6704 4.8636C13.5462 4.78538 13.4466 4.67364 13.3832 4.54127C11.3892 0.364253 5.69423 -0.249761 2.85683 3.40693L2.40989 3.98347C1.26564 5.45834 0.712665 7.30678 0.85904 9.16752C1.00542 11.0283 1.84062 12.7676 3.20142 14.0455H3.19997Z"
                stroke="#079aff" fill="#fff" stroke-width="1.4"/>
          </svg>
          Добавить в избранное
        </button>
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