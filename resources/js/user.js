import {openModal, closeModal, handleModalClose} from './components/modal-functions.js';
import {handleSearchInput} from './user/search.js';
import {validateLogin, validateEmail, validateName, validatePassword} from "./user/validation.js";

const createUserBtn = document.getElementById('createUserBtn');
const modalCreate = document.getElementById('modalAddUser');
const modalCreateCloseBtn = document.getElementById('modalCloseAddUser');
const createBtnUser = document.getElementById('createBtnUser');

createUserBtn.addEventListener('click', () => {
    openModal(modalCreate);
});

modalCreateCloseBtn.addEventListener('click', () => {
    closeModal(modalCreate);
});

handleModalClose(modalCreate);

handleSearchInput();

createBtnUser.addEventListener('click', async (e) => {
    e.preventDefault();
    const newLogin = document.getElementById('login').value.trim();
    const newEmail = document.getElementById('email').value.trim();
    const newName = document.getElementById('name').value.trim();
    const newPassword = document.getElementById('password').value.trim();
    const errorLoginCheck = document.getElementById('loginCheckError');
    const errorLoginSymbols = document.getElementById('loginError');
    const errorLoginLength = document.getElementById('loginLengthError');
    const errorLoginMax = document.getElementById('loginMaxError');
    const errorNameSymbols = document.getElementById('nameError');
    const errorNameMin = document.getElementById('nameMinError');
    const errorNameMax = document.getElementById('nameMaxError');
    const errorEmailCheck = document.getElementById('emailCheckError');
    const errorEmailSymbols = document.getElementById('emailErrorParameters');
    const errorEmailLength = document.getElementById('emailLengthError');
    const errorPassword = document.getElementById('passwordError');
    const errorPasswordLength = document.getElementById('passwordLengthError');
    const errorPasswordMax = document.getElementById('passwordMaxError');
    const userId = window.location.pathname.split('/').slice(-2, -1)[0];

    const isLoginValid = await validateLogin(newLogin, errorLoginCheck, errorLoginSymbols, errorLoginLength, errorLoginMax, 'create', userId);
    const isEmailValid = await validateEmail(newEmail, errorEmailCheck, errorEmailSymbols, errorEmailLength, 'create', userId);
    const isNameValid = validateName(newName, errorNameSymbols, errorNameMin, errorNameMax);
    const isPasswordValid = validatePassword(newPassword, errorPassword, errorPasswordLength, errorPasswordMax)

    if (isLoginValid && isEmailValid && isNameValid && isPasswordValid) {
        const formData = new FormData(document.getElementById('userForm'));
        try {
            const response = await fetch(`/admin/users/`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            if (!response.ok) {
                const errorData = await response.json();
                console.error(errorData.message);
            } else {
                const userData = await response.json();
                if (userData.user) {
                    displayUser(userData.user);
                    console.log(userData.message);
                    closeModal(modalCreate);
                }
            }
        } catch (error) {
            console.error('Ошибка при отправке запроса:', error);
        }
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const deleteButtons = document.querySelectorAll('.admin-users__action--delete');
    const loginDeleteUser = document.getElementById('loginDeleteUser');
    const modalDelete = document.getElementById('modalDeleteUser');
    const modalCloseDeleteBtn = document.getElementById('modalCloseDeleteUser');
    const modalCancelDeleteBtn = document.getElementById('modalCancelDeleteUser');
    const confirmDeleteUserBtn = document.getElementById('confirmDeleteUser');

    deleteButtons.forEach(button => {
        button.addEventListener('click', event => {
            const userId = event.currentTarget.dataset.userId;
            console.log('User Id: ', userId);
            if (userId) {
                loginDeleteUser.textContent = event.currentTarget.closest('.admin-users__item').querySelector('.admin-users__login').textContent;
                modalDelete.dataset.userId = userId;
                openModal(modalDelete);
            } else {
                console.error('Ошибка: ID юзера не найден');
            }
        });
    });

    modalCloseDeleteBtn.addEventListener('click', () => {
        closeModal(modalDelete);
    });

    modalCancelDeleteBtn.addEventListener('click', () => {
        closeModal(modalDelete);
    });

    handleModalClose(modalDelete);

    confirmDeleteUserBtn.addEventListener('click', async () => {
        const userId = modalDelete.dataset.userId;
        try {
            const response = await fetch(`/admin/users/${userId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });
            if (response.ok) {
                const userItem = document.querySelector(`.admin-users__item[data-user-id="${userId}"]`);
                if (userItem) {
                    userItem.remove();
                    closeModal(modalDelete);
                }
            } else {
                console.error('Ошибка удаления, пользователь не был найден');
            }
        } catch (error) {
            console.error('Произошла ошибка: ', error);
        }
    });
});

function displayUser(user) {
    const userListContainer = document.getElementById('userListContainer');
    const currentUser = {id: 1};
    const userItem = document.createElement('li');
    userItem.classList.add('admin-users__item');
    userItem.dataset.userId = user.id;

    const userLogin = document.createElement('p');
    userLogin.classList.add('admin-users__login');
    userLogin.innerHTML = `<span>${user.login}</span>`;

    const editLink = document.createElement('a');
    editLink.classList.add('admin-users__edit');
    editLink.href = `/admin/users/${user.id}/edit`;
    editLink.textContent = 'Редактировать';

    const userContent = document.createElement('div');
    userContent.classList.add('admin-users__content');
    userContent.innerHTML = `
        <p>Имя: ${user.name}</p>
        <p>Почта: ${user.email}</p>
        <p>Роль: ${user.role}</p>
    `;

    const userActions = document.createElement('div');
    userActions.classList.add('admin-users__actions');
    if (user.id !== currentUser.id) {
        const deleteButton = document.createElement('button');
        deleteButton.classList.add('admin-users__action', 'admin-users__action--delete');
        deleteButton.type = 'button';
        deleteButton.dataset.userId = user.id;
        deleteButton.textContent = 'Удалить аккаунт';

        deleteButton.addEventListener('click', event => {
            const userId = event.currentTarget.dataset.userId;
            console.log('User Id: ', userId);
            const modalDelete = document.getElementById('modalDeleteUser');
            const loginDeleteUser = document.getElementById('loginDeleteUser');
            if (userId) {
                loginDeleteUser.textContent = user.login;
                modalDelete.dataset.userId = userId;
                openModal(modalDelete);
            } else {
                console.error('Ошибка: ID юзера не найден');
            }
        });

        userActions.appendChild(deleteButton);
    } else {
        const noActionText = document.createElement('p');
        noActionText.classList.add('admin-users__action', 'admin-users__action--long');
        noActionText.textContent = '¯\\_(ツ)_/¯ Не делай глупых решений';
        userActions.appendChild(noActionText);
    }

    userItem.appendChild(userLogin);
    userItem.appendChild(editLink);
    userItem.appendChild(userContent);
    userItem.appendChild(userActions);

    userListContainer.appendChild(userItem);
}