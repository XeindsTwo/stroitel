@include('fragments/head', ['title' => 'Главная | Diseased'])
<body class="body">
@include('fragments.meta')
@include('fragments.header')
@include('home.home')
@include('home.about')
@include('home.best-orders')
@include('home.more')
@include('home.benefits')
@include('home.bio')
@include('home.original')
@include('fragments/footer')
@vite(['resources/js/slider-orders.js'])
</body>