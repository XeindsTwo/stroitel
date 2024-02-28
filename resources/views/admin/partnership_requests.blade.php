@include('fragments/head', ['title' => 'Управление заявлениями партнеров'])
<body class="body">
@include('fragments.header-admin')
<div class="container">
  <div class="breadcrumbs">
    <div class="breadcrumbs__top">
      <div class="breadcrumbs__item">
        <a class="breadcrumbs__link" href="{{route('admin.partnership-requests')}}">Главная админ-панели</a>
      </div>
      <div class="breadcrumbs__item">
        <span>Управление заявлениями партнеров</span>
      </div>
    </div>
  </div>
  @if($requests->isEmpty())
    <p class="admin__empty">Заявления от партнеров ещё не существует</p>
  @endif
  <ul class="admin__list">
    @foreach($requests as $request)
      <li class="admin__item">
        <button class="admin__delete" type="button">Удалить заявление</button>
        <p>Имя: {{ $request->organization_name }}</p>
        <p>Email: <a class="admin__item-link" href="mailto:{{ $request->email }}">{{ $request->email }}</a></p>
        <p>Телефон: <a class="admin__item-link" href="tel:{{ $request->phone }}">{{ $request->phone }}</a></p>
        <p>{{ $request->comment }}</p>
      </li>
    @endforeach
  </ul>
</div>
</body>