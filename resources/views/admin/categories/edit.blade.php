@include('fragments/head', ['title' => 'Редактирование категории'])
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
        <span>Редактирование категории</span>
      </div>
    </div>
  </div>
  <form class="create-category__form" id="categoryForm" enctype="multipart/form-data">
    <div class="create-category__item short">
      <div>
        <label class="label" for="name">Имя категории</label>
        <span class="error" id="errorNameCategory">Имя категории должно быть уникальным</span>
        <input class="input" type="text" name="name" id="name" value="{{$category->name}}"
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
    <ul class="create-category__list" id="subcategoriesContainer">
      @foreach($category->subcategories as $subcategory)
        <li class="create-category__item" id="subcategoryItem{{$loop->index}}">
          <div>
            <label class="label" for="subcategoryName{{$loop->index}}">Имя подкатегории</label>
            <input class="input" type="text" name="subcategories[{{$loop->index}}][name]"
                   id="subcategoryName{{$loop->index}}"
                   placeholder="Введите название" maxlength="255"
                   required value="{{$subcategory->name}}"
            >
          </div>
          <div>
            <label class="label" for="subcategoryImage{{$loop->index}}">Изображение подкатегории</label>
            <input type="file" name="subcategories[{{$loop->index}}][image]"
                   id="subcategoryImage{{$loop->index}}"
                   class="create-category__file" accept="image/png, image/jpeg, image/webp">
            <span class="error"
                  id="subcategoryImageError{{$loop->index}}">Подкатегория должна содержать изображение</span>
            <span class="error"
                  id="subcategoryImageMaxSizeError{{$loop->index}}">Максимальный вес изображения - 2мб</span>
            <span class="error" id="subcategoryImageFileResolError{{$loop->index}}">Разрешен только формат WEBP, PNG, JPG и JPEG</span>
            <div class="image-loader" id="subcategoryImageLoader{{$loop->index}}">Загрузить изображение</div>
            <button class="create-category__remove deleteSubcategoryBtn" type="button"
                    data-subcategory-id="{{$loop->index}}">Удалить подкатегорию
            </button>
          </div>
        </li>
      @endforeach
    </ul>
    <button class="create-category__submit btn" type="submit">Сохранить изменения</button>
  </form>
</div>
</body>

<script>
  function validateSubcategories() {
    const subcategoryImageInputs = document.querySelectorAll('.create-category__file');
    for (let i = 0; i < subcategoryImageInputs.length; i++) {
      const imageInput = subcategoryImageInputs[i];
      const subcategoryIndex = imageInput.id.replace('subcategoryImage', '');
      const errorMessage = document.getElementById(`subcategoryImageError${subcategoryIndex}`);
      if (!imageInput.files || imageInput.files.length === 0) {
        errorMessage.classList.add('error--active');
        setTimeout(function () {
          errorMessage.classList.remove('error--active');
        }, 2300);
        return false;
      }
    }
    return true;
  }

  document.getElementById('categoryForm').addEventListener('submit', function (event) {
    event.preventDefault();
    const formData = new FormData(this);
    const mainImageInput = document.getElementById('image');

    if (mainImageInput.files.length === 0) {
      const photoMainCategoryError = document.getElementById('photoMainCategoryError');
      photoMainCategoryError.classList.add('error--active');
      setTimeout(function () {
        photoMainCategoryError.classList.remove('error--active');
      }, 2300);
      return;
    }

    if (!validateSubcategories()) {
      return;
    }

    fetch('{{ route('admin.categories.update', $category->id) }}', {
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
          window.location.href = '{{ route('admin.categories.index') }}';
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

  @if($category->image)
  const imageURL = "{{ asset('storage/category_images/' . $category->image) }}";
  fetch(imageURL)
    .then(response => response.blob())
    .then(blob => {
      const file = new File([blob], "{{ $category->image }}");
      const dataTransfer = new DataTransfer();
      dataTransfer.items.add(file);
      mainImageInput.files = dataTransfer.files;
      const reader = new FileReader();
      reader.onload = function (event) {
        mainImageLoader.innerHTML = `<img src="${event.target.result}" alt="Изображение" width="260" height="150">`;
      };
      reader.readAsDataURL(file);
    })
    .catch(error => {
      console.error('Error loading image:', error);
    });
  @endif

  @if($category->subcategories->isNotEmpty())
  const subcategoriesData = @json($category->subcategories);

  subcategoriesData.forEach((subcategory, index) => {
    const subcategoryNameInput = document.getElementById(`subcategoryName${index}`);
    const subcategoryImageLoader = document.getElementById(`subcategoryImageLoader${index}`);
    const subcategoryImageInput = document.getElementById(`subcategoryImage${index}`);

    subcategoryNameInput.value = subcategory.name;

    if (subcategory.image) {
      const imageURL = "{{ asset('storage/subcategory_images/') }}" + '/' + subcategory.image;
      fetch(imageURL)
        .then(response => response.blob())
        .then(blob => {
          const file = new File([blob], subcategory.image);
          const dataTransfer = new DataTransfer();
          dataTransfer.items.add(file);
          subcategoryImageInput.files = dataTransfer.files;
          const reader = new FileReader();
          reader.onload = function (event) {
            subcategoryImageLoader.innerHTML = `<img src="${event.target.result}" alt="Изображение" width="260" height="150">`;
          };
          reader.readAsDataURL(file);
        })
        .catch(error => {
          console.error('Error loading subcategory image:', error);
        });
    }

    subcategoryImageLoader.addEventListener('click', function () {
      subcategoryImageInput.click();
    });

    subcategoryImageInput.addEventListener('change', function () {
      const file = subcategoryImageInput.files[0];
      const maxFileSize = 2 * 1024 * 1024;
      const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

      if (file) {
        if (!allowedTypes.includes(file.type)) {
          document.getElementById(`subcategoryImageFileResolError${index}`).classList.add('error--active');
          setTimeout(function () {
            document.getElementById(`subcategoryImageFileResolError${index}`).classList.remove('error--active');
          }, 2300);
          clearSubcategoryImageInput(index);
          return;
        }
        if (file.size > maxFileSize) {
          document.getElementById(`subcategoryImageMaxSizeError${index}`).classList.add('error--active');
          setTimeout(function () {
            document.getElementById(`subcategoryImageMaxSizeError${index}`).classList.remove('error--active');
          }, 2300);
          clearSubcategoryImageInput(index);
          return;
        }

        const reader = new FileReader();
        reader.onload = function (event) {
          subcategoryImageLoader.innerHTML = `<img src="${event.target.result}" alt="Изображение" width="260" height="150">`;
        };
        reader.readAsDataURL(file);
      } else {
        clearSubcategoryImageInput(index);
      }
    });
  });
  @endif

  mainImageLoader.addEventListener('click', function () {
    mainImageInput.click();
  });

  mainImageInput.addEventListener('change', function () {
    const file = mainImageInput.files[0];
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
  if (subcategoriesContainer && subcategoriesContainer.children.length > 0) {
    subcategoriesContainer.style.display = 'grid';
  } else {
    subcategoriesContainer.style.display = 'none';
  }

  document.getElementById('addSubcategoryBtn').addEventListener('click', function () {
    const index = subcategoriesContainer ? subcategoriesContainer.children.length : 0;
    const newSubcategoryItem = document.createElement('li');
    newSubcategoryItem.classList.add('create-category__item');
    newSubcategoryItem.id = `subcategoryItem${index}`;
    newSubcategoryItem.innerHTML = `
        <div>
            <label class="label" for="subcategoryName${index}">Имя подкатегории</label>
            <input class="input" type="text" name="subcategories[${index}][name]"
                   id="subcategoryName${index}" maxlength="255"
                   placeholder="Введите название" required>
        </div>
        <div>
            <label class="label" for="subcategoryImage${index}">Изображение подкатегории</label>
            <input type="file" name="subcategories[${index}][image]"
                   id="subcategoryImage${index}"
                   class="create-category__file" accept="image/png, image/jpeg, image/webp" style="display: none;">
            <span class="error" id="subcategoryImageError${index}">Подкатегория должна содержать изображение</span>
            <span class="error" id="subcategoryImageMaxSizeError${index}">Максимальный вес изображения - 2мб</span>
            <span class="error" id="subcategoryImageFileResolError${index}">Разрешен только формат WEBP, PNG, JPG и JPEG</span>
            <label class="image-loader" id="subcategoryImageLoader${index}" for="subcategoryImage${index}">Загрузить изображение</label>
            <button class="create-category__remove deleteSubcategoryBtn" type="button" data-subcategory-id="${index}">Удалить подкатегорию</button>
        </div>`;
    if (subcategoriesContainer) {
      subcategoriesContainer.appendChild(newSubcategoryItem);
      subcategoriesContainer.style.display = 'grid';
    }

    const newSubcategoryImageInput = document.getElementById(`subcategoryImage${index}`);
    newSubcategoryImageInput.addEventListener('change', function () {
      const file = newSubcategoryImageInput.files[0];
      const maxFileSize = 2 * 1024 * 1024;
      const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

      if (file) {
        if (!allowedTypes.includes(file.type)) {
          document.getElementById(`subcategoryImageFileResolError${index}`).classList.add('error--active');
          setTimeout(function () {
            document.getElementById(`subcategoryImageFileResolError${index}`).classList.remove('error--active');
          }, 2300);
          clearSubcategoryImageInput(index);
          return;
        }
        if (file.size > maxFileSize) {
          document.getElementById(`subcategoryImageMaxSizeError${index}`).classList.add('error--active');
          setTimeout(function () {
            document.getElementById(`subcategoryImageMaxSizeError${index}`).classList.remove('error--active');
          }, 2300);
          clearSubcategoryImageInput(index);
          return;
        }

        const reader = new FileReader();
        reader.onload = function (event) {
          document.getElementById(`subcategoryImageLoader${index}`).innerHTML = `<img src="${event.target.result}" alt="Изображение" width="260" height="150">`;
        };
        reader.readAsDataURL(file);
      } else {
        clearSubcategoryImageInput(index);
      }
    });
  });

  function clearSubcategoryImageInput(index) {
    document.getElementById(`subcategoryImageLoader${index}`).innerHTML = 'Загрузить изображение';
    document.getElementById(`subcategoryImage${index}`).value = '';
  }

  document.addEventListener('click', function (event) {
    if (event.target.classList.contains('deleteSubcategoryBtn')) {
      const subcategoryId = event.target.dataset.subcategoryId;
      const subcategoryItem = document.getElementById(`subcategoryItem${subcategoryId}`);
      if (confirm("Вы уверены, что хотите удалить эту подкатегорию и связанные с ней товары?" +
        " Отменить действие после сохранения изменений будет невозможно")) {
        subcategoryItem.remove();
        if (subcategoriesContainer.children.length === 0) {
          subcategoriesContainer.style.display = 'none';
        }
      }
    }
  });
</script>