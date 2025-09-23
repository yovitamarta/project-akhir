<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - E-Kantin MEALYUNG</title>
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

    .register-container {
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

    .register-left {
      background: linear-gradient(135deg, #fb923c 0%, #ef4444 100%);
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      padding: 3rem;
      text-align: center;
    }

    .register-left img {
      width: 280px;
      margin-bottom: 1.5rem;
      animation: float 6s ease-in-out infinite;
    }

    .register-left h2 {
      font-size: 28px;
      font-weight: 700;
      margin-bottom: 0.75rem;
    }

    .register-left p {
      font-size: 16px;
      opacity: 0.9;
    }

    @keyframes float {
      0% { transform: translateY(0px); }
      50% { transform: translateY(-18px); }
      100% { transform: translateY(0px); }
    }

    .register-right {
      padding: 4rem 3rem;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .register-right h3 {
      font-size: 26px;
      font-weight: 700;
      margin-bottom: 1.5rem;
      color: #1f2937;
      text-align: center;
    }

    .btn-register {
      background: linear-gradient(135deg, #ef4444 0%, #fb923c 100%);
      transition: all 0.3s ease;
    }

    .btn-register:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 20px rgba(239, 68, 68, 0.3);
    }

    .login-link a {
      color: #ef4444;
      font-weight: 600;
    }

    .login-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="register-container">
    <!-- Left Side -->
    <div class="register-left">
      <img src="https://cdn-icons-png.flaticon.com/512/747/747376.png" alt="Ilustrasi Register">
      <h2>Buat Akun Baru</h2>
      <p>Daftar sekarang untuk mulai menikmati layanan MEALYUNG</p>
    </div>

    <!-- Right Side -->
    <div class="register-right">
      <h3>Form Registrasi</h3>

      <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="form-group mb-4">
          <x-input-label for="name" :value="__('Name')" />
          <x-text-input id="name" class="block mt-1 w-full border rounded-lg p-3" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
          <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-600" />
        </div>

        <!-- Email Address -->
        <div class="form-group mb-4">
          <x-input-label for="email" :value="__('Email')" />
          <x-text-input id="email" class="block mt-1 w-full border rounded-lg p-3" type="email" name="email" :value="old('email')" required autocomplete="username" />
          <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
        </div>

        <!-- Password -->
        <div class="form-group mb-4">
          <x-input-label for="password" :value="__('Password')" />
          <x-text-input id="password" class="block mt-1 w-full border rounded-lg p-3" type="password" name="password" required autocomplete="new-password" />
          <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
        </div>

        <!-- Confirm Password -->
        <div class="form-group mb-4">
          <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
          <x-text-input id="password_confirmation" class="block mt-1 w-full border rounded-lg p-3" type="password" name="password_confirmation" required autocomplete="new-password" />
          <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600" />
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between mt-6">
          <div class="login-link">
            <p>Sudah punya akun? 
              <a href="{{ route('login') }}">{{ __('Login sekarang') }}</a>
            </p>
          </div>

          <button type="submit" class="btn-register py-3 px-6 rounded-lg text-white font-semibold shadow-lg">
            {{ __('Register') }}
          </button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
