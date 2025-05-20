<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>📅 Planning des Formations - FSAC</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }
        .card {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }
        .header-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: #0d6efd;
        }
        .planning-table th {
            background-color: #e9ecef;
            font-weight: 600;
        }
        .seance-type-cours { background-color: #d1e7dd; color: #0f5132; }
        .seance-type-td { background-color: #cff4fc; color: #055160; }
        .seance-type-tp { background-color: #fff3cd; color: #664d03; }
        .seance-type-online { background-color: #e2d9f3; color: #423266; }
        .seance-type-autre { background-color: #f8d7da; color: #58151c; }
        @media print {
            .no-print { display: none !important; }
            body { -webkit-print-color-adjust: exact !important; }
        }
    </style>
</head>
<body>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12">
            <div class="card p-4 p-md-5 bg-white">
                <div class="text-center mb-4">
                    <h2 class="header-title"><i class="bi bi-calendar3 me-2"></i>Planning des Formations</h2>
                    <p class="text-muted">Faculté des Sciences Ain Chock - Université Hassan II de Casablanca</p>
                </div>

                <form id="planning-form" novalidate>
                    <div class="mb-3">
                        <label for="niveau" class="form-label">Niveau <span class="text-danger">*</span></label>
                        <select class="form-select form-select-lg" id="niveau" name="niveau" required>
                            <option value="" selected disabled>-- Sélectionnez un niveau --</option>
                            <option value="licence">Licence</option>
                            <option value="master">Master</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="filiere" class="form-label">Filière <span class="text-danger">*</span></label>
                        <select class="form-select form-select-lg" id="filiere" name="filiere" required disabled>
                            <option value="" selected disabled>-- Sélectionnez d'abord le niveau --</option>
                        </select>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">
                           <i class="bi bi-eye-fill me-2"></i>Voir le planning
                        </button>
                    </div>
                </form>
            </div>

            <div id="planning-display-section" class="mt-5" style="display: none;">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                       <h3 class="mb-0" id="planning-title"><i class="bi bi-table me-2"></i>Emploi du Temps</h3>
                    </div>
                    <div class="card-body p-0">
                        <div class="p-3">
                            <p class="lead" id="planning-semaine-info"></p>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped planning-table text-center">
                                <thead id="planning-table-head"></thead>
                                <tbody id="planning-table-body"></tbody>
                            </table>
                        </div>
                        <div class="card-footer text-center bg-light border-top-0 pt-3 pb-3 no-print">
                            <button class="btn btn-secondary" onclick="window.print()">
                                <i class="bi bi-printer-fill me-2"></i> Imprimer
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Options des formations
    const formations = {
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

    // Plannings selon la nouvelle structure demandée
    const planningsData = {
        // Exemple pour une formation en Licence
        "licence_administrationavancee": {
            titre: "Licence - Administration Avancée des Systèmes et Réseaux Informatiques",
            semaineDu: "11 Mars 2024 au 17 Mars 2024",
            horaires: ["09:00-11:00", "11:30-13:30", "14:00-16:00", "19:00-21:00"],
            jours: {
                "Lundi": [
                    null,
                    null,
                    null,
                    { matiere: "Module 1 (Q&A)", salle: "En ligne", type: "En Ligne" }
                ],
                "Mardi": [
                    null,
                    null,
                    null,
                    { matiere: "Module 2 (Q&A)", salle: "En ligne", type: "En Ligne" }
                ],
                "Mercredi": [
                    null,
                    null,
                    null,
                    { matiere: "Module 3 (Q&A)", salle: "En ligne", type: "En Ligne" }
                ],
                "Jeudi": [
                    null,
                    null,
                    null,
                    null
                ],
                "Vendredi": [
                    null,
                    null,
                    null,
                    null
                ],
                "Samedi": [
                    null,
                    null,
                    { matiere: "Module 1", salle: "Amphi A", type: "Cours" },
                    null
                ],
                "Dimanche": [
                    { matiere: "Module 2", salle: "Amphi B", type: "Cours" },
                    { matiere: "Module 3", salle: "Amphi C", type: "Cours" },
                    null,
                    null
                ]
            }
        },
        
        // Exemple pour une formation en Master
        "master_bigdata": {
            titre: "Master - Big Data et Cloud Computing", 
            semaineDu: "11 Mars 2024 au 17 Mars 2024",
            horaires: ["09:00-11:00", "11:30-13:30", "14:00-17:00", "19:00-21:00"],
            jours: {
                "Lundi": [
                    null,
                    null,
                    null,
                    { matiere: "Module 1 (Q&A)", salle: "En ligne", type: "En Ligne" }
                ],
                "Mardi": [
                    null,
                    null,
                    null,
                    { matiere: "Module 2 (Q&A)", salle: "En ligne", type: "En Ligne" }
                ],
                "Mercredi": [
                    null,
                    null,
                    null,
                    { matiere: "Module 3 (Q&A)", salle: "En ligne", type: "En Ligne" }
                ],
                "Jeudi": [
                    null,
                    null,
                    null,
                    null
                ],
                "Vendredi": [
                    null,
                    null,
                    null,
                    null
                ],
                "Samedi": [
                    null,
                    null,
                    { matiere: "Module 1", salle: "Amphi M", type: "Cours" },
                    null
                ],
                "Dimanche": [
                    { matiere: "Module 2", salle: "Amphi M", type: "Cours" },
                    { matiere: "Module 3", salle: "Lab Data", type: "TP" },
                    null,
                    null
                ]
            }
        }
    };

    // Éléments DOM
    const planningForm = document.getElementById('planning-form');
    const niveauSelect = document.getElementById('niveau');
    const filiereSelect = document.getElementById('filiere');
    const planningDisplaySection = document.getElementById('planning-display-section');
    const planningTitleEl = document.getElementById('planning-title');
    const planningSemaineInfoEl = document.getElementById('planning-semaine-info');
    const planningTableHeadEl = document.getElementById('planning-table-head');
    const planningTableBodyEl = document.getElementById('planning-table-body');

    // Mettre à jour les filières selon le niveau sélectionné
    niveauSelect.addEventListener('change', function() {
        const niveau = this.value;
        filiereSelect.innerHTML = '<option value="" selected disabled>-- Sélectionnez une filière --</option>';
        
        if (niveau) {
            filiereSelect.disabled = false;
            formations[niveau].forEach(filiere => {
                const option = document.createElement('option');
                option.value = filiere.toLowerCase().replace(/\s+/g, '');
                option.textContent = filiere;
                filiereSelect.appendChild(option);
            });
        } else {
            filiereSelect.disabled = true;
        }
    });

    // Afficher le planning
    function displayPlanning(planning) {
        planningTitleEl.innerHTML = `<i class="bi bi-table me-2"></i>${planning.titre}`;
        planningSemaineInfoEl.textContent = `Semaine du : ${planning.semaineDu}`;

        // En-tête (jours)
        planningTableHeadEl.innerHTML = '';
        const headerRow = planningTableHeadEl.insertRow();
        const thHoraire = document.createElement('th');
        thHoraire.scope = "col";
        thHoraire.textContent = 'Horaire';
        headerRow.appendChild(thHoraire);
        
        Object.keys(planning.jours).forEach(jour => {
            const th = document.createElement('th');
            th.scope = "col";
            th.textContent = jour;
            headerRow.appendChild(th);
        });

        // Corps (séances)
        planningTableBodyEl.innerHTML = '';
        planning.horaires.forEach((horaire, indexHoraire) => {
            const bodyRow = planningTableBodyEl.insertRow();
            const tdHoraire = bodyRow.insertCell();
            tdHoraire.textContent = horaire;
            tdHoraire.classList.add('fw-bold');

            Object.values(planning.jours).forEach(seancesDuJour => {
                const tdSeance = bodyRow.insertCell();
                const seance = seancesDuJour[indexHoraire];
                if (seance) {
                    tdSeance.innerHTML = `
                        <div class="fw-bold">${seance.matiere}</div>
                        <small class="text-muted d-block">${seance.salle}</small>
                        <span class="badge rounded-pill ${getSeanceTypeClass(seance.type)} mt-1">${seance.type}</span>`;
                    tdSeance.classList.add(getSeanceTypeClass(seance.type));
                }
            });
        });

        planningDisplaySection.style.display = 'block';
    }

    function getSeanceTypeClass(type) {
        switch(type?.toLowerCase()){
            case 'cours': return 'seance-type-cours';
            case 'td': return 'seance-type-td';
            case 'tp': return 'seance-type-tp';
            case 'en ligne': 
            case 'q&a': 
                return 'seance-type-online';
            case 'projet': return 'seance-type-autre';
            default: return '';
        }
    }

    // Soumission du formulaire
    planningForm.addEventListener('submit', function(event) {
        event.preventDefault();
        
        if (!planningForm.checkValidity()) {
            event.stopPropagation();
            planningForm.classList.add('was-validated');
            return;
        }

        const niveau = niveauSelect.value;
        const filiere = filiereSelect.value;
        const searchKey = `${niveau}_${filiere}`;

        if (planningsData[searchKey]) {
            displayPlanning(planningsData[searchKey]);
        } else {
            // Planning par défaut selon la structure demandée
            const defaultPlanning = {
                titre: `${niveauSelect.options[niveauSelect.selectedIndex].text} - ${filiereSelect.options[filiereSelect.selectedIndex].text}`,
                semaineDu: new Date().toLocaleDateString('fr-FR', { day: '2-digit', month: 'long', year: 'numeric' }),
                horaires: ["09:00-11:00", "11:30-13:30", "14:00-16:00", "19:00-21:00"],
                jours: {
                    "Lundi": [
                        null,
                        null,
                        null,
                        { matiere: "Module 1 (Q&A)", salle: "En ligne", type: "En Ligne" }
                    ],
                    "Mardi": [
                        null,
                        null,
                        null,
                        { matiere: "Module 2 (Q&A)", salle: "En ligne", type: "En Ligne" }
                    ],
                    "Mercredi": [
                        null,
                        null,
                        null,
                        { matiere: "Module 3 (Q&A)", salle: "En ligne", type: "En Ligne" }
                    ],
                    "Jeudi": [
                        null,
                        null,
                        null,
                        null
                    ],
                    "Vendredi": [
                        null,
                        null,
                        null,
                        null
                    ],
                    "Samedi": [
                        null,
                        null,
                        { matiere: "Module 1", salle: "Amphi A", type: "Cours" },
                        null
                    ],
                    "Dimanche": [
                        { matiere: "Module 2", salle: "Amphi B", type: "Cours" },
                        { matiere: "Module 3", salle: "Amphi C", type: "Cours" },
                        null,
                        null
                    ]
                }
            };
            displayPlanning(defaultPlanning);
        }
    });
</script>
</body>
</html>