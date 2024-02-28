document.addEventListener('DOMContentLoaded', function () {
  const ratings = document.querySelectorAll('.company-reviews__rating');

  ratings.forEach(function (rating) {
    const value = parseInt(rating.textContent);
    rating.innerHTML = generateStars(value);
  });
});

function generateStars(value) {
  let stars = '';
  for (let i = 0; i < value; i++) {
    stars += '<span class="star star-filled">&#9733;</span>';
  }
  return stars;
}