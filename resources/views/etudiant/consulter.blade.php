<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Étudiants</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .info-card {
            transition: all 0.3s ease;
        }
        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .badge-status, .badge-module-status {
            font-size: 0.85em;
            padding: 0.5em 0.75em;
        }
        .avatar-initials {
            width: 80px;
            height: 80px;
            font-size: 2rem;
        }
        .modal-header, .card-header {
            background-color: #0d6efd;
            color: white;
        }
        .btn-close-white {
            filter: invert(1) grayscale(100%) brightness(200%);
        }
        .specialization-badge {
            background-color: #6f42c1;
            color: white;
            margin-right: 5px;
            margin-bottom: 5px;
        }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5 mb-5">
    <div class="card shadow-sm p-4 mb-4">
        <h2 class="mb-4 text-center text-primary"><i class="bi bi-people-fill me-2"></i>Gestion des Étudiants</h2>

        <form id="search-form">
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="search-cne" class="form-label">CNE</label>
                    <input type="text" class="form-control" id="search-cne" placeholder="Entrez le CNE">
                </div>
                <div class="col-md-4">
                    <label for="search-nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="search-nom" placeholder="Entrez le nom">
                </div>
                <div class="col-md-4">
                    <label for="search-prenom" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="search-prenom" placeholder="Entrez le prénom">
                </div>
            </div>
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="bi bi-search me-1"></i> Rechercher
                </button>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                    <i class="bi bi-plus-circle me-1"></i> Ajouter Étudiant
                </button>
            </div>
        </form>
    </div>

    <!-- Section des résultats -->
    <div id="results-section">
        <!-- Résultats de recherche -->
        <div id="search-results-container" class="row g-4" style="display: none;">
            <h4 class="mb-3 col-12" id="results-title">Détails de l'Étudiant</h4>
            
            <div class="col-md-6 col-lg-4">
                <div class="card info-card h-100 shadow-sm">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Informations Personnelles</h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <div id="student-avatar" class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto avatar-initials">
                                <span>--</span>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>CNE:</span>
                                <strong id="student-cne-display">N/A</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>CIN:</span>
                                <strong id="student-cin-display">N/A</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Nom:</span>
                                <strong id="student-nom-display">N/A</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Prénom:</span>
                                <strong id="student-prenom-display">N/A</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Né(e) le:</span>
                                <strong id="student-dateNaissance-display">N/A</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Filière:</span>
                                <strong id="student-filiere-display">N/A</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Spécialisation:</span>
                                <div id="student-specialization-display"></div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Statut:</span>
                                <span class="badge badge-status" id="student-statut-display">N/A</span>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer bg-light">
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-sm btn-warning" id="edit-student-button">
                                <i class="bi bi-pencil-square me-1"></i> Modifier
                            </button>
                            <button class="btn btn-sm btn-danger" id="delete-student-button">
                                <i class="bi bi-trash3 me-1"></i> Supprimer
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modules et notes -->
            <div class="col-md-6 col-lg-8">
                <div class="card h-100 shadow-sm">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Modules et Notes</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Module</th>
                                        <th>Note</th>
                                        <th>Statut Module</th>
                                    </tr>
                                </thead>
                                <tbody id="modules-list-tbody">
                                    <tr><td colspan="3" class="text-center text-muted">Aucun module pour cet étudiant.</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Message quand aucun résultat -->
        <div id="no-results-message" class="text-center py-5" style="display: none;">
            <div class="alert alert-info shadow-sm">
                <h4 class="alert-heading"><i class="bi bi-info-circle-fill me-2"></i>Aucun étudiant trouvé</h4>
                <p>Veuillez affiner vos critères de recherche ou ajouter un nouvel étudiant.</p>
            </div>
        </div>
        <!-- Message d'accueil/instructions -->
        <div id="welcome-message" class="text-center py-5">
            <div class="alert alert-secondary shadow-sm">
                <h4 class="alert-heading"><i class="bi bi-search me-2"></i>Bienvenue</h4>
                <p>Utilisez le formulaire ci-dessus pour rechercher un étudiant par CNE, nom ou prénom, ou pour ajouter un nouvel étudiant.</p>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ajout Étudiant -->
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStudentModalLabel"><i class="bi bi-person-plus-fill me-2"></i>Ajouter un Nouvel Étudiant</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add-student-form" novalidate>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="new-cne" class="form-label">CNE <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="new-cne" required>
                            <div class="invalid-feedback">Veuillez saisir le CNE.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="new-cin" class="form-label">CIN <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="new-cin" required>
                            <div class="invalid-feedback">Veuillez saisir le CIN.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="new-nom" class="form-label">Nom <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="new-nom" required>
                            <div class="invalid-feedback">Veuillez saisir le nom.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="new-prenom" class="form-label">Prénom <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="new-prenom" required>
                            <div class="invalid-feedback">Veuillez saisir le prénom.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="new-date-naissance" class="form-label">Date de naissance <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="new-date-naissance" required>
                            <div class="invalid-feedback">Veuillez sélectionner la date de naissance.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="new-filiere" class="form-label">Niveau <span class="text-danger">*</span></label>
                            <select class="form-select" id="new-filiere" required>
                                <option value="" selected disabled>Choisir un niveau...</option>
                                <option value="Licence">Licence</option>
                                <option value="Master">Master</option>
                            </select>
                            <div class="invalid-feedback">Veuillez choisir un niveau.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="new-specialization" class="form-label">Spécialisation <span class="text-danger">*</span></label>
                            <select class="form-select" id="new-specialization" required>
                                <option value="" selected disabled>Choisir une spécialisation...</option>
                                <!-- Options de licence -->
                                <optgroup label="Licence" id="licence-options">
                                    <option value="AASRI">Administration Avancée des Systèmes et Réseaux Informatiques</option>
                                    <option value="ASBDR">Administration, Systèmes, Bases de Données et Réseaux</option>
                                    <option value="DI">Développement Informatique</option>
                                    <option value="DWM">Développement Web et Mobile</option>
                                    <option value="FSD">Développement Full Stack et DevOps</option>
                                    <option value="IRC">Ingénierie Réseaux et Cloud Computing</option>
                                </optgroup>
                                <!-- Options de master -->
                                <optgroup label="Master" id="master-options">
                                    <option value="BDC">Big Data et Cloud Computing</option>
                                    <option value="BISD">Business Intelligence et Sciences de Données</option>
                                    <option value="MSI">Management des Systèmes d'Information</option>
                                    <option value="CC">Cybersécurité et Cyberdéfense</option>
                                </optgroup>
                            </select>
                            <div class="invalid-feedback">Veuillez choisir une spécialisation.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="new-statut" class="form-label">Statut <span class="text-danger">*</span></label>
                            <select class="form-select" id="new-statut" required>
                                <option value="inscrit" selected>Inscrit</option>
                                <option value="non-inscrit">Non inscrit</option>
                                <option value="diplome">Diplômé</option>
                                <option value="abandon">Abandon</option>
                            </select>
                            <div class="invalid-feedback">Veuillez choisir un statut.</div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" id="save-new-student-button">
                    <i class="bi bi-check-circle me-1"></i> Enregistrer
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Modification Étudiant -->
<div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStudentModalLabel"><i class="bi bi-pencil-fill me-2"></i>Modifier les Informations de l'Étudiant</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit-student-form" novalidate>
                    <input type="hidden" id="edit-student-original-cne">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="edit-cne" class="form-label">CNE</label>
                            <input type="text" class="form-control" id="edit-cne" readonly disabled>
                            <small class="form-text text-muted">Le CNE ne peut pas être modifié.</small>
                        </div>
                        <div class="col-md-6">
                            <label for="edit-cin" class="form-label">CIN <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit-cin" required>
                            <div class="invalid-feedback">Veuillez saisir le CIN.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="edit-nom" class="form-label">Nom <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit-nom" required>
                            <div class="invalid-feedback">Veuillez saisir le nom.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="edit-prenom" class="form-label">Prénom <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit-prenom" required>
                            <div class="invalid-feedback">Veuillez saisir le prénom.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="edit-date-naissance" class="form-label">Date de naissance <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="edit-date-naissance" required>
                            <div class="invalid-feedback">Veuillez sélectionner la date de naissance.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="edit-filiere" class="form-label">Niveau <span class="text-danger">*</span></label>
                            <select class="form-select" id="edit-filiere" required>
                                <option value="">Choisir un niveau...</option>
                                <option value="Licence">Licence</option>
                                <option value="Master">Master</option>
                            </select>
                            <div class="invalid-feedback">Veuillez choisir un niveau.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="edit-specialization" class="form-label">Spécialisation <span class="text-danger">*</span></label>
                            <select class="form-select" id="edit-specialization" required>
                                <option value="">Choisir une spécialisation...</option>
                                <!-- Options seront dynamiquement mises à jour en fonction du niveau -->
                                <optgroup label="Licence" id="edit-licence-options">
                                    <option value="AASRI">Administration Avancée Systèmes et Réseaux</option>
                                    <option value="ASBDR">Administration Systèmes, BD et Réseaux</option>
                                    <option value="DI">Développement Informatique</option>
                                    <option value="DWM">Développement Web et Mobile</option>
                                    <option value="FSD">Full Stack et DevOps</option>
                                    <option value="IRC">Ingénierie Réseaux et Cloud</option>
                                </optgroup>
                                <optgroup label="Master" id="edit-master-options">
                                    <option value="BDC">Big Data et Cloud</option>
                                    <option value="BISD">Business Intelligence</option>
                                    <option value="MSI">Management des SI</option>
                                    <option value="CC">Cybersécurité</option>
                                </optgroup>
                            </select>
                            <div class="invalid-feedback">Veuillez choisir une spécialisation.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="edit-statut" class="form-label">Statut <span class="text-danger">*</span></label>
                            <select class="form-select" id="edit-statut" required>
                                <option value="inscrit">Inscrit</option>
                                <option value="non-inscrit">Non inscrit</option>
                                <option value="diplome">Diplômé</option>
                                <option value="abandon">Abandon</option>
                            </select>
                            <div class="invalid-feedback">Veuillez choisir un statut.</div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" id="save-updated-student-button">
                    <i class="bi bi-save me-1"></i> Mettre à jour
                </button>
            </div>
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
    // === DATA STORE ===
    let etudiants = [
        {
            cne: 'G134567890', cin: 'Q300400', nom: 'El Amrani', prenom: 'Fatima', dateNaissance: '1999-07-15',
            filiere: 'Licence', specialization: 'AASRI', statut: 'inscrit',
            modules: [
                { nom: 'Algorithmique', note: 14, statutModule: 'Validé' },
                { nom: 'Systèmes d\'exploitation', note: 11.5, statutModule: 'En cours' }
            ]
        },
        {
            cne: 'R123450987', cin: 'S200100', nom: 'Bennani', prenom: 'Ahmed', dateNaissance: '2000-02-20',
            filiere: 'Master', specialization: 'BDC', statut: 'inscrit',
            modules: [
                { nom: 'Big Data Analytics', note: 16, statutModule: 'Validé' },
                { nom: 'Cloud Computing', note: 13, statutModule: 'Validé' }
            ]
        },
        {
            cne: 'D112233445', cin: 'T500600', nom: 'Cherkaoui', prenom: 'Sofia', dateNaissance: '1998-11-05',
            filiere: 'Licence', specialization: 'FSD', statut: 'diplome',
            modules: [
                { nom: 'Développement Web Avancé', note: 17, statutModule: 'Validé' },
                { nom: 'DevOps', note: 15, statutModule: 'Validé' }
            ]
        }
    ];
    let currentDisplayedStudentCNE = null;

    // Mappage des codes spécialisation vers les noms complets
    const specializationNames = {
        "AASRI": "Admin. Avancée des Systèmes et Réseaux",
        "ASBDR": "Admin. Systèmes, BD et Réseaux",
        "DI": "Développement Informatique",
        "DWM": "Développement Web et Mobile",
        "FSD": "Full Stack et DevOps",
        "IRC": "Ingénierie Réseaux et Cloud",
        "BDC": "Big Data et Cloud",
        "BISD": "Business Intelligence",
        "MSI": "Management des SI",
        "CC": "Cybersécurité"
    };

    // === DOM ELEMENTS CACHING ===
    const searchFormEl = document.getElementById('search-form');
    const searchCneInput = document.getElementById('search-cne');
    const searchNomInput = document.getElementById('search-nom');
    const searchPrenomInput = document.getElementById('search-prenom');

    const resultsContainerEl = document.getElementById('search-results-container');
    const noResultsMessageEl = document.getElementById('no-results-message');
    const welcomeMessageEl = document.getElementById('welcome-message');
    const resultsTitleEl = document.getElementById('results-title');

    const studentAvatarEl = document.getElementById('student-avatar').querySelector('span');
    const studentCneDisplayEl = document.getElementById('student-cne-display');
    const studentCinDisplayEl = document.getElementById('student-cin-display');
    const studentNomDisplayEl = document.getElementById('student-nom-display');
    const studentPrenomDisplayEl = document.getElementById('student-prenom-display');
    const studentDateNaissanceDisplayEl = document.getElementById('student-dateNaissance-display');
    const studentFiliereDisplayEl = document.getElementById('student-filiere-display');
    const studentSpecializationDisplayEl = document.getElementById('student-specialization-display');
    const studentStatutDisplayEl = document.getElementById('student-statut-display');
    const modulesListTbodyEl = document.getElementById('modules-list-tbody');

    const addStudentModalEl = document.getElementById('addStudentModal');
    const addStudentFormEl = document.getElementById('add-student-form');
    const addStudentBootstrapModal = new bootstrap.Modal(addStudentModalEl);
    const newFiliereSelect = document.getElementById('new-filiere');
    const newSpecializationSelect = document.getElementById('new-specialization');

    const editStudentModalEl = document.getElementById('editStudentModal');
    const editStudentFormEl = document.getElementById('edit-student-form');
    const editStudentBootstrapModal = new bootstrap.Modal(editStudentModalEl);
    const editFiliereSelect = document.getElementById('edit-filiere');
    const editSpecializationSelect = document.getElementById('edit-specialization');
    
    const appToastEl = document.getElementById('appToast');
    const appToast = new bootstrap.Toast(appToastEl);
    const toastTitleEl = document.getElementById('toast-title');
    const toastBodyEl = document.getElementById('toast-body');

    // === UTILITY FUNCTIONS ===
    function formatDate(dateString) {
        if (!dateString) return 'N/A';
        const [year, month, day] = dateString.split('-');
        return `${day}/${month}/${year}`;
    }

    function getInitials(nom, prenom) {
        const pInitial = prenom ? prenom.charAt(0).toUpperCase() : '';
        const nInitial = nom ? nom.charAt(0).toUpperCase() : '';
        return `${pInitial}${nInitial}` || '--';
    }

    function getStatusBadgeClass(statut) {
        switch (statut?.toLowerCase()) {
            case 'inscrit': return 'bg-success';
            case 'non-inscrit': return 'bg-secondary';
            case 'diplome': return 'bg-primary';
            case 'abandon': return 'bg-danger';
            default: return 'bg-light text-dark';
        }
    }

    function getModuleStatusBadgeClass(statutModule) {
        switch (statutModule?.toLowerCase()) {
            case 'validé': return 'bg-success';
            case 'en cours': return 'bg-info text-dark';
            case 'non validé': return 'bg-danger';
            case 'non noté': return 'bg-warning text-dark';
            default: return 'bg-secondary';
        }
    }

    function showToast(title, message, type = 'info') {
        toastTitleEl.textContent = title;
        toastBodyEl.textContent = message;
        appToastEl.classList.remove('bg-success', 'bg-danger', 'bg-warning', 'bg-info', 'text-white');
        if (type === 'success') appToastEl.classList.add('bg-success', 'text-white');
        else if (type === 'error') appToastEl.classList.add('bg-danger', 'text-white');
        else if (type === 'warning') appToastEl.classList.add('bg-warning', 'text-dark');
        else appToastEl.classList.add('bg-info', 'text-white');

        appToast.show();
    }

    // === UI UPDATE FUNCTIONS ===
    function displayStudentDetails(student) {
        if (!student) {
            resultsContainerEl.style.display = 'none';
            welcomeMessageEl.style.display = 'none';
            noResultsMessageEl.style.display = 'block';
            currentDisplayedStudentCNE = null;
            return;
        }
        currentDisplayedStudentCNE = student.cne;
        studentAvatarEl.textContent = getInitials(student.nom, student.prenom);
        studentCneDisplayEl.textContent = student.cne;
        studentCinDisplayEl.textContent = student.cin;
        studentNomDisplayEl.textContent = student.nom;
        studentPrenomDisplayEl.textContent = student.prenom;
        studentDateNaissanceDisplayEl.textContent = formatDate(student.dateNaissance);
        studentFiliereDisplayEl.textContent = student.filiere;
        
        // Afficher la spécialisation avec le nom complet
        const specializationName = specializationNames[student.specialization] || student.specialization;
        studentSpecializationDisplayEl.innerHTML = `<span class="badge specialization-badge">${specializationName}</span>`;
        
        studentStatutDisplayEl.textContent = student.statut.charAt(0).toUpperCase() + student.statut.slice(1);
        studentStatutDisplayEl.className = `badge badge-status ${getStatusBadgeClass(student.statut)}`;

        modulesListTbodyEl.innerHTML = '';
        if (student.modules && student.modules.length > 0) {
            student.modules.forEach(module => {
                const row = modulesListTbodyEl.insertRow();
                row.insertCell().textContent = module.nom;
                row.insertCell().textContent = module.note !== null ? module.note.toFixed(1) : 'N/A';
                const statutCell = row.insertCell();
                statutCell.innerHTML = `<span class="badge badge-module-status ${getModuleStatusBadgeClass(module.statutModule)}">${module.statutModule}</span>`;
            });
        } else {
            modulesListTbodyEl.innerHTML = '<tr><td colspan="3" class="text-center text-muted">Aucun module enregistré pour cet étudiant.</td></tr>';
        }

        resultsContainerEl.style.display = 'flex';
        noResultsMessageEl.style.display = 'none';
        welcomeMessageEl.style.display = 'none';
    }

    function clearAndHideResults() {
        resultsContainerEl.style.display = 'none';
        noResultsMessageEl.style.display = 'none';
        welcomeMessageEl.style.display = 'block';
        currentDisplayedStudentCNE = null;
        searchFormEl.reset();
    }
    
    // === FORM VALIDATION ===
    function validateForm(formEl) {
        if (!formEl.checkValidity()) {
            formEl.classList.add('was-validated');
            return false;
        }
        formEl.classList.remove('was-validated');
        return true;
    }

    // === EVENT HANDLERS & DATA LOGIC ===
    searchFormEl.addEventListener('submit', function(event) {
        event.preventDefault();
        const cneQuery = searchCneInput.value.trim().toLowerCase();
        const nomQuery = searchNomInput.value.trim().toLowerCase();
        const prenomQuery = searchPrenomInput.value.trim().toLowerCase();

        if (!cneQuery && !nomQuery && !prenomQuery) {
            showToast("Recherche", "Veuillez entrer au moins un critère de recherche.", "warning");
            clearAndHideResults();
            return;
        }

        const foundStudent = etudiants.find(etd =>
            (cneQuery && etd.cne.toLowerCase().includes(cneQuery)) ||
            (nomQuery && etd.nom.toLowerCase().includes(nomQuery)) ||
            (prenomQuery && etd.prenom.toLowerCase().includes(prenomQuery))
        );
        
        resultsTitleEl.textContent = "Résultat de la Recherche";
        displayStudentDetails(foundStudent);
    });

    // Gestion du changement de niveau pour afficher les bonnes spécialisations
    newFiliereSelect.addEventListener('change', function() {
        const niveau = this.value;
        const licenceOptions = document.getElementById('licence-options');
        const masterOptions = document.getElementById('master-options');
        
        if (niveau === 'Licence') {
            licenceOptions.style.display = 'block';
            masterOptions.style.display = 'none';
            newSpecializationSelect.value = '';
        } else if (niveau === 'Master') {
            licenceOptions.style.display = 'none';
            masterOptions.style.display = 'block';
            newSpecializationSelect.value = '';
        } else {
            licenceOptions.style.display = 'none';
            masterOptions.style.display = 'none';
            newSpecializationSelect.value = '';
        }
    });

    editFiliereSelect.addEventListener('change', function() {
        const niveau = this.value;
        const licenceOptions = document.getElementById('edit-licence-options');
        const masterOptions = document.getElementById('edit-master-options');
        
        if (niveau === 'Licence') {
            licenceOptions.style.display = 'block';
            masterOptions.style.display = 'none';
            editSpecializationSelect.value = '';
        } else if (niveau === 'Master') {
            licenceOptions.style.display = 'none';
            masterOptions.style.display = 'block';
            editSpecializationSelect.value = '';
        } else {
            licenceOptions.style.display = 'none';
            masterOptions.style.display = 'none';
            editSpecializationSelect.value = '';
        }
    });

    document.getElementById('save-new-student-button').addEventListener('click', function() {
        if (!validateForm(addStudentFormEl)) return;

        const newStudentData = {
            cne: document.getElementById('new-cne').value.trim(),
            cin: document.getElementById('new-cin').value.trim(),
            nom: document.getElementById('new-nom').value.trim(),
            prenom: document.getElementById('new-prenom').value.trim(),
            dateNaissance: document.getElementById('new-date-naissance').value,
            filiere: document.getElementById('new-filiere').value,
            specialization: document.getElementById('new-specialization').value,
            statut: document.getElementById('new-statut').value,
            modules: []
        };

        if (etudiants.some(etd => etd.cne === newStudentData.cne)) {
            showToast("Erreur", "Un étudiant avec ce CNE existe déjà.", "error");
            document.getElementById('new-cne').classList.add('is-invalid');
            return;
        }
        document.getElementById('new-cne').classList.remove('is-invalid');

        etudiants.push(newStudentData);
        showToast("Succès", `L'étudiant ${newStudentData.prenom} ${newStudentData.nom} a été ajouté.`, "success");
        
        addStudentBootstrapModal.hide();
    });
    
    addStudentModalEl.addEventListener('hidden.bs.modal', () => {
        addStudentFormEl.reset();
        addStudentFormEl.classList.remove('was-validated');
    });

    document.getElementById('edit-student-button').addEventListener('click', function() {
        if (!currentDisplayedStudentCNE) {
            showToast("Erreur", "Aucun étudiant n'est sélectionné pour la modification.", "error");
            return;
        }
        const studentToEdit = etudiants.find(etd => etd.cne === currentDisplayedStudentCNE);
        if (studentToEdit) {
            document.getElementById('edit-student-original-cne').value = studentToEdit.cne;
            document.getElementById('edit-cne').value = studentToEdit.cne;
            document.getElementById('edit-cin').value = studentToEdit.cin;
            document.getElementById('edit-nom').value = studentToEdit.nom;
            document.getElementById('edit-prenom').value = studentToEdit.prenom;
            document.getElementById('edit-date-naissance').value = studentToEdit.dateNaissance;
            document.getElementById('edit-filiere').value = studentToEdit.filiere;
            document.getElementById('edit-specialization').value = studentToEdit.specialization;
            document.getElementById('edit-statut').value = studentToEdit.statut;
            
            // Afficher les bonnes options de spécialisation selon le niveau
            const niveau = studentToEdit.filiere;
            const licenceOptions = document.getElementById('edit-licence-options');
            const masterOptions = document.getElementById('edit-master-options');
            
            if (niveau === 'Licence') {
                licenceOptions.style.display = 'block';
                masterOptions.style.display = 'none';
            } else if (niveau === 'Master') {
                licenceOptions.style.display = 'none';
                masterOptions.style.display = 'block';
            }
            
            editStudentBootstrapModal.show();
        } else {
            showToast("Erreur", "Étudiant non trouvé pour la modification.", "error");
        }
    });

    document.getElementById('save-updated-student-button').addEventListener('click', function() {
        if (!validateForm(editStudentFormEl)) return;

        const originalCne = document.getElementById('edit-student-original-cne').value;
        const studentIndex = etudiants.findIndex(etd => etd.cne === originalCne);

        if (studentIndex === -1) {
            showToast("Erreur", "L'étudiant original n'a pas été trouvé pour la mise à jour.", "error");
            editStudentBootstrapModal.hide();
            return;
        }

        const updatedStudentData = {
            cne: document.getElementById('edit-cne').value.trim(),
            cin: document.getElementById('edit-cin').value.trim(),
            nom: document.getElementById('edit-nom').value.trim(),
            prenom: document.getElementById('edit-prenom').value.trim(),
            dateNaissance: document.getElementById('edit-date-naissance').value,
            filiere: document.getElementById('edit-filiere').value,
            specialization: document.getElementById('edit-specialization').value,
            statut: document.getElementById('edit-statut').value,
            modules: etudiants[studentIndex].modules
        };
        
        etudiants[studentIndex] = updatedStudentData;
        showToast("Succès", `Les informations de ${updatedStudentData.prenom} ${updatedStudentData.nom} ont été mises à jour.`, "success");

        displayStudentDetails(updatedStudentData);
        editStudentBootstrapModal.hide();
    });

    editStudentModalEl.addEventListener('hidden.bs.modal', () => {
        editStudentFormEl.reset();
        editStudentFormEl.classList.remove('was-validated');
    });

    document.getElementById('delete-student-button').addEventListener('click', function() {
        if (!currentDisplayedStudentCNE) {
            showToast("Erreur", "Aucun étudiant n'est sélectionné pour la suppression.", "error");
            return;
        }

        const studentToDelete = etudiants.find(etd => etd.cne === currentDisplayedStudentCNE);
        if (!studentToDelete) {
            showToast("Erreur", "Étudiant non trouvé pour la suppression.", "error");
            return;
        }

        if (confirm(`Êtes-vous sûr de vouloir supprimer l'étudiant ${studentToDelete.prenom} ${studentToDelete.nom} (CNE: ${studentToDelete.cne}) ? Cette action est irréversible.`)) {
            etudiants = etudiants.filter(etd => etd.cne !== currentDisplayedStudentCNE);
            showToast("Succès", `L'étudiant ${studentToDelete.prenom} ${studentToDelete.nom} a été supprimé.`, "success");
            clearAndHideResults();
        }
    });

    // Initial state
    clearAndHideResults();
</script>
</body>
</html>