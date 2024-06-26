@include('fragments/head', ['title' => 'Страница не найдена'])
<body class="body">
@include('fragments.meta')
@include('fragments.header')
<section class="error-page indent">
  <img class="error-page__img error-page__img--one" src="{{asset('static/images/decor-one.svg')}}" alt="декор"
       width="425" height="270">
  <img class="error-page__img error-page__img--two" src="{{asset('static/images/decor-two.svg')}}" alt="декор"
       width="466" height="260">
  <div class="container">
    <div class="error-page__content">
      <h1 class="error-page__title">Страница не найдена</h1>
      <p class="error-page__text">
        Возможно, она удалена или был введен неправильный адрес
      </p>
      <a class="btn" href="{{asset(route('index'))}}">На главную</a>
    </div>
  </div>
</section>
</body>