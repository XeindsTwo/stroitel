import {openModal} from '../components/modal-functions.js';

export function handleSearchInput() {
    let searchTimer;

    const searchForm = document.getElementById('searchForm');
    searchForm.addEventListener('input', function () {
        clearTimeout(searchTimer);
        searchTimer = setTimeout(() => {
            const formData = new FormData(this);
            const searchText = formData.get('query').trim();

            if (!searchText) {
                fetch(`/admin/users/all`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        displayUsers(data.users);
                        if (data.users.length === 0) {
                            showNoResultsMessage();
                        }
                    })
                    .catch(error => {
                        console.error('There has been a problem with your fetch operation:', error);
                        const userListContainer = document.getElementById('userListContainer');
                        userListContainer.innerHTML = `<p class="error">Что-то пошло не так при загрузке данных</p>`;
                    });
            } else {
                fetch(`/admin/users/search?${new URLSearchParams(formData).toString()}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        displayUsers(data.users);
                        if (data.users.length === 0) {
                            showNoResultsMessage();
                        }
                    })
                    .catch(error => {
                        console.error('There has been a problem with your fetch operation:', error);
                        const userListContainer = document.getElementById('userListContainer');
                        userListContainer.innerHTML = `<p class="error">Что-то пошло не так при загрузке данных</p>`;
                    });
            }
        }, 600);
    });
}

export function displayUsers(users) {
    const userListContainer = document.getElementById('userListContainer');
    const currentUser = {id: 1};
    const newContent = users.map(user => `
        <li class="admin-users__item" data-user-id="${user.id}">
            <p class="admin-users__login"><span>${user.login}</span></p>
            <a class="admin-users__edit" href="/admin/users/${user.id}/edit">
                Редактировать
            </a>
            <div class="admin-users__content">
                <p>Имя: ${user.name}</p>
                <p>Почта: ${user.email}</p>
                <p>Роль: ${user.role}</p>
            </div>
            <div class="admin-users__actions">
                ${user.id !== currentUser.id ? `
                    <button class="admin-users__action admin-users__action--reset" type="button">Сбросить пароль</button>
                    <button class="admin-users__action admin-users__action--delete" type="button" data-user-id="${user.id}">
                        Удалить аккаунт
                    </button>
                ` : `
                    <p class="admin-users__action admin-users__action--long">¯\\_(ツ)_/¯ не делай глупых решений</p>
                `}
            </div>
        </li>`
    ).join('');

    userListContainer.innerHTML = `${newContent}`;
    const modalDelete = document.getElementById('modalDeleteUser');
    const deleteButtons = document.querySelectorAll('.admin-users__action--delete');
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
}

export function showNoResultsMessage() {
    const userListContainer = document.getElementById('userListContainer');
    userListContainer.innerHTML = `<p class="no-results-message">¯\\_(ツ)_/¯ Ничего не было найдено</p>`;
}