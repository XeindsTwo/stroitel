@include('fragments/head', ['title' => 'Услуги магазина'])
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
        <span class="breadcrumbs__link breadcrumbs__link--inactive">Услуги</span>
      </div>
    </div>
  </div>
</div>
<section class="uslugi">
  <div class="container">
    <h1 class="uslugi__title title">Услуги магазина</h1>
    <ul class="uslugi__list">
      <li class="uslugi__item">
        <a class="uslugi__link" href="{{route('services.strojmateriali')}}">Доставка строительных материалов</a>
        <img
            class="uslugi__img"
            src="{{asset('static/images/uslugi/3.png')}}"
            width="220" height="170"
            alt="Распил"
        >
        <p class="uslugi__text">Укажите адрес доставки и параметры вашего заказа</p>
        <a class="uslugi__more" href="{{route('services.strojmateriali')}}">
          <svg class="svg_icon" viewBox="0 0 8 14" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M7.9882 6.99869C7.9882 7.2496 7.8924 7.50048 7.7012 7.69177L1.68146 13.7115C1.29853 14.0944 0.67767 14.0944 0.294894 13.7115C-0.0878814 13.3287 -0.0878814 12.708 0.294894 12.325L5.6215 6.99869L0.29508 1.67237C-0.0876953 1.28944 -0.0876953 0.668769 0.29508 0.286024C0.677856 -0.0970926 1.29871 -0.0970926 1.68164 0.286024L7.70139 6.30561C7.89262 6.497 7.9882 6.74788 7.9882 6.99869Z"></path>
          </svg>
          Подробнее
        </a>
      </li>
      <li class="uslugi__item">
        <a class="uslugi__link" href="{{route('services.raspil')}}">Распил</a>
        <img
            class="uslugi__img"
            src="{{asset('static/images/uslugi/2.png')}}"
            width="220" height="170"
            alt="Распил"
        >
        <p class="uslugi__text">Заказать распил строительных материалов</p>
        <a class="uslugi__more" href="{{route('services.raspil')}}">
          <svg class="svg_icon" viewBox="0 0 8 14" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M7.9882 6.99869C7.9882 7.2496 7.8924 7.50048 7.7012 7.69177L1.68146 13.7115C1.29853 14.0944 0.67767 14.0944 0.294894 13.7115C-0.0878814 13.3287 -0.0878814 12.708 0.294894 12.325L5.6215 6.99869L0.29508 1.67237C-0.0876953 1.28944 -0.0876953 0.668769 0.29508 0.286024C0.677856 -0.0970926 1.29871 -0.0970926 1.68164 0.286024L7.70139 6.30561C7.89262 6.497 7.9882 6.74788 7.9882 6.99869Z"></path>
          </svg>
          Подробнее
        </a>
      </li>
      <li class="uslugi__item">
        <a class="uslugi__link" href="{{route('services.coloring')}}">Колеровка декоративных штукатурок и красок</a>
        <img
            class="uslugi__img"
            src="{{asset('static/images/uslugi/1.png')}}"
            width="220" height="170"
            alt="Колеровка декоративных штукатурок и красок"
        >
        <p class="uslugi__text">Окраска по каталогу RAL в любой цвет</p>
        <a class="uslugi__more" href="{{route('services.coloring')}}">
          <svg class="svg_icon" viewBox="0 0 8 14" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M7.9882 6.99869C7.9882 7.2496 7.8924 7.50048 7.7012 7.69177L1.68146 13.7115C1.29853 14.0944 0.67767 14.0944 0.294894 13.7115C-0.0878814 13.3287 -0.0878814 12.708 0.294894 12.325L5.6215 6.99869L0.29508 1.67237C-0.0876953 1.28944 -0.0876953 0.668769 0.29508 0.286024C0.677856 -0.0970926 1.29871 -0.0970926 1.68164 0.286024L7.70139 6.30561C7.89262 6.497 7.9882 6.74788 7.9882 6.99869Z"></path>
          </svg>
          Подробнее
        </a>
      </li>
    </ul>
  </div>
</section>
@include('fragments.footer')
</body>