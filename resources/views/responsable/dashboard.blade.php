<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord Responsable</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Icons (Bootstrap Icons) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f2f5f9;
        }

        .navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        h1 {
            font-weight: 700;
            color: #0d6efd;
        }

        .card {
            border: none;
            border-radius: 1rem;
            background-color: #ffffff;
            transition: transform 0.2s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        }

        .card-title {
            font-weight: 600;
            font-size: 1.2rem;
        }

        .btn-primary {
            border-radius: 50px;
            font-weight: 500;
        }

        .dashboard-title {
            font-size: 2rem;
        }
    </style>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid px-4">
        <a class="navbar-brand text-primary fw-bold d-flex align-items-center" href="#">
            <img src="/images/télécharger.png" alt="Image d'en-tête" style="height: 48px; width: auto; margin-right: 12px;">
            🎓 Espace Responsable
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-primary">Déconnexion</button>
        </form>
    </div>
</nav>

<!-- Dashboard -->
<div class="container py-5">
    <h1 class="text-center dashboard-title mb-5">👨‍💼 Tableau de bord du Responsable</h1>

    <div class="row g-4">

        <div class="col-md-4">
            <div class="card p-4 text-center h-100">
                <div class="card-body">
                    <div class="mb-3 fs-2 text-primary"><i class="bi bi-calendar-check-fill"></i></div>
                    <h5 class="card-title">Planifier des cours</h5>
                    <p class="text-muted">Créer et organiser les plannings des cours.</p>
                    <a href="{{ route('responsable.planification') }}" class="btn btn-primary w-100">Planifier</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-4 text-center h-100">
                <div class="card-body">
                    <div class="mb-3 fs-2 text-primary"><i class="bi bi-clipboard-check-fill"></i></div>
                    <h5 class="card-title">Gestion des inscriptions</h5>
                    <p class="text-muted">Valider ou refuser les demandes d’inscription.</p>
                    <a href="{{ route('responsable.inscriptions') }}" class="btn btn-primary w-100">Gérer</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-4 text-center h-100">
                <div class="card-body">
                    <div class="mb-3 fs-2 text-primary"><i class="bi bi-people-fill"></i></div>
                    <h5 class="card-title">Étudiants inscrits</h5>
                    <p class="text-muted">Consulter la liste des étudiants par formation.</p>
                    <a href="{{ route('responsable.inscrit') }}" class="btn btn-primary w-100">Consulter</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 mx-auto">
            <div class="card p-4 text-center h-100">
                <div class="card-body">
                    <div class="mb-3 fs-2 text-primary"><i class="bi bi-megaphone-fill"></i></div>
                    <h5 class="card-title">Cibler des annonces</h5>
                    <p class="text-muted">Envoyer des annonces aux étudiants ou formateurs.</p>
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
