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

@include('fragments.footer')
</body>