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
        Вы имеете доступ к админ-панели <br>
        Перейти в админ-панель
      </a>
    @endif
    <p class="profile__orders-empty">
      У вас ещё нет заказов
    </p>
  </div>
</section>
@vite(['resources/js/app.js'])
</body>