@include('fragments/head', ['title' => 'Частые вопросы'])
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
        <span>Частые вопросы</span>
      </div>
    </div>
  </div>
</div>
<section class="company">
  <div class="container">
    <div class="company__inner">
      @include('company.components.aside')
      <div class="company__content company--left">
        <div class="company__top">
          <h1 class="company__title title">Частые вопросы</h1>
          <p class="company__top-text">
            Мы собрали для вас наиболее частые вопросы, которые нам задают и наши ответы на них:
          </p>
        </div>
        <ul class="accordion__list">
          <li class="accordion__item">
            <div class="accordion__head">
              <h3 class="accordion__title">Как осуществляется доставка по Кубани?</h3>
            </div>
            <div class="accordion__body">
              <p>
                Доставка заказов по России и в регионы осуществляется по 100% предоплате транспортной компанией «СДЭК».
                Обратите внимание, срок отгрузки товара после перечисления денежных средств на расчетный счет компании,
                составляет 1–3 дня (за исключением отдельно оговоренных сроков). Информацию о тарифах и ориентировочной
                дате прибытия в ваш город, вы сможете самостоятельно уточнить на сайте перевозчика. Вес брутто,
                габаритные размеры уточняйте у наших менеджеров или на странице с товаром.
              </p>
            </div>
          </li>
          <li class="accordion__item">
            <div class="accordion__head">
              <h3 class="accordion__title">Возможен ли самовывоз заказанного товара?</h3>
            </div>
            <div class="accordion__body">
              <p>
                Вы можете самостоятельно забрать товар из пунктов выдачи интернет-магазина
              </p>
            </div>
          </li>
          <li class="accordion__item">
            <div class="accordion__head">
              <h3 class="accordion__title">Что делать в случае неисправности полученного товара?</h3>
            </div>
            <div class="accordion__body">
              <p>
                Каждый проданный нами товар проходит предпродажную подготовку, но даже у брендовых товаров бывают
                поломки. Если же случилась поломка инструмента, Вам следует обратиться в один из сервисных центров
                указанных на сайте для осуществления гарантийного ремонта
              </p>
            </div>
          </li>
          <li class="accordion__item">
            <div class="accordion__head">
              <h3 class="accordion__title">Подскажите какой режим работы телефонного консультанта?</h3>
            </div>
            <div class="accordion__body">
              <p>
                Наши операторы работают: Пн-Пт: с 9:00 до 18:00, Сб-Вс: с 10:00 до 15:00.
              </p>
            </div>
          </li>
          <li class="accordion__item">
            <div class="accordion__head">
              <h3 class="accordion__title">
                Даёте гарантию на стройматериалы? Могу быть уверенным, что это не контрафакт? Сертификаты есть на товар?
              </h3>
            </div>
            <div class="accordion__body">
              <p>
                Сертификаты на весь товар имеются. Гарантия дается на товар на срок гарантии завода — изготовителя
                продукции
              </p>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>
@include('fragments.footer')
@vite(['resources/js/components/accordion.js'])
</body>