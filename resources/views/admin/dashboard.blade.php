<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Administrateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff; /* Fond blanc */
        }
        .dashboard-card {
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .dashboard-title {
            font-size: 1.8rem;
            font-weight: bold;
            color: #0d6efd;
        }
        .btn-dashboard {
            width: 100%;
            padding: 15px;
            font-size: 1.1rem;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<!-- Image d'en-tête centrée en haut de la page, positionnée au milieu en haut -->
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-auto">
            <img src="/images/télécharger.png" alt="Image d'en-tête" class="img-fluid d-block mx-auto" style="max-width: 320px; width: 100%; height: 120px;">
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="card dashboard-card">
        <div class="card-header bg-white text-center border-bottom">
            <h2 class="dashboard-title">👨‍💼 Tableau de Bord - Administrateur</h2>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-4">
                    <a href="{{ route('admin.gestion_comptes') }}" class="btn btn-primary btn-dashboard">👤 Gestion des comptes</a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('admin.gestion_filiers') }}" class="btn btn-primary btn-dashboard">🏛️ Gestion des filières</a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('admin.gestion_annees') }}" class="btn btn-primary btn-dashboard">📅 Gestion des années académiques</a>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
