<header class="header">
  <div class="container">
    <div class="header__inner">
      <a href="/" class="logo">
        <img src="{{asset('static/images/icons/logo-long.svg')}}" alt="логотип компании">
      </a>
      <div class="header__delivery">
        <button class="header__select" type="button">Выберите ваш город (Белореченск)</button>
        <span class="header__address">г. Белореченск, ул. Полевая, д. 16</span>
      </div>
      <a class="header__call" href="mailto:zakaz@diseased.com">
        zakaz@diseased.com
      </a>
      <div class="header__feedback">
        <a class="header__call" href="tel:+73450982212">+7 (345) 098-22-12</a>
        <span>Отдел продаж</span>
      </div>
    </div>
    <nav class="header__nav">
      <ul class="header__list">
        <li>
          <a class="header__catalog btn" href="">
            <svg width="15" height="12" viewBox="0 0 15 12" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                  d="M13.9172 0H0.852071C0.381485 0 0 0.383756 0 0.857143C0 1.33053 0.381485 1.71429 0.852071 1.71429H13.9172C14.3877 1.71429 14.7692 1.33053 14.7692 0.857143C14.7692 0.383756 14.3877 0 13.9172 0Z"
                  fill="white"/>
              <path
                  d="M13.9172 5.1427H0.852071C0.381485 5.1427 0 5.52646 0 5.99984C0 6.47323 0.381485 6.85699 0.852071 6.85699H13.9172C14.3877 6.85699 14.7692 6.47323 14.7692 5.99984C14.7692 5.52646 14.3877 5.1427 13.9172 5.1427Z"
                  fill="white"/>
              <path
                  d="M13.9172 10.2858H0.852071C0.381485 10.2858 0 10.6695 0 11.1429C0 11.6163 0.381485 12.0001 0.852071 12.0001H13.9172C14.3877 12.0001 14.7692 11.6163 14.7692 11.1429C14.7692 10.6695 14.3877 10.2858 13.9172 10.2858Z"
                  fill="white"/>
            </svg>
            Каталог
          </a>
        </li>
        <li>
          <a class="header__link" href="{{route('about')}}">О компании</a>
        </li>
        <li>
          <a class="header__link" href="">Акции</a>
        </li>
        <li>
          <a class="header__link" href="{{route('partneram')}}">Партнерам</a>
        </li>
        <li>
          <a class="header__link" href="">Статьи и новости</a>
        </li>
        <li>
          <a class="header__link" href="{{route('contacts')}}">Контакты</a>
        </li>
        <li>
          @if(Auth::check())
            <a class="header__link" href="{{route('profile')}}">Личный кабинет</a>
          @else
            <a class="header__link" href="{{route('login')}}">Личный кабинет</a>
          @endif
        </li>
      </ul>
    </nav>
  </div>
</header>
