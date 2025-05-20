<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page d'accueil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
        margin: 0;
        padding: 0;
        background-image: url('/images/50027253596\_69b2d9af7a\_o.jpg');
        background-size: cover;
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        }

        .container {
            text-align: center;
            background-color:rgba(245, 245, 245, 0.78);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        h1 {
            color: #333;
            margin-bottom: 30px;
        }

        .btn {
            display: block;
            width: 250px;
            margin: 15px auto;
            padding: 15px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>

<div class="container">
    <h1>Bienvenue sur l'application de la gestion des inscriptions</h1>

    <a href="{{ route('login.etudiant') }}" class="btn">Espace Étudiant</a>
    <a href="{{ route('login.responsable') }}" class="btn">Espace Responsable</a>
    <a href="{{ route('login.admin') }}" class="btn">Espace Administrateur</a>
</div>

</body>
</html>
