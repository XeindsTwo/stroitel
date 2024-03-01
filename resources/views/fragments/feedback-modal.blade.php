<div class="modal" id="feedback-modal">
  <button class="modal__close" type="button" id="close-feedback">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M18 6L6 18M6 6L18 18" stroke="#545860" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round"/>
    </svg>
  </button>
  <h2 class="modal__title">
    Задайте любой вопрос или отправьте заявку
  </h2>
  <form class="modal__form" id="feedback-form" action="{{route('feedback-request.store')}}">
    @csrf
    <ul class="modal__list">
      <li>
        <input class="input" id="name" name="name"
               maxlength="70" type="text" placeholder="Введите имя"
               pattern="[А-Яа-яЁё\s\-]+" required
               title="Имя может содержать только кириллицу, пробелы и дефисы"
        >
      </li>
      <li>
        <input class="input" id="phone" name="phone" type="text" placeholder="Введите номер телефона" required
               data-tel-input>
      </li>
      <li>
        <input class="input" id="email" name="email" type="email" maxlength="120" placeholder="Введите почту" required>
      </li>
      <li>
        <textarea class="input input--textarea" id="comment" name="comment" maxlength="2000"
                  placeholder="Ваш комментарий (необязательно)"></textarea>
      </li>
      <li>
        <label class="label" for="file">Файл ТЗ или реквизиты</label>
        <span class="error" id="max-size-error">
          Файл не может весить более 2мб
        </span>
        <span class="error" id="format-error">
          Работа с файлами поддерживается только .pdf, .doc, .docx, .xls, .xlsx, .jpg, .jpeg, .png форматы
        </span>
        <input class="input" id="file" name="file" type="file" accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png">
      </li>
    </ul>
    <p class="modal__privacy">
      Отправляя данные через эту форму, Вы автоматически соглашаетесь на <a href="{{route('privacy')}}">политику
        конфиденциальности</a>
    </p>
    <button class="btn" type="submit">Отправить</button>
  </form>
</div>

<div class="modal modal--bottom" id="complete-modal">
  <button class="modal__close" type="button" id="close-complete">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M18 6L6 18M6 6L18 18" stroke="#545860" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round"/>
    </svg>
  </button>
  <h2 class="modal__title">
    Поздравляем! Заявки была успешно отправлена
  </h2>
  <ul class="modal__list modal__list--bottom">
    <p class="modal__text">
      В ближайшее время с вами свяжется наш менеджер
    </p>
    <button class="modal__complete btn" type="button" id="close-complete-btn">Закрыть окно</button>
  </ul>
</div>