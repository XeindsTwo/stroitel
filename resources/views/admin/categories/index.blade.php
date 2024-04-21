@include('fragments/head', ['title' => 'Управление категориями товаров'])
<body class="body">
@include('fragments.header-admin')
<div class="container">
  <div class="breadcrumbs">
    <div class="breadcrumbs__top">
      <div class="breadcrumbs__item">
        <a class="breadcrumbs__link" href="{{route('admin.partnership-requests')}}">Главная админ-панели</a>
      </div>
      <div class="breadcrumbs__item">
        <span>Управление категориями товаров</span>
      </div>
    </div>
  </div>
  <a class="admin-categories__create btn" href="{{route('admin.categories.create')}}">Создать категорию</a>
  @if($categories->isEmpty())
    <p>Категорий на данный момент не существует</p>
  @else
    <ul class="admin-categories__list">
      @foreach($categories as $category)
        <li class="admin-categories__item">
          <p class="admin-categories__name">{{$category->name}}</p>
          <img class="admin-categories__img" width="260" height="150"
               src="{{asset('storage/category_images/' . $category->image)}}" alt="{{$category->name}}">
          <div class="admin-categories__actions">
            <button class="admin-categories__action delete-category" type="button" data-category-id="{{$category->id}}">
              Удалить
            </button>
            |
            <a class="admin-categories__action"
               href="{{route('admin.categories.edit', $category->id)}}"
            >
              Редактировать
            </a>
          </div>
        </li>
      @endforeach
    </ul>
  @endif
</div>
</body>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-category');

    deleteButtons.forEach(button => {
      button.addEventListener('click', function () {
        const categoryId = this.getAttribute('data-category-id');
        const confirmation = confirm('Вы уверены, что хотите удалить эту категорию? Отменить действие будет невозможно. Удаляться также подкатегории, и товары связанные с данной категорией');

        if (confirmation) {
          fetch(`{{ route('admin.categories.destroy', ':id') }}`.replace(':id', categoryId), {
            method: 'DELETE',
            headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
          })
            .then(response => response.json())
            .then(data => {
              const deletedCategoryElement = document.querySelector(`.delete-category[data-category-id="${categoryId}"]`);
              deletedCategoryElement.closest('.admin-categories__item').remove();
              alert(data.message);
            })
            .catch(error => {
              console.error('Error:', error);
              alert('Произошла ошибка при удалении категории');
            });
        }
      });
    });
  });
</script>