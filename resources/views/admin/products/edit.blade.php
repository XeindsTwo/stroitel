@include('fragments/head', ['title' => 'Редактирование товара'])
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
        <span>Редактирование товара</span>
      </div>
    </div>
  </div>
  <div class="create-product">
    <form action="{{route('admin.products.update', ['id' => $product->id])}}" method="POST"
          enctype="multipart/form-data">
      @csrf
      <ul class="create-product__list">
        <li class="create-product__checkbox">
          <label for="availability">Товар в наличии:</label>
          <input
              class="checkbox" type="checkbox"
              id="availability" name="availability" value="1"
              @if($product->availability) checked @endif
          >
        </li>
        <li class="create-product__item">
          <div>
            <label class="label" for="category_id">Категория:</label>
            <select class="input" name="category_id" id="category_id" required>
              <option value="">Выберите категорию</option>
              @foreach($categories as $category)
                <option value="{{ $category->id }}"
                        @if($product->category_id == $category->id) selected @endif
                        data-has-subcategories="{{ $category->subcategories->isNotEmpty() ? 'true' : 'false' }}">{{ $category->name }}</option>
              @endforeach
            </select>
          </div>
          <div id="subcategory_container" @if(!$product->subcategory_id) style="display: none;" @endif>
            <label class="label" for="subcategory_id">Подкатегория:</label>
            <select class="input" name="subcategory_id" id="subcategory_id">
              <option value="">Выберите подкатегорию</option>
              @if($product->subcategory_id)
                @foreach($product->category->subcategories as $subcategory)
                  <option value="{{ $subcategory->id }}"
                          @if($product->subcategory_id == $subcategory->id) selected @endif
                          data-category-id="{{ $subcategory->category_id }}">{{ $subcategory->name }}</option>
                @endforeach
              @endif
            </select>
          </div>
        </li>
        <li>
          <div>
            <label class="label" for="name">Название:</label>
            <input
                class="input" type="text"
                name="name" id="name" required
                placeholder="Введите название" value="{{$product->name}}"
            >
          </div>
        </li>
        <li class="create-product__item">
          <div>
            <label class="label" for="price">Цена (за шт):</label>
            <input
                class="input" type="number"
                name="price" id="price" min="50" max="300000"
                required placeholder="Введите цену" value="{{$product->price}}"
            >
          </div>
          <div>
            <label class="label" for="new_price">Новая цена (необязательно):</label>
            <input
                class="input" type="number"
                name="new_price" id="new_price" min="50" max="300000"
                placeholder="Введите цену (скидка)" value="{{ $product->new_price }}"
            >
          </div>
        </li>
        <li>
          <label class="label" for="description">Описание:</label>
          <textarea class="input input--textarea-high"
                    name="description" id="description" maxlength="2300"
                    placeholder="Напишите что-то" required>{{ $product->description }}</textarea>
        </li>
        <li>
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
        </li>
      </ul>
      <button class="create-product__add" id="add-property" type="button">Добавить свойство</button>
      <div class="create-product__properties" id="properties-container">
        @foreach ($productComposition as $index => $composition)
          <div class="create-product__item">
            <div>
              <label class="label" for="property_name_{{ $loop->index }}">Название характеристики:</label>
              <input class="input" type="text" name="properties[{{ $loop->index }}][name]" id="property_name_{{ $loop->index }}" required
                     placeholder="Введите название" value="{{ $composition->property_name }}">
            </div>
            <div>
              <label class="label" for="property_value_{{ $loop->index }}">Значение характеристики:</label>
              <input class="input" type="text" name="properties[{{ $loop->index }}][value]" id="property_value_{{ $loop->index }}" required
                     placeholder="Введите характеристику" value="{{ $composition->property_value }}">
            </div>
            @if ($index > 0)
              <button class="create-product__remove" type="button">Удалить свойство</button>
            @endif
          </div>
        @endforeach
      </div>
      <button class="btn btn-primary" type="submit">Сохранить изменения</button>
    </form>
  </div>
</div>
</body>

<script>
  async function loadAndSetImagePreview(imageUrl) {
    try {
      const response = await fetch(imageUrl);
      const blob = await response.blob();
      const file = new File([blob], 'product_image');
      const dataTransfer = new DataTransfer();
      dataTransfer.items.add(file);
      const imageInput = document.getElementById('image');
      imageInput.files = dataTransfer.files;

      const reader = new FileReader();
      reader.onload = function (event) {
        const previewImage = document.getElementById('image-preview__img');
        previewImage.setAttribute('src', event.target.result);
        document.getElementById('image-preview__text').style.display = 'none';
        previewImage.style.display = 'block';
      };
      reader.readAsDataURL(file);
    } catch (error) {
      console.error('Error loading image:', error);
      document.getElementById('image').value = '';
    }
  }

  async function submitForm(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);

    const imageSrc = document.getElementById('image-preview__img').getAttribute('src');
    if (!imageSrc) {
      const photoError = document.getElementById('photoError');
      photoError.classList.add('error--active');
      setTimeout(() => {
        photoError.classList.remove('error--active');
      }, 2000);
      return;
    }

    try {
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
        console.log('Продукт успешно обновлен');
        //window.location.href = "{{ route('admin.products.index') }}";
      }
    } catch (error) {
      console.error('Произошла ошибка:', error);
    }
  }

  document.addEventListener('DOMContentLoaded', function () {
    let imageSrc = "{{ $product->image_path ? asset('storage/products/' . $product->image_path) : '' }}";
    if (imageSrc) {
      loadAndSetImagePreview(imageSrc);
    }

    const form = document.querySelector('form');
    form.addEventListener('submit', submitForm);

    const customFileInputs = document.querySelectorAll('.input-file');
    customFileInputs.forEach(function (input) {
      const previewId = input.dataset.preview;
      const previewContainer = document.getElementById(previewId);
      const previewImage = previewContainer.querySelector('img');
      const previewText = previewContainer.querySelector('p');
      const maxSizeError = document.getElementById('max-size-error');
      const formatError = document.getElementById('format-error');

      if (previewImage.src !== '#') {
        previewText.style.display = 'none';
        previewImage.style.display = 'block';
      }

      function hideError(element) {
        setTimeout(function () {
          element.style.display = 'none';
        }, 2000);
      }

      input.addEventListener('change', function () {
        const file = this.files[0];

        if (!file) {
          return;
        }

        const allowedFormats = ['image/webp', 'image/png', 'image/jpg', 'image/jpeg'];
        if (!allowedFormats.includes(file.type)) {
          formatError.style.display = 'block';
          hideError(formatError);
          resetPreview();
          console.log(imageSrc)
          return;
        } else {
          formatError.style.display = 'none';
        }

        if (file.size > 2 * 1024 * 1024) {
          maxSizeError.style.display = 'block';
          hideError(maxSizeError);
          resetPreview();
          console.log(imageSrc)
          return;
        } else {
          maxSizeError.style.display = 'none';
        }

        if (file) {
          const reader = new FileReader();

          reader.addEventListener('load', function () {
            previewText.style.display = 'none';
            previewImage.style.display = 'block';
            previewImage.setAttribute('src', reader.result);
          });

          reader.readAsDataURL(file);
        }
      });

      previewContainer.addEventListener('click', function () {
        input.click();
      });

      function resetPreview() {
        const previewText = document.getElementById('image-preview__text');
        const previewImage = document.getElementById('image-preview__img');

        previewText.style.display = 'block';
        previewImage.style.display = 'none';
        previewImage.removeAttribute('src');

        const imageInput = document.getElementById('image');
        imageInput.value = '';
        imageSrc = '';
      }
    });
  });
</script>

<script>
  const categorySelect = document.getElementById('category_id');
  const subcategoryContainer = document.getElementById('subcategory_container');
  const subcategorySelect = document.getElementById('subcategory_id');
  const categories = {!! json_encode($categories) !!};
  const productCategoryId = {{ $product->category_id }};
  const productSubcategoryId = {{ $product->subcategory_id ?: 'null' }};

  categorySelect.addEventListener('change', function () {
    const categoryId = this.value;
    if (!categoryId) {
      subcategoryContainer.style.display = 'none';
      subcategorySelect.value = '';
      subcategorySelect.innerHTML = '<option value="">Выберите подкатегорию</option>';
      subcategorySelect.removeAttribute('required');
      return;
    }

    const selectedCategory = categories.find(category => category.id === parseInt(categoryId));
    const hasSubcategories = selectedCategory.subcategories.length > 0;

    subcategorySelect.innerHTML = '<option value="">Выберите подкатегорию</option>';
    if (hasSubcategories) {
      selectedCategory.subcategories.forEach(subcategory => {
        const option = document.createElement('option');
        option.value = subcategory.id;
        option.textContent = subcategory.name;
        subcategorySelect.appendChild(option);
      });
      subcategoryContainer.style.display = 'block';
      subcategorySelect.setAttribute('required', 'required');
    } else {
      subcategoryContainer.style.display = 'none';
      subcategorySelect.value = '';
      subcategorySelect.removeAttribute('required');
    }
  });

  if (productCategoryId) {
    categorySelect.value = productCategoryId;
    categorySelect.dispatchEvent(new Event('change'));
  }

  if (productSubcategoryId) {
    subcategorySelect.value = productSubcategoryId;
  }
</script>
@vite(['resources/js/product/update-properties.js'])