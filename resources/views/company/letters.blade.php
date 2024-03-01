@include('fragments/head', ['title' => 'Благодарственные письма'])
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css">
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
        <a class="breadcrumbs__link" href="{{route('about')}}">О компании</a>
      </div>
      <div class="breadcrumbs__item">
        <span>Благодарственные письма</span>
      </div>
    </div>
  </div>
</div>
<section class="company">
  <div class="container">
    <div class="company__inner">
      @include('company.components.aside')
      <div class="company__content company--left">
        <h1 class="company-letters__title title">Благодарственные письма</h1>
        <ul class="company-letters__list">
          <li>
            <img class="company-letters__img" src="{{ asset('static/images/letters/1.jpg') }}" alt="" width="320" height="420">
            <span class="company-letters__name">Письмо от ООО «Рувир»</span>
            <a class="company-letters__link" href="{{ asset('static/images/letters/1.jpg') }}"
               data-fancybox="gallery">Смотреть</a>
          </li>
          <li>
            <img class="company-letters__img" src="{{ asset('static/images/letters/2.jpg') }}" alt="" width="320" height="420">
            <span class="company-letters__name">Письмо АО «ПРОКС-ТМ»</span>
            <a class="company-letters__link" href="{{ asset('static/images/letters/2.jpg') }}"
               data-fancybox="gallery">Смотреть</a>
          </li>
          <li>
            <img class="company-letters__img" src="{{ asset('static/images/letters/3.jpg') }}" alt="" width="320" height="420">
            <span class="company-letters__name">Письмо от Klever Lab</span>
            <a class="company-letters__link" href="{{ asset('static/images/letters/3.jpg') }}"
               data-fancybox="gallery">Смотреть</a>
          </li>
          <li>
            <img class="company-letters__img" src="{{ asset('static/images/letters/4.jpg') }}" alt="" width="320" height="420">
            <span class="company-letters__name">Письмо от ООО «АЛИЧЕ»</span>
            <a class="company-letters__link" href="{{ asset('static/images/letters/4.jpg') }}"
               data-fancybox="gallery">Смотреть</a>
          </li>
          <li>
            <img class="company-letters__img" src="{{ asset('static/images/letters/5.jpg') }}" alt="" width="320" height="420">
            <span class="company-letters__name">Письмо от «Е3 Awards»</span>
            <a class="company-letters__link" href="{{ asset('static/images/letters/5.jpg') }}"
               data-fancybox="gallery">Смотреть</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>
@include('fragments.footer')
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
  Fancybox.bind("[data-fancybox]", {});
</script>
</body>