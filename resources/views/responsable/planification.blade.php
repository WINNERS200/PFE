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
          <select class="form-select" id="module" name="module" required>
            <option selected disabled>Choisissez un module</option>
          </select>
        </div>
        <div class="col-md-6">
          <label for="formateur" class="form-label">Formateur</label>
          <select class="form-select" id="formateur" name="formateur" required>
            <option selected disabled>Choisissez un formateur</option>
            <option>Pr. Mohammed ERRAIS</option>
            <option>Pr. Khalid MOUSSAID</option>
            <option>Pr. Brahim RAOUYANE</option>
            <option>Pr. Mohamed RIDA</option>
            <option>Pr. Noureddine ABGHOUR</option>
            <option>Pr. Rim KOULALI</option>
            <option>Pr. Amina ELOMRI</option>
            <option>Pr. Tarik NAHHAL</option>
            <option>Pr. Mounia MIYARA</option>
            <option>Pr. Laila FETJAH</option>
          </select>
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
          <!-- Lignes dynamiques ici -->
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
  const specializations = {
    "Licence": [
      { code: "AASRI", name: "Administration Avancée des Systèmes et Réseaux Informatiques" },
      { code: "ASBDR", name: "Administration, Systèmes, Bases de Données et Réseaux" },
      { code: "DI", name: "Développement Informatique" },
      { code: "DWM", name: "Développement Web et Mobile" },
      { code: "FSD", name: "Développement Full Stack et DevOps" },
      { code: "IRC", name: "Ingénierie Réseaux et Cloud Computing" }
    ],
    "Master": [
      { code: "BDC", name: "Big Data et Cloud Computing" },
      { code: "BISD", name: "Business Intelligence et Sciences de Données" },
      { code: "MSI", name: "Management des Systèmes d'Information" },
      { code: "CC", name: "Cybersécurité et Cyberdéfense" }
    ]
  };

  const modulesParSpecialisation = {
    "AASRI": ["Linux avancé", "Administration réseaux", "Sécurité des systèmes"],
    "ASBDR": ["Oracle SQL", "Administration SGBD", "Sécurité base de données"],
    "DI": ["POO avec Java", "Structures de données", "Patrons de conception"],
    "DWM": ["Laravel", "ReactJS", "API REST"],
    "FSD": ["DevOps", "NodeJS", "Angular"],
    "IRC": ["Cisco", "Virtualisation", "Cloud AWS"],
    "BDC": ["BigQuery", "Spark", "NoSQL"],
    "BISD": ["Power BI", "Data Mining", "SQL Server"],
    "MSI": ["ERP", "Gestion de projet", "Audit SI"],
    "CC": ["Sécurité réseau", "Pentest", "Cryptographie"]
  };

  const niveauSelect = document.getElementById("niveau");
  const specializationSelect = document.getElementById("specialization");
  const moduleSelect = document.getElementById("module");
  const form = document.getElementById("form-planning");
  const tableBody = document.getElementById("planning-table-body");

  niveauSelect.addEventListener("change", function () {
    const niveau = this.value;
    specializationSelect.innerHTML = '<option selected disabled>Choisir une spécialisation</option>';
    moduleSelect.innerHTML = '<option selected disabled>Choisissez un module</option>';

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

  specializationSelect.addEventListener("change", function () {
    const specializationCode = this.value;
    moduleSelect.innerHTML = '<option selected disabled>Choisissez un module</option>';
    const modules = modulesParSpecialisation[specializationCode] || [];
    modules.forEach(mod => {
      const opt = document.createElement("option");
      opt.value = mod;
      opt.textContent = mod;
      moduleSelect.appendChild(opt);
    });
  });

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    const niveau = niveauSelect.value;
    const specializationCode = specializationSelect.value;
    const specialization = [...specializations[niveau]].find(s => s.code === specializationCode);
    const module = moduleSelect.value;
    const formateur = document.getElementById("formateur").value;
    const date = document.getElementById("date").value;
    const heure = document.getElementById("heure").value;
    const salle = document.getElementById("salle").value;

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
    moduleSelect.innerHTML = '<option selected disabled>Choisissez un module</option>';
  });

  function supprimerLigne(bouton) {
    if (confirm("Supprimer cette ligne ?")) {
      bouton.closest("tr").remove();
    }
  }
</script>

</body>
</html>