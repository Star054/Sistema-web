<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>

    <img src="{{ asset('images/b.png') }}" alt="Logo"
         style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; position: absolute; top: 20px; left: 20px;">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1d4e89, #f60000, #ffb74d, #e91e63);
            background-size: 300% 300%;
            animation: backgroundShift 10s ease infinite;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        @keyframes backgroundShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }


        .login-container {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            padding: 2rem;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .login-container:hover {
            transform: scale(1.01);
        }

        h2 {
            font-size: 2rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            text-align: left;
        }

        label {
            font-weight: 600;
            color: #555;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            display: inline-block;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #1d4e89;
            box-shadow: 0 0 10px rgba(29, 78, 137, 0.3);
            outline: none;
        }

        .form-group input[type="checkbox"] {
            width: 1.2rem;
            height: 1.2rem;
            margin-right: 0.75rem;
            cursor: pointer;
        }

        .form-group .checkbox-label {
            font-size: 1rem;
            font-weight: 600;
            color: #555;
        }

        .forgot-password {
            display: inline-block;
            margin-bottom: 1.5rem;
            color: #1d4e89;
            font-size: 0.9rem;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: #e91e63;
        }

        .login-btn {
            width: 100%;
            background-color: #1d4e89;
            color: white;
            padding: 0.75rem;
            font-size: 1rem;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .login-btn:hover {
            background-color: #e91e63;
            transform: scale(1.05);
        }

        .register-link {
            margin-top: 1.5rem;
            display: block;
            color: #555;
            font-size: 0.9rem;
        }

        .register-link a {
            color: #1d4e89;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .register-link a:hover {
            color: #e91e63;
        }



    </style>
</head>
<body>

<div class="login-container">
    <h2>Iniciar Sesión</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input id="email" type="email" name="email" required autofocus autocomplete="username" value="{{ old('email') }}">
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input id="password" type="password" name="password" required autocomplete="current-password">
        </div>

        <!-- Remember Me -->
        <div class="form-group">
            <input id="remember_me" type="checkbox" name="remember">
            <label for="remember_me" class="checkbox-label">Recordarme</label>
        </div>

        <!-- Forgot Password -->
        <a href="{{ route('password.request') }}" class="forgot-password">¿Olvidaste tu contraseña?</a>

        <!-- Submit Button -->
        <button type="submit" class="login-btn">Iniciar sesión</button>
    </form>

    <!-- Register Link -->
{{--    @if (Route::has('register'))--}}
{{--        <p class="register-link">--}}
{{--            ¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate aquí</a>--}}
{{--        </p>--}}
{{--    @endif--}}
</div>

</body>
</html>
