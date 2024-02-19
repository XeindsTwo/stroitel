<div>
  <form wire:submit.prevent="addUser">
    <div class="form-group">
      <label class="label" for="login">Логин:</label>
      @error('login') <span class="error error--active">{{ $message }}</span> @enderror
      <input class="input" type="text" required wire:model="login" id="login">
    </div>

    <div class="form-group">
      <label class="label" for="name">Имя:</label>
      @error('name') <span class="error error--active">{{ $message }}</span> @enderror
      <input class="input" type="text" required wire:model="name" id="name">
    </div>

    <div class="form-group">
      <label class="label" for="email">Email:</label>
      @error('email') <span class="error error--active">{{ $message }}</span> @enderror
      <input class="input" type="email" required wire:model="email" id="email">
    </div>

    <div class="form-group">
      <label class="label" for="password">Пароль:</label>
      @error('password') <span class="error error--active">{{ $message }}</span> @enderror
      <input class="input" type="password" required wire:model="password" id="password">
    </div>

    <div class="form-group">
      <label class="label" for="role">Роль:</label>
      <select class="input" wire:model="role" id="role" required>
        <option value="USER">Пользователь</option>
        <option value="ADMIN">Администратор</option>
      </select>
    </div>

    <button type="submit">Добавить пользователя</button>
  </form>

  @if (session()->has('message'))
    <div>{{ session('message') }}</div>
  @endif

  <ul>
    @foreach($users as $user)
      <li>{{ $user->login }} <br> {{ $user->email }}</li>
      <br>
      <br>
    @endforeach
  </ul>
</div>