<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Administrateur</title>
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
            margin-bottom: 5px;
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
            font-size: 12px;
            margin-bottom: 10px;
            display: none;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Connexion Administrateur</h2>
        <form id="adminLoginForm" action="#" method="POST">
            @csrf
            <input type="email" name="email" id="adminEmail" placeholder="Adresse e-mail" required>
            <div id="emailError" class="error-message"></div>
            
            <input type="password" name="password" id="adminPassword" placeholder="Mot de passe" required>
            <div id="passwordError" class="error-message"></div>
            
            <button type="submit" class="login-button">Se connecter</button>
        </form>
        <div class="back-link">
            <a href="{{ url('/') }}">← Retour à l'accueil</a>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const loginForm = document.getElementById('adminLoginForm');
        const emailInput = document.getElementById('adminEmail');
        const passwordInput = document.getElementById('adminPassword');

        // Validation de l'email en temps réel
        emailInput.addEventListener('input', function() {
            if (!this.value.includes('@') || !this.value.includes('.')) {
                document.getElementById('emailError').textContent = 'Veuillez entrer une adresse email valide';
                document.getElementById('emailError').style.display = 'block';
                this.classList.add('input-error');
            } else {
                document.getElementById('emailError').style.display = 'none';
                this.classList.remove('input-error');
            }
        });

        // Validation du mot de passe en temps réel
        passwordInput.addEventListener('input', function() {
            if (this.value.length < 8) {
                document.getElementById('passwordError').textContent = 'Le mot de passe doit contenir au moins 8 caractères';
                document.getElementById('passwordError').style.display = 'block';
                this.classList.add('input-error');
            } else {
                document.getElementById('passwordError').style.display = 'none';
                this.classList.remove('input-error');
            }
        });

        // Validation finale avant soumission
        loginForm.addEventListener('submit', function(e) {
            let isValid = true;
            
            // Validation email
            if (!emailInput.value.includes('@') || !emailInput.value.includes('.')) {
                document.getElementById('emailError').textContent = 'Veuillez entrer une adresse email valide';
                document.getElementById('emailError').style.display = 'block';
                emailInput.classList.add('input-error');
                isValid = false;
            }
            
            // Validation mot de passe
            if (passwordInput.value.length < 8) {
                document.getElementById('passwordError').textContent = 'Le mot de passe doit contenir au moins 8 caractères';
                document.getElementById('passwordError').style.display = 'block';
                passwordInput.classList.add('input-error');
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
            } else {
                // Optionnel: Afficher un indicateur de chargement
                this.querySelector('.login-button').textContent = 'Connexion en cours...';
            }
        });
    });
    </script>
</body>
</html>