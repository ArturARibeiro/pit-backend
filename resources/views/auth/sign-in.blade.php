<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <style>
        html, body {
            font-family: sans-serif;
            display: flex;
            min-height: 100%;
            max-width: 100vw;
            background: #FFB000;
            font-size: 16px;
            padding: .5rem;
            flex: 1;
            margin: 0;
        }

        .form-container {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 1;
        }

        .form {
            width: clamp(120px, 100%, 400px);
            padding: 2rem;
            border-radius: .375rem;
            background: white;
            display: flex;
            flex-direction: column;
            gap: 1rem;

            & .form__heading {
                font-weight: 700;
                margin: 0;
                padding: 0;
            }

            & .form__alert {
                padding: 1rem 1.25rem;
                text-align: center;
                border-radius: .375rem;
                border: solid 1px #FFB00055;
                background: #FFB00022;
                color: #a67708;
            }

            & .form__label {
                display: flex;
                flex-direction: column;
                gap: .125rem;

                & .form__title {
                    font-weight: 500;
                }

                & .form__input {
                    background: rgb(234, 234, 234);
                    border: 1px solid rgb(234, 234, 234);
                    border-radius: 0.375rem;
                    padding: 0.675rem 1rem;
                    font-weight: 500;
                    font-size: 1rem;
                    line-height: 1;
                    outline: none;
                }
            }

            & .form__buttons {
                display: flex;
                flex-direction: column;
                gap: .25rem;

                & .form__button {
                    padding: .75rem 1rem;
                    background: #FFB000;
                    font-weight: bold;
                    display: inline-flex;
                    justify-content: center;
                    border-radius: .375rem;
                    transition: opacity 80ms;
                    text-decoration: none;
                    font-size: .875rem;
                    border: none;
                    cursor: pointer;

                    &:active {
                        opacity: .5;
                    }
                }

                & .form__button--outline {
                    padding: .75rem 1rem;
                    background: transparent;
                    font-weight: bold;
                    display: inline-flex;
                    justify-content: center;
                    border-radius: .375rem;
                    border: solid 1px currentColor;
                    transition: opacity 80ms;
                    text-decoration: none;
                    font-size: .875rem;
                    color: #FFB000;
                    cursor: pointer;

                    &:active {
                        opacity: .5;
                    }
                }
            }
        }
    </style>
</head>
<body>
<div class="form-container">
    <form class="form" action="{{ route('auth.register') }}" method="POST"> @csrf
        <h2 class="form__heading">Cadastro</h2>

        <label class="form__label">
            <small class="form__title">Nome completo</small>
            <input
                type="text"
                name="name"
                class="form__input"
                placeholder="Ex: João da Silva"
                value="{{ old('name') }}"
                required
            />
            @error('name')
            {{ $message }}
            @enderror
        </label>

        <label class="form__label">
            <small class="form__title">E-mail</small>
            <input
                type="email"
                name="email"
                class="form__input"
                inputmode="email"
                placeholder="email@dominio.com"
                value="{{ old('email') }}"
                required
            />
            @error('email')
            {{ $message }}
            @enderror
        </label>

        <label class="form__label">
            <small class="form__title">Telefone</small>
            <input
                type="tel"
                name="phone"
                class="form__input"
                inputmode="tel"
                placeholder="(00) 91234-5678"
                value="{{ old('phone') }}"
                required
            />
            @error('phone')
            {{ $message }}
            @enderror
        </label>

        <label class="form__label">
            <small class="form__title">Senha</small>
            <input
                type="password"
                name="password"
                class="form__input"
                placeholder="********"
                value="{{ old('password') }}"
                required
            />
            @error('password')
            {{ $message }}
            @enderror
        </label>

        <label class="form__label">
            <small class="form__title">Confirmar Senha</small>
            <input
                type="password"
                name="password_confirmation"
                class="form__input"
                placeholder="********"
                value="{{ old('password_confirmation') }}"
                required
            />
            @error('password_confirmation')
            {{ $message }}
            @enderror
        </label>

        <div class="form__buttons">
            <button type="submit" class="form__button">Cadastrar</button>
            <a href="/login" class="form__button--outline">Já possuo uma conta</a>
        </div>
    </form>
</div>
</body>
</html>
