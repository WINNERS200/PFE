<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Enseignant</title>
    <style>
        body {
            background-image: url('/images/50027253596_69b2d9af7a_o.jpg');
            background-size: cover;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            width: 400px;
            background-color: #f4f4f4;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        .input-error {
            border-color: #dc3545;
        }

        .login-button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background-color: #007bff;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        .login-button:hover {
            background-color: #0056b3;
        }

        .back-link {
            text-align: center;
            margin-top: 15px;
        }

        .back-link a {
            color: #007bff;
            text-decoration: none;
        }

        .back-link a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: #dc3545;
            font-size: 14px;
            margin-top: -10px;
            margin-bottom: 15px;
            display: none;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Connexion Enseignant</h2>
        <form id="loginForm" action="#" method="POST">
            @csrf
            <input type="email" name="email" id="email" placeholder="Adresse e-mail" required>
            <div id="emailError" class="error-message"></div>
            
            <input type="password" name="password" id="password" placeholder="Mot de passe" required>
            <div id="passwordError" class="error-message"></div>
            
            <button type="submit" class="login-button">Se connecter</button>
        </form>
        <div class="back-link">
            <a href="{{ url('/') }}">← Retour à l'accueil</a>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const loginForm = document.getElementById('loginForm');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const emailError = document.getElementById('emailError');
        const passwordError = document.getElementById('passwordError');

        // Validation de l'email en temps réel
        emailInput.addEventListener('input', function() {
            const email = emailInput.value;
            if (!email.includes('@') || !email.includes('.')) {
                emailError.textContent = 'Veuillez entrer une adresse email valide';
                emailError.style.display = 'block';
                emailInput.classList.add('input-error');
            } else {
                emailError.style.display = 'none';
                emailInput.classList.remove('input-error');
            }
        });

        // Validation du mot de passe en temps réel
        passwordInput.addEventListener('input', function() {
            if (passwordInput.value.length < 8) {
                passwordError.textContent = 'Le mot de passe doit contenir au moins 8 caractères';
                passwordError.style.display = 'block';
                passwordInput.classList.add('input-error');
            } else {
                passwordError.style.display = 'none';
                passwordInput.classList.remove('input-error');
            }
        });

        // Validation finale avant soumission
        loginForm.addEventListener('submit', function(e) {
            let isValid = true;
            
            // Validation email
            if (!emailInput.value.includes('@') || !emailInput.value.includes('.')) {
                emailError.textContent = 'Veuillez entrer une adresse email valide';
                emailError.style.display = 'block';
                emailInput.classList.add('input-error');
                isValid = false;
            }
            
            // Validation mot de passe
            if (passwordInput.value.length < /) {
                passwordError.textContent = 'Le mot de passe doit contenir au moins 8 caractères';
                passwordError.style.display = 'block';
                passwordInput.classList.add('input-error');
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
            }
        });
    });
    </script>
</body>
</html>