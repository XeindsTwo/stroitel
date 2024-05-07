const forms = document.querySelectorAll('.form');

forms.forEach(form => {
  const valueInput = form.querySelector('.quantity');
  const plusBtn = form.querySelector('.plus');
  const minusBtn = form.querySelector('.minus');
  let counterValue = 1;
  valueInput.value = counterValue;

  plusBtn.addEventListener('click', () => {
    counterValue++;
    valueInput.value = counterValue;
  });

  minusBtn.addEventListener('click', () => {
    if (counterValue > 1) {
      counterValue--;
      valueInput.value = counterValue;
    }
  });

  form.addEventListener('submit', async (event) => {
    event.preventDefault();
    const quantityValue = parseInt(valueInput.value.trim());
    if (isNaN(quantityValue) || quantityValue < 1) {
      showToast('Минимальное количество товара в корзину - 1');
      return;
    } else if (quantityValue > 1000) {
      showToast('Максимальное количество товара в корзине - 1000');
      return;
    }

    try {
      const productId = form.querySelector('input[name="product_id"]').value;
      const response = await fetch(`/add-to-cart/${productId}`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({
          product_id: productId,
          quantity: quantityValue
        })
      });

      const responseData = await response.json();
      if (response.status === 401) {
        throw new Error(responseData.message);
      } else if (response.status === 402) {
        throw new Error(responseData.message);
      } else if (response.status === 403) {
        throw new Error(responseData.message);
      } else if (response.status === 400) {
        throw new Error(responseData.message);
      }

      if (!response.ok) {
        throw new Error('Ошибка при добавлении товара в корзину');
      }

      showToast('Товар успешно добавлен в корзину');
    } catch (error) {
      showToast(error.message);
    }
  });
});

function showToast(message) {
  Toastify({
    text: message,
    duration: 3000,
    gravity: 'bottom',
    position: 'right',
  }).showToast();
}