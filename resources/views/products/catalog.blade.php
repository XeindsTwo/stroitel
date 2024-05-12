@include('fragments.head', ['title' => 'Каталог магазина'])
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
<section class="catalog">
  <div class="container">
    <h2 class="title">Каталог товаров компании</h2>
    <ul class="catalog__list">
      @foreach($categories as $category)
        <li>
          <a class="catalog__item" href="{{ $category->subcategories->isNotEmpty() ? route('category.subcategories', ['categoryId' => $category->id]) : route('category.products', ['categoryId' => $category->id]) }}">
            <p class="catalog__title">{{ $category->name }}</p>
            <img
                class="catalog__img"
                src="{{ asset('storage/category_images/' . $category->image) }}"
                alt="{{ $category->name }}" width="280" height="162"
            >
          </a>
        </li>
      @endforeach
    </ul>
  </div>
</section>
@include('fragments.footer')
</body>