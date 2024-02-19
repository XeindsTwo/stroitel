@include('fragments/head', ['title' => 'Регистрация'])
<body class="body">
<section class="auth">
    <div class="container">
        <div class="auth__content">
            <a class="auth__logo logo" href="/">
                <img class="logo" width="166" height="32" src="{{asset('static/images/icons/logo.svg')}}"
                     alt="логотип">
            </a>
            <a class="auth__back" href="/">
                <svg width="22" height="12" viewBox="0 0 22 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.292786 6.69471C0.105315 6.50718 0 6.25288 0 5.98771C0 5.72255 0.105315 5.46824 0.292786 5.28071L5.29279 0.280712C5.48139 0.0985542 5.73399 -0.00224062 5.99619 3.78025e-05C6.25838 0.00231622 6.5092 0.107485 6.6946 0.292894C6.88001 0.478302 6.98518 0.729114 6.98746 0.991311C6.98974 1.25351 6.88894 1.50611 6.70679 1.69471L3.41379 4.98771H20.9998C21.265 4.98771 21.5194 5.09307 21.7069 5.28061C21.8944 5.46814 21.9998 5.7225 21.9998 5.98771C21.9998 6.25293 21.8944 6.50728 21.7069 6.69482C21.5194 6.88235 21.265 6.98771 20.9998 6.98771H3.41379L6.70679 10.2807C6.8023 10.373 6.87848 10.4833 6.93089 10.6053C6.9833 10.7273 7.01088 10.8585 7.01204 10.9913C7.01319 11.1241 6.98789 11.2558 6.93761 11.3787C6.88733 11.5016 6.81307 11.6132 6.71918 11.7071C6.62529 11.801 6.51364 11.8753 6.39074 11.9255C6.26784 11.9758 6.13616 12.0011 6.00339 12C5.87061 11.9988 5.73939 11.9712 5.61738 11.9188C5.49538 11.8664 5.38503 11.7902 5.29279 11.6947L0.292786 6.69471Z"
                          fill="#4E1528"/>
                </svg>
                Вернуться на главную
            </a>
            <h2 class="auth__title">Регистрация профиля</h2>
            <form id="formAuth" method="POST" action="{{route('register')}}">
                @csrf
                <ul class="auth__list">
                    <li class="auth__item">
                        <label class="label" for="login">Логин</label>
                        <span class="error" id="loginError">Логин не должен иметь запрещенные символы</span>
                        <span class="error" id="loginCheckError">Логин уже используется</span>
                        <span class="error" id="loginLengthError">Минимальное количество символов - 5</span>
                        <span class="error" id="loginMaxError">Максимальное количество символов - 60</span>
                        <input class="input" id="login" type="text" name="login" placeholder="Введите ваш логин">
                    </li>
                    <li class="auth__item">
                        <label class="label" for="name">Имя</label>
                        <span class="error" id="nameMinError">Мин. количество символов - 2</span>
                        <span class="error" id="nameMaxError">Макс. количество символов - 50</span>
                        <span class="error" id="nameError">Имя не должно содержать запрещенные символы</span>
                        <input class="input" id="name" type="text" name="name" placeholder="Введите ваше имя"
                               value="{{ old('name') }}">
                    </li>
                    <li class="auth__item">
                        <label class="label" for="email">Email</label>
                        <span class="error" id="emailError">Почта уже используется</span>
                        <span class="error" id="emailErrorParameters">Почта не соответствует параметрам</span>
                        <span class="error" id="emailLengthError">Макс. количество символов - 80</span>
                        <input class="input" id="email" type="email" name="email" placeholder="Введите ваш email"
                               value="{{ old('email') }}">
                    </li>
                    <li class="auth__item">
                        <label class="label" for="password">Пароль</label>
                        <span class="error" id="passwordError">Пароль не должен иметь кириллицу</span>
                        <span class="error" id="passwordLengthError">Минимальное количество символов - 8</span>
                        <span class="error" id="passwordMaxError">Максимальное количество символов - 60</span>
                        <input class="input" id="password" type="password" placeholder="Введите пароль" name="password">
                    </li>
                    <li class="auth__item">
                        <label class="label" for="captcha">Введите капчу</label>
                        <div class="auth__head">
                            <img class="auth__captcha" id="captchaImage" src="{{ route('generate-captcha') }}"
                                 alt="captcha">
                            <button class="auth__refresh" id="refreshCaptcha" type="button">
                                <svg width="25" height="26" viewBox="0 0 25 26" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.6416 10.6084C3.25274 8.32764 4.63581 6.3293 6.55515 4.95392C8.4745 3.57854 10.8114 2.91121 13.1676 3.06564C15.5238 3.22008 17.7535 4.18672 19.4769 5.80086C21.2003 7.41499 22.3107 9.57676 22.6189 11.9178C22.9271 14.2589 22.4141 16.6344 21.1672 18.6396C19.9203 20.6448 18.0167 22.1556 15.7807 22.9146C13.5448 23.6736 11.1148 23.6338 8.90491 22.802C6.69499 21.9703 4.84184 20.398 3.66121 18.3531"
                                          stroke="#242424" stroke-width="1.3" stroke-linejoin="round"/>
                                    <path d="M0.973025 5.76904L2.29381 10.6983L7.22302 9.37748" stroke="#242424"
                                          stroke-width="1.3" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                        <span class="error" id="captchaError">Капча была введена неверно, попробуйте снова</span>
                        <input class="input" id="captcha" name="captcha" type="text" placeholder="Введите капчу"
                               required>
                    </li>
                </ul>
                <span class="auth__link">
                    Есть аккаунт? <a href="{{route('login')}}">Войти</a>
                </span>
                <button class="auth__btn" id="registration-btn" type="submit">Зарегистрироваться</button>
            </form>
        </div>
        <div class="auth__decor"></div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@vite(['resources/js/register.js'])
@vite(['resources/js/captcha.js'])
</body>
