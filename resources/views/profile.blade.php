@include('fragments/head', ['title' => 'Личный кабинет'])
<body class="body">
@include('fragments.meta')
@include('fragments.header')
<section class="profile">
  <div class="container">
    <h1 class="title">Здравствуйте, {{$user->name}}</h1>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button class="profile__logout" type="submit">Выйти из аккаунта</button>
    </form>
    @if($user->role === 'ADMIN')
      <a class="profile__admin" href="{{ route('admin.products.index') }}">
        Панель администрирования
      </a>
    @endif
    <ul class="profile__list">
      <li class="profile__item">
        <span>Ваш логин</span>
        {{$user->login}}
      </li>
      <li class="profile__item">
        <span>Ваше имя</span>
        <span data-field="name">{{$user->name}}</span>
      </li>
      <li class="profile__item">
        <span>Ваша электронная почта</span>
        <span data-field="email">{{$user->email}}</span>
      </li>
    </ul>
    <button
        class="profile__edit"
        type="button"
        data-name="{{$user->name}}"
        data-email="{{$user->email}}"
    >
      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
        <path fill-rule="evenodd" clip-rule="evenodd"
              d="M11.5446 1.28273C11.3906 1.28273 11.2381 1.31306 11.0958 1.372C10.9535 1.43093 10.8243 1.51731 10.7154 1.6262L2.17738 10.1642L1.55547 12.4445L3.83581 11.8226L12.3738 3.28464C12.4827 3.17574 12.5691 3.04646 12.628 2.90419C12.6869 2.76191 12.7173 2.60942 12.7173 2.45542C12.7173 2.30142 12.6869 2.14893 12.628 2.00665C12.5691 1.86437 12.4827 1.7351 12.3738 1.6262C12.2649 1.51731 12.1356 1.43093 11.9934 1.372C11.8511 1.31306 11.6986 1.28273 11.5446 1.28273ZM10.6049 0.186908C10.9028 0.0635111 11.2221 0 11.5446 0C11.867 0 12.1863 0.0635112 12.4842 0.186908C12.7821 0.310304 13.0528 0.491169 13.2808 0.719175C13.5088 0.947182 13.6897 1.21786 13.8131 1.51577C13.9365 1.81368 14 2.13297 14 2.45542C14 2.77787 13.9365 3.09716 13.8131 3.39507C13.6897 3.69297 13.5088 3.96366 13.2808 4.19166L4.6224 12.8501C4.54348 12.929 4.44532 12.986 4.33764 13.0153L0.810134 13.9774C0.588086 14.0379 0.350613 13.9749 0.187866 13.8121C0.0251199 13.6494 -0.0379445 13.4119 0.0226141 13.1899L0.984661 9.66236C1.01403 9.55468 1.07099 9.45652 1.14991 9.3776L9.80834 0.719175C10.0363 0.491169 10.307 0.310304 10.6049 0.186908Z"
              fill="black"/>
      </svg>
      Редактировать данные
    </button>
    <div class="profile__orders">
      <h2 class="profile__orders-title">
        История заказов
      </h2>
      @if($orders->isEmpty())
        <p class="profile__orders-empty">У вас ещё нет заказов</p>
      @else
        <ul class="profile__orders-list">
          @foreach($orders as $order)
            <li class="profile__order">
              <p class="profile__order-id">Заказ №{{ $order->id }}</p>
              <ul class="profile__order-info">
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
              <ul class="profile__order-products">
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
  </div>
</section>
<div class="modal" id="modal_profile">
  <button class="modal__close" type="button" id="close_edit">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M18 6L6 18M6 6L18 18" stroke="#545860" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round"/>
    </svg>
  </button>
  <h2 class="modal__title">
    Редактирование профиля
  </h2>
  <form class="modal__form" id="edit_profile-form" action="{{route('profile.update')}}">
    @csrf
    <ul class="modal__list">
      <li>
        <input class="input" id="name" name="name"
               maxlength="70" type="text" placeholder="Введите имя" required
               pattern="^[A-Za-zА-Яа-яЁё\s\-]+$"
               title="Имя может содержать только кириллицу и латиницу, пробелы, тире и дефисы"
        >
      </li>
      <li>
        <span class="error" id="email_error">Почта занята другим пользователем</span>
        <input class="input" id="email" name="email" type="email" maxlength="120"
               placeholder="Введите почту" required>
      </li>
    </ul>
    <button class="btn" type="submit">Сохранить изменения</button>
  </form>
</div>
@vite(['resources/js/profile.js'])
@vite(['resources/js/components/phone-mask.js'])
</body>