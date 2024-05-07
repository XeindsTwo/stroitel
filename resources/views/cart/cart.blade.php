@include('fragments.head', ['title' => 'Корзина товаров'])
<link href="https://cdn.jsdelivr.net/npm/toastify-js@1.12.0/src/toastify.min.css" rel="stylesheet">
<body class="body">
@include('fragments.meta')
@include('fragments.header')
<div class="container">
  <div class="breadcrumbs">
    <div class="breadcrumbs__top">
      <div class="breadcrumbs__item">
        <a class="breadcrumbs__link" href="{{ route('index') }}">Главная</a>
      </div>
      <div class="breadcrumbs__item">
        <span class="breadcrumbs__link breadcrumbs__link--inactive">Корзина товаров</span>
      </div>
    </div>
  </div>
</div>
<section class="cart">
  <div class="container">
    @if(count($cartItems) > 0)
      <h2 class="title title--long">Ваша корзина</h2>
      <p class="cart__info">
        Вы можете сформировать и отправить нам свой заказ <br>
        В течение ближайшего времени мы сделаем расчет и пришлем вам всю информацию <br>
        Стоимость всего заказа может меняться <br>
      </p>
      <div class="cart__table">
        <div class="cart__head cart__row">
          <div class="cart__item naming">Наименование</div>
          <div class="cart__item price">Стоимость (ед.)</div>
          <div class="cart__item quantity">Количество</div>
          <div class="cart__item total">Стоимость</div>
          <div class="cart__item action">Действие</div>
        </div>
        @foreach($cartItems as $item)
          <div class="cart__row">
            <div class="cart__item naming">
              <a class="cart__link" href="{{ route('show_product', ['id' => $item->product_id]) }}"
                 target="_blank">{{ $item->name }}</a>
            </div>
            <div class="cart__item price" data-price="{{ $item->new_price ? : $item->price }}">
              {{ $item->new_price ? : $item->price }} &#8381;
            </div>
            <div class="cart__item quantity">
              <form class="cart__form" method="post">
                <input type="hidden" name="product_id" value="{{$item->product_id}}">
                <div class="cart__quantity">
                  <button class="cart__btn minus" type="button">
                    <svg viewBox="0 0 17 16" xmlns="http://www.w3.org/2000/svg">
                      <rect x="1" y="9" width="2" height="16" rx="1" transform="rotate(-90.0355 1 9)"></rect>
                    </svg>
                  </button>
                  <input class="catalog__value quantity" type="number" name="quantity" id="quantity"
                         value="{{$item->quantity}}" data-cart-id="{{$item->cart_id}}">
                  <button class="cart__btn plus" type="button">
                    <svg viewBox="0 0 17 16" xmlns="http://www.w3.org/2000/svg">
                      <rect x="8" width="2" height="16" rx="1"></rect>
                      <rect x="1" y="9" width="2" height="16" rx="1" transform="rotate(-90.0355 1 9)"></rect>
                    </svg>
                  </button>
                </div>
              </form>
            </div>
            <div class="cart__item total unit_cost">{{ $item->quantity * ($item->new_price ? : $item->price) }}
              &#8381;
            </div>
            <div class="cart__item action">
              <button class="cart__delete" type="button" data-product-id="{{ $item->product_id }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                  <path
                      d="M16.5625 2.5H13.125V1.875C13.125 0.841133 12.2839 0 11.25 0H8.75C7.71613 0 6.875 0.841133 6.875 1.875V2.5H3.4375C2.57594 2.5 1.875 3.20094 1.875 4.0625V6.25C1.875 6.59515 2.15485 6.875 2.5 6.875H2.84156L3.38153 18.2142C3.42922 19.2156 4.25187 20 5.25437 20H14.7456C15.7481 20 16.5708 19.2156 16.6185 18.2142L17.1585 6.875H17.5C17.8451 6.875 18.125 6.59515 18.125 6.25V4.0625C18.125 3.20094 17.4241 2.5 16.5625 2.5ZM8.125 1.875C8.125 1.53039 8.4054 1.25 8.75 1.25H11.25C11.5946 1.25 11.875 1.53039 11.875 1.875V2.5H8.125V1.875ZM3.125 4.0625C3.125 3.89019 3.26519 3.75 3.4375 3.75H16.5625C16.7348 3.75 16.875 3.89019 16.875 4.0625V5.625C16.6824 5.625 3.92317 5.625 3.125 5.625V4.0625ZM15.3699 18.1547C15.354 18.4885 15.0797 18.75 14.7456 18.75H5.25437C4.92019 18.75 4.64597 18.4885 4.63012 18.1547L4.09297 6.875H15.907L15.3699 18.1547Z"
                      fill="#079AFF"/>
                  <path
                      d="M10 17.5C10.3451 17.5 10.625 17.2201 10.625 16.875V8.75C10.625 8.40487 10.3451 8.125 10 8.125C9.65487 8.125 9.375 8.40487 9.375 8.75V16.875C9.375 17.2201 9.6548 17.5 10 17.5Z"
                      fill="#079AFF"/>
                  <path
                      d="M13.125 17.5C13.4701 17.5 13.75 17.2201 13.75 16.875V8.75C13.75 8.40487 13.4701 8.125 13.125 8.125C12.7799 8.125 12.5 8.40487 12.5 8.75V16.875C12.5 17.2201 12.7798 17.5 13.125 17.5Z"
                      fill="#079AFF"/>
                  <path
                      d="M6.875 17.5C7.22013 17.5 7.5 17.2201 7.5 16.875V8.75C7.5 8.40487 7.22013 8.125 6.875 8.125C6.52985 8.125 6.25 8.40487 6.25 8.75V16.875C6.25 17.2201 6.52981 17.5 6.875 17.5Z"
                      fill="#079AFF"/>
                </svg>
              </button>
            </div>
          </div>
        @endforeach
        <div class="cart__head cart__row">
          <div class="cart__item cart__total naming">Общая стоимость</div>
          <div class="cart__item price"></div>
          <div class="cart__item quantity"></div>
          <div class="cart__item total" id="cartTotal">{{ $totalPrice }} &#8381;</div>
          <div class="cart__item action"></div>
        </div>
      </div>
      <a class="cart__order" href="{{route('order.index')}}">Перейти к оформлению заказа</a>
    @else
      @if(Auth::check())
        <p class="cart__info accent">
          Ваша корзина для оформления заказа ещё пуста. Вы можете начать покупки, добавив товары
        </p>
        <a class="cart__main btn" href="{{route('index')}}">На главную</a>
      @else
        <p class="cart__info accent">
          Чтобы добавлять товары в корзину, нужно быть зарегистрированным в системе
        </p>
        <a class="cart__main btn" href="{{route('index')}}">На главную</a>
      @endif
    @endif
  </div>
</section>
@include('fragments.footer')
<script src="https://cdn.jsdelivr.net/npm/toastify-js@1.12.0/src/toastify.min.js"></script>
<script>
  document.querySelectorAll('.cart__delete').forEach(button => {
    button.addEventListener('click', async () => {
      const productId = button.dataset.productId;

      const confirmed = confirm('Вы уверены, что хотите удалить этот товар из корзины? Отменить действие будет невозможно');
      if (confirmed) {
        try {
          const response = await fetch('/cart/remove', {
            method: 'DELETE',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({product_id: productId})
          });

          if (response.ok) {
            const row = button.closest('.cart__row');
            const totalPriceElement = document.getElementById('cartTotal');
            const totalPrice = parseFloat(totalPriceElement.innerText.replace('₽', ''));
            const priceElement = row.querySelector('.total');
            const price = parseFloat(priceElement.innerText.replace('₽', ''));
            const newTotalPrice = totalPrice - price;

            row.remove();
            totalPriceElement.innerText = newTotalPrice + ' ₽';
            Toastify({
              text: 'Товар успешно удален из корзины',
              duration: 3000,
              gravity: 'bottom',
              position: 'right',
              backgroundColor: '#4CAF50',
            }).showToast();
          } else {
            const errorData = await response.json();
            console.error('Ошибка при удалении товара:', errorData);
            Toastify({
              text: 'Ошибка при удалении товара: ' + errorData.error,
              duration: 3000,
              gravity: 'bottom',
              position: 'right',
              backgroundColor: '#ff4c4c',
            }).showToast();
          }
        } catch (error) {
          console.error('Ошибка при удалении товара:', error);
          Toastify({
            text: 'Ошибка при удалении товара: ' + error.message,
            duration: 3000,
            gravity: 'bottom',
            position: 'right',
            backgroundColor: '#ff4c4c',
          }).showToast();
        }
      }
    });
  });
</script>
<script>
  document.querySelectorAll('.cart__form').forEach(form => {
    const quantityInput = form.querySelector('.quantity');
    const unitCostElement = form.closest('.cart__row').querySelector('.unit_cost');
    const priceElement = form.closest('.cart__row').querySelector('.price');
    const totalPriceElement = document.getElementById('cartTotal');
    const cartItemId = quantityInput.getAttribute('data-cart-id');
    let quantity = parseInt(quantityInput.value);
    let unitPrice = parseFloat(unitCostElement.innerText);

    form.addEventListener('click', async (event) => {
      const button = event.target.closest('button');
      if (!button) return;

      if (button.classList.contains('plus')) {
        if (quantity < 1000) {
          quantity++;
          updateQuantityAndTotal();
        }
      } else if (button.classList.contains('minus')) {
        if (quantity > 1) {
          quantity--;
          updateQuantityAndTotal();
        }
      }
    });

    const updateQuantityAndTotal = async () => {
      const productIdInput = form.querySelector('input[name="product_id"]');
      const productId = productIdInput.value;
      quantityInput.value = quantity;
      unitPrice = parseFloat(priceElement.dataset.price);
      const newTotalPrice = calculateTotalPrice();
      totalPriceElement.innerText = newTotalPrice + ' ₽';

      try {
        const response = await fetch(`/cart/update/${cartItemId}`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({product_id: productId, quantity: quantity})
        });

        if (response.ok) {
          const responseData = await response.json();
          const successMessage = responseData.message;
          Toastify({
            text: successMessage,
            duration: 3000,
            gravity: 'bottom',
            position: 'right',
            backgroundColor: '#4CAF50',
          }).showToast();
        } else {
          throw new Error('Ошибка при обновлении количества товара в корзине');
        }
      } catch (error) {
        console.error(error.message);
        Toastify({
          text: error.message,
          duration: 3000,
          gravity: 'bottom',
          position: 'right',
          backgroundColor: '#ff4c4c',
        }).showToast();
      }
    };

    const calculateTotalPrice = () => {
      const newTotalPrice = unitPrice * quantityInput.value;
      unitCostElement.innerText = newTotalPrice + ' ₽';

      let total = 0;
      document.querySelectorAll('.unit_cost').forEach(item => {
        total += parseFloat(item.innerText);
      });
      return total;
    };

    quantityInput.addEventListener('input', () => {
      let newQuantity = parseInt(quantityInput.value);
      if (newQuantity < 1) {
        newQuantity = 1;
      } else if (newQuantity > 1000) {
        newQuantity = 1000;
      }
      quantity = newQuantity;
      updateQuantityAndTotal();
    });
  });
</script>
</body>