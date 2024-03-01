@include('fragments/head', ['title' => 'Управление отзывами магазина'])
<body class="body">
@include('fragments.header-admin')
<div class="container">
  <div class="breadcrumbs">
    <div class="breadcrumbs__top">
      <div class="breadcrumbs__item">
        <a class="breadcrumbs__link" href="{{route('admin.feedback-request')}}">Главная админ-панели</a>
      </div>
      <div class="breadcrumbs__item">
        <span>Управление одобренными отзывами магазина</span>
      </div>
    </div>
  </div>
  <a class="admin__link header__admin-link" href="{{route('admin.feedback-request')}}">Перейти на страницу не одобренных отзывов</a>
  <p class="admin__info">
    Данная страница - второй этап отзывов. Данные одобренные отзывы уже отображаются на странице о компании
    <br>
    <br>
    Отзыв можно удалить, но он будет удалён окончательно из БД
  </p>
  @if($approvedReviews->isEmpty())
    <p class="admin__empty">Текущих отзывов о магазине ещё не существует :(</p>
  @endif
  <ul class="admin__list">
    @foreach($approvedReviews as $review)
      <li class="admin__item">
        <div class="admin__actions">
          <button class="admin__action admin__delete" type="button" data-id="{{$review->id}}">
            Удалить отзыв
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
@vite(['resources/js/reviews/admin/delete-review.js'])
