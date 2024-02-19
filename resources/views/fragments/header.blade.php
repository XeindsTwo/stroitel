<header class="header">
    <div class="container">
        <div class="header__inner">
            <a href="/" class="logo">
                <img src="{{asset('static/images/icons/logo.svg')}}" alt="">
            </a>
            <nav class="header__nav">
                <ul class="header__list">
                    <li>
                        <a class="header__link" href="#services">Услуги</a>
                    </li>
                    <li>
                        <a class="header__link" href="#benefits">Премущества</a>
                    </li>
                    <li>
                        <a class="header__link" href="#faq">FAQ</a>
                    </li>
                    <li>
                        <button class="header__link" id="btn-contact" type="button">Контакты</button>
                    </li>
                </ul>
            </nav>
            @if(Auth::check())
                <div class="header__auth">
                    <div class="header__balance">
                        <span>10 200,22 ₽</span>
                        <a class="header__btn-balance btn" href="">Пополнить</a>
                    </div>
                    <div class="header__actions">
                        <a class="header__action header__profile" href="">
                            <img src="{{asset('static/images/avatar.png')}}" width="44" height="44" alt="аватар">
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="header__action header__logout" type="submit">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M6.5 16.5H3.16667C2.72464 16.5 2.30072 16.3244 1.98816 16.0118C1.67559 15.6993 1.5 15.2754 1.5 14.8333V3.16667C1.5 2.72464 1.67559 2.30072 1.98816 1.98816C2.30072 1.67559 2.72464 1.5 3.16667 1.5H6.5M12.3333 13.1667L16.5 9M16.5 9L12.3333 4.83333M16.5 9H6.5"
                                        stroke="#FE4F4F" stroke-width="1.67" stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <button class="header__btn btn" id="btn-auth" type="button">Войти</button>
            @endif
        </div>
    </div>
</header>
