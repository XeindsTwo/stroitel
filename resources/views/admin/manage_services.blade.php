@include('fragments/head', ['title' => 'Управление заявками на услуги магазина'])
<body class="body">
@include('fragments.header-admin')
<div class="container">
  <div class="breadcrumbs">
    <div class="breadcrumbs__top">
      <div class="breadcrumbs__item">
        <a class="breadcrumbs__link" href="{{route('admin.feedback-request')}}">Главная админ-панели</a>
      </div>
      <div class="breadcrumbs__item">
        <span>Управление заявками на услуги магазина</span>
      </div>
    </div>
  </div>
</div>
<section>
  <div class="container">
    @if($services->isEmpty())
      <p class="admin__empty">Заявок на услуги ещё не существует :(</p>
    @else
      <div class="admin__select">
        Сортировать:
        <select class="input" id="serviceTypeFilter">
          <option value="">Все</option>
          @foreach($serviceTypes as $type)
            <option value="{{ $type }}">{{ $type }}</option>
          @endforeach
        </select>
      </div>
    @endif
    <ul class="admin__list two">
      @foreach($services as $service)
        <li class="admin__item" data-service-type="{{$service->service_type}}">
          <div class="admin__actions">
            <button
                class="admin__action admin__delete" type="button"
                data-id="{{$service->id}}"
            >
              Удалить заявку
            </button>
          </div>
          <p>Время создания - {{\Carbon\Carbon::parse($service->created_at)->format('d M Y')}}</p>
          <p>Имя: {{$service->name}}</p>
          <p>Email: <a class="admin__item-link" href="mailto:{{$service->email}}">{{$service->email}}</a></p>
          <p>Телефон: <a class="admin__item-link" href="tel:{{$service->phone}}">{{$service->phone}}</a></p>
          @if($service->question)
            <pre class="admin__pre">{{$service->question}}</pre>
          @endif
          <p class="admin__service">Услуга: {{$service->service_type}}</p>
        </li>
      @endforeach
    </ul>
  </div>
</section>
</body>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const serviceTypeFilter = document.getElementById('serviceTypeFilter');
    const adminItems = document.querySelectorAll('.admin__item');

    serviceTypeFilter.addEventListener('change', function () {
      const selectedType = serviceTypeFilter.value;
      adminItems.forEach(function (item) {
        const itemType = item.dataset.serviceType;
        if (selectedType === '' || selectedType === itemType) {
          item.style.display = 'flex';
        } else {
          item.style.display = 'none';
        }
      });
    });
  });
</script>
<script>
  const serviceTypeFilter = document.getElementById('serviceTypeFilter');
  const adminItems = document.querySelectorAll('.admin__item');

  serviceTypeFilter.addEventListener('change', function () {
    const selectedType = serviceTypeFilter.value;
    adminItems.forEach(function (item) {
      const itemType = item.dataset.serviceType;
      if (selectedType === '' || selectedType === itemType) {
        item.style.display = 'flex';
      } else {
        item.style.display = 'none';
      }
    });
  });

  document.querySelectorAll('.admin__delete').forEach(function (button) {
    button.addEventListener('click', function () {
      const requestId = button.getAttribute('data-id');
      if (confirm('Вы уверены, что хотите удалить эту заявку? Отменить удаление будет невозможно')) {
        fetch(`/admin/services/${requestId}`, {
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          }
        })
          .then(response => {
            if (!response.ok) {
              throw new Error('Ошибка при удалении заявки');
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
    });
  });
</script>