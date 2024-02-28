@include('fragments/head', ['title' => 'Оплата и доставка'])
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
        <span>Отзывы о компании</span>
      </div>
    </div>
  </div>
</div>
<section class="company">
  <div class="container">
    <div class="company__inner {{$reviews->isEmpty() ? 'no-reviews' : ''}}">
      @include('company.components.aside')
      <div class="company__content company--left">
        <h1 class="company-reviews__title title">Отзывы о компании</h1>
        @if($reviews->isEmpty())
          <p class="company-reviews__empty">¯\_(ツ)_/¯, кто-то украл все наши отзывы</p>
        @else
          <ul class="company-reviews__list">
            @foreach ($reviews as $review)
              <li class="company-reviews__item">
                <div class="company-reviews__head">
                  <span class="company-reviews__name">
                    {{$review->name}}
                  </span>
                  <span class="company-reviews__rating">
                    {{$review->rating}}
                  </span>
                </div>
                <p class="company-reviews__text">
                  {{ $review->comment }}
                </p>
                <time class="company-reviews__date" datetime="{{ $review->created_at->format('Y-m-d') }}">
                  {{ $review->created_at->format('d.m.Y') }}
                </time>
              </li>
            @endforeach
          </ul>
        @endif
        <form class="company-reviews__form" id="reviewForm" method="post" action="{{ route('send_review') }}">
          @csrf
          <div class="company-reviews__cells">
            <div class="company-reviews__left">
              <div class="company-reviews__cell">
                <label class="label label--big" for="name">Как вас зовут?</label>
                <input class="input input--white" type="text" id="name" name="name"
                       placeholder="Введите своё имя"
                       required pattern="[А-Яа-яЁё\s\-]+"
                       maxlength="255"
                       title="Пожалуйста, используйте только кириллицу, пробелы и дефисы"
                >
              </div>
              <div class="company-reviews__cell">
                <label class="label label--big" for="email">Ваш email</label>
                <input class="input input--white" type="email" id="email" name="email" placeholder="Введите свой email"
                       required maxlength="255">
              </div>
              <div class="company-reviews__cell company-reviews__cell--small">
                <label class="label label--big" for="rating">Ваш рейтинг продукции</label>
                <div class="star-rating">
                  <span class="star" data-value="1">&#9733;</span>
                  <span class="star" data-value="2">&#9733;</span>
                  <span class="star" data-value="3">&#9733;</span>
                  <span class="star" data-value="4">&#9733;</span>
                  <span class="star" data-value="5">&#9733;</span>
                  <input type="hidden" name="rating" id="rating" value="5">
                </div>
              </div>
              <span
                  class="company-reviews__today">Дата написания: {{ \Carbon\Carbon::now()->timezone('Europe/Moscow')->format('d.m.Y') }}</span>
            </div>
            <div class="company-reviews__cell">
              <label class="label label--big" for="comment">Ваш комментарий, вопрос или отзыв:</label>
              <textarea class="input input--textarea input--nonheight input--white" id="comment" name="comment"
                        placeholder="Сюда вы можете написать любой комментарий, задать вопрос или оставить отзыв на товар. После модерации, наши администраторы опубликуют и ответят вам"
                        required maxlength="2000"></textarea>
              <button class="company-reviews__btn btn" type="submit">Отправить</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@include('fragments.footer')
</body>
@vite(['resources/js/reviews/form-submit.js'])
@vite(['resources/js/reviews/generate-stars.js'])
@vite(['resources/js/reviews/star-rating.js'])