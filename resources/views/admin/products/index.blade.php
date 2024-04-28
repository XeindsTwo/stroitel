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
        <span>Управление товарами магазина</span>
      </div>
    </div>
  </div>
  <a class="admin-products__create btn" href="{{route('admin.products.create')}}">Создать новый товар</a>
  <ul class="admin-products__list">
    @foreach($products as $product)
      <li class="admin-products__item">
        <a class="admin-products__image" href="{{ route('show_product', ['id' => $product->id]) }}">
          <img src="{{ asset('storage/products/' . $product->image_path) }}" alt="{{ $product->name }}">
        </a>
        <div class="admin-products__info">
          <p class="admin-products__article">Артикул: {{ $product->article }}</p>
          <p class="admin-products__name">{{ $product->name }}</p>
          <div class="admin-products__price">
            Цена за шт:
            <span>{{ number_format($product->price, 0, '.', ' ') }} &#8381;</span>
          </div>
        </div>
        <div class="admin-products__actions">
          <button class="admin-products__action delete-product" type="button" data-product-id="{{ $product->id }}">
            Удалить
          </button>
          |
          <a
              class="admin-products__action"
              href="{{route('admin.products.edit', ['id' => $product->id])}}"
          >
            Редактировать
          </a>
        </div>
      </li>
    @endforeach
  </ul>
</div>
</body>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-product');

    deleteButtons.forEach(button => {
      button.addEventListener('click', function () {
        const productId = button.dataset.productId;

        if (confirm('Вы уверены, что хотите удалить этот товар? Отменить действие будет невозможно')) {
          fetch(`/admin/products/${productId}`, {
            method: 'DELETE',
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
          })
            .then(response => {
              if (!response.ok) {
                throw new Error('Ошибка удаления товара');
              }
              return response.json();
            })
            .then(data => {
              alert(data.message);
              const productItem = button.closest('.admin-products__item');
              if (productItem) {
                productItem.parentNode.removeChild(productItem);
              }
            })
            .catch(error => {
              console.error(error.message);
              alert('Произошла ошибка при удалении товара');
            });
        }
      });
    });
  });
</script>