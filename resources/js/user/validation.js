export async function validateLogin(loginValue, errorCheck, errorSymbols, errorLength, errorMax, actionType, userId) {
    let valid = true;
    try {
        let url = actionType === 'edit' ? '/check-login-edit' : '/check-login-create';

        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({login: loginValue, userId: userId})
        });

        const data = await response.json();

        if (data.exists) {
            errorCheck.classList.add('error--active');
            valid = false;
        } else {
            errorCheck.classList.remove('error--active');
        }

        const loginRegex = /^[a-zA-Z0-9_]+$/;

        if (!loginRegex.test(loginValue) || /[А-я]/.test(loginValue)) {
            errorSymbols.classList.add('error--active');
            valid = false;
        } else {
            errorSymbols.classList.remove('error--active');
        }

        if (loginValue.length < 5) {
            errorLength.classList.add('error--active');
            valid = false;
        } else {
            errorLength.classList.remove('error--active');
        }

        if (loginValue.length > 60) {
            errorMax.classList.add('error--active');
            valid = false;
        } else {
            errorMax.classList.remove('error--active');
        }

    } catch (error) {
        console.error('Error:', error);
        valid = false;
    }

    return valid;
}

export async function validateEmail(emailValue, errorCheck, errorSymbols, errorLength, actionType, userId) {
    let valid = true;
    try {
        let url = actionType === 'edit' ? '/check-email-edit' : '/check-email-create';

        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({email: emailValue, userId: userId})
        });

        const data = await response.json();

        if (data.exists) {
            errorCheck.classList.add('error--active');
            valid = false;
        } else {
            errorCheck.classList.remove('error--active');
        }

        const emailRegex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;

        if (!emailRegex.test(emailValue)) {
            errorSymbols.classList.add('error--active');
            valid = false;
        } else {
            errorSymbols.classList.remove('error--active');
        }

        if (emailValue.length > 80) {
            errorLength.classList.add('error--active');
            valid = false;
        } else {
            errorLength.classList.remove('error--active');
        }
    } catch (error) {
        console.error('Error:', error);
        valid = false;
    }

    return valid;
}

export function validateName(nameValue, errorSymbols, errorMin, errorMax) {
    let valid = true;
    const nameRegex = /^[A-Za-zА-я\-]+$/;

    if (!nameRegex.test(nameValue)) {
        errorSymbols.classList.add('error--active');
        valid = false;
    } else {
        errorSymbols.classList.remove('error--active');
    }

    if (nameValue.length < 2) {
        errorMin.classList.add('error--active');
        valid = false;
    } else {
        errorMin.classList.remove('error--active');
    }

    if (nameValue.length > 50) {
        errorMax.classList.add('error--active');
        valid = false;
    } else {
        errorMax.classList.remove('error--active');
    }

    return valid;
}

export function validatePassword(passwordValue, errorSymbols, errorLength, errorMax) {
    let valid = true;

    const passwordRegex = /[А-я]/;

    if (passwordRegex.test(passwordValue)) {
        errorSymbols.classList.add('error--active');
        valid = false;
    } else {
        errorSymbols.classList.remove('error--active');
    }

    if (passwordValue.length < 8) {
        errorLength.classList.add('error--active');
        valid = false;
    } else {
        errorLength.classList.remove('error--active');
    }

    if (passwordValue.length > 60) {
        errorMax.classList.add('error--active');
        valid = false;
    } else {
        errorMax.classList.remove('error--active');
    }

    return valid;
}