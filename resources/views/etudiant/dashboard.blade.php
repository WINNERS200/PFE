<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Étudiant</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
        <!-- Image d'en-tête alignée en haut à droite, au-dessus de la barre de navigation -->
        <div class="position-absolute top-0 end-0 mt-3 me-3" style="z-index: 1050;">
            <img src="/images/télécharger.png" alt="Image d'en-tête" class="img-fluid" style="max-width: 200px;">
        </div>
        

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Espace Étudiant</a>
    </div>
</nav>

<div class="container mt-4">
    <h2 class="text-center mb-4">Bienvenue sur votre tableau de bord</h2>

    <div class="row row-cols-1 row-cols-md-2 g-4">
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">📌 Consulter le statut</h5>
                    <p class="card-text">Voir l’état de votre inscription ou votre profil.</p>
                    <a href="{{ route('etudiant.consulter') }}" class="btn btn-primary">Voir le statut</a>
                </div>
            </div>
        </div>
        
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">📝 S'inscrire à une formation</h5>
                    <p class="card-text">Choisissez une formation et inscrivez-vous facilement.</p>
                    <a href="{{ route('etudiant.inscription') }}" class="btn btn-primary">S'inscrire</a>
                </div>
            </div>
        </div>
        
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">💳 Payer les frais</h5>
                    <p class="card-text">Effectuez vos paiements de manière sécurisée.</p>
                    <a href="{{ route('etudiant.paiement') }}" class="btn btn-primary">Payer</a>
                </div>
            </div>
        </div>
        
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">📄 Fiche administrative</h5>
                    <p class="card-text">Générez votre fiche ou documents administratifs.</p>
                    <a href="{{ route('etudiant.fiche') }}" class="btn btn-primary">Demander fiche</a>
                </div>
            </div>
        </div>
        
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">📅 Consulter le planning</h5>
                    <p class="card-text">Accédez à votre emploi du temps.</p>
                    <a href="{{ route('etudiant.planning') }}" class="btn btn-primary">Voir le planning</a>
                </div>
            </div>
        </div>
        
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">📚 Historique académique</h5>
                    <p class="card-text">Consultez vos notes et formations passées.</p>
                    <a href="{{ route('etudiant.historique') }}" class="btn btn-primary">Voir l'historique</a>
                </div>
            </div>
        </div>
        
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">📢 Annonces</h5>
                    <p class="card-text">Tenez-vous informé des dernières actualités.</p>
                    <a href="{{ route('etudiant.annonces') }}" class="btn btn-primary">Voir les annonces</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>