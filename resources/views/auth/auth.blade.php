<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Аутентификация</title>
    @include('components.auth-style')
</head>

<body>
    <div class="auth-container">
        <!-- Регистрация -->
        <div id="register-form">
        
            <h1>register</h1>
            <form method="POST" action="{{ route('register') }}" id="register">
            @csrf    
            <div class="form-group">
                <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="register-name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />

                
                </div>
                <div class="form-group">
                <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="register-email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />

              
                </div>
                <div class="form-group">
                <x-input-label for="password" :value="__('Password')" />

<x-text-input id="register-password" class="block mt-1 w-full"
                type="password"
                name="password"
                required autocomplete="new-password" />

<x-input-error :messages="$errors->get('password')" class="mt-2" />

                 
                </div>
                <div class="form-group">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

<x-text-input id="register-confirm-password" class="block mt-1 w-full"
                type="password"
                name="password_confirmation" required autocomplete="new-password" />

<x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                </div>
                <button id="reggoBut" type="submit">Зарегистрироваться</button>
            </form>
            <div class="auth-footer">
            Already registered? <a href="#" id="show-login">Login!</a>
            </div>
        </div>

        <!-- Авторизация -->
        <div id="login-form" class="hidden">
            <h1>Login</h1>
            <form method="POST" action="{{ route('login') }}" id="login">
@csrf
                <div class="form-group">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="login-email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="form-group">
                <x-input-label for="password" :value="__('Password')" />

<x-text-input id="login-password" class="block mt-1 w-full"
                type="password"
                name="password"
                required autocomplete="current-password" />

<x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <button id="loggoBut" type="submit">Войти</button>
            </form>
            <div class="auth-footer">
            No account? <a href="#" id="show-register">Register!</a><br>
                <a href="#" id="show-reset">Forgot password?</a>
            </div>
        </div>

        <!-- Сброс пароля -->
        <div id="reset-form" class="hidden">
            <h1>Reset password</h1>
            <form id="reset">
                <div class="form-group">
                    <label for="reset-email">Email</label>
                    <input type="email" id="reset-email" name="email" required>
                    <div id="reset-message" class="success-message hidden"></div>
                    <div id="reset-error" class="error-message hidden"></div>
                </div>
                <button id="resgoBut" type="submit">Send reset url</button>
            </form>
            <div class="auth-footer">
                <a href="#" id="show-login-from-reset">go to login</a>
            </div>
        </div>
    </div>

    <script>
        let reglogButtons = [
            "Unlock Your Notes!",
            "Dive into Markdown!",
            "Access Your Mind!",
            "Open the Brain Vault!",
            "Secure Your Insights!",
            "Enter the Note Hub!",
            "Jump in!",
            "Go for it!",
            "Let’s do this!"
        ];

        function getRandomElements(arr) {
            // Проверяем, что массив содержит минимум 3 элемента
            if (arr.length < 3) {
                throw new Error("Массив должен содержать как минимум 3 элемента.");
            }

            // Создаем копию массива для случайной выборки
            const shuffled = arr.slice().sort(() => 0.5 - Math.random());
            
            // Возвращаем первые три элемента из перемешанного массива
            return shuffled.slice(0, 2);
        }

        let goButtons = getRandomElements(reglogButtons);
        document.getElementById('reggoBut').innerText = goButtons[0];
        document.getElementById('loggoBut').innerText = goButtons[1];


        // Переключение между формами
        document.getElementById('show-login').addEventListener('click', function (e) {
            e.preventDefault();
            document.getElementById('register-form').classList.add('hidden');
            document.getElementById('login-form').classList.remove('hidden');
            document.getElementById('reset-form').classList.add('hidden');
        });

        document.getElementById('show-register').addEventListener('click', function (e) {
            e.preventDefault();
            document.getElementById('register-form').classList.remove('hidden');
            document.getElementById('login-form').classList.add('hidden');
            document.getElementById('reset-form').classList.add('hidden');
        });

        document.getElementById('show-reset').addEventListener('click', function (e) {
            e.preventDefault();
            document.getElementById('register-form').classList.add('hidden');
            document.getElementById('login-form').classList.add('hidden');
            document.getElementById('reset-form').classList.remove('hidden');
        });

        document.getElementById('show-login-from-reset').addEventListener('click', function (e) {
            e.preventDefault();
            document.getElementById('register-form').classList.add('hidden');
            document.getElementById('login-form').classList.remove('hidden');
            document.getElementById('reset-form').classList.add('hidden');
        });
    </script>
</body>

</html>