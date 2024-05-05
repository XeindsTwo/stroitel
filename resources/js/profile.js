import {openModal, closeModal, handleModalClose} from './components/modal-functions.js';

const btnEdit = document.querySelector('.profile__edit');
const modalEdit = document.getElementById('modal_profile');
const closeEdit = document.getElementById('close_edit');

btnEdit.addEventListener('click', () => {
  openModal(modalEdit);

  const name = btnEdit.getAttribute('data-name');
  const email = btnEdit.getAttribute('data-email');
  document.getElementById('name').value = name;
  document.getElementById('email').value = email;
});

closeEdit.addEventListener('click', () => {
  closeModal(modalEdit);
});

handleModalClose(modalEdit);

const form = document.getElementById('edit_profile-form');

form.addEventListener('submit', async (event) => {
  event.preventDefault();

  const formData = new FormData(form);

  try {
    const response = await fetch('/profile/update', {
      method: 'POST',
      body: formData
    });

    if (response.ok) {
      closeModal(modalEdit);
      const newName = formData.get('name');
      const newEmail = formData.get('email');
      document.querySelector('[data-field="name"]').textContent = newName;
      document.querySelector('[data-field="email"]').textContent = newEmail;
      document.querySelector('.title').textContent = `Здравствуйте, ${newName}`;
      btnEdit.setAttribute('data-name', newName);
      btnEdit.setAttribute('data-email', newEmail);
    } else {
      const responseData = await response.json();
      if (responseData.error && responseData.error.email) {
        const emailErrorSpan = document.getElementById('email_error');
        emailErrorSpan.style.display = 'block';
        setTimeout(() => {
          emailErrorSpan.style.display = 'none';
        }, 2000);
      }
      console.error('Ошибка при обновлении профиля');
    }
  } catch (error) {
    console.error('Ошибка при обновлении профиля:', error);
  }
});