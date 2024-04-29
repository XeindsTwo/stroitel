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
        <span>Управление онлайн-заявками</span>
      </div>
    </div>
  </div>

  @if($feedbackRequests->isEmpty())
    <p class="admin__empty">Онлайн-заявок на данный момент нет :(</p>
  @endif
  <ul class="admin__list">
    @foreach($feedbackRequests as $feedback)
      <li class="admin__item">
        <div class="admin__actions">
          <button class="admin__action admin__delete" type="button" data-id="{{$feedback->id}}">
            Удалить заявку
          </button>
        </div>
        <p>Время создания - {{ \Carbon\Carbon::parse($feedback->created_at)->format('d M Y') }}</p>
        <p>Имя - {{ $feedback->name_feedback }}</p>
        <p>Email - <a class="admin__item-link" href="mailto:{{ $feedback->email_feedback }}">{{ $feedback->email_feedback }}</a></p>
        <p>Телефон - <a class="admin__item-link" href="tel:{{ $feedback->phone_feedback }}">{{ $feedback->phone_feedback }}</a></p>
        @if($feedback->comment_feedback)
          <p>Комментарий: {{ $feedback->comment_feedback }}</p>
        @endif
        @if($feedback->file_path)
          <p>
            Файл: <a class="admin__item-link" href="{{ asset('storage/' . $feedback->file_path) }}" target="_blank">скачать документ</a>
          </p>
        @endif
      </li>
    @endforeach
  </ul>
</div>
</body>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const deleteButtons = document.querySelectorAll('.admin__delete');

    deleteButtons.forEach(button => {
      button.addEventListener('click', async () => {
        const id = button.dataset.id;
        const confirmed = confirm('Вы уверены, что хотите удалить эту заявку? Удаление отменить будет невозможно');

        if (!confirmed) {
          return;
        }

        try {
          const response = await fetch(`/admin/feedback-requests/${id}`, {
            method: 'DELETE',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': '{{ csrf_token() }}',
            }
          });

          if (response.ok) {
            const data = await response.json();
            console.log(data.message);
            button.closest('.admin__item').remove();
          } else {
            throw new Error('Ошибка при удалении заявки');
          }
        } catch (error) {
          console.error(error.message);
          alert(error.message);
        }
      });
    });
  });
</script>