<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - E-Kantin MEALYUNG</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #f5f5f5ff 0%, #f1f1f1ff 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .login-container {
      display: grid;
      grid-template-columns: 1fr 1fr;
      max-width: 1100px;
      width: 100%;
      background: rgba(255, 255, 255, 0.9);
      border-radius: 20px;
      overflow: hidden;
      backdrop-filter: blur(12px);
      box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
    }

    .login-left {
      background: linear-gradient(135deg, #fb923c 0%, #ef4444 100%);
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      padding: 3rem;
      text-align: center;
    }

    .login-left img {
      width: 280px;
      margin-bottom: 1.5rem;
      animation: float 6s ease-in-out infinite;
    }

    .login-left h2 {
      font-size: 28px;
      font-weight: 700;
      margin-bottom: 0.75rem;
    }

    .login-left p {
      font-size: 16px;
      opacity: 0.9;
    }

    @keyframes float {
      0% { transform: translateY(0px); }
      50% { transform: translateY(-18px); }
      100% { transform: translateY(0px); }
    }

    .login-right {
      padding: 4rem 3rem;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .login-right h3 {
      font-size: 26px;
      font-weight: 700;
      margin-bottom: 1.5rem;
      color: #1f2937;
      text-align: center;
    }

    .btn-login {
      background: linear-gradient(135deg, #ef4444 0%, #fb923c 100%);
      transition: all 0.3s ease;
    }

    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 20px rgba(239, 68, 68, 0.3);
    }

    .register-link a {
      color: #ef4444;
      font-weight: 600;
    }

    .register-link a:hover {
      text-decoration: underline;
    }

    .password-container {
      position: relative;
    }

    .password-toggle {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #9ca3af;
    }

    .password-toggle:hover {
      color: #ef4444;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <!-- Left Side -->
    <div class="login-left">
      <img src="https://cdn-icons-png.flaticon.com/512/8146/8146003.png" alt="Ilustrasi Login">
      <h2>Selamat Datang</h2>
      <p>Login ke akun MEALYUNG untuk menikmati pesanank</p>
    </div>

    <!-- Right Side -->
    <div class="login-right">
      <!-- Session Status -->
      @if (session('status'))
        <div class="mb-4 text-green-600 font-medium">
          {{ session('status') }}
        </div>
      @endif

      <h3>Login ke Akun Anda</h3>

      <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="form-group mb-4">
          <x-input-label for="email" :value="__('Email')" />
          <x-text-input id="email" class="block mt-1 w-full border rounded-lg p-3"
                        type="email" name="email"
                        :value="old('email')" required autofocus 
                        autocomplete="username" />
          <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
        </div>

        <!-- Password -->
        <div class="form-group mb-4">
          <x-input-label for="password" :value="__('Password')" />
          <div class="password-container">
            <x-text-input id="password" class="block mt-1 w-full border rounded-lg p-3 pr-10"
                          type="password"
                          name="password"
                          required autocomplete="current-password" />
            <i class="password-toggle fas fa-eye" id="togglePassword"></i>
          </div>
          <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
        </div>

        <!-- Remember Me + Forgot -->
        <div class="flex items-center justify-between mb-5">
          <label for="remember_me" class="flex items-center">
            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-red-600 focus:ring-red-500" name="remember">
            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
          </label>

          @if (Route::has('password.request'))
            <a class="text-sm text-red-600 hover:underline" href="{{ route('password.request') }}">
              {{ __('Forgot your password?') }}
            </a>
          @endif
        </div>

        <!-- Actions -->
        <div>
          <button type="submit" class="btn-login w-full py-3 px-4 rounded-lg text-white font-semibold shadow-lg">
            {{ __('Log in') }}
          </button>
        </div>
      </form>

      <!-- Register -->
      <div class="register-link mt-6 text-center">
        <p>Belum punya akun? 
          <a href="{{ route('register') }}">{{ __('Register now') }}</a>
        </p>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const togglePassword = document.getElementById('togglePassword');
      const passwordInput = document.getElementById('password');

      togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
      });
    });
  </script>
</body>
</html>
