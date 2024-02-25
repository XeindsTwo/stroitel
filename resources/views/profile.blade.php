@include('fragments/head', ['title' => 'Личный кабинет'])
<body class="body">
@include('fragments.meta')
@include('fragments.header')
<section class="profile">
  <div class="container">
    <h1 class="title">Здравствуйте, {{$user->name}}</h1>
  </div>
</section>
@vite(['resources/js/app.js'])
</body>