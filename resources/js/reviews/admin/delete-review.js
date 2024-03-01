const approveButtons = document.querySelectorAll('.admin__delete');

approveButtons.forEach(button => {
  button.addEventListener('click', function () {
    const reviewId = this.getAttribute('data-id');

    if (confirm('Вы действительно хотите удалить данный отзыв? Отменить данное решение будет невозможно')) {
      fetch(`/admin/reviews/${reviewId}/`, {
        method: 'DELETE',
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