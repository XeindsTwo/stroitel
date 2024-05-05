<footer class="footer">
  <div class="container">
    <div class="footer__inner">
      <a class="logo" href="/">
        <img src="{{asset('static/images/icons/logo-long-footer.svg')}}" alt="">
      </a>
      <ul class="footer__columns">
        <li class="footer__column">
          <span class="footer__name">Подробнее о компании</span>
          <div class="footer__links">
            <a class="footer__link" href="{{route('payment_delivery')}}">Оплата и доставка</a>
            <a class="footer__link" href="{{route('reviews')}}">Наши отзывы</a>
            <a class="footer__link" href="{{route('faq')}}">Частые вопросы</a>
            <a class="footer__link" href="{{route('letters')}}">Благодарственные письма</a>
          </div>
        </li>
        <li>
          <span class="footer__name">Полезные ссылки</span>
          <div class="footer__links">
            <a class="footer__link" href="{{route('contacts')}}">Контакты</a>
            <a class="footer__link" href="https://aridal.ru/pdf/buklet_2019.pdf" target="_blank">Каталог PDF</a>
            <a class="footer__link" href="{{route('partneram')}}">Партнерам</a>
            <a class="footer__link" href="{{route('services.strojmateriali')}}">Доставка строительных материалов</a>
            <a class="footer__link" href="{{route('services.raspil')}}">Распил</a>
            <a class="footer__link" href="{{route('services.coloring')}}">Колеровка декоративных штукатурок и красок</a>
          </div>
        </li>
      </ul>
    </div>
    <div class="footer__bottom">
      <div class="footer__contacts">
        <a class="footer__contact" href="{{route('profile')}}" target="_blank">Личный кабинет</a>
        <a class="footer__contact" href="tel:+73450982212">+7 (345) 098-22-12</a>
        <a class="footer__contact" href="mailto:zakaz@diseased.com">zakaz@diseased.com</a>
        <a class="footer__contact" href="https://maps.app.goo.gl/B1APybfZX7XJJ9jD6" target="_blank">
          г. Белореченск, ул. Полевая, д. 16
        </a>
        <span class="footer__contact">ИНН - 7812022297</span>
      </div>
      <div class="footer__bottom-inner">
        <p class="footer__author">
          © 2024 Diseased. Все права защищены.
        </p>
        <a class="footer__privacy" href="{{route('privacy')}}">Политика конфиденциальности</a>
      </div>
    </div>
  </div>
</footer>
@vite(['resources/js/components/phone-mask.js'])