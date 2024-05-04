@include('fragments.head', ['title' => $category->name])
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
      <div class="breadcrumbs__item">
        <span class="breadcrumbs__link breadcrumbs__link--inactive">{{$category->name}}</span>
      </div>
    </div>
  </div>
</div>
<section class="catalog">
  <div class="container">
    <h2 class="title">{{$category->name}}</h2>
    <ul class="catalog__list">
      @foreach($subcategories as $subcategory)
        <li>
          <a class="catalog__item"
             href="{{ route('category.subcategory.products', ['categoryId' => $subcategory->category_id, 'subcategoryId' => $subcategory->id]) }}">
            <p class="catalog__title">{{ $subcategory->name }}</p>
            <img
                class="catalog__img"
                src="{{ asset('storage/subcategory_images/' . $subcategory->image) }}"
                alt="{{ $subcategory->name }}"
            >
          </a>
        </li>
      @endforeach
    </ul>
  </div>
</section>
@include('fragments.footer')
</body>