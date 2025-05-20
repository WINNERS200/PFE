<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Planification des Cours</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .specialization-badge {
      background-color: #6f42c1;
      color: white;
      margin-right: 5px;
      margin-bottom: 5px;
    }
    .card {
      border-radius: 0.5rem;
    }
    .table th {
      background-color: #f8f9fa;
    }
    .formateur-info {
      font-weight: 500;
      color: #0d6efd;
    }
    .formateur-field {
      background-color: #f8f9fa;
    }
  </style>
</head>
<body class="bg-light">

<div class="container mt-5">
  <h2 class="text-center mb-4">📅 Planification des cours</h2>

  <div class="card shadow-sm p-4 mb-4">
    <form id="form-planning">
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="niveau" class="form-label">Niveau</label>
          <select class="form-select" id="niveau" name="niveau" required>
            <option selected disabled>Choisir un niveau</option>
            <option value="Licence">Licence</option>
            <option value="Master">Master</option>
          </select>
        </div>
        
        <div class="col-md-6">
          <label for="specialization" class="form-label">Spécialisation</label>
          <select class="form-select" id="specialization" name="specialization" required disabled>
            <option selected disabled>Choisissez d'abord le niveau</option>
          </select>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-md-6">
          <label for="module" class="form-label">Module</label>
          <input type="text" class="form-control" id="module" name="module" placeholder="Nom du module" required>
        </div>

        <div class="col-md-6">
          <label for="formateur" class="form-label">Formateur</label>
          <input type="text" class="form-control formateur-field" id="formateur" name="formateur" readonly>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-md-3">
          <label for="date" class="form-label">Date</label>
          <input type="date" class="form-control" id="date" name="date" required>
        </div>

        <div class="col-md-3">
          <label for="heure" class="form-label">Heure</label>
          <input type="time" class="form-control" id="heure" name="heure" required>
        </div>

        <div class="col-md-6">
          <label for="salle" class="form-label">Salle</label>
          <input type="text" class="form-control" id="salle" name="salle" placeholder="Ex: Salle A2" required>
        </div>
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-primary">Enregistrer la planification</button>
      </div>
    </form>
  </div>

  <div class="mt-4">
    <h5>🗓️ Plannings enregistrés</h5>
    <div class="table-responsive">
      <table class="table table-bordered table-hover mt-3 bg-white">
        <thead class="table-light">
          <tr>
            <th>Niveau</th>
            <th>Spécialisation</th>
            <th>Module</th>
            <th>Formateur</th>
            <th>Date</th>
            <th>Heure</th>
            <th>Salle</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="planning-table-body">
          <!-- Lignes seront ajoutées dynamiquement -->
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
  // Mappage des spécialisations et formateurs
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

  // DOM Elements
  const niveauSelect = document.getElementById("niveau");
  const specializationSelect = document.getElementById("specialization");
  const formateurInput = document.getElementById("formateur");
  const form = document.getElementById("form-planning");
  const tableBody = document.getElementById("planning-table-body");

  // Gestion du changement de niveau
  niveauSelect.addEventListener("change", function() {
    const niveau = this.value;
    specializationSelect.innerHTML = '<option selected disabled>Choisir une spécialisation</option>';
    formateurInput.value = "";
    
    if (niveau) {
      specializationSelect.disabled = false;
      specializations[niveau].forEach(spec => {
        const option = document.createElement("option");
        option.value = spec.code;
        option.textContent = spec.name;
        specializationSelect.appendChild(option);
      });
    } else {
      specializationSelect.disabled = true;
    }
  });

  // Gestion du changement de spécialisation
  specializationSelect.addEventListener("change", function() {
    const niveau = niveauSelect.value;
    const specializationCode = this.value;
    
    if (niveau && specializationCode) {
      const selectedSpec = specializations[niveau].find(s => s.code === specializationCode);
      formateurInput.value = selectedSpec.formateur;
    } else {
      formateurInput.value = "";
    }
  });

  // Gestion de la soumission du formulaire
  form.addEventListener("submit", function(e) {
    e.preventDefault();

    // Récupération des valeurs
    const niveau = document.getElementById("niveau").value;
    const specializationCode = document.getElementById("specialization").value;
    const module = document.getElementById("module").value;
    const formateur = document.getElementById("formateur").value;
    const date = document.getElementById("date").value;
    const heure = document.getElementById("heure").value;
    const salle = document.getElementById("salle").value;

    // Validation
    if (!niveau || !specializationCode || !module || !formateur || !date || !heure || !salle) {
      alert("Veuillez remplir tous les champs du formulaire");
      return;
    }

    // Trouver le nom complet de la spécialisation
    const specialization = specializations[niveau].find(s => s.code === specializationCode);

    // Création d'une nouvelle ligne
    const nouvelleLigne = document.createElement("tr");
    nouvelleLigne.innerHTML = `
      <td>${niveau}</td>
      <td><span class="badge specialization-badge">${specialization.name}</span></td>
      <td>${module}</td>
      <td><span class="formateur-info">${formateur}</span></td>
      <td>${date}</td>
      <td>${heure}</td>
      <td>${salle}</td>
      <td><button class="btn btn-danger btn-sm" onclick="supprimerLigne(this)">Supprimer</button></td>
    `;

    tableBody.appendChild(nouvelleLigne);
    form.reset();
    specializationSelect.disabled = true;
    formateurInput.value = "";
  });

  function supprimerLigne(bouton) {
    if (confirm("Êtes-vous sûr de vouloir supprimer cette planification ?")) {
      const ligne = bouton.closest("tr");
      ligne.remove();
    }
  }
</script>

</body>
</html>