<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .form-container {
            max-width: 800px;
            margin: 0 auto;
        }
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1100;
        }
        .form-control:focus, .form-select:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
        }
        .btn-primary {
            background-color: #4e73df;
            border-color: #4e73df;
        }
        .btn-primary:hover {
            background-color: #3a5bbf;
            border-color: #3a5bbf;
        }
    </style>
</head>
<body class="bg-light">

<!-- Conteneur pour les notifications Toast -->
<div class="toast-container"></div>

<div class="container py-5">
    <div class="card shadow-sm form-container">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0 text-center"><i class="bi bi-person-plus me-2"></i>Formulaire d'Inscription</h2>
        </div>
        
        <div class="card-body">
            <form id="inscription-form">
                <div class="row g-3">
                    <!-- Colonne 1 -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                        </div>

                        <div class="mb-3">
                            <label for="prenom" class="form-label">Prénom <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="prenom" name="prenom" required>
                        </div>

                        <div class="mb-3">
                            <label for="date_naissance" class="form-label">Date de naissance <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="date_naissance" name="date_naissance" required>
                        </div>
                    </div>

                    <!-- Colonne 2 -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="cin" class="form-label">CIN <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="cin" name="cin" required>
                        </div>

                        <div class="mb-3">
                            <label for="cne" class="form-label">CNE <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="cne" name="cne" required>
                        </div>

                        <div class="row g-2">
                            <div class="col-md-6">
                                <label for="formation" class="form-label">Formation <span class="text-danger">*</span></label>
                                <select class="form-select" id="formation" name="formation" onchange="updateOptions()" required>
                                    <option value="" selected disabled>Choisir...</option>
                                    <option value="licence">Licence</option>
                                    <option value="master">Master</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="option" class="form-label">Option <span class="text-danger">*</span></label>
                                <select class="form-select" id="option" name="option" required disabled>
                                    <option value="" selected disabled>Choisir d'abord la formation</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary px-4 py-2">
                        <i class="bi bi-save me-1"></i> Enregistrer l'inscription
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Options par formation
    const formationOptions = {
        licence: [
            "Administration Avancée des Systèmes et Réseaux Informatiques",
            "Administration, Systèmes, Bases de Données et Réseaux",
            "Développement Informatique",
            "Développement Web et Mobile",
            "Développement Full Stack et Devops",
            "Ingénierie Réseaux et Cloud Computing"
        ],
        master: [
            "Big Data et Cloud Computing",
            "Business Intelligence et Sciences de Données",
            "Management des Systèmes d'Information",
            "Cybersécurité et Cyberdéfense"
        ]
    };

    // Mettre à jour les options selon la formation sélectionnée
    function updateOptions() {
        const formation = document.getElementById("formation").value;
        const optionSelect = document.getElementById("option");
        
        optionSelect.innerHTML = '';
        optionSelect.disabled = !formation;
        
        if (formation) {
            // Ajouter une option par défaut
            const defaultOption = document.createElement("option");
            defaultOption.value = "";
            defaultOption.text = "Choisir une option...";
            defaultOption.disabled = true;
            defaultOption.selected = true;
            optionSelect.add(defaultOption);
            
            // Ajouter les options spécifiques
            formationOptions[formation].forEach(opt => {
                const option = document.createElement("option");
                option.value = opt;
                option.text = opt;
                optionSelect.add(option);
            });
        }
    }

    // Afficher une notification Toast
    function showToast(message, type = 'success') {
        const toastContainer = document.querySelector('.toast-container');
        const toastEl = document.createElement('div');
        
        toastEl.className = `toast align-items-center text-white bg-${type} border-0`;
        toastEl.setAttribute('role', 'alert');
        toastEl.setAttribute('aria-live', 'assertive');
        toastEl.setAttribute('aria-atomic', 'true');
        
        toastEl.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    <i class="bi ${type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill'} me-2"></i>
                    ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        `;
        
        toastContainer.appendChild(toastEl);
        const toast = new bootstrap.Toast(toastEl);
        toast.show();
        
        // Supprimer le Toast après disparition
        toastEl.addEventListener('hidden.bs.toast', () => {
            toastEl.remove();
        });
    }

    // Gérer la soumission du formulaire
    document.getElementById("inscription-form").addEventListener("submit", function(e) {
        e.preventDefault();
        
        // Récupérer les valeurs du formulaire
        const formData = {
            nom: document.getElementById("nom").value,
            prenom: document.getElementById("prenom").value,
            date_naissance: document.getElementById("date_naissance").value,
            cin: document.getElementById("cin").value,
            cne: document.getElementById("cne").value,
            formation: document.getElementById("formation").value,
            option: document.getElementById("option").value
        };
        
        // Ici vous pourriez envoyer les données à un serveur
        console.log("Données d'inscription:", formData);
        
        // Réinitialiser le formulaire
        this.reset();
        document.getElementById("option").disabled = true;
        
        // Afficher une notification de succès
        showToast('Inscription réussie avec succès!');
        
        // Option: Afficher un résumé dans la console
        const message = `
            Nouvelle inscription:
            - Nom: ${formData.nom} ${formData.prenom}
            - Date de naissance: ${formData.date_naissance}
            - CIN: ${formData.cin}
            - CNE: ${formData.cne}
            - Formation: ${formData.formation === 'licence' ? 'Licence' : 'Master'} en ${formData.option}
        `;
        console.log(message);
    });

    // Initialiser le formulaire
    document.addEventListener("DOMContentLoaded", function() {
        updateOptions();
    });
</script>
</body>
</html>