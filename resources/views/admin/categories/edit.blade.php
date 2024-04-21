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
               accept="image/png, image/jpeg, image/webp" value="{{ asset('storage/category_images/' . $category->image) }}">
        <span class="error" id="photoMainCategoryError">Категория должна содержать изображение</span>
        <span class="error" id="photoMainCategoryMaxSizeError">Максимальный вес изображения - 2мб</span>
        <span class="error" id="photoMainCategoryFileResolError">Разрешен только формат WEBP, PNG, JPG и JPEG</span>
        <div id="mainImageLoader" class="image-loader">Загрузить изображение</div>
      </div>
    </div>
    <button class="create-category__add" type="button" id="addSubcategoryBtn">Добавить подкатегорию</button>
    <ul class="create-category__list" id="subcategoriesContainer" style="display: none"></ul>
    <button class="create-category__submit btn" type="submit">Сохранить изменения</button>
  </form>
</div>
</body>

<script>
  document.getElementById('categoryForm').addEventListener('submit', function (event) {
    event.preventDefault();
    const formData = new FormData(this);

    const mainImageLoader = document.getElementById('mainImageLoader');
    const mainImage = mainImageLoader.querySelector('img');

    if (!mainImage) {
      const photoMainCategoryError = document.getElementById('photoMainCategoryError');
      photoMainCategoryError.classList.add('error--active');
      setTimeout(function () {
        photoMainCategoryError.classList.remove('error--active');
      }, 2300);
      return;
    }

    const base64Image = mainImage.getAttribute('src');
    formData.append('image', base64Image);

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

    fetch('{{ route('admin.categories.create', $category->id) }}', {
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

  @if($category->image)
    mainImageLoader.innerHTML = `<img src="{{ asset('storage/category_images/' . $category->image) }}" alt="{{$category->name}}" width="260" height="150">`;
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
</script>