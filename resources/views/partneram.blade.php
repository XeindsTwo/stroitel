@include('fragments/head', ['title' => 'Партнерам компании Diseased'])
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
        <span>Партнерам компании ПСП</span>
      </div>
    </div>
  </div>
</div>
<section class="partneram">
  <div class="container">
    <div class="partneram__top">
      <h1 class="partneram__title title">Партнерам нашей компании</h1>
      <p class="partneram__top-text">
        Лучшим доказательством успешности компании является портфель ее клиентов
      </p>
    </div>
  </div>
  <div class="partneram__inner">
    <div class="container">
      <span class="title">Более 1500 клиентов уже выбрали нас</span>
      <p class="partneram__text">
        от небольшого бизнеса до крупных федеральных компаний
      </p>
      <ul class="partneram__numbers">
        <li class="partneram__number">
          <span class="partneram__digital">70%</span>
          <span class="partneram__subtext">
            B2B
          </span>
        </li>
        <li class="partneram__number">
          <span class="partneram__digital">23%</span>
          <span class="partneram__subtext">
            B2G государственный сектор
          </span>
        </li>
        <li class="partneram__number">
          <span class="partneram__digital">7%</span>
          <span class="partneram__subtext">
            Малый бизнес и частные лица
          </span>
        </li>
        <li class="partneram__number">
          <span class="partneram__digital">100+</span>
          <span class="partneram__subtext">
            Торговых баз в СЗФО
          </span>
        </li>
        <li class="partneram__number">
          <span class="partneram__digital">27%</span>
          <span class="partneram__subtext">
            Компаний пришли к нам по рекомендациям
          </span>
        </li>
        <li class="partneram__number">
          <span class="partneram__digital">10 лет</span>
          <span class="partneram__subtext">
            Каждый третий клиент сотрудничает с нами более 10 лет
          </span>
        </li>
      </ul>
      <ul class="partneram__logos">
        <li class="partneram__logo">
          <img src="{{asset('static/images/logos-company/1.png')}}" alt="">
        </li>
        <li class="partneram__logo">
          <img src="{{asset('static/images/logos-company/2.jpg')}}" alt="">
        </li>
        <li class="partneram__logo">
          <img src="{{asset('static/images/logos-company/3.png')}}" alt="">
        </li>
        <li class="partneram__logo">
          <img src="{{asset('static/images/logos-company/4.png')}}" alt="">
        </li>
        <li class="partneram__logo">
          <img src="{{asset('static/images/logos-company/5.png')}}" alt="">
        </li>
        <li class="partneram__logo">
          <img src="{{asset('static/images/logos-company/6.png')}}" alt="">
        </li>
        <li class="partneram__logo">
          <img src="{{asset('static/images/logos-company/7.png')}}" alt="">
        </li>
        <li class="partneram__logo">
          <img src="{{asset('static/images/logos-company/8.png')}}" alt="">
        </li>
        <li class="partneram__logo">
          <img src="{{asset('static/images/logos-company/9.png')}}" alt="">
        </li>
        <li class="partneram__logo">
          <img src="{{asset('static/images/logos-company/10.png')}}" alt="">
        </li>
        <li class="partneram__logo">
          <img src="{{asset('static/images/logos-company/11.png')}}" alt="">
        </li>
        <li class="partneram__logo">
          <img src="{{asset('static/images/logos-company/12.png')}}" alt="">
        </li>
        <li class="partneram__logo">
          <img src="{{asset('static/images/logos-company/13.png')}}" alt="">
        </li>
        <li class="partneram__logo">
          <img src="{{asset('static/images/logos-company/14.png')}}" alt="">
        </li>
        <li class="partneram__logo">
          <img src="{{asset('static/images/logos-company/15.png')}}" alt="">
        </li>
        <li class="partneram__logo">
          <img src="{{asset('static/images/logos-company/16.png')}}" alt="">
        </li>
        <li class="partneram__logo">
          <img src="{{asset('static/images/logos-company/17.png')}}" alt="">
        </li>
        <li class="partneram__logo">
          <img src="{{asset('static/images/logos-company/18.png')}}" alt="">
        </li>
        <li class="partneram__logo">
          <img src="{{asset('static/images/logos-company/19.png')}}" alt="">
        </li>
        <li class="partneram__logo">
          <img src="{{asset('static/images/logos-company/20.jpg')}}" alt="">
        </li>
      </ul>
    </div>
  </div>
  <div class="partneram__feedback">
    <div class="container">
      <span class="title">Хотите стать нашим партнером?</span>
      <p class="partneram__text">
        Оставьте свои контактные данные для обсуждения условий партнерства
      </p>
      <form class="partneram__form" method="post" action="{{route('partnership-requests.store')}}">
        @csrf
        <ul class="partneram__list">
          <li class="partneram__column">
            <label>
              <input class="input" id="email" name="email" type="email" maxlength="255"
                     required
                     placeholder="Ваша электронная почта">
            </label>
            <label>
              <input class="input" id="organization_name" name="organization_name"
                     maxlength="255"
                     type="text" required placeholder="Наименование вашей организации">
            </label>
            <label>
              <input class="input" id="phone" name="phone" type="text" maxlength="255" required
                     placeholder="Номер телефона для связи">
            </label>
          </li>
          <li class="partneram__column">
            <label class="partneram__label">
              <textarea class="input input--textarea" maxlength="2000" name="comment" id="comment"
                        placeholder="Ваш комментарий"></textarea>
            </label>
          </li>
        </ul>
        <p class="partneram__confirm">
          Отправляя данные через эту форму, Вы автоматически соглашаетесь на
          <a href="">политику конфиденциальности</a>
        </p>
        <button class="partneram__btn btn" type="submit">Отправить</button>
      </form>
    </div>
  </div>
</section>
@include('fragments.footer')
</body>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('.partneram__form');

    form.addEventListener('submit', function (event) {
      event.preventDefault();

      fetch('/partnership-requests', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
          email: form.email.value,
          organization_name: form.organization_name.value,
          phone: form.phone.value,
          comment: form.comment.value
        })
      })
        .then(response => {
          if (!response.ok) {
            if (response.status === 429) {
              return response.json().then(data => {
                throw new Error(data.error);
              });
            }
            throw new Error('Ошибка при отправке запроса');
          }
          return response.json();
        })
        .then(data => {
          alert('Заявка успешно отправлена');
          form.reset();
        })
        .catch(error => {
          alert(error.message);
        });
    });
  });
</script>