<header class="header">
  <div class="container">
    <nav class="header__nav">
      <a class="header__logo logo" href="/">
        <img src="{{asset('static/images/icons/logo-long.svg')}}" alt="">
      </a>
      <ul class="header__admin-list">
        <li>
          <a class="header__admin-link {{Route::currentRouteName() === 'admin.feedback-request' ? 'active' : '' }}"
             href="{{route('admin.feedback-request')}}">
            Управление онлайн-заявками
          </a>
        </li>
        <li>
          <a class="header__admin-link {{Route::currentRouteName() === 'admin.partnership-requests' ? 'active' : '' }}"
             href="{{route('admin.partnership-requests')}}">
            Управление заявлениями (партнёрство)
          </a>
        </li>
        <li>
          <a class="header__admin-link {{Route::currentRouteName() === 'admin.reviews' ? 'active' : '' }}"
             href="{{route('admin.reviews')}}">
            Управление отзывами магазина
          </a>
        </li>
      </ul>
    </nav>
  </div>
</header>
