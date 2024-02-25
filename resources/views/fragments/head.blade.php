<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
        content="Diseased - Интернет-магазин стройматериалов в Белореченске осуществляет продажу строительных и отделочных материалов оптом и в розницу по выгодной цене от производителя. Доставка по всему городу. ☎️ +7 (345) 098-22-12">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $title ?? 'Diseased | Магазин строительных материалов' }}</title>
  <link rel="icon" href="{{asset('static/images/icons/favicon.svg')}}" type="images/x-icon">
  <link rel="shortcut icon" href="{{asset('static/images/icons/favicon.svg')}}" type="images/x-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet">
  @stack('head')
  @vite(['resources/scss/style.scss'])
  @livewireStyles
</head>