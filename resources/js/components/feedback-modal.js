import {openModal, closeModal, handleModalClose} from './modal-functions.js';

const feedbackModal = document.getElementById('feedback-modal');
const feedbackOpenButton = document.getElementById('feedback-open');
const closeContactButton = document.getElementById('close-feedback');

feedbackOpenButton.addEventListener('click', () => {
  openModal(feedbackModal);
});

closeContactButton.addEventListener('click', () => {
  closeModal(feedbackModal);
});

handleModalClose(feedbackModal);

const fileInput = document.getElementById('file');
const maxSize = 2 * 1024 * 1024; // 2 MB
const allowedFormats = ['.pdf', '.doc', '.docx', '.xls', '.xlsx', '.jpg', '.jpeg', '.png'];
const maxSizeError = document.getElementById('max-size-error');
const formatError = document.getElementById('format-error');

fileInput.addEventListener('change', () => {
  const file = fileInput.files[0];
  if (file.size > maxSize) {
    maxSizeError.classList.add('error--active');
    setTimeout(() => {
      maxSizeError.classList.remove('error--active');
    }, 2000);
    fileInput.value = '';
    return;
  }

  const fileName = file.name;
  const extension = fileName.substring(fileName.lastIndexOf('.')).toLowerCase();
  if (!allowedFormats.includes(extension)) {
    formatError.classList.add('error--active');
    setTimeout(() => {
      formatError.classList.remove('error--active');
    }, 4000);
    fileInput.value = '';
  }
});

const form = document.getElementById('feedback-form');
form.addEventListener('submit', async (event) => {
  event.preventDefault();

  if (maxSizeError.classList.contains('error--active') || formatError.classList.contains('error--active')) {
    return;
  }

  const formData = new FormData(form);

  try {
    const response = await fetch('/feedback-request', {
      method: 'POST',
      body: formData
    });

    if (response.ok) {
      const data = await response.json();
      console.log(data);
      closeModal(feedbackModal);
      openModal(document.getElementById('complete-modal'));
      handleModalClose(document.getElementById('complete-modal'));
      feedbackModal.querySelector('form').reset();

      const closeCompleteButton = document.getElementById('close-complete');
      const closeCompleteButton2 = document.getElementById('close-complete-btn');
      closeCompleteButton.addEventListener('click', () => {
        closeModal(document.getElementById('complete-modal'));
      });
      closeCompleteButton2.addEventListener('click', () => {
        closeModal(document.getElementById('complete-modal'));
      });
    } else if (response.status === 429) {
      throw new Error('Вы отправили много заявок за последнее время. Попробуйте позже.');
    } else {
      throw new Error('Ошибка при отправке запроса');
    }
  } catch (error) {
    console.error(error);
    alert(error.message);
  }
});