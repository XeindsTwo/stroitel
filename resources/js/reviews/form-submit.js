document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('reviewForm');

  form.addEventListener('submit', function (event) {
    event.preventDefault();
    const formData = new FormData(form);

    fetch(form.action, {
      method: 'POST',
      body: formData,
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      }
    })
      .then(response => {
        if (response.status === 429) {
          throw new Error('Слишком много запросов. Пожалуйста, подождите некоторое время и повторите попытку.');
        }
        if (!response.ok) {
          throw new Error('Ошибка при отправке запроса');
        }
        return response.json();
      })
      .then(data => {
        alert(data.message);
        form.reset();
      })
      .catch(error => {
        console.error('Ошибка:', error);
        alert(error.message || 'Произошла ошибка. Попробуйте еще раз.');
      });
  });
});