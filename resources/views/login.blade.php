@include('fragments/head', ['title' => 'Авторизация'])
<body class="body">
@include('fragments.meta')
@include('fragments.header')
<div class="container">
  <div class="breadcrumbs">
    <div class="breadcrumbs__top">
      <div class="breadcrumbs__item">
        <a class="breadcrumbs__link" href="{{route('index')}}">Главная</a>
      </div>
      <div class="breadcrumbs__item">
        <span>Вход в личный кабинет</span>
      </div>
    </div>
  </div>
</div>
<section class="auth">
  <div class="container">
    <div class="auth__content">
      <h1 class="auth__title title">Вход в профиль</h1>
      <p class="auth__text">Вы увидите историю заказов, будете иметь возможность оставлять отзывы и т.д.</p>
      <form id="formAuth" method="POST" action="{{ route('login') }}">
        @csrf
        <span class="error @if($errors->has('login')) error--active @endif" id="authError">
                    {{ $errors->first('login') ?? 'Неверно введен логин или пароль' }}
                </span>
        <ul class="auth__list">
          <li class="auth__item">
            <label class="label" for="login">Логин</label>
            <input class="input" name="login" id="login" type="text" placeholder="Введите логин"
                   value="{{ old('login') }}" required>
          </li>
          <li class="auth__item">
            <label class="label" for="password">Пароль</label>
            <input class="input" id="password" type="password" placeholder="Введите пароль" name="password"
                   value="{{ old('password') }}" required>
          </li>
        </ul>
        <span class="auth__link">
          Нет аккаунта? <a href="{{route('register')}}">Тогда зарегистрируйтесь</a>
        </span>
        <button class="auth__btn btn" id="loginBtn" type="submit">Войти</button>
      </form>
    </div>
    <div class="auth__decor"></div>
  </div>
</section>
@include('fragments/footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
