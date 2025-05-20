<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>📢 Annonces de l'Administration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
            color: #343a40;
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
        .announcement-item {
            border-left: 5px solid #0d6efd;
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            background-color: #fff;
        }
        .announcement-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 0.3rem 0.8rem rgba(0,0,0,0.1) !important;
        }
        .announcement-item h5 {
            color: #2c3e50;
            font-weight: 500;
        }
        .announcement-item p {
            color: #495057;
            font-size: 0.95rem;
            line-height: 1.6;
        }
        .announcement-item small {
            font-size: 0.85rem;
            color: #6c757d;
        }
        .badge-priority-haute { background-color: #dc3545; }
        .badge-priority-moyenne { background-color: #ffc107; color: #000 !important; }
        .badge-priority-basse { background-color: #198754; }
        .filter-controls {
            background-color: #fcfdff;
            border: 1px solid #e3eaf3;
            border-radius: 0.5rem;
        }
        .specialization-badge {
            background-color: #6f42c1;
            color: white;
            margin-right: 5px;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>

<div class="container mt-5 mb-5">
    <div class="card shadow-sm p-4 p-md-5">
        <div class="text-center mb-4">
            <h2 class="header-title"><i class="bi bi-megaphone-fill me-2"></i>Annonces</h2>
            <p class="text-muted">Tenez-vous informé(e) des dernières actualités et informations importantes.</p>
        </div>

        <!-- Zone de filtres améliorée avec filtre par spécialisation -->
        <div class="filter-controls p-3 mb-4">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="filter-keyword" class="form-label">Rechercher par mot-clé :</label>
                    <input type="text" id="filter-keyword" class="form-control" placeholder="Ex: inscription, examen...">
                </div>
                <div class="col-md-3">
                    <label for="filter-priority" class="form-label">Priorité :</label>
                    <select id="filter-priority" class="form-select">
                        <option value="toutes" selected>Toutes</option>
                        <option value="haute">Haute</option>
                        <option value="moyenne">Moyenne</option>
                        <option value="basse">Basse</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="filter-specialization" class="form-label">Spécialisation :</label>
                    <select id="filter-specialization" class="form-select">
                        <option value="toutes" selected>Toutes</option>
                        <option value="licence">Licence</option>
                        <option value="master">Master</option>
                        <option value="AASRI">Admin. Systèmes & Réseaux</option>
                        <option value="ASBDR">Admin. Systèmes, BD & Réseaux</option>
                        <option value="DI">Développement Informatique</option>
                        <option value="DWM">Développement Web & Mobile</option>
                        <option value="FSD">Full Stack & DevOps</option>
                        <option value="IRC">Ingénierie Réseaux & Cloud</option>
                        <option value="BDC">Big Data & Cloud</option>
                        <option value="BISD">Business Intelligence</option>
                        <option value="MSI">Management SI</option>
                        <option value="CC">Cybersécurité</option>
                    </select>
                </div>
                <div class="col-md-2 text-md-end text-center mt-3 mt-md-0">
                    <button type="button" id="apply-filters-btn" class="btn btn-primary w-100">
                        <i class="bi bi-funnel-fill me-1"></i> Filtrer
                    </button>
                </div>
            </div>
        </div>

        <!-- Liste des annonces -->
        <div id="announcements-list" class="list-group">
            <!-- Les annonces seront injectées ici par JavaScript -->
        </div>

        <!-- Message si aucune annonce -->
        <div id="no-announcements-message" class="alert alert-info text-center mt-4" style="display: none;" role="alert">
            <h4 class="alert-heading"><i class="bi bi-info-circle-fill me-2"></i>Aucune annonce à afficher</h4>
            <p>Il n'y a actuellement aucune annonce correspondant à vos filtres.</p>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // === DATA STORE (Simulé) ===
    const allAnnouncements = [
        {
            id: 1,
            titre: "🗓️ Report du démarrage des cours du Semestre 2",
            contenu: "Les cours du semestre 2 pour toutes les filières débuteront exceptionnellement le <strong>Lundi 20 Septembre 2025</strong> au lieu de la date initialement prévue du 15 Septembre. Veuillez consulter vos emplois du temps mis à jour sur la plateforme.",
            datePublication: "2025-05-10",
            priorite: "haute",
            specializations: ["licence", "master", "AASRI", "ASBDR", "DI", "DWM", "FSD", "IRC", "BDC", "BISD", "MSI", "CC"]
        },
        {
            id: 2,
            titre: "💼 Inscriptions aux Formations de Master Ouvertes",
            contenu: "Les inscriptions pour les différentes formations de Master (Session Automne 2025) sont officiellement ouvertes. Options disponibles : Big Data et Cloud Computing, Business Intelligence et Sciences de Données, Management des Systèmes d'Information, Cybersécurité et Cyberdéfense. Date limite : <strong>30 Juin 2025</strong>.",
            datePublication: "2025-05-05",
            priorite: "moyenne",
            specializations: ["master", "BDC", "BISD", "MSI", "CC"]
        },
        {
            id: 3,
            titre: "📢 Nouveaux parcours Licence Informatique",
            contenu: "Découvrez nos nouvelles options de licence : Administration Avancée des Systèmes et Réseaux Informatiques, Administration, Systèmes, Bases de Données et Réseaux, Développement Informatique, Développement Web et Mobile, Développement Full Stack et DevOps, Ingénierie Réseaux et Cloud Computing.",
            datePublication: "2025-04-28",
            priorite: "haute",
            specializations: ["licence", "AASRI", "ASBDR", "DI", "DWM", "FSD", "IRC"]
        },
        {
            id: 4,
            titre: "🎓 Séminaire Cloud Computing pour IRC et BDC",
            contenu: "Séminaire spécialisé sur les architectures cloud modernes destiné aux étudiants des parcours Ingénierie Réseaux et Cloud Computing (Licence) et Big Data et Cloud Computing (Master). <strong>15 Juin 2025 à 14h00</strong> en Amphi A.",
            datePublication: "2025-05-12",
            priorite: "basse",
            specializations: ["IRC", "BDC"]
        },
        {
            id: 5,
            titre: "⚠️ Maintenance des labos de cybersécurité",
            contenu: "Maintenance programmée des laboratoires de cybersécurité le <strong>18 Mai 2025 de 08h00 à 12h00</strong>. Affecte les parcours Cybersécurité et Cyberdéfense (Master) et Administration des Systèmes (Licence).",
            datePublication: "2025-05-14",
            priorite: "moyenne",
            specializations: ["CC", "AASRI", "ASBDR"]
        },
        {
            id: 6,
            titre: "📚 Atelier DevOps pour FSD",
            contenu: "Atelier pratique sur les pipelines CI/CD pour les étudiants du parcours Full Stack et DevOps. Prérequis : connaissance de Docker et Git. Inscription obligatoire avant le 25 Mai.",
            datePublication: "2025-05-15",
            priorite: "moyenne",
            specializations: ["FSD"]
        }
    ];

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

    // === DOM ELEMENTS ===
    const announcementsListEl = document.getElementById('announcements-list');
    const noAnnouncementsMessageEl = document.getElementById('no-announcements-message');
    const filterKeywordInput = document.getElementById('filter-keyword');
    const filterPrioritySelect = document.getElementById('filter-priority');
    const filterSpecializationSelect = document.getElementById('filter-specialization');
    const applyFiltersBtn = document.getElementById('apply-filters-btn');

    // === UTILITY FUNCTIONS ===
    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('fr-FR', { day: '2-digit', month: 'long', year: 'numeric' });
    }
    
    function getPriorityBadgeClass(priorite) {
        switch(priorite?.toLowerCase()){
            case 'haute': return 'badge-priority-haute';
            case 'moyenne': return 'badge-priority-moyenne';
            case 'basse': return 'badge-priority-basse';
            default: return 'bg-secondary';
        }
    }

    // === UI UPDATE FUNCTION ===
    function displayAnnouncements(announcementsToDisplay) {
        announcementsListEl.innerHTML = '';

        if (!announcementsToDisplay || announcementsToDisplay.length === 0) {
            noAnnouncementsMessageEl.style.display = 'block';
            announcementsListEl.style.display = 'none';
            return;
        }

        noAnnouncementsMessageEl.style.display = 'none';
        announcementsListEl.style.display = 'block';

        announcementsToDisplay.sort((a, b) => new Date(b.datePublication) - new Date(a.datePublication));

        announcementsToDisplay.forEach(annonce => {
            const annonceElement = document.createElement('div');
            annonceElement.className = 'list-group-item list-group-item-action mb-3 shadow-sm announcement-item';

            let priorityBadge = '';
            if(annonce.priorite){
                priorityBadge = `<span class="badge rounded-pill ${getPriorityBadgeClass(annonce.priorite)} float-end">${annonce.priorite.charAt(0).toUpperCase() + annonce.priorite.slice(1)}</span>`;
            }

            // Générer les badges de spécialisation
            let specializationBadges = '';
            if(annonce.specializations) {
                const filteredSpecs = annonce.specializations.filter(spec => 
                    spec !== "licence" && spec !== "master" && specializationNames[spec]
                );
                specializationBadges = filteredSpecs.map(spec => 
                    `<span class="badge specialization-badge rounded-pill">${specializationNames[spec]}</span>`
                ).join('');
            }

            annonceElement.innerHTML = `
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">${annonce.titre}</h5>
                    <small class="text-muted">Publié le ${formatDate(annonce.datePublication)}</small>
                </div>
                ${priorityBadge ? `<div class="mb-2">${priorityBadge}</div>` : ''}
                <p class="mb-1">${annonce.contenu}</p>
                ${specializationBadges ? `<div class="mt-2">${specializationBadges}</div>` : ''}
            `;
            
            announcementsListEl.appendChild(annonceElement);
        });
    }

    // === FILTERING LOGIC ===
    function filterAnnouncements() {
        const keyword = filterKeywordInput.value.trim().toLowerCase();
        const priority = filterPrioritySelect.value;
        const specialization = filterSpecializationSelect.value;

        let filtered = allAnnouncements;

        if (keyword) {
            filtered = filtered.filter(annonce =>
                annonce.titre.toLowerCase().includes(keyword) ||
                annonce.contenu.toLowerCase().includes(keyword)
            );
        }

        if (priority !== "toutes") {
            filtered = filtered.filter(annonce => annonce.priorite === priority);
        }

        if (specialization !== "toutes") {
            filtered = filtered.filter(annonce => 
                specialization === "licence" ? 
                    annonce.specializations.some(spec => 
                        ["AASRI", "ASBDR", "DI", "DWM", "FSD", "IRC"].includes(spec)) :
                specialization === "master" ? 
                    annonce.specializations.some(spec => 
                        ["BDC", "BISD", "MSI", "CC"].includes(spec)) :
                annonce.specializations.includes(specialization)
            );
        }

        displayAnnouncements(filtered);
    }

    // === EVENT HANDLERS ===
    applyFiltersBtn.addEventListener('click', filterAnnouncements);
    filterKeywordInput.addEventListener('keyup', () => {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(filterAnnouncements, 300);
    });
    filterPrioritySelect.addEventListener('change', filterAnnouncements);
    filterSpecializationSelect.addEventListener('change', filterAnnouncements);

    let debounceTimer;

    // Initial display of all announcements
    displayAnnouncements(allAnnouncements);
</script>
</body>
</html>