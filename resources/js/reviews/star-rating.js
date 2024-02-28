document.addEventListener('DOMContentLoaded', function () {
  const stars = document.querySelectorAll('.star');
  const ratingInput = document.getElementById('rating');
  let selectedStars = ratingInput.value;

  highlightStars(selectedStars);

  stars.forEach(function (star) {
    star.addEventListener('click', function () {
      const value = this.getAttribute('data-value');
      ratingInput.value = value;
      selectedStars = value;
      resetStarsColor();
      highlightStars(value);
      console.log('Выбрано звезд: ' + value);
    });

    star.addEventListener('mouseenter', function () {
      const value = this.getAttribute('data-value');
      if (value !== selectedStars) {
        resetStarsColor();
        highlightStars(value);
      }
    });

    star.addEventListener('mouseleave', function () {
      resetStarsColor();
      highlightStars(selectedStars);
    });
  });

  function highlightStars(value) {
    stars.forEach(function (star) {
      if (star.getAttribute('data-value') <= value) {
        star.style.color = '#079aff';
      }
    });
  }

  function resetStarsColor() {
    stars.forEach(function (star) {
      star.style.color = 'gray';
    });
  }
});