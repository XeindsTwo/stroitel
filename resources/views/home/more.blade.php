<section class="more indent">
  <div class="container">
    <h2 class="title">Более 600 товаров в наличии на складе</h2>
    <ul class="more__list">
      @foreach($categories as $category)
        <li>
          @if($category->subcategories->isNotEmpty())
            <a class="more__item" href="{{ route('category.subcategories', ['categoryId' => $category->id]) }}">
              @else
                <a class="more__item" href="{{ route('category.products', ['categoryId' => $category->id]) }}">
                  @endif
                  <p class="more__title">{{ $category->name }}</p>
                  <img
                      class="more__img"
                      src="{{ asset('storage/category_images/' . $category->image) }}"
                      alt="{{ $category->name }}" width="280" height="162"
                  >
                </a>
        </li>
      @endforeach
    </ul>
    <a class="btn" href="{{ route('catalog') }}">Узнать больше</a>
  </div>
</section>