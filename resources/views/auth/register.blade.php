<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un compte - Formation Continue</title>
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

        .register-container {
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

        input[type="text"],
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

        .register-button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background-color: #28a745;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        .register-button:hover {
            background-color: #218838;
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
    <div class="register-container">
        <h2>Créer un compte</h2>
        <form method="POST" action="{{ route('register.etudiant.submit') }}" id="registerForm">
            @csrf
            
            <input type="text" name="name" id="name" placeholder="Nom complet" required>
            <div id="nameError" class="error-message"></div>
            
            <input type="email" name="email" id="email" placeholder="Adresse e-mail" required>
            <div id="emailError" class="error-message"></div>
            
            <input type="password" name="password" id="password" placeholder="Mot de passe" required>
            <div id="passwordError" class="error-message"></div>
            
            <input type="password" name="password_confirmation" id="confirmPassword" placeholder="Confirmer le mot de passe" required>
            <div id="confirmPasswordError" class="error-message"></div>
            
            <button type="submit" class="register-button">S'inscrire</button>
        </form>
        <div class="back-link">
            <a href="{{ url('/') }}">← Retour à l'accueil</a>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const registerForm = document.getElementById('registerForm');
        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirmPassword');
        
        // Validation du nom
        nameInput.addEventListener('input', function() {
            if (this.value.length < 3) {
                document.getElementById('nameError').textContent = 'Le nom doit contenir au moins 3 caractères';
                document.getElementById('nameError').style.display = 'block';
                this.classList.add('input-error');
            } else {
                document.getElementById('nameError').style.display = 'none';
                this.classList.remove('input-error');
            }
        });

        // Validation de l'email
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

        // Validation du mot de passe
        passwordInput.addEventListener('input', function() {
            if (this.value.length < 8) {
                document.getElementById('passwordError').textContent = 'Le mot de passe doit contenir au moins 8 caractères';
                document.getElementById('passwordError').style.display = 'block';
                this.classList.add('input-error');
            } else {
                document.getElementById('passwordError').style.display = 'none';
                this.classList.remove('input-error');
            }
            
            // Vérifier la correspondance des mots de passe
            if (confirmPasswordInput.value && this.value !== confirmPasswordInput.value) {
                document.getElementById('confirmPasswordError').textContent = 'Les mots de passe ne correspondent pas';
                document.getElementById('confirmPasswordError').style.display = 'block';
                confirmPasswordInput.classList.add('input-error');
            }
        });

        // Validation de la confirmation du mot de passe
        confirmPasswordInput.addEventListener('input', function() {
            if (this.value !== passwordInput.value) {
                document.getElementById('confirmPasswordError').textContent = 'Les mots de passe ne correspondent pas';
                document.getElementById('confirmPasswordError').style.display = 'block';
                this.classList.add('input-error');
            } else {
                document.getElementById('confirmPasswordError').style.display = 'none';
                this.classList.remove('input-error');
            }
        });

        // Validation finale avant soumission
        registerForm.addEventListener('submit', function(e) {
            let isValid = true;
            
            // Validation du nom
            if (nameInput.value.length < 3) {
                document.getElementById('nameError').textContent = 'Le nom doit contenir au moins 3 caractères';
                document.getElementById('nameError').style.display = 'block';
                nameInput.classList.add('input-error');
                isValid = false;
            }
            
            // Validation de l'email
            if (!emailInput.value.includes('@') || !emailInput.value.includes('.')) {
                document.getElementById('emailError').textContent = 'Veuillez entrer une adresse email valide';
                document.getElementById('emailError').style.display = 'block';
                emailInput.classList.add('input-error');
                isValid = false;
            }
            
            // Validation du mot de passe
            if (passwordInput.value.length < 8) {
                document.getElementById('passwordError').textContent = 'Le mot de passe doit contenir au moins 8 caractères';
                document.getElementById('passwordError').style.display = 'block';
                passwordInput.classList.add('input-error');
                isValid = false;
            }
            
            // Validation de la confirmation
            if (passwordInput.value !== confirmPasswordInput.value) {
                document.getElementById('confirmPasswordError').textContent = 'Les mots de passe ne correspondent pas';
                document.getElementById('confirmPasswordError').style.display = 'block';
                confirmPasswordInput.classList.add('input-error');
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