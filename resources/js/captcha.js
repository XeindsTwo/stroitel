function refreshCaptcha() {
    const captchaImage = document.getElementById('captchaImage');
    const generateCaptchaURL = '/generate-captcha';

    fetch(generateCaptchaURL)
        .then(response => {
            if (!response.ok) {
                throw new Error('Ошибка при обновлении капчи');
            }
            return response.blob();
        })
        .then(blob => {
            captchaImage.src = URL.createObjectURL(blob);
        })
        .catch(error => {
            console.error(error);
            alert('Ошибка при обновлении капчи');
        });
}

document.getElementById('refreshCaptcha').addEventListener('click', refreshCaptcha);

document.getElementById('formAuth').addEventListener('submit', function () {
    event.preventDefault();
    const captchaInput = document.getElementById('captcha');
    const captchaValue = captchaInput.value;

    fetch('/validate-captcha', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({captcha: captchaValue})
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('formAuth').submit();
            } else {
                const captchaError = document.getElementById('captchaError');
                captchaError.classList.add('error--active');
                refreshCaptcha();

                captchaInput.value = '';
                setTimeout(() => {
                    captchaError.classList.remove('error--active');
                }, 4000);
            }
        })
        .catch(error => {
            console.error(error);
        });
});