@include('fragments/head', ['title' => 'Создание товара'])
<body class="body">
@include('fragments.header-admin')
<div class="container">
  <div class="breadcrumbs">
    <div class="breadcrumbs__top">
      <div class="breadcrumbs__item">
        <a class="breadcrumbs__link" href="{{ route('admin.partnership-requests') }}">Главная админ-панели</a>
      </div>
      <div class="breadcrumbs__item">
        <a class="breadcrumbs__link" href="{{ route('admin.products.index') }}">
          Управление товарами магазина
        </a>
      </div>
      <div class="breadcrumbs__item">
        <span>Создание товара</span>
      </div>
    </div>
  </div>
  <div class="create-product">
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <ul class="create-product__list">
        <li class="create-product__item">
          <div>
            <label class="label" for="name">Название:</label>
            <input class="input" type="text" name="name" id="name" required placeholder="Введите название">
          </div>
          <div>
            <label class="label" for="price">Цена (за шт):</label>
            <input class="input" type="number" name="price" id="price" min="50" max="300000" required placeholder="Введите цену">
          </div>
        </li>
        <div>
          <label class="label" for="description">Описание:</label>
          <textarea class="input input--textarea-high" name="description" id="description" placeholder="Напишите что-то" maxlength="1500" required></textarea>
        </div>
        <div>
          <label class="label" for="image">Изображение:</label>
          <span class="error" id="max-size-error">Макс. вес изображения - 2мб</span>
          <span class="error" id="format-error">Разрешен только формат webp, png, jpg, jpeg</span>
          <div class="image-preview" id="image-preview">
            <img class="image-preview__img" id="image-preview__img" style="display: none;" src="#" alt="изображение продукта">
            <p id="image-preview__text">Загрузите изображение</p>
          </div>
          <input type="file" name="image" id="image" class="input-file" required
                 data-preview="image-preview" style="display: none;">
        </div>
      </ul>
      <button class="create-product__add" id="add-property" type="button">Добавить свойство</button>
      <div class="create-product__properties" id="properties-container">
        <div class="create-product__item">
          <div>
            <label class="label" for="property_name_1">Название характеристики:</label>
            <input class="input" type="text" name="properties[0][name]" id="property_name_1" required placeholder="Введите название">
          </div>
          <div>
            <label class="label" for="property_value_1">Значение характеристики:</label>
            <input class="input" type="text" name="properties[0][value]" id="property_value_1" required placeholder="Введите характеристику">
          </div>
        </div>
      </div>
      <button class="btn btn-primary" type="submit">Добавить товар в БД</button>
    </form>
  </div>
</div>
</body>
@vite(['resources/js/components/custom-file.js'])
@vite(['resources/js/product/properties.js'])