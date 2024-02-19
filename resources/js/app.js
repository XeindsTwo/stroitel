import {openModal, closeModal, handleModalClose} from './components/modal-functions.js';

const modalContact = document.getElementById('modal-contact')
const openModalContact = document.getElementById('btn-contact')
const closeModalContact = document.getElementById('close-contact')

const modalAuth = document.getElementById('modal-auth')
const openModalAuth = document.getElementById('btn-auth')
const closeModalAuth = document.getElementById('close-auth')

openModalContact.addEventListener('click', () => {
    openModal(modalContact)
})

closeModalContact.addEventListener('click', () => {
    closeModal(modalContact)
})

handleModalClose(modalContact)

openModalAuth.addEventListener('click', () => {
    openModal(modalAuth)
})

closeModalAuth.addEventListener('click', () => {
    closeModal(modalAuth)
})

handleModalClose(modalAuth)
