<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Étudiants Inscrits</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <style>
    body {
        background-color: #f8f9fa;
    }
    .badge-filiere {
      font-size: 0.85rem;
      padding: 0.4em 0.7em;
    }
    .table thead th {
        background-color: #e9ecef;
    }
    .card {
        border-radius: 0.75rem;
    }
    .header-title {
        font-size: 1.8rem;
        font-weight: 600;
        color: #0d6efd;
    }
    .modal-header {
        background-color: #0d6efd;
        color: white;
    }
    .btn-close-white {
        filter: invert(1) grayscale(100%) brightness(200%);
    }
    .details-list-group .list-group-item {
        border-left: 0;
        border-right: 0;
    }
    .details-list-group .list-group-item:first-child {
        border-top: 0;
    }
    .details-list-group .list-group-item:last-child {
        border-bottom: 0;
    }
    .specialization-badge {
      background-color: #6f42c1;
      color: white;
    }
    .formateur-info {
      font-weight: 500;
      color: #0d6efd;
    }
  </style>
</head>
<body class="bg-light">

<div class="container py-5">
  <div class="text-center mb-4">
      <h2 class="header-title"><i class="bi bi-people-fill me-2"></i>Liste des Étudiants Inscrits</h2>
  </div>

  <!-- Filtre par filière -->
  <div class="mb-4 d-flex justify-content-start align-items-center">
    <label for="filtreFiliere" class="form-label me-2 mb-0 fw-bold">Filtrer par niveau :</label>
    <select class="form-select w-auto shadow-sm" id="filtreFiliere">
      <option value="all">Tous les niveaux</option>
      <option value="Licence">Licence</option>
      <option value="Master">Master</option>
    </select>
  </div>

  <!-- Tableau des étudiants -->
  <div class="card shadow-sm">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover table-striped mb-0" id="tableEtudiants">
            <thead class="table-light">
            <tr>
                <th>Nom Complet</th>
                <th>CIN</th>
                <th>Niveau</th>
                <th>Spécialisation</th>
                <th>Formateur</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody id="etudiants-tbody">
            <!-- Les lignes d'étudiants seront injectées ici par JavaScript -->
            </tbody>
        </table>
      </div>
    </div>
  </div>

    <!-- Message si aucun étudiant -->
    <div id="no-etudiants-message" class="alert alert-info text-center mt-4" style="display: none;" role="alert">
        <h4 class="alert-heading"><i class="bi bi-info-circle-fill me-2"></i>Aucun étudiant à afficher</h4>
        <p>Aucun étudiant ne correspond aux critères de filtre actuels ou la liste est vide.</p>
    </div>
</div>

<!-- Modal Détails Étudiant -->
<div class="modal fade" id="studentDetailsModal" tabindex="-1" aria-labelledby="studentDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content shadow">
      <div class="modal-header">
        <h5 class="modal-title" id="studentDetailsModalLabel"><i class="bi bi-person-lines-fill me-2"></i>Détails de l'Étudiant</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <div class="row">
            <div class="col-md-4 text-center mb-3 mb-md-0">
                <img id="modal-avatar" src="https://via.placeholder.com/150/007bff/FFFFFF?Text=ET" class="img-fluid rounded-circle border p-1" alt="Avatar Étudiant" style="width: 120px; height: 120px;">
                <h4 class="mt-2 mb-0" id="modal-nom-complet">N/A</h4>
                <p class="text-muted mb-0" id="modal-cne-small">CNE: N/A</p>
            </div>
            <div class="col-md-8">
                <h5>Informations Personnelles</h5>
                <ul class="list-group list-group-flush details-list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between"><span>CIN:</span> <strong id="modal-cin">N/A</strong></li>
                    <li class="list-group-item d-flex justify-content-between"><span>Date de Naissance:</span> <strong id="modal-date-naissance">N/A</strong></li>
                    <li class="list-group-item d-flex justify-content-between"><span>Email:</span> <a href="#" id="modal-email">N/A</a></li>
                    <li class="list-group-item d-flex justify-content-between"><span>Téléphone:</span> <strong id="modal-telephone">N/A</strong></li>
                </ul>
                <h5>Informations Académiques</h5>
                 <ul class="list-group list-group-flush details-list-group">
                    <li class="list-group-item d-flex justify-content-between"><span>Niveau:</span> <strong id="modal-niveau">N/A</strong></li>
                    <li class="list-group-item d-flex justify-content-between"><span>Spécialisation:</span> <strong id="modal-specialization">N/A</strong></li>
                    <li class="list-group-item d-flex justify-content-between"><span>Formateur:</span> <strong id="modal-formateur" class="formateur-info">N/A</strong></li>
                    <li class="list-group-item d-flex justify-content-between"><span>Date d'Inscription:</span> <strong id="modal-date-inscription">N/A</strong></li>
                </ul>
            </div>
        </div>
        <div class="mt-4 border-top pt-3">
            <h5>Modules Inscrits</h5>
            <ul class="list-group list-group-flush" id="modal-modules-list">
                <!-- Les modules seront listés ici -->
            </ul>
        </div>
      </div>
      <div class="modal-footer bg-light">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        <button type="button" class="btn btn-primary" onclick="window.print();"><i class="bi bi-printer me-1"></i>Imprimer Fiche</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // === DATA STORE (Simulé) ===
    const specializations = {
        "Licence": [
            { 
                code: "AASRI", 
                name: "Administration Avancée des Systèmes et Réseaux Informatiques",
                formateur: "Pr. Mohammed ERRAIS"
            },
            { 
                code: "ASBDR", 
                name: "Administration, Systèmes, Bases de Données et Réseaux",
                formateur: "Pr. Khalid MOUSSAID"
            },
            { 
                code: "DI", 
                name: "Développement Informatique",
                formateur: "Pr. Brahim RAOUYANE"
            },
            { 
                code: "DWM", 
                name: "Développement Web et Mobile",
                formateur: "Pr. Mohamed RIDA"
            },
            { 
                code: "FSD", 
                name: "Développement Full Stack et DevOps",
                formateur: "Pr. Noureddine ABGHOUR"
            },
            { 
                code: "IRC", 
                name: "Ingénierie Réseaux et Cloud Computing",
                formateur: "Pr. Rim KOULALI"
            }
        ],
        "Master": [
            { 
                code: "BDC", 
                name: "Big Data et Cloud Computing",
                formateur: "Pr. Amina ELOMRI"
            },
            { 
                code: "BISD", 
                name: "Business Intelligence et Sciences de Données",
                formateur: "Pr. Tarik NAHHAL"
            },
            { 
                code: "MSI", 
                name: "Management des Systèmes d'Information",
                formateur: "Pr. Mounia MIYARA"
            },
            { 
                code: "CC", 
                name: "Cybersécurité et Cyberdéfense",
                formateur: "Pr. Laila FETJAH"
            }
        ]
    };

    const etudiantsData = [
        {
            id: 's001', 
            cne: 'M130012345', 
            nom: 'El Fassi', 
            prenom: 'Omar', 
            cin: 'AB123456', 
            niveau: 'Licence',
            specialization: specializations["Licence"][1], // ASBDR
            email: 'omar.elfassi@example.com', 
            telephone: '0600112233', 
            dateNaissance: '1999-05-10', 
            dateInscription: '2022-09-15', 
            avatarSeed: 'OE',
            modules: [ 
                {nom: 'Administration des Bases de Données', note: 16}, 
                {nom: 'Sécurité des Réseaux', note: 14} 
            ]
        },
        {
            id: 's002', 
            cne: 'R120098765', 
            nom: 'Zahra', 
            prenom: 'Fatima', 
            cin: 'CD789123', 
            niveau: 'Master',
            specialization: specializations["Master"][0], // BDC
            email: 'fatima.zahra@example.com', 
            telephone: '0611223344', 
            dateNaissance: '1998-01-20', 
            dateInscription: '2023-09-10', 
            avatarSeed: 'FZ',
            modules: [ 
                {nom: 'Big Data Analytics', note: 17}, 
                {nom: 'Cloud Computing', note: 15} 
            ]
        },
        {
            id: 's003', 
            cne: 'G140054321', 
            nom: 'Amrani', 
            prenom: 'Youssef', 
            cin: 'EF456789', 
            niveau: 'Licence',
            specialization: specializations["Licence"][3], // DWM
            email: 'youssef.amrani@example.com', 
            telephone: '0622334455', 
            dateNaissance: '2000-11-03', 
            dateInscription: '2023-09-18', 
            avatarSeed: 'YA',
            modules: [
                {nom: 'Développement Frontend', note: 18},
                {nom: 'Applications Mobiles', note: 16}
            ]
        },
        {
            id: 's004', 
            cne: 'P110011223', 
            nom: 'Alaoui', 
            prenom: 'Salma', 
            cin: 'GH987654', 
            niveau: 'Master',
            specialization: specializations["Master"][3], // CC
            email: 'salma.alaoui@example.com', 
            telephone: '0633445566', 
            dateNaissance: '1997-08-25', 
            dateInscription: '2024-09-05', 
            avatarSeed: 'SA',
            modules: [ 
                {nom: 'Cryptographie', note: 19}, 
                {nom: 'Sécurité des Systèmes', note: 17} 
            ]
        },
        {
            id: 's005', 
            cne: 'K100022334', 
            nom: 'Benjelloun', 
            prenom: 'Ali', 
            cin: 'IJ123987', 
            niveau: 'Licence',
            specialization: specializations["Licence"][4], // FSD
            email: 'ali.benjelloun@example.com', 
            telephone: '0644556677', 
            dateNaissance: '1999-03-12', 
            dateInscription: '2022-09-12', 
            avatarSeed: 'AB',
            modules: [ 
                {nom: 'DevOps', note: 15}, 
                {nom: 'Architecture des Applications', note: 14} 
            ]
        }
    ];

    // === DOM ELEMENTS ===
    const etudiantsTbodyEl = document.getElementById('etudiants-tbody');
    const filtreFiliereSelectEl = document.getElementById('filtreFiliere');
    const noEtudiantsMessageEl = document.getElementById('no-etudiants-message');

    const studentDetailsModalEl = document.getElementById('studentDetailsModal');
    const studentDetailsBootstrapModal = new bootstrap.Modal(studentDetailsModalEl);
    const modalNomCompletEl = document.getElementById('modal-nom-complet');
    const modalCneSmallEl = document.getElementById('modal-cne-small');
    const modalCinEl = document.getElementById('modal-cin');
    const modalDateNaissanceEl = document.getElementById('modal-date-naissance');
    const modalEmailEl = document.getElementById('modal-email');
    const modalTelephoneEl = document.getElementById('modal-telephone');
    const modalNiveauEl = document.getElementById('modal-niveau');
    const modalSpecializationEl = document.getElementById('modal-specialization');
    const modalFormateurEl = document.getElementById('modal-formateur');
    const modalDateInscriptionEl = document.getElementById('modal-date-inscription');
    const modalAvatarEl = document.getElementById('modal-avatar');
    const modalModulesListEl = document.getElementById('modal-modules-list');

    // === UTILITY FUNCTIONS ===
    function formatDate(dateString) {
        if (!dateString) return 'N/A';
        const date = new Date(dateString);
        return date.toLocaleDateString('fr-FR', { day: '2-digit', month: 'long', year: 'numeric' });
    }

    // === UI UPDATE FUNCTIONS ===
    function displayEtudiants(filteredEtudiants) {
        etudiantsTbodyEl.innerHTML = ''; // Clear previous rows

        if (!filteredEtudiants || filteredEtudiants.length === 0) {
            noEtudiantsMessageEl.style.display = 'block';
            return;
        }
        noEtudiantsMessageEl.style.display = 'none';

        filteredEtudiants.forEach(etd => {
            const row = etudiantsTbodyEl.insertRow();
            row.dataset.niveau = etd.niveau; // For filtering

            row.insertCell().textContent = `${etd.prenom} ${etd.nom}`;
            row.insertCell().textContent = etd.cin;
            row.insertCell().textContent = etd.niveau;
            
            const specCell = row.insertCell();
            specCell.innerHTML = `<span class="badge specialization-badge">${etd.specialization.name}</span>`;
            
            const formateurCell = row.insertCell();
            formateurCell.innerHTML = `<span class="formateur-info">${etd.specialization.formateur}</span>`;
            
            row.insertCell().innerHTML = `<a href="mailto:${etd.email}">${etd.email}</a>`;

            const actionCell = row.insertCell();
            const detailsButton = document.createElement('button');
            detailsButton.className = 'btn btn-sm btn-outline-primary';
            detailsButton.innerHTML = '<i class="bi bi-eye-fill me-1"></i>Détails';
            detailsButton.dataset.etudiantId = etd.id;
            detailsButton.addEventListener('click', showStudentDetails);
            actionCell.appendChild(detailsButton);
        });
    }

    function showStudentDetails(event) {
        const etudiantId = event.currentTarget.dataset.etudiantId;
        const etudiant = etudiantsData.find(etd => etd.id === etudiantId);

        if (etudiant) {
            modalNomCompletEl.textContent = `${etudiant.prenom} ${etudiant.nom}`;
            modalCneSmallEl.textContent = `CNE: ${etudiant.cne}`;
            modalCinEl.textContent = etudiant.cin;
            modalDateNaissanceEl.textContent = formatDate(etudiant.dateNaissance);
            modalEmailEl.textContent = etudiant.email;
            modalEmailEl.href = `mailto:${etudiant.email}`;
            modalTelephoneEl.textContent = etudiant.telephone || 'N/A';
            modalNiveauEl.textContent = etudiant.niveau;
            modalSpecializationEl.textContent = etudiant.specialization.name;
            modalFormateurEl.textContent = etudiant.specialization.formateur;
            modalDateInscriptionEl.textContent = formatDate(etudiant.dateInscription);
            
            // Avatar
            const initials = (etudiant.prenom.charAt(0) + etudiant.nom.charAt(0)).toUpperCase();
            modalAvatarEl.src = `https://via.placeholder.com/150/007bff/FFFFFF?Text=${initials}`;

            // Modules
            modalModulesListEl.innerHTML = '';
            etudiant.modules.forEach(mod => {
                const li = document.createElement('li');
                li.className = 'list-group-item d-flex justify-content-between align-items-center';
                li.innerHTML = `
                    ${mod.nom}
                    <span class="badge bg-info rounded-pill">${mod.note !== null ? mod.note.toFixed(1) + '/20' : 'Non noté'}</span>
                `;
                modalModulesListEl.appendChild(li);
            });

            studentDetailsBootstrapModal.show();
        }
    }

    // === EVENT HANDLERS ===
    filtreFiliereSelectEl.addEventListener("change", function () {
        const selectedNiveau = this.value;
        let etudiantsToDisplay;

        if (selectedNiveau === "all") {
            etudiantsToDisplay = etudiantsData;
        } else {
            etudiantsToDisplay = etudiantsData.filter(etd => etd.niveau === selectedNiveau);
        }
        displayEtudiants(etudiantsToDisplay);
    });

    // === INITIALIZATION ===
    displayEtudiants(etudiantsData); // Display all students initially
</script>
</body>
</html>