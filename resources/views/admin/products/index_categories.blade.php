@include('fragments/head', ['title' => 'Управление товарами магазина'])
<body class="body">
@include('fragments.header-admin')
<div class="container">
  <div class="breadcrumbs">
    <div class="breadcrumbs__top">
      <div class="breadcrumbs__item">
        <a class="breadcrumbs__link" href="{{route('admin.partnership-requests')}}">Главная админ-панели</a>
      </div>
      <div class="breadcrumbs__item">
        <a class="breadcrumbs__link" href="{{route('admin.products.index')}}">Управление товарами магазина</a>
      </div>
      <div class="breadcrumbs__item">
        <span>{{$category->name}}</span>
      </div>
    </div>
  </div>
  <a class="admin-products__create btn" href="{{route('admin.products.create')}}">Создать новый товар</a>
  <ul class="admin-products__list">
    @foreach ($subcategories as $subcategory)
      <li>
        <a class="category"
           href="{{ route('admin.products.index_subcategory_products', ['category_id' => $category->id, 'subcategory_id' => $subcategory->id]) }}">
          <p class="category__title">
            {{$subcategory->name}}
          </p>
          <img
              class="category__img"
              src="{{asset('storage/subcategory_images/' . $subcategory->image)}}"
              alt="{{$subcategory->name}}"
              width="260"
              height="150"
          >
        </a>
      </li>
    @endforeach
  </ul>
</div>
</body>