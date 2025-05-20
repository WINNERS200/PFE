<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>📚 Historique Académique</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }
        .card {
            border-radius: 0.75rem;
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.075);
        }
        .header-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: #0d6efd;
        }
        .table thead th {
            background-color: #e9ecef;
            font-weight: 600;
        }
        .btn-primary {
            padding: 0.5rem 1.25rem;
        }
        .result-valide {
            color: #198754;
            font-weight: bold;
        }
        .result-non-valide {
            color: #dc3545;
            font-weight: bold;
        }
        .result-en-cours {
            color: #6c757d;
            font-style: italic;
        }
        .filter-card {
            background-color: #fcfdff;
            border: 1px solid #e3eaf3;
        }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5 mb-5">
    <div class="card shadow-sm p-4 p-md-5">
        <div class="text-center mb-4">
            <h2 class="header-title"><i class="bi bi-journal-bookmark-fill me-2"></i>Historique Académique</h2>
            <p class="text-muted">Consultez vos notes et les détails de vos formations passées.</p>
        </div>

        <!-- Zone de filtre -->
        <div class="card filter-card p-3 mb-4">
            <form id="filter-form" class="row g-3 align-items-end" novalidate>
                <div class="col-md-5">
                    <label for="annee" class="form-label">Année universitaire :</label>
                    <select id="annee" class="form-select" name="annee" required>
                        <option value="" selected disabled>Choisissez une année...</option>
                        <option value="2024/2025">2024/2025</option>
                        <option value="2023/2024">2023/2024</option>
                        <option value="2022/2023">2022/2023</option>
                    </select>
                    <div class="invalid-feedback">Veuillez sélectionner une année.</div>
                </div>
                <div class="col-md-5">
                    <label for="formation" class="form-label">Formation :</label>
                    <select id="formation" class="form-select" name="formation" required>
                        <option value="" selected disabled>Choisissez une formation...</option>
                        
                        <!-- Options de Licence -->
                        <optgroup label="Licence">
                            <option value="Administration Avancée des Systèmes et Réseaux Informatiques">Administration Avancée des Systèmes et Réseaux Informatiques</option>
                            <option value="Administration, Systèmes, Bases de Données et Réseaux">Administration, Systèmes, Bases de Données et Réseaux</option>
                            <option value="Développement Informatique">Développement Informatique</option>
                            <option value="Développement Web et Mobile">Développement Web et Mobile</option>
                            <option value="Développement Full Stack et Devops">Développement Full Stack et Devops</option>
                            <option value="Ingénierie Réseaux et Cloud Computing">Ingénierie Réseaux et Cloud Computing</option>
                        </optgroup>
                        
                        <!-- Options de Master -->
                        <optgroup label="Master">
                            <option value="Big Data et Cloud Computing">Big Data et Cloud Computing</option>
                            <option value="Business Intelligence et Sciences de Données">Business Intelligence et Sciences de Données</option>
                            <option value="Management des Systèmes d'Information">Management des Systèmes d'Information</option>
                            <option value="Cybersécurité et Cyberdéfense">Cybersécurité et Cyberdéfense</option>
                        </optgroup>
                    </select>
                    <div class="invalid-feedback">Veuillez sélectionner une formation.</div>
                </div>
                <div class="col-md-2 text-md-end text-center mt-3 mt-md-0">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-filter me-1"></i> Afficher
                    </button>
                </div>
            </form>
        </div>

        <!-- Tableau des résultats -->
        <div id="results-section" style="display: none;">
            <h4 class="mb-3" id="results-title">Résultats pour : <span class="text-primary" id="selected-criteria"></span></h4>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Module</th>
                            <th>Semestre</th>
                            <th>Note (/20)</th>
                            <th>Crédits ECTS</th>
                            <th>Résultat</th>
                        </tr>
                    </thead>
                    <tbody id="results-tbody">
                        <!-- Les lignes de résultats seront injectées ici -->
                    </tbody>
                </table>
            </div>
            <div class="mt-3 p-3 bg-light rounded border">
                <h5>Légende :</h5>
                <span class="badge bg-success me-2">Validé</span>
                <span class="badge bg-danger me-2">Non Validé</span>
                <span class="badge bg-secondary">En Cours / Non Noté</span>
            </div>
        </div>

        <!-- Message si aucun résultat ou état initial -->
        <div id="no-results-message" class="alert alert-info text-center mt-4" role="alert">
            <h4 class="alert-heading"><i class="bi bi-info-circle-fill me-2"></i>Aucun historique à afficher</h4>
            <p>Veuillez sélectionner une année et une formation pour consulter votre historique académique.</p>
        </div>
    </div>
</div>

<!-- Toast pour les notifications -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="appToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <strong class="me-auto" id="toast-title">Notification</strong>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body" id="toast-body">
      Message ici.
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // === DATA STORE (Simulé) ===
    const historiqueData = {
        // Exemples pour les nouvelles formations
        "2023/2024_Administration Avancée des Systèmes et Réseaux Informatiques": [
            { module: "Sécurité des Réseaux", semestre: "S1", note: 16.00, credits: 5, resultat: "Validé" },
            { module: "Virtualisation Avancée", semestre: "S1", note: 14.50, credits: 4, resultat: "Validé" }
        ],
        "2023/2024_Développement Full Stack et Devops": [
            { module: "Développement Front-End", semestre: "S1", note: 15.00, credits: 5, resultat: "Validé" },
            { module: "Architecture Microservices", semestre: "S2", note: null, credits: 5, resultat: "En Cours" }
        ],
        "2023/2024_Big Data et Cloud Computing": [
            { module: "Hadoop et Spark", semestre: "S1", note: 17.00, credits: 6, resultat: "Validé" },
            { module: "Cloud Data Management", semestre: "S1", note: 13.00, credits: 6, resultat: "Validé" }
        ],
        "2023/2024_Cybersécurité et Cyberdéfense": [
            { module: "Pentesting Avancé", semestre: "S1", note: 18.50, credits: 6, resultat: "Validé" },
            { module: "Forensique Numérique", semestre: "S2", note: null, credits: 6, resultat: "En Cours" }
        ]
        // Ajoutez plus de données ici pour les autres formations
    };

    // === DOM ELEMENTS ===
    const filterFormEl = document.getElementById('filter-form');
    const anneeSelectEl = document.getElementById('annee');
    const formationSelectEl = document.getElementById('formation');
    const resultsSectionEl = document.getElementById('results-section');
    const resultsTbodyEl = document.getElementById('results-tbody');
    const noResultsMessageEl = document.getElementById('no-results-message');
    const selectedCriteriaEl = document.getElementById('selected-criteria');

    const appToastEl = document.getElementById('appToast');
    const appToast = new bootstrap.Toast(appToastEl);
    const toastTitleEl = document.getElementById('toast-title');
    const toastBodyEl = document.getElementById('toast-body');

    // === UTILITY FUNCTIONS ===
    function showToast(title, message, type = 'info') {
        toastTitleEl.textContent = title;
        toastBodyEl.textContent = message;
        appToastEl.querySelector('.toast-header').className = 'toast-header';
        let headerClass = 'bg-info text-white';
        if (type === 'success') headerClass = 'bg-success text-white';
        else if (type === 'error') headerClass = 'bg-danger text-white';
        else if (type === 'warning') headerClass = 'bg-warning text-dark';
        appToastEl.querySelector('.toast-header').classList.add(...headerClass.split(' '));
        appToast.show();
    }

    function getResultClass(resultat) {
        switch (resultat?.toLowerCase()) {
            case 'validé': return 'result-valide';
            case 'non validé': return 'result-non-valide';
            case 'en cours':
            case 'non noté':
                 return 'result-en-cours';
            default: return '';
        }
    }

    // === UI UPDATE FUNCTIONS ===
    function displayResults(data, annee, formation) {
        resultsTbodyEl.innerHTML = '';

        if (!data || data.length === 0) {
            resultsSectionEl.style.display = 'none';
            noResultsMessageEl.style.display = 'block';
            noResultsMessageEl.innerHTML = `
                <h4 class="alert-heading"><i class="bi bi-exclamation-circle-fill me-2"></i>Aucun résultat</h4>
                <p>Aucun historique trouvé pour ${formation} en ${annee}.</p>`;
            return;
        }
        
        selectedCriteriaEl.textContent = `${formation} - ${annee}`;

        data.forEach(item => {
            const row = resultsTbodyEl.insertRow();
            row.insertCell().textContent = item.module;
            row.insertCell().textContent = item.semestre;
            row.insertCell().textContent = item.note !== null ? item.note.toFixed(2) : '-';
            row.insertCell().textContent = item.credits !== null ? item.credits : '-';
            const resultatCell = row.insertCell();
            resultatCell.textContent = item.resultat;
            resultatCell.className = getResultClass(item.resultat);
        });

        resultsSectionEl.style.display = 'block';
        noResultsMessageEl.style.display = 'none';
    }

    function showInitialMessage() {
        resultsSectionEl.style.display = 'none';
        noResultsMessageEl.style.display = 'block';
        noResultsMessageEl.innerHTML = `
            <h4 class="alert-heading"><i class="bi bi-info-circle-fill me-2"></i>Consultez votre historique</h4>
            <p>Veuillez sélectionner une année universitaire et une formation pour afficher les détails.</p>`;
    }

    // === EVENT HANDLERS ===
    filterFormEl.addEventListener('submit', function(event) {
        event.preventDefault();
        event.stopPropagation();

        if (!filterFormEl.checkValidity()) {
            filterFormEl.classList.add('was-validated');
            showToast("Filtres incomplets", "Veuillez sélectionner une année et une formation.", "warning");
            return;
        }
        filterFormEl.classList.add('was-validated');

        const selectedAnnee = anneeSelectEl.value;
        const selectedFormation = formationSelectEl.value;

        const searchKey = `${selectedAnnee}_${selectedFormation}`;
        const results = historiqueData[searchKey];
        displayResults(results, selectedAnnee, selectedFormation);
    });
    
    [anneeSelectEl, formationSelectEl].forEach(selectElement => {
        selectElement.addEventListener('change', () => {
            if (filterFormEl.classList.contains('was-validated')) {
                if (anneeSelectEl.value && formationSelectEl.value) {
                    filterFormEl.classList.remove('was-validated');
                    anneeSelectEl.classList.add('is-valid'); anneeSelectEl.classList.remove('is-invalid');
                    formationSelectEl.classList.add('is-valid'); formationSelectEl.classList.remove('is-invalid');
                } else {
                    if (!anneeSelectEl.value) { anneeSelectEl.classList.add('is-invalid'); anneeSelectEl.classList.remove('is-valid');}
                    else {anneeSelectEl.classList.remove('is-invalid'); anneeSelectEl.classList.add('is-valid');}

                    if (!formationSelectEl.value) { formationSelectEl.classList.add('is-invalid'); formationSelectEl.classList.remove('is-valid');}
                    else {formationSelectEl.classList.remove('is-invalid'); formationSelectEl.classList.add('is-valid');}
                }
            }
        });
    });

    // Initial state
    showInitialMessage();
</script>
</body>
</html>