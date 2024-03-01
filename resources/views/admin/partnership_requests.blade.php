@include('fragments/head', ['title' => 'Управление заявлениями партнеров'])
<body class="body">
@include('fragments.header-admin')
<div class="container">
  <div class="breadcrumbs">
    <div class="breadcrumbs__top">
      <div class="breadcrumbs__item">
        <a class="breadcrumbs__link" href="{{route('admin.feedback-request')}}">Главная админ-панели</a>
      </div>
      <div class="breadcrumbs__item">
        <span>Управление заявлениями партнеров</span>
      </div>
    </div>
  </div>
  @if($requests->isEmpty())
    <p class="admin__empty">Заявлений от партнеров ещё не существует :(</p>
  @endif
  <ul class="admin__list">
    @foreach($requests as $request)
      <li class="admin__item">
        <div class="admin__actions">
          <button class="admin__action admin__delete" type="button" data-id="{{ $request->id }}"
                  onclick="deleteRequest(this)">
            Удалить заявление
          </button>
        </div>
        <p>Имя: {{ $request->organization_name }}</p>
        <p>Email: <a class="admin__item-link" href="mailto:{{ $request->email }}">{{ $request->email }}</a></p>
        <p>Телефон: <a class="admin__item-link" href="tel:{{ $request->phone }}">{{ $request->phone }}</a></p>
        @if($request->comment)
          <pre class="admin__pre">{{ $request->comment }}</pre>
        @endif
      </li>
    @endforeach
  </ul>
</div>
</body>

<script>
  function deleteRequest(button) {
    const requestId = button.getAttribute('data-id');
    if (confirm('Вы уверены, что хотите удалить это заявление? Отменить удаление будет невозможно')) {
      fetch(`/admin/partnership-requests/${requestId}`, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        }
      })
        .then(response => {
          if (!response.ok) {
            throw new Error('Ошибка при удалении заявления');
          }
          return response.json();
        })
        .then(data => {
          alert(data.message);
          const listItem = button.closest('.admin__item');
          listItem.remove();
        })
        .catch(error => {
          console.error('Ошибка:', error);
          alert('Произошла ошибка. Попробуйте еще раз.');
        });
    }
  }
</script>