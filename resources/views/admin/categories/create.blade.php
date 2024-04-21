@include('fragments/head', ['title' => 'Создание категории'])
<body class="body">
@include('fragments.header-admin')
<div class="container">
  <div class="breadcrumbs">
    <div class="breadcrumbs__top">
      <div class="breadcrumbs__item">
        <a class="breadcrumbs__link" href="{{ route('admin.partnership-requests') }}">Главная админ-панели</a>
      </div>
      <div class="breadcrumbs__item">
        <a class="breadcrumbs__link" href="{{ route('admin.categories.index') }}">Управление категориями товаров</a>
      </div>
      <div class="breadcrumbs__item">
        <span>Создание категории</span>
      </div>
    </div>
  </div>
  <form class="create-category__form" id="categoryForm" enctype="multipart/form-data">
    <div class="create-category__item short">
      <div>
        <label class="label" for="name">Имя категории</label>
        <span class="error" id="errorNameCategory">Имя категории должно быть уникальным</span>
        <input class="input" type="text" name="name" id="name" value="{{ old('name') }}"
               placeholder="Введите название" required maxlength="255">
      </div>
      <div>
        <label class="label" for="image">Изображение категории</label>
        <input type="file" name="image" id="image" class="create-category__file"
               accept="image/png, image/jpeg, image/webp">
        <span class="error" id="photoMainCategoryError">Категория должна содержать изображение</span>
        <span class="error" id="photoMainCategoryMaxSizeError">Максимальный вес изображения - 2мб</span>
        <span class="error" id="photoMainCategoryFileResolError">Разрешен только формат WEBP, PNG, JPG и JPEG</span>
        <div id="mainImageLoader" class="image-loader">Загрузить изображение</div>
      </div>
    </div>
    <button class="create-category__add" type="button" id="addSubcategoryBtn">Добавить подкатегорию</button>
    <ul class="create-category__list" id="subcategoriesContainer" style="display: none"></ul>
    <button class="create-category__submit btn" type="submit">Создать категорию</button>
  </form>
</div>
</body>

<script>
  document.getElementById('categoryForm').addEventListener('submit', function (event) {
    event.preventDefault();
    const formData = new FormData(this);

    const mainImageInput = document.getElementById('image');
    if (!mainImageInput.files.length) {
      const photoMainCategoryError = document.getElementById('photoMainCategoryError');
      photoMainCategoryError.classList.add('error--active');
      setTimeout(function () {
        photoMainCategoryError.classList.remove('error--active');
      }, 2300);
      document.getElementById('mainImageLoader').innerHTML = 'Загрузить изображение';
      mainImageInput.value = '';
      return;
    }

    const file = mainImageInput.files[0];
    const maxFileSize = 2 * 1024 * 1024;
    const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

    if (!allowedTypes.includes(file.type)) {
      const photoMainCategoryFileResolError = document.getElementById('photoMainCategoryFileResolError');
      photoMainCategoryFileResolError.classList.add('error--active');
      setTimeout(function () {
        photoMainCategoryFileResolError.classList.remove('error--active');
      }, 2300);
      document.getElementById('mainImageLoader').innerHTML = 'Загрузить изображение';
      mainImageInput.value = '';
      return;
    }
    if (file.size > maxFileSize) {
      const photoMainCategoryMaxSizeError = document.getElementById('photoMainCategoryMaxSizeError');
      photoMainCategoryMaxSizeError.classList.add('error--active');
      setTimeout(function () {
        photoMainCategoryMaxSizeError.classList.remove('error--active');
      }, 2300);
      document.getElementById('mainImageLoader').innerHTML = 'Загрузить изображение';
      mainImageInput.value = '';
      return;
    }

    const subcategoryInputs = document.querySelectorAll('.create-category__list input[type="file"]');
    let subcategoriesValid = true;
    subcategoryInputs.forEach(function (input) {
      const file = input.files[0];
      if (!file) {
        const subcategoryImageError = document.getElementById(`subcategoryImageError${subcategoryIndex}`);
        subcategoryImageError.classList.add('error--active');
        setTimeout(function () {
          subcategoryImageError.classList.remove('error--active');
        }, 2300);
        subcategoriesValid = false;
      }
    });

    if (!subcategoriesValid) {
      return;
    }

    fetch('{{ route('admin.categories.store') }}', {
      method: 'POST',
      body: formData,
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      }
    })
      .then(response => response.json())
      .then(data => {
        console.log(data);
        if (data.errors) {
          const errorMessage = document.getElementById('errorNameCategory');
          errorMessage.innerText = data.errors.name[0];
          errorMessage.classList.add('error--active');
          setTimeout(function () {
            errorMessage.classList.remove('error--active');
          }, 2300);
        } else {
          window.location.href = '{{route('admin.categories.index')}}'
        }
      })
      .catch(error => {
        console.error('Error:', error);
      });
  });

  function clearMainImageInput() {
    document.getElementById('mainImageLoader').innerHTML = 'Загрузить изображение';
    document.getElementById('image').value = '';
  }

  const mainImageInput = document.getElementById('image');
  const mainImageLoader = document.getElementById('mainImageLoader');

  mainImageLoader.addEventListener('click', function () {
    mainImageInput.click();
  });

  mainImageInput.addEventListener('change', function () {
    const file = this.files[0];
    const maxFileSize = 2 * 1024 * 1024;
    const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

    if (file) {
      if (!allowedTypes.includes(file.type)) {
        document.getElementById('photoMainCategoryFileResolError').classList.add('error--active');
        setTimeout(function () {
          document.getElementById('photoMainCategoryFileResolError').classList.remove('error--active');
        }, 2300);
        clearMainImageInput();
        return;
      }
      if (file.size > maxFileSize) {
        document.getElementById('photoMainCategoryMaxSizeError').classList.add('error--active');
        setTimeout(function () {
          document.getElementById('photoMainCategoryMaxSizeError').classList.remove('error--active');
        }, 2300);
        clearMainImageInput();
        return;
      }

      const reader = new FileReader();
      reader.onload = function (event) {
        mainImageLoader.innerHTML = `<img src="${event.target.result}" alt="Изображение" width="260" height="150">`;
      };
      reader.readAsDataURL(file);
    } else {
      clearMainImageInput();
    }
  });

  const subcategoriesContainer = document.getElementById('subcategoriesContainer');
  const addSubcategoryBtn = document.getElementById('addSubcategoryBtn');

  let subcategoryIndex = 0;

  addSubcategoryBtn.addEventListener('click', function () {
    subcategoryIndex++;

    const subcategoryItem = document.createElement('li');
    subcategoryItem.classList.add('create-category__item');
    subcategoryItem.setAttribute('data-index', subcategoryIndex);
    subcategoryItem.innerHTML = `
      <div>
        <label class="label" for="subcategoryName${subcategoryIndex}">Имя подкатегории</label>
        <input class="input" type="text" name="subcategories[${subcategoryIndex}][name]" id="subcategoryName${subcategoryIndex}"
               placeholder="Введите название" required>
      </div>
      <div>
        <label class="label" for="subcategoryImage${subcategoryIndex}">Изображение подкатегории</label>
        <input type="file" name="subcategories[${subcategoryIndex}][image]" id="subcategoryImage${subcategoryIndex}"
               class="create-category__file" accept="image/png, image/jpeg, image/webp">
        <span class="error" id="subcategoryImageError${subcategoryIndex}">Подкатегория должна содержать изображение</span>
        <span class="error" id="subcategoryImageMaxSizeError${subcategoryIndex}">Максимальный вес изображения - 2мб</span>
        <span class="error" id="subcategoryImageFileResolError${subcategoryIndex}">Разрешен только формат WEBP, PNG, JPG и JPEG</span>
        <div class="image-loader" id="subcategoryImageLoader${subcategoryIndex}">Загрузить изображение</div>
        <button class="create-category__remove" type="button">Удалить подкатегорию</button>
      </div>
    `;

    subcategoriesContainer.appendChild(subcategoryItem);
    subcategoriesContainer.style.display = 'grid';
    subcategoryItem.style.display = 'flex';

    const subcategoryImageInput = document.getElementById(`subcategoryImage${subcategoryIndex}`);
    const subcategoryImageLoader = document.getElementById(`subcategoryImageLoader${subcategoryIndex}`);
    const subcategoryImageError = document.getElementById(`subcategoryImageError${subcategoryIndex}`);
    const subcategoryImageMaxSizeError = document.getElementById(`subcategoryImageMaxSizeError${subcategoryIndex}`);
    const subcategoryImageFileResolError = document.getElementById(`subcategoryImageFileResolError${subcategoryIndex}`);

    subcategoryImageLoader.addEventListener('click', function () {
      subcategoryImageInput.click();
    });

    subcategoryImageInput.addEventListener('change', function () {
      const file = this.files[0];
      const maxFileSize = 2 * 1024 * 1024;
      const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

      if (file) {
        if (!allowedTypes.includes(file.type)) {
          subcategoryImageFileResolError.classList.add('error--active');
          setTimeout(function () {
            subcategoryImageFileResolError.classList.remove('error--active');
          }, 2300);
          clearSubcategoryFormData(subcategoryIndex);
          return;
        }
        if (file.size > maxFileSize) {
          subcategoryImageMaxSizeError.classList.add('error--active');
          setTimeout(function () {
            subcategoryImageMaxSizeError.classList.remove('error--active');
          }, 2300);
          clearSubcategoryFormData(subcategoryIndex);
          return;
        }

        const reader = new FileReader();
        reader.onload = function (event) {
          subcategoryImageLoader.innerHTML = `<img src="${event.target.result}" alt="Изображение">`;
        };
        reader.readAsDataURL(file);
      } else {
        subcategoryImageLoader.innerHTML = 'Загрузить изображение';
      }
    });

    const deleteSubcategoryBtn = subcategoryItem.querySelector('.create-category__remove');
    deleteSubcategoryBtn.addEventListener('click', function () {
      const subcategoryIndex = subcategoryItem.getAttribute('data-index');
      subcategoryItem.remove();
      clearSubcategoryFormData(subcategoryIndex);

      const remainingSubcategories = subcategoriesContainer.querySelectorAll('.create-category__item');
      if (remainingSubcategories.length === 0) {
        subcategoriesContainer.style.display = 'none';
      }
    });
  });

  function clearSubcategoryFormData(index) {
    const subcategoryNameInput = document.getElementById(`subcategoryName${index}`);
    const subcategoryImageInput = document.getElementById(`subcategoryImage${index}`);
    const subcategoryImageLoader = document.getElementById(`subcategoryImageLoader${index}`);

    if (subcategoryNameInput && subcategoryImageInput.files.length === 0) {
      subcategoryNameInput.value = '';
    }

    if (subcategoryImageInput) {
      subcategoryImageInput.value = '';
      subcategoryImageLoader.innerHTML = 'Загрузить изображение';
    }
  }
</script>