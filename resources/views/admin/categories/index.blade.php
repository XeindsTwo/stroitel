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
        <li class="admin-products__item">
          <p class="admin-products__name">{{$category->name}}</p>
          <div class="admin-products__actions">
            <button class="admin-products__action delete-category" type="button" data-category-id="{{$category->id}}">
              Удалить
            </button>
            |
            <button class="admin-products__action" type="button">Редактировать</button>
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
              deletedCategoryElement.closest('.admin-products__item').remove();
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