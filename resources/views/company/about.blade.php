@include('fragments/head', ['title' => 'О компании'])
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
        <span>О компании</span>
      </div>
    </div>
  </div>
</div>
<section class="company">
  <div class="container">
    <div class="company__inner">
      @include('company.components.aside')
      <div class="company__content">
        @include('company.main.history')
        @include('company.main.numbers')
      </div>
    </div>
  </div>
</section>
@include('fragments.footer')
</body>