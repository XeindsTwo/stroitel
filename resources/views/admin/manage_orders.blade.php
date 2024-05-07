@include('fragments/head', ['title' => 'Управление заказами магазина'])
<link href="https://cdn.jsdelivr.net/npm/toastify-js@1.12.0/src/toastify.min.css" rel="stylesheet">
<body class="body">
@include('fragments.header-admin')
<div class="container">
  <div class="breadcrumbs">
    <div class="breadcrumbs__top">
      <div class="breadcrumbs__item">
        <a class="breadcrumbs__link" href="{{route('admin.feedback-request')}}">Главная админ-панели</a>
      </div>
      <div class="breadcrumbs__item">
        <span>Управление заказами магазина</span>
      </div>
    </div>
  </div>
</div>
<section class="manage-orders">
  <div class="container">
    @if($orders->isEmpty())
      <p class="manage-orders__orders-empty">В системе ещё не существует заказов :(</p>
    @else
      <input class="input" type="text" id="searchInput" placeholder="Поиск по заказам (имя, номер телефона, адрес)">
      <ul class="manage-orders__orders-list">
        @foreach($orders as $order)
          <li class="manage-orders__order">
            <p class="manage-orders__order-id">Заказ №{{ $order->id }}</p>
            <button class="manage-orders__delete" data-order="{{$order->id}}">Удалить заказ</button>
            <ul class="manage-orders__order-info">
              <li>Имя: <br> {{ $order->name }}</li>
              <li>Номер телефона: <br> {{ $order->phone_number }}</li>
              <li>Почта: <br> {{ $order->email }}</li>
              <li>Дата: <br> {{ $order->created_at->format('d M Y') }}</li>
              <li>Общая стоимость заказа: <br> {{ number_format($order->total_price, 0, ',', ' ') }} &#8381;</li>
              @if($order->delivery_address)
                <li>Адрес доставки: <br> {{ $order->delivery_address }}</li>
              @endif
              @if($order->delivery_option === 'delivery')
                <li>Тип доставки: Доставка</li>
              @elseif($order->delivery_option === 'pickup')
                <li>Тип доставки: Самовывоз</li>
              @endif
              @if($order->payment_option === 'cash')
                <li>Способ оплаты: Наличными</li>
              @elseif($order->payment_option === 'non-cash')
                <li>Способ оплаты: Безналичный расчет</li>
              @endif
            </ul>
            <ul class="manage-orders__order-products">
              @foreach($order->products as $product)
                <li class="catalog__product">
                  <a class="catalog__image" href="{{ route('show_product', ['id' => $product->id]) }}" target="_blank">
                    <img src="{{ asset('storage/products/' . $product->image_path) }}" loading="lazy" alt="{{ $product->name }}">
                  </a>
                  <div class="catalog__info">
                    <p class="catalog__article">Артикул: {{ $product->article }}</p>
                    <p class="catalog__name">{{ $product->name }}</p>
                    <div class="catalog__order">
                      <span>Количество товара - </span> {{ $product->pivot->quantity }} шт.
                    </div>
                  </div>
                </li>
              @endforeach
            </ul>
          </li>
        @endforeach
      </ul>
    @endif
  </div>
</section>
</body>
<script src="https://cdn.jsdelivr.net/npm/toastify-js@1.12.0/src/toastify.min.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('input', function() {
      const searchQuery = this.value.trim().toLowerCase();
      const ordersList = document.querySelectorAll('.manage-orders__order');
      let found = false;

      ordersList.forEach(function(order) {
        const orderInfo = order.querySelector('.manage-orders__order-info').innerText.toLowerCase();

        if (orderInfo.includes(searchQuery)) {
          order.style.display = 'block';
          found = true;
        } else {
          order.style.display = 'none';
        }
      });

      if (!found && searchQuery === '') {
        ordersList.forEach(function(order) {
          order.style.display = 'block';
        });
      }
    });

    const deleteButtons = document.querySelectorAll('.manage-orders__delete');
    deleteButtons.forEach(function(button) {
      button.addEventListener('click', function() {
        const orderId = this.getAttribute('data-order');
        const orderToDelete = this.closest('.manage-orders__order');
        if (confirm('Вы уверены, что хотите удалить этот заказ? Отменить действие будет невозможно')) {
          fetch(`/admin/orders/${orderId}`, {
            method: 'DELETE',
            headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}',
            }
          })
            .then(response => {
              if (!response.ok) {
                throw new Error('Произошла ошибка при удалении заказа');
              }
              return response.json();
            })
            .then(data => {
              Toastify({
                text: data.success,
                duration: 3000,
                close: true,
                gravity: 'bottom',
                position: 'right',
                backgroundColor: 'green'
              }).showToast();
              orderToDelete.remove();
            })
            .catch(error => {
              Toastify({
                text: error.message,
                duration: 3000,
                close: true,
                gravity: 'bottom',
                position: 'right',
                backgroundColor: 'red'
              }).showToast();
            });
        }
      });
    });
  });
</script>