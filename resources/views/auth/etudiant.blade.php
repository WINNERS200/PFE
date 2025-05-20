<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Étudiant</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background-image: url('/images/50027253596_69b2d9af7a_o.jpg');
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 400px;
            margin: 100px auto;
            padding: 30px;
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .btn-blue {
            width: 100%;
            padding: 12px;
            margin-top: 15px;
            background-color: #007bff;
            color: white;
            border: none;
            font-weight: bold;
            font-size: 15px;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn-blue:hover {
            background-color: #0056b3;
        }

        .btn-create {
            display: block;
            width: 100%;
            margin-top: 15px;
            padding: 12px;
            background-color: #28a745;
            color: white;
            border: none;
            font-weight: bold;
            font-size: 15px;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-create:hover {
            background-color: #218838;
        }

        .link {
            margin-top: 20px;
        }

        .link a {
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
        }

        .error {
            color: red;
            margin-bottom: 15px;
        }

        .input-error {
            border-color: red;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Connexion Étudiant</h2>

    {{-- Afficher les erreurs --}}
    @if(session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif

    {{-- Formulaire de connexion --}}
    <form method="POST" action="{{ route('login.etudiant') }}" id="loginForm">
        @csrf
        <input type="email" name="email" id="email" placeholder="Adresse e-mail" required>
        <input type="password" name="password" id="password" placeholder="Mot de passe" required>
        <button type="submit" class="btn-blue">Se connecter</button>
    </form>

    {{-- Lien vers la page d'enregistrement --}}
    <form action="{{ route('register.etudiant') }}" method="GET">
        <button type="submit" class="btn-create">Créer un compte</button>
    </form>

    {{-- Lien de mot de passe oublié --}}
    <div class="link">
        <a href="#" id="forgotPassword">Mot de passe oublié ?</a>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Validation basique avant soumission
    const loginForm = document.getElementById('loginForm');
    const passwordInput = document.getElementById('password');
    
    loginForm.addEventListener('submit', function(e) {
        const email = document.getElementById('email').value;
        const password = passwordInput.value;
        
        // Validation email simple
        if (!email.includes('@') || !email.includes('.')) {
            e.preventDefault();
            alert('Veuillez entrer une adresse email valide');
            return;
        }
        
        // Validation mot de passe
        if (password.length < 6) {
            e.preventDefault();
            passwordInput.classList.add('input-error');
            alert('Le mot de passe doit contenir au moins 8 caractères');
        }
    });

    // Réinitialiser l'erreur quand l'utilisateur tape
    passwordInput.addEventListener('input', function() {
        if (this.classList.contains('input-error')) {
            this.classList.remove('input-error');
        }
    });

    // Lien mot de passe oublié avec email pré-rempli si valide
    document.getElementById('forgotPassword').addEventListener('click', function(e) {
        e.preventDefault();
        const email = document.getElementById('email').value;
        let url = '/mot-de-passe-oublie';
        
        if (email.includes('@') && email.includes('.')) {
            url += `?email=${encodeURIComponent(email)}`;
        }
        
        window.location.href = url;
    });
});
</script>

</body>
</html>