@include('fragments/head', ['title' => 'Главная | Diseased'])
<body class="body">
@if (Auth::check() && Auth::user()->role === 'ADMIN')
  <livewire:add-user/>
@endif
@include('fragments.header')
@include('home.home')
@include('fragments/footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@livewireScripts
</body>