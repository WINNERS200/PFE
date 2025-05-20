<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Affectation des Formateurs</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      padding: 20px;
    }
    .card {
      margin-bottom: 20px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      border-radius: 0.5rem;
    }
    .badge {
      font-size: 0.9em;
    }
    .specialization-badge {
      background-color: #6f42c1;
      color: white;
    }
    .formateur-info {
      font-weight: 500;
      color: #0d6efd;
    }
    .modal-header {
      background-color: #0d6efd;
      color: white;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2 class="my-4">👨‍🏫 Affectation des formateurs</h2>
    
    <!-- Formulaire d'affectation -->
    <div class="card">
      <div class="card-header bg-primary text-white">
        Affecter un formateur à un module
      </div>
      <div class="card-body">
        <form id="affectation-form">
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="niveau" class="form-label">Niveau</label>
              <select class="form-select" id="niveau" required>
                <option value="" selected disabled>Choisir un niveau</option>
                <option value="Licence">Licence</option>
                <option value="Master">Master</option>
              </select>
            </div>
            
            <div class="col-md-6">
              <label for="specialization" class="form-label">Spécialisation</label>
              <select class="form-select" id="specialization" required disabled>
                <option value="" selected disabled>Choisissez d'abord le niveau</option>
              </select>
            </div>
          </div>
          
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="module" class="form-label">Module</label>
              <select class="form-select" id="module" required disabled>
                <option value="" selected disabled>Choisissez d'abord la spécialisation</option>
              </select>
            </div>
            
            <div class="col-md-6">
              <label for="formateur" class="form-label">Formateur</label>
              <input type="text" class="form-control" id="formateur" readonly>
            </div>
          </div>
          
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="date-debut" class="form-label">Date de début</label>
              <input type="date" class="form-control" id="date-debut" required>
            </div>
            
            <div class="col-md-6">
              <label for="date-fin" class="form-label">Date de fin</label>
              <input type="date" class="form-control" id="date-fin" required>
            </div>
          </div>
          
          <button type="submit" class="btn btn-primary">Enregistrer l'affectation</button>
        </form>
      </div>
    </div>
    
    <!-- Liste des affectations -->
    <div class="card">
      <div class="card-header bg-success text-white">
        Affectations en cours
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Niveau</th>
                <th>Spécialisation</th>
                <th>Module</th>
                <th>Formateur</th>
                <th>Période</th>
                <th>Statut</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="affectations-list">
              <!-- Exemples d'affectations -->
              <tr>
                <td>Licence</td>
                <td><span class="badge specialization-badge">Admin. Systèmes, BD et Réseaux</span></td>
                <td>Sécurité des Bases de Données</td>
                <td><span class="formateur-info">Pr. Khalid MOUSSAID</span></td>
                <td>15/05 - 20/05/2025</td>
                <td><span class="badge bg-success">Confirmé</span></td>
                <td>
                  <button class="btn btn-sm btn-danger" onclick="supprimerAffectation(this)">Supprimer</button>
                </td>
              </tr>
              <tr>
                <td>Master</td>
                <td><span class="badge specialization-badge">Big Data et Cloud Computing</span></td>
                <td>Analyse de Données Massives</td>
                <td><span class="formateur-info">Pr. Amina ELOMRI</span></td>
                <td>18/05 - 22/05/2025</td>
                <td><span class="badge bg-warning text-dark">En attente</span></td>
                <td>
                  <button class="btn btn-sm btn-danger" onclick="supprimerAffectation(this)">Supprimer</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Base de données des spécialisations, modules et formateurs
    const specializations = {
      "Licence": [
        { 
          name: "Administration Avancée des Systèmes et Réseaux Informatiques",
          formateur: "Pr. Mohammed ERRAIS",
          modules: [
            "Administration Système",
            "Sécurité des Réseaux",
            "Virtualisation"
          ]
        },
        { 
          name: "Administration, Systèmes, Bases de Données et Réseaux",
          formateur: "Pr. Khalid MOUSSAID",
          modules: [
            "Administration BDD",
            "Sécurité des Bases de Données",
            "Réseaux Avancés"
          ]
        },
        { 
          name: "Développement Web et Mobile",
          formateur: "Pr. Mohamed RIDA",
          modules: [
            "Développement Frontend",
            "Applications Mobiles",
            "Frameworks JavaScript"
          ]
        }
      ],
      "Master": [
        { 
          name: "Big Data et Cloud Computing",
          formateur: "Pr. Amina ELOMRI",
          modules: [
            "Analyse de Données Massives",
            "Cloud Computing",
            "Machine Learning"
          ]
        },
        { 
          name: "Cybersécurité et Cyberdéfense",
          formateur: "Pr. Laila FETJAH",
          modules: [
            "Cryptographie Avancée",
            "Pentesting",
            "Sécurité des Systèmes"
          ]
        }
      ]
    };

    // DOM Elements
    const niveauSelect = document.getElementById('niveau');
    const specializationSelect = document.getElementById('specialization');
    const moduleSelect = document.getElementById('module');
    const formateurInput = document.getElementById('formateur');
    const affectationForm = document.getElementById('affectation-form');

    // Gestion du changement de niveau
    niveauSelect.addEventListener('change', function() {
      const niveau = this.value;
      specializationSelect.innerHTML = '<option value="" selected disabled>Choisir une spécialisation</option>';
      moduleSelect.innerHTML = '<option value="" selected disabled>Choisissez d\'abord la spécialisation</option>';
      moduleSelect.disabled = true;
      formateurInput.value = '';
      
      if (niveau) {
        specializationSelect.disabled = false;
        specializations[niveau].forEach(spec => {
          const option = document.createElement('option');
          option.value = spec.name;
          option.textContent = spec.name;
          specializationSelect.appendChild(option);
        });
      } else {
        specializationSelect.disabled = true;
      }
    });

    // Gestion du changement de spécialisation
    specializationSelect.addEventListener('change', function() {
      const niveau = niveauSelect.value;
      const specName = this.value;
      moduleSelect.innerHTML = '<option value="" selected disabled>Choisir un module</option>';
      
      if (niveau && specName) {
        moduleSelect.disabled = false;
        const selectedSpec = specializations[niveau].find(s => s.name === specName);
        
        // Remplir les modules
        selectedSpec.modules.forEach(mod => {
          const option = document.createElement('option');
          option.value = mod;
          option.textContent = mod;
          moduleSelect.appendChild(option);
        });
        
        // Afficher le formateur automatiquement
        formateurInput.value = selectedSpec.formateur;
      } else {
        moduleSelect.disabled = true;
        formateurInput.value = '';
      }
    });

    // Gestion de la soumission du formulaire
    affectationForm.addEventListener('submit', function(e) {
      e.preventDefault();
      
      const niveau = niveauSelect.value;
      const specialization = specializationSelect.value;
      const module = moduleSelect.options[moduleSelect.selectedIndex].text;
      const formateur = formateurInput.value;
      const dateDebut = document.getElementById('date-debut').value;
      const dateFin = document.getElementById('date-fin').value;
      
      if (!niveau || !specialization || !module || !formateur || !dateDebut || !dateFin) {
        alert('Veuillez remplir tous les champs du formulaire');
        return;
      }

      // Création de la nouvelle ligne
      const newRow = document.createElement('tr');
      newRow.innerHTML = `
        <td>${niveau}</td>
        <td><span class="badge specialization-badge">${specialization}</span></td>
        <td>${module}</td>
        <td><span class="formateur-info">${formateur}</span></td>
        <td>${formatDate(dateDebut)} - ${formatDate(dateFin)}</td>
        <td><span class="badge bg-warning text-dark">En attente</span></td>
        <td>
          <button class="btn btn-sm btn-danger" onclick="supprimerAffectation(this)">Supprimer</button>
        </td>
      `;
      
      // Ajout à la table
      document.getElementById('affectations-list').appendChild(newRow);
      
      // Réinitialisation du formulaire
      this.reset();
      specializationSelect.disabled = true;
      moduleSelect.disabled = true;
      formateurInput.value = '';
    });
    
    // Formatage de la date (JJ/MM/AAAA)
    function formatDate(dateString) {
      if (!dateString) return 'N/A';
      const date = new Date(dateString);
      return date.toLocaleDateString('fr-FR');
    }
    
    // Suppression d'une affectation
    function supprimerAffectation(btn) {
      if (confirm('Confirmer la suppression de cette affectation ?')) {
        btn.closest('tr').remove();
      }
    }
  </script>
</body>
</html>