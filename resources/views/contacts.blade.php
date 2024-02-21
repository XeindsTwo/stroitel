@include('fragments/head', ['title' => 'Контакты компании'])
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
        <span>Контакты компании</span>
      </div>
    </div>
  </div>
</div>
@include('contacts.contacts')
@include('contacts.phones')
@include('contacts.requisites')
@include('fragments.footer')
</body>