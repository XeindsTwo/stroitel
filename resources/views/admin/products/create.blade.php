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
            <label class="label" for="name">Категория:</label>
            <select class="input" name="category_id" id="category_id" required>
              <option value="">Выберите категорию</option>
              @foreach($categories as $category)
                <option value="{{ $category->id }}"
                        data-has-subcategories="{{ $category->subcategories->isNotEmpty() ? 'true' : 'false' }}">{{ $category->name }}</option>
              @endforeach
            </select>
          </div>
          <div id="subcategory_container" style="display: none;">
            <label class="label" for="name">Подкатегория:</label>
            <select class="input" name="subcategory_id" id="subcategory_id">
              <option value="">Выберите подкатегорию</option>
              @foreach($categories as $category)
                @foreach($category->subcategories as $subcategory)
                  <option value="{{ $subcategory->id }}"
                          data-category-id="{{ $subcategory->category_id }}">{{ $subcategory->name }}</option>
                @endforeach
              @endforeach
            </select>
          </div>
        </li>
        <li class="create-product__item">
          <div>
            <label class="label" for="name">Название:</label>
            <input class="input" type="text" name="name" id="name" required placeholder="Введите название">
          </div>
          <div>
            <label class="label" for="price">Цена (за шт):</label>
            <input class="input" type="number" name="price" id="price" min="50" max="300000" required
                   placeholder="Введите цену">
          </div>
        </li>
        <div>
          <label class="label" for="description">Описание:</label>
          <textarea class="input input--textarea-high" name="description" id="description" placeholder="Напишите что-то"
                    maxlength="2300" required></textarea>
        </div>
        <div>
          <label class="label" for="image">Изображение:</label>
          <span class="error" id="photoError">Товар должен содержать изображение</span>
          <span class="error" id="max-size-error">Макс. вес изображения - 2мб</span>
          <span class="error" id="format-error">Разрешен только формат webp, png, jpg, jpeg</span>
          <div class="image-preview" id="image-preview">
            <img class="image-preview__img" id="image-preview__img" style="display: none;" src="#"
                 alt="изображение продукта">
            <p id="image-preview__text">Загрузите изображение</p>
          </div>
          <input type="file" name="image" id="image" class="input-file"
                 data-preview="image-preview" style="display: none;" accept=".png, .jpg, .jpeg, .webp">
        </div>
      </ul>
      <button class="create-product__add" id="add-property" type="button">Добавить свойство</button>
      <div class="create-product__properties" id="properties-container">
        <div class="create-product__item">
          <div>
            <label class="label" for="property_name_1">Название характеристики:</label>
            <input class="input" type="text" name="properties[0][name]" id="property_name_1" required
                   placeholder="Введите название">
          </div>
          <div>
            <label class="label" for="property_value_1">Значение характеристики:</label>
            <input class="input" type="text" name="properties[0][value]" id="property_value_1" required
                   placeholder="Введите характеристику">
          </div>
        </div>
      </div>
      <button class="btn btn-primary" type="submit">Добавить товар в БД</button>
    </form>
  </div>
</div>
</body>
<script>
  const form = document.querySelector('form');
  form.addEventListener('submit', async function (event) {
    event.preventDefault();

    const imageInput = document.getElementById('image');
    if (!imageInput.files.length) {
      const photoError = document.getElementById('photoError');
      photoError.classList.add('error--active');
      setTimeout(() => {
        photoError.classList.remove('error--active');
      }, 2000);

      return;
    }

    try {
      const formData = new FormData(form);
      const response = await fetch(form.action, {
        method: form.method,
        body: formData
      });

      if (!response.ok) {
        const responseData = await response.json();
        if (responseData.errors) {
          Object.values(responseData.errors).forEach(errors => {
            errors.forEach(error => {
              console.error(error);
            });
          });
        } else {
          console.error('Произошла ошибка при отправке запроса');
        }
      } else {
        console.log('Продукт успешно создан');
        window.location.href = "{{ route('admin.products.index') }}";
      }
    } catch (error) {
      console.error('Произошла ошибка:', error);
    }
  });
</script>
<script>
  const categorySelect = document.getElementById('category_id');
  const subcategoryContainer = document.getElementById('subcategory_container');
  const subcategorySelect = document.getElementById('subcategory_id');
  const categories = {!! json_encode($categories) !!};

  categorySelect.addEventListener('change', function () {
    const categoryId = this.value;
    if (!categoryId) {
      subcategoryContainer.style.display = 'none';
      subcategorySelect.value = '';
      subcategorySelect.innerHTML = '<option value="">Выберите подкатегорию</option>';
      subcategorySelect.removeAttribute('required');
      return;
    }

    subcategoryContainer.style.display = 'block';
    const selectedCategory = this.options[this.selectedIndex];
    const hasSubcategories = selectedCategory.getAttribute('data-has-subcategories') === 'true';

    subcategorySelect.innerHTML = '<option value="">Выберите подкатегорию</option>';
    categories.forEach(category => {
      if (category.id === parseInt(categoryId)) {
        category.subcategories.forEach(subcategory => {
          const option = document.createElement('option');
          option.value = subcategory.id;
          option.textContent = subcategory.name;
          subcategorySelect.appendChild(option);
        });
      }
    });

    if (hasSubcategories) {
      subcategoryContainer.style.display = 'block';
      subcategorySelect.setAttribute('required', 'required');
    } else {
      subcategoryContainer.style.display = 'none';
      subcategorySelect.value = '';
      subcategorySelect.removeAttribute('required');
    }
  });
</script>
@vite(['resources/js/components/custom-file.js'])
@vite(['resources/js/product/properties.js'])