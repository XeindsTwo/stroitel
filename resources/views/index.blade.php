@include('fragments/head', ['title' => 'Главная | Diseased'])
<link href="https://cdn.jsdelivr.net/npm/toastify-js@1.12.0/src/toastify.min.css" rel="stylesheet">
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
<script src="https://cdn.jsdelivr.net/npm/toastify-js@1.12.0/src/toastify.min.js"></script>
</body>