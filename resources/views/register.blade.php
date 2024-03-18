@include('fragments/head', ['title' => 'Регистрация'])
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
        <span>Регистрация личного кабинета</span>
      </div>
    </div>
  </div>
</div>
<section class="auth">
  <div class="container">
    <div class="auth__content">
      <h1 class="auth__title title">Регистрация аккаунта</h1>
      <p class="auth__text">
        Вы можете зайти в личный кабинет или зарегистрироваться на сайте для легкого обращения с заказом
      </p>
      <form id="formAuth" method="POST" action="{{route('register')}}">
        @csrf
        <div id="responseMessage"></div>
        <ul class="auth__list">
          <li class="auth__item">
            <label class="label" for="login">Логин</label>
            <span class="error" id="loginError">Логин не должен иметь запрещенные символы</span>
            <span class="error" id="loginCheckError">Логин уже используется</span>
            <span class="error" id="loginLengthError">Минимальное количество символов - 5</span>
            <input class="input" id="login" type="text" name="login" maxlength="60" autocomplete="none" placeholder="Введите ваш логин">
          </li>
          <li class="auth__item">
            <label class="label" for="name">Имя</label>
            <span class="error" id="nameMinError">Мин. количество символов - 2</span>
            <span class="error" id="nameError">Имя не должно содержать запрещенные символы</span>
            <input class="input" id="name" type="text" name="name" maxlength="50" placeholder="Введите ваше имя"
                   value="{{ old('name') }}">
          </li>
          <li class="auth__item">
            <label class="label" for="email">Email</label>
            <span class="error" id="emailError">Почта уже используется</span>
            <span class="error" id="emailErrorParameters">Почта не соответствует параметрам</span>
            <input class="input" id="email" type="email" name="email" maxlength="80" placeholder="Введите ваш email"
                   value="{{ old('email') }}">
          </li>
          <li class="auth__item">
            <label class="label" for="password">Пароль</label>
            <span class="error" id="passwordError">
              Пароль может содержать только латинские буквы, цифры и нижнее подчеркивание
            </span>
            <span class="error" id="passwordLengthError">Минимальное количество символов - 8</span>
            <input class="input" id="password" type="password" autocomplete="new-password" placeholder="Введите пароль" maxlength="60" name="password">
          </li>
        </ul>
        <span class="auth__link">Есть аккаунт? <a href="{{route('login')}}">Тогда войдите в аккаунт</a></span>
        <button class="auth__btn btn" id="registration-btn" type="submit">Зарегистрироваться</button>
      </form>
    </div>
  </div>
</section>
@include('fragments/footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@vite(['resources/js/register.js'])
</body>
