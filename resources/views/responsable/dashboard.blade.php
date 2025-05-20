<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord Responsable</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #ffffff; /* Fond blanc */
            min-height: 100vh;
        }

        .card {
            background-color: #f8f9fa; /* Gris clair */
        }

        .card-title {
            font-weight: bold;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 230px;
        }

        h1 {
            font-weight: bold;
            color: #0d6efd;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom mb-4">
        <div class="container-fluid">
            <a class="navbar-brand text-primary fw-bold" href="#">Espace Responsable</a>
            <form method="POST" action="{{ route('logout') }}" class="d-flex">
                @csrf
                <button type="submit" class="btn btn-primary">Déconnexion</button>
            </form>
        </div>
    </nav>

    <!-- Dashboard -->
    <div class="container py-4">
        <h1 class="text-center mb-5">👨‍💼 Tableau de bord du Responsable</h1>

        <div class="row g-4">

            <div class="col-md-4">
                <div class="card shadow-sm h-100 text-center">
                    <div class="card-body">
                        <h5 class="card-title">🗓️ Planifier des cours</h5>
                        <p class="card-text">Créer et organiser les plannings des cours.</p>
                        <a href="{{ route('responsable.planification') }}" class="btn btn-primary w-100">Planifier</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm h-100 text-center">
                    <div class="card-body">
                        <h5 class="card-title">📝 Gestion des inscriptions</h5>
                        <p class="card-text">Valider ou refuser les demandes d’inscription.</p>
                        <a href="{{ route('responsable.inscriptions') }}" class="btn btn-primary w-100">Gérer</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm h-100 text-center">
                    <div class="card-body">
                        <h5 class="card-title">👨‍🎓 Étudiants inscrits</h5>
                        <p class="card-text">Consulter la liste des étudiants par formation.</p>
                        <a href="{{ route('responsable.inscrit') }}" class="btn btn-primary w-100">Consulter</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm h-100 text-center">
                    <div class="card-body">
                        <h5 class="card-title">👩‍🏫 Affecter les formateurs</h5>
                        <p class="card-text">Attribuer les modules aux formateurs disponibles.</p>
                        <a href="{{ route('responsable.affecter') }}" class="btn btn-primary w-100">Affecter</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm h-100 text-center">
                    <div class="card-body">
                        <h5 class="card-title">📢 Cibler des annonces</h5>
                        <p class="card-text">Envoyer des annonces aux étudiants ou formateurs.</p>
                        <a href="{{ route('responsable.annonce') }}" class="btn btn-primary w-100">Publier</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
