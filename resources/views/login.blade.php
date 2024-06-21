<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BORALAJEAR! | Login</title>
    <!-- Favicons -->
    <link href="{{ asset('public/img/elemento.ico') }}" rel="icon">
    <link href="{{ asset('public/img/elemento.ico') }}" rel="apple-touch-icon">
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #2bab3c;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
        }

        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        .input-group {
            margin-bottom: 10px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            padding: 8px;
            width: 100%;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        button {
            padding: 10px;
            background-color: #048f2a;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 30px;
        }

        button:hover {
            background-color: #2bab3c;
        }

        .alert {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #f5c6cb;
            border-radius: 3px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <form action="{{ url('/admin/autenticar') }}" method="post">
            @csrf
            <h2>Login</h2>
            @if (session('erroLogin'))
                <div class="alert alert-danger">{{ session('erroLogin') }}</div>
            @endif
            <div class="input-group">
                <label for="username">Usuário</label>
                <input type="text" id="username" name="usuario" placeholder="Seu usuário" required>
            </div>
            <div class="input-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="senha" placeholder="Sua senha" required>
            </div>
            <button class="mb-4" type="submit">Entrar</button>
            <a style="margin-top: 3vw;" href="{{ url('/') }}">Voltar para página</a>
        </form>
    </div>
</body>

</html>
