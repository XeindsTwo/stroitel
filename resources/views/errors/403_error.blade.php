@include('fragments.head', ['title' => 'Ошибка доступа'])
<body class="body">
<section class="error-page indent">
    <img class="error-page__img error-page__img--one" src="{{asset('static/images/decor-one.svg')}}" alt="декор"
         width="425" height="270">
    <img class="error-page__img error-page__img--two" src="{{asset('static/images/decor-two.svg')}}" alt="декор"
         width="466" height="260">
    <div class="container">
        <div class="error-page__content">
            <h1 class="error-page__title">Доступ запрещен</h1>
            <p class="error-page__text">
                У вас нет необходимых прав для доступа к этой странице.
            </p>
            <a class="error-page__btn" href="{{asset(route('index'))}}">На главную</a>
        </div>
    </div>
</section>
@vite(['resources/js/app.js'])
</body>
