const approveButtons = document.querySelectorAll('.admin__confirm');

approveButtons.forEach(button => {
  button.addEventListener('click', function () {
    const reviewId = this.getAttribute('data-id');

    if (confirm('Вы уверены, что хотите одобрить этот отзыв? В дальнейшем отзыв можно только удалить из БД окончательно')) {
      fetch(`/admin/reviews/${reviewId}/approve`, {
        method: 'PUT',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        }
      })
        .then(response => {
          if (!response.ok) {
            throw new Error('Ошибка при одобрении отзыва');
          }
          return response.json();
        })
        .then(data => {
          alert(data.message);
          const listItem = button.closest('.admin__item');
          listItem.remove();
        })
        .catch(error => {
          console.error('Ошибка:', error);
          alert('Произошла ошибка. Попробуйте еще раз.');
        });
    }
  });
});