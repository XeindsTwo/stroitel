@include('fragments/head', ['title' => 'Личный кабинет'])
<body class="body">
@include('fragments.meta')
@include('fragments.header')
<section class="profile">
  <div class="container">
    <h1 class="title">Здравствуйте, {{$user->name}}</h1>
      <form action="{{route('logout')}}" method="post">
          @csrf
          <button class="profile__logout" type="submit">Выйти из аккаунта</button>
      </form>
    @if($user->role === 'ADMIN')
      <div class="profile__admin">
        Вы имеете доступ к админ-панели
        <a class="profile__link" href="{{ route('admin.feedback-request') }}">Перейти в админ-панель</a>
      </div>
    @endif
  </div>
</section>
@include('fragments/footer')
@vite(['resources/js/app.js'])
</body>
