const customFileInputs = document.querySelectorAll('.input-file');

customFileInputs.forEach(function (input) {
  const previewId = input.dataset.preview;
  const previewContainer = document.getElementById(previewId);
  const previewImage = previewContainer.querySelector('img');
  const previewText = previewContainer.querySelector('p');
  const maxSizeError = document.getElementById('max-size-error');
  const formatError = document.getElementById('format-error');

  function hideError(element) {
    setTimeout(function () {
      element.style.display = 'none';
    }, 2000);
  }

  input.addEventListener('change', function () {
    const file = this.files[0];

    const allowedFormats = ['image/webp', 'image/png', 'image/jpeg'];
    if (!allowedFormats.includes(file.type)) {
      formatError.style.display = 'block';
      hideError(formatError);
      return;
    } else {
      formatError.style.display = 'none';
    }

    if (file.size > 2 * 1024 * 1024) {
      maxSizeError.style.display = 'block';
      hideError(maxSizeError);
      return;
    } else {
      maxSizeError.style.display = 'none';
    }

    if (file) {
      const reader = new FileReader();

      previewText.style.display = 'none';
      previewImage.style.display = 'block';

      reader.addEventListener('load', function () {
        previewImage.setAttribute('src', reader.result);
      });

      reader.readAsDataURL(file);
    } else {
      previewText.style.display = 'block';
      previewImage.style.display = 'none';
      previewImage.setAttribute('src', '#');
    }
  });

  previewContainer.addEventListener('click', function () {
    input.click();
  });
});