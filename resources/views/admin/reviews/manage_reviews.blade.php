@include('fragments.head', ['title' => 'Управление отзывами магазина'])
<body class="body">
@include('fragments.header-admin')
<div class="container">
  <div class="breadcrumbs">
    <div class="breadcrumbs__top">
      <div class="breadcrumbs__item">
        <a class="breadcrumbs__link" href="{{route('admin.feedback-request')}}">Главная админ-панели</a>
      </div>
      <div class="breadcrumbs__item">
        <span>Управление не одобренными отзывами магазина</span>
      </div>
    </div>
  </div>
  <a class="admin__link header__admin-link" href="{{route('admin.reviews.approved')}}">
    Перейти на страницу одобренных отзывов
  </a>
  <p class="admin__info">
    Данная страница - лишь первый этап по отзывам. Здесь можно либо одобрить отзыв, либо отклонить его
    <br>
    <br>
    Если отклонить отзыв, то отзыв безвозвратно будет удалён из БД
    <br>
    <br>
    Если отзыв одобрить, то он будет отображаться на <a href="{{route('reviews')}}">странице компании</a>.
    Но его можно будет удалить в будущем
  </p>
  @if($unapprovedReviews->isEmpty())
    <p class="admin__empty">Отзывов о магазине ещё не существует :(</p>
  @endif
  <ul class="admin__list">
    @foreach($unapprovedReviews as $review)
      <li class="admin__item">
        <div class="admin__actions">
          <button class="admin__action admin__delete" type="button" data-id="{{$review->id}}">
            Отклонить отзыв
          </button>
          <button class="admin__action admin__confirm" type="button" data-id="{{$review->id}}">
            Одобрить отзыв
          </button>
        </div>
        <p class="admin__rating">
          Рейтинг - <span class="company-reviews__rating">{{$review->rating}}</span>
        </p>
        <p>Имя: {{ $review->name }}</p>
        <p>Почта: {{ $review->email }}</p>
        <p>{{ $review->comment }}</p>
      </li>
    @endforeach
  </ul>
</div>
</body>
@vite(['resources/js/reviews/generate-stars.js'])
@vite(['resources/js/reviews/admin/reject-review.js'])
@vite(['resources/js/reviews/admin/approve-review.js'])