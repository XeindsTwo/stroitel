import {validateLogin, validateEmail, validateName} from "./validation.js";

document.addEventListener('DOMContentLoaded', function () {
    const updateButton = document.getElementById('updateButton');
    const loginInput = document.getElementById('login');
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
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
    const userId = window.location.pathname.split('/').slice(-2, -1)[0];

    updateButton.addEventListener('click', async function (event) {
        event.preventDefault();
        const newLogin = loginInput.value.trim();
        const newEmail = emailInput.value.trim();
        const newName = nameInput.value.trim();

        const isLoginValid = await validateLogin(newLogin, errorLoginCheck, errorLoginSymbols, errorLoginLength, errorLoginMax, 'edit', userId);
        const isEmailValid = await validateEmail(newEmail, errorEmailCheck, errorEmailSymbols, errorEmailLength, 'edit', userId);
        const isNameValid = validateName(newName, errorNameSymbols, errorNameMin, errorNameMax);

        if (isLoginValid && isEmailValid && isNameValid) {
            document.getElementById('updateForm').submit();
        }
    });
});