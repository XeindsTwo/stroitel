@include('fragments/head', ['title' => 'Каталог магазина'])
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
        <span class="breadcrumbs__link breadcrumbs__link--inactive">Каталог компании</span>
      </div>
    </div>
  </div>
</div>
<section class="product__characteristics">
  <div class="container">
    <ul class="admin-products__list">
      @foreach($products as $product)
        <li class="admin-products__item">
          <a class="admin-products__image" href="{{ route('show_product', ['id' => $product->id]) }}">
            <img src="{{ asset('storage/products/' . $product->image_path) }}" alt="{{ $product->name }}">
          </a>
          <div class="admin-products__info">
            <p class="admin-products__article">Артикул: {{ $product->article }}</p>
            <p class="admin-products__name">{{ $product->name }}</p>
            <div class="admin-products__price">
              Цена за шт:
              <span>{{ number_format($product->price, 0, '.', ' ') }} &#8381;</span>
            </div>
          </div>
        </li>
      @endforeach
    </ul>
  </div>
</section>
@include('fragments.footer')
</body>