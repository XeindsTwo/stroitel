@include('fragments/head', ['title' => 'Личный кабинет'])
<body class="body">
@include('fragments.meta')
@include('fragments.header')
<section class="profile">
  <div class="container">
    <h1 class="title">Здравствуйте, {{$user->name}}</h1>
    @if($user->role === 'ADMIN')
      <div class="profile__admin">
        Вы имеете доступ к админ-панели
        <a class="profile__link" href="{{ route('admin.partnership-requests') }}">Перейти в админ-панель</a>
      </div>
    @endif
  </div>
</section>
@vite(['resources/js/app.js'])
</body>