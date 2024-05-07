@include('fragments.head', ['title' => 'Оформление заказа'])
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
        <span class="breadcrumbs__link breadcrumbs__link--inactive">Оформление заказа</span>
      </div>
    </div>
  </div>
</div>
<section class="order">
  <div class="container">
    @if(count($cartItems) > 0)
      <h2 class="title title--long">Оформление заказа</h2>
      <div class="order__table">
        <div class="order__head order__row">
          <div class="order__item naming">Наименование</div>
          <div class="order__item price">Стоимость (ед.)</div>
          <div class="order__item quantity">Количество</div>
          <div class="order__item total">Стоимость</div>
        </div>
        @foreach($cartItems as $item)
          <div class="order__row">
            <div class="order__item naming">
              <a class="order__link" href="{{ route('show_product', ['id' => $item->product_id]) }}"
                 target="_blank">{{ $item->name }}</a>
            </div>
            <div class="order__item price" data-price="{{ $item->new_price ? : $item->price }}">
              {{ $item->new_price ? : $item->price }} &#8381;
            </div>
            <div class="order__item quantity">
              {{$item->quantity}}
            </div>
            <div class="order__item total unit_cost">
              {{ $item->quantity * ($item->new_price ? : $item->price) }} &#8381;
            </div>
          </div>
        @endforeach
        <div class="order__head order__row">
          <div class="order__item order__total naming">Общая стоимость</div>
          <div class="order__item price"></div>
          <div class="order__item quantity"></div>
          <div class="order__item total" id="cartTotal">{{ $totalPrice }} &#8381;</div>
        </div>
      </div>
      <a class="order__cart" href="{{route('cart.show_cart')}}">Вернуться к корзине товаров</a>
      <p class="order__info">
        Оставьте свои контактные данные для подтверждения заказа и связи с менеджером
      </p>
      <form class="order__form" action="">
        <div class="order__left">
          <ul class="order__list">
            <li class="order__list-item">
              <input
                  class="input" name="name" id="name" maxlength="255"
                  type="text" placeholder="Ваше имя" required
                  value="{{ auth()->check() ? auth()->user()->name : '' }}"
              >
            </li>
            <li class="order__list-item">
              <input
                  class="input" name="phone_number" id="phone_number" maxlength="255"
                  type="text" placeholder="Ваш номер телефона"
                  data-tel-input required
              >
            </li>
            <li class="order__list-item">
              <input
                  class="input" name="email" id="email" maxlength="255"
                  type="text" placeholder="Ваша электронная почта" required
                  value="{{ auth()->check() ? auth()->user()->email : '' }}"
              >
            </li>
            <li class="order__list-item">
              <input
                  class="input" name="delivery_address" id="delivery_address" maxlength="255"
                  type="text" placeholder="Ваш адрес доставки"
              >
            </li>
            <li class="order__list-item">
            <textarea
                class="input input--textarea-high" name="comment" id="comment" maxlength="2000"
                type="text" placeholder="Ваш комментарий (неоябазетльно)"
            ></textarea>
            </li>
          </ul>
          <p class="order__confirm">
            Отправляя данные через эту форму, Вы автоматически соглашаетесь на
            <a href="{{route('privacy')}}">политику конфиденциальности</a>
          </p>
          <button class="order__btn btn" type="submit">Оформить заказ</button>
        </div>
        <div class="order__right">
          <div class="order__right-item">
            <span class="order__name">Вариант доставки:</span>
            <li>
              <input type="radio" id="pickup" name="delivery_option" value="pickup" checked>
              <label for="pickup">Самовывоз</label>
            </li>
            <li>
              <input type="radio" id="delivery" name="delivery_option" value="delivery">
              <label for="delivery">Доставка</label>
            </li>
          </div>
          <div class="order__right-item">
            <span class="order__name">Вариант оплаты:</span>
            <li>
              <input type="radio" id="cash" name="payment_option" value="cash" checked>
              <label for="cash">Наличный расчет</label>
            </li>
            <li>
              <input type="radio" id="non-cash" name="payment_option" value="non-cash">
              <label for="non-cash">Безналичный расчет</label>
            </li>
          </div>
        </div>
      </form>
    @else
      @if(Auth::check())
        <p class="order__info non">
          Ваша корзина для оформления заказа ещё пуста. Вы можете начать покупки, добавив товары
        </p>
        <a class="order__main btn" href="{{route('index')}}">На главную</a>
      @else
        <p class="order__info non">
          Чтобы оформлять заказы нужно быть зарегистрированным пользователем
        </p>
        <a class="order__main btn" href="{{route('index')}}">На главную</a>
      @endif
    @endif
  </div>
</section>
<div class="modal left long" id="modal_order">
  <button class="modal__close" type="button" id="close_order">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M18 6L6 18M6 6L18 18" stroke="#545860" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
  </button>
  <h2 class="modal__title long">
    Успешное создание заказа
  </h2>
  <div class="modal__text modal__text--long">
    <p>Ваш заказ был успешно создан. Вы можете увидеть его в личном кабинете</p>
    <p>Ожидайте дальнейшего ответа от нашего менеджера</p>
  </div>
  <button class="btn" type="button" id="close_order_btn">Закрыть окно</button>
</div>
@include('fragments.footer')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const deliveryOptionRadio = document.querySelectorAll('input[name="delivery_option"]');
    const deliveryAddressInput = document.getElementById('delivery_address');

    function toggleDeliveryAddressInput() {
      if (deliveryOptionRadio[1].checked) {
        deliveryAddressInput.removeAttribute('disabled');
        deliveryAddressInput.setAttribute('required', true);
        deliveryAddressInput.classList.remove('inactive');
      } else {
        deliveryAddressInput.setAttribute('disabled', true);
        deliveryAddressInput.removeAttribute('required');
        deliveryAddressInput.classList.add('inactive');
      }
    }

    deliveryOptionRadio.forEach(function (radio) {
      radio.addEventListener('change', toggleDeliveryAddressInput);
    });

    toggleDeliveryAddressInput();
  });
</script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('.order__form');

    form.addEventListener('submit', function (event) {
      event.preventDefault();

      const formData = new FormData(form);

      fetch('{{ route('order.store') }}', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: formData
      })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            console.log(data.success);
            const modal = document.getElementById('modal_order');
            modal.classList.add('modal--active');
            document.body.classList.add('body--active');
          } else if (data.error) {
            console.error(data.error);
          }
        })
        .catch(error => {
          console.error('Ошибка при создании заказа', error.message);
        });
    });

    const closeModalAndRedirect = function () {
      const modal = document.getElementById('modal_order');
      modal.classList.remove('modal--active');
      document.body.classList.remove('body--active');

      setTimeout(function () {
        window.location.href = '/profile';
      }, 900);
    };

    const closeOrderButton = document.getElementById('close_order');
    if (closeOrderButton) {
      closeOrderButton.addEventListener('click', closeModalAndRedirect);
    }

    const closeOrderButton2 = document.getElementById('close_order_btn');
    if (closeOrderButton2) {
      closeOrderButton2.addEventListener('click', closeModalAndRedirect);
    }
  });
</script>
</body>