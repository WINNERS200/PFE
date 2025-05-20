<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Gestion des inscriptions</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .btn-validation { width: 100px; }
    .specialization-badge {
      background-color: #6f42c1;
      color: white;
      margin-right: 5px;
    }
    .formateur-info {
      font-weight: 500;
      color: #0d6efd;
    }
    .card {
      border-radius: 0.5rem;
    }
    .table th {
      background-color: #f8f9fa;
    }
  </style>
</head>
<body class="bg-light">

<div class="container mt-5">
  <h2 class="text-center mb-4">📋 Gestion des inscriptions</h2>

  <!-- Liste des demandes -->
  <div class="card mb-4 p-4 shadow-sm">
    <h5>🕓 Demandes en attente</h5>
    <div class="table-responsive">
      <table class="table table-bordered table-hover mt-3 bg-white">
        <thead class="table-light">
          <tr>
            <th>Nom</th>
            <th>Email</th>
            <th>Niveau</th>
            <th>Spécialisation</th>
            <th>Formateur attitré</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="table-demandes">
          <tr>
            <td>Fatima Zahra</td>
            <td>fatima@gmail.com</td>
            <td>Master</td>
            <td><span class="badge specialization-badge">Big Data et Cloud Computing</span></td>
            <td><span class="formateur-info">Pr. Amina ELOMRI</span></td>
            <td>
              <button class="btn btn-success btn-sm btn-validation" onclick="valider(this)">Valider</button>
              <button class="btn btn-danger btn-sm btn-validation" onclick="refuser(this)">Refuser</button>
            </td>
          </tr>
          <tr>
            <td>Yassine El Amrani</td>
            <td>yassine@gmail.com</td>
            <td>Licence</td>
            <td><span class="badge specialization-badge">Admin. Systèmes, BD et Réseaux</span></td>
            <td><span class="formateur-info">Pr. Khalid MOUSSAID</span></td>
            <td>
              <button class="btn btn-success btn-sm btn-validation" onclick="valider(this)">Valider</button>
              <button class="btn btn-danger btn-sm btn-validation" onclick="refuser(this)">Refuser</button>
            </td>
          </tr>
          <tr>
            <td>Salma Benali</td>
            <td>salma@gmail.com</td>
            <td>Licence</td>
            <td><span class="badge specialization-badge">Développement Web et Mobile</span></td>
            <td><span class="formateur-info">Pr. Mohamed RIDA</span></td>
            <td>
              <button class="btn btn-success btn-sm btn-validation" onclick="valider(this)">Valider</button>
              <button class="btn btn-danger btn-sm btn-validation" onclick="refuser(this)">Refuser</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Historique -->
  <div class="card p-4 shadow-sm">
    <h5>📚 Historique des inscriptions</h5>
    <div class="table-responsive">
      <table class="table table-bordered table-hover mt-3 bg-white">
        <thead class="table-light">
          <tr>
            <th>Nom</th>
            <th>Email</th>
            <th>Niveau</th>
            <th>Spécialisation</th>
            <th>Formateur</th>
            <th>Statut</th>
          </tr>
        </thead>
        <tbody id="table-historique">
          <!-- Exemple d'inscription validée -->
          <tr>
            <td>Karim Bennani</td>
            <td>karim@gmail.com</td>
            <td>Master</td>
            <td><span class="badge specialization-badge">Cybersécurité et Cyberdéfense</span></td>
            <td><span class="formateur-info">Pr. Laila FETJAH</span></td>
            <td><span class="badge bg-success">Validé</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
  // Base de données des spécialisations et formateurs
  const specializations = {
    "Licence": [
      { 
        name: "Administration Avancée des Systèmes et Réseaux Informatiques",
        formateur: "Pr. Mohammed ERRAIS"
      },
      { 
        name: "Administration, Systèmes, Bases de Données et Réseaux",
        formateur: "Pr. Khalid MOUSSAID"
      },
      { 
        name: "Développement Informatique",
        formateur: "Pr. Brahim RAOUYANE"
      },
      { 
        name: "Développement Web et Mobile",
        formateur: "Pr. Mohamed RIDA"
      },
      { 
        name: "Développement Full Stack et DevOps",
        formateur: "Pr. Noureddine ABGHOUR"
      },
      { 
        name: "Ingénierie Réseaux et Cloud Computing",
        formateur: "Pr. Rim KOULALI"
      }
    ],
    "Master": [
      { 
        name: "Big Data et Cloud Computing",
        formateur: "Pr. Amina ELOMRI"
      },
      { 
        name: "Business Intelligence et Sciences de Données",
        formateur: "Pr. Tarik NAHHAL"
      },
      { 
        name: "Management des Systèmes d'Information",
        formateur: "Pr. Mounia MIYARA"
      },
      { 
        name: "Cybersécurité et Cyberdéfense",
        formateur: "Pr. Laila FETJAH"
      }
    ]
  };

  function valider(button) {
    let row = button.closest('tr');
    let nom = row.cells[0].innerText;
    let email = row.cells[1].innerText;
    let niveau = row.cells[2].innerText;
    let specialisation = row.cells[3].innerText;
    let formateur = row.cells[4].innerText;

    ajouterHistorique(nom, email, niveau, specialisation, formateur, 'Validé');
    row.remove();
  }

  function refuser(button) {
    let row = button.closest('tr');
    let nom = row.cells[0].innerText;
    let email = row.cells[1].innerText;
    let niveau = row.cells[2].innerText;
    let specialisation = row.cells[3].innerText;
    let formateur = row.cells[4].innerText;

    ajouterHistorique(nom, email, niveau, specialisation, formateur, 'Refusé');
    row.remove();
  }

  function ajouterHistorique(nom, email, niveau, specialisation, formateur, statut) {
    let table = document.getElementById('table-historique');
    let ligne = document.createElement('tr');

    ligne.innerHTML = `
      <td>${nom}</td>
      <td>${email}</td>
      <td>${niveau}</td>
      <td>${specialisation}</td>
      <td>${formateur}</td>
      <td><span class="badge ${statut === 'Validé' ? 'bg-success' : 'bg-danger'}">${statut}</span></td>
    `;

    table.appendChild(ligne);
  }
</script>

</body>
</html>