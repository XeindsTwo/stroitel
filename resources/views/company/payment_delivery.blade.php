@include('fragments/head', ['title' => 'Оплата и доставка'])
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
        <span>Оплата и доставка</span>
      </div>
    </div>
  </div>
</div>
<section class="company">
  <div class="container">
    <div class="company__inner">
      @include('company.components.aside')
      <div class="company__content">
        @include('company.payment_delivery.start')
        @include('company.payment_delivery.how_order')
        @include('company.payment_delivery.delivery')
        @include('company.payment_delivery.delivery_edge')
        @include('company.payment_delivery.question')
      </div>
    </div>
  </div>
</section>
@include('fragments.footer')
</body>