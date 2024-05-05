<section class="best-orders">
  <div class="container">
    <div class="best-orders__top">
      <h2 class="title">Лучшие скидочные предложения мая</h2>
      <a class="btn" href="{{route('discounted')}}">К акциям</a>
    </div>
  </div>
  <div class="best-orders__swiper swiper">
    <div class="swiper-wrapper">
      @foreach($discountedProducts as $product)
        <div class="swiper-slide">
          <div class="best-orders__item">
            <div class="best-orders__top">
              <span class="best-orders__slogan">Акция</span>
            </div>
            <a class="best-orders__img" href="{{ route('show_product', ['id' => $product->id]) }}">
              <img src="{{ asset('storage/products/' . $product->image_path) }}" alt="{{ $product->name }}">
            </a>
            <span class="best-orders__article">Артикул: {{$product->article}}</span>
            <a class="best-orders__title" href="{{ route('show_product', ['id' => $product->id]) }}">
              {{ $product->name }}
            </a>
            <div class="best-orders__price">
              <div class="best-orders__new">
                <span>Цена за шт</span>
                <span>{{$product->new_price}} ₽</span>
              </div>
              <span class="best-orders__old">{{$product->price}} ₽</span>
            </div>
          </div>
        </div>
      @endforeach
    </div>
    <button class="best-orders__btn best-orders__btn--prev" type="button">
      <svg class="best-orders__icon" viewBox="0 0 10 18" xmlns="http://www.w3.org/2000/svg">
        <path d="M8.40002 1.80005L1.20002 9.00005L8.40002 16.2" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round"></path>
      </svg>
    </button>
    <button class="best-orders__btn best-orders__btn--next" type="button">
      <svg class="best-orders__icon" viewBox="0 0 10 18" xmlns="http://www.w3.org/2000/svg">
        <path d="M1.60002 16.2L8.80002 9.00005L1.60002 1.80005" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round"></path>
      </svg>
    </button>
  </div>
</section>