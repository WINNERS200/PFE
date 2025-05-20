<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Gestion des Années Académiques</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .badge-status {
      font-size: 0.9em;
      padding: 0.4em 0.65em;
    }
  </style>
</head>
<body class="bg-light">

<div class="container mt-5">
  <h2 class="text-center mb-4">📅 Gestion des années académiques</h2>

  <div class="card shadow-sm p-4 mb-4">
    <form id="form-annee">
      <input type="hidden" id="edit-id">
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="annee" class="form-label">Année académique</label>
          <input type="text" class="form-control" id="annee" name="annee" placeholder="Ex: 2023-2024" required>
        </div>

        <div class="col-md-6">
          <label for="date-debut" class="form-label">Date de début</label>
          <input type="date" class="form-control" id="date-debut" name="date-debut" required>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-md-6">
          <label for="date-fin" class="form-label">Date de fin</label>
          <input type="date" class="form-control" id="date-fin" name="date-fin" required>
        </div>

        <div class="col-md-6">
          <label for="statut" class="form-label">Statut</label>
          <select class="form-select" id="statut" name="statut" required>
            <option value="planifie">Planifié</option>
            <option value="encours" selected>En cours</option>
            <option value="termine">Terminé</option>
          </select>
        </div>
      </div>

      <!-- Section des filières associées -->
      <div class="mb-3">
        <label class="form-label">Filières associées</label>
        <div class="card p-3">
          <div class="row">
            <!-- Filières de Licence -->
            <div class="col-md-6">
              <h6>Licence Informatique</h6>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="filiere-l1" value="Administration Avancée des Systèmes et Réseaux Informatiques - Pr. Mohammed ERRAIS">
                <label class="form-check-label" for="filiere-l1">Administration Avancée (Pr. ERRAIS)</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="filiere-l2" value="Administration, Systèmes, Bases de Données et Réseaux - Pr. Khalid MOUSSAID">
                <label class="form-check-label" for="filiere-l2">Administration Systèmes (Pr. MOUSSAID)</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="filiere-l3" value="Développement Informatique - Pr. Brahim RAOUYANE">
                <label class="form-check-label" for="filiere-l3">Développement Informatique (Pr. RAOUYANE)</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="filiere-l4" value="Développement Web et Mobile - Pr. Mohamed RIDA">
                <label class="form-check-label" for="filiere-l4">Développement Web/Mobile (Pr. RIDA)</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="filiere-l5" value="Développement Full Stack et Devops - Pr. Noureddine ABGHOUR">
                <label class="form-check-label" for="filiere-l5">Full Stack & Devops (Pr. ABGHOUR)</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="filiere-l6" value="Ingénierie Réseaux et Cloud Computing - Pr. Rim KOULALI">
                <label class="form-check-label" for="filiere-l6">Réseaux & Cloud (Pr. KOULALI)</label>
              </div>
            </div>

            <!-- Filières de Master -->
            <div class="col-md-6">
              <h6>Master Informatique</h6>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="filiere-m1" value="Big Data et Cloud Computing - Pr. Amina ELOMRI">
                <label class="form-check-label" for="filiere-m1">Big Data & Cloud (Pr. ELOMRI)</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="filiere-m2" value="Business Intelligence et Sciences de Données - Pr. Tarik NAHHAL">
                <label class="form-check-label" for="filiere-m2">Business Intelligence (Pr. NAHHAL)</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="filiere-m3" value="Management des Systèmes d'Information - Pr. Mounia MIYARA">
                <label class="form-check-label" for="filiere-m3">Management SI (Pr. MIYARA)</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="filiere-m4" value="Cybersécurité et Cyberdéfense - Pr. Laila FETJAH">
                <label class="form-check-label" for="filiere-m4">Cybersécurité (Pr. FETJAH)</label>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-primary" id="submit-btn">Enregistrer</button>
        <button type="button" class="btn btn-secondary mt-2" id="cancel-btn" style="display:none;" onclick="annulerModification()">Annuler</button>
      </div>
    </form>
  </div>

  <div class="mt-4">
    <h5>📋 Liste des années académiques</h5>
    <div class="input-group mb-3">
      <input type="text" class="form-control" placeholder="Rechercher une année...">
      <button class="btn btn-outline-secondary" type="button">Filtrer</button>
    </div>
    
    <table class="table table-bordered table-hover mt-3 bg-white">
      <thead class="table-light">
        <tr>
          <th>Année</th>
          <th>Période</th>
          <th>Statut</th>
          <th>Filières associées</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="annees-table-body">
        <tr data-id="1" data-filieres='["Administration Avancée des Systèmes et Réseaux Informatiques - Pr. Mohammed ERRAIS","Développement Web et Mobile - Pr. Mohamed RIDA"]'>
          <td>2023-2024</td>
          <td>01/09/2023 - 30/06/2024</td>
          <td data-statut="encours"><span class="badge bg-success badge-status">En cours</span></td>
          <td>
            <span class="badge bg-light text-dark me-1">Admin. Avancée (ERRAIS)</span>
            <span class="badge bg-light text-dark">Web/Mobile (RIDA)</span>
          </td>
          <td>
            <button class="btn btn-sm btn-warning me-1" onclick="modifierAnnee(this)">Modifier</button>
            <button class="btn btn-sm btn-danger" onclick="supprimerAnnee(this)">Supprimer</button>
          </td>
        </tr>
        <tr data-id="2" data-filieres='["Big Data et Cloud Computing - Pr. Amina ELOMRI","Cybersécurité et Cyberdéfense - Pr. Laila FETJAH"]'>
          <td>2024-2025</td>
          <td>02/09/2024 - 30/06/2025</td>
          <td data-statut="planifie"><span class="badge bg-info badge-status">Planifié</span></td>
          <td>
            <span class="badge bg-light text-dark me-1">Big Data (ELOMRI)</span>
            <span class="badge bg-light text-dark">Cybersécurité (FETJAH)</span>
          </td>
          <td>
            <button class="btn btn-sm btn-warning me-1" onclick="modifierAnnee(this)">Modifier</button>
            <button class="btn btn-sm btn-danger" onclick="supprimerAnnee(this)">Supprimer</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<script>
  // Variables
  let enModeEdition = false;
  let currentEditId = null;
  const form = document.getElementById("form-annee");
  const tableBody = document.getElementById("annees-table-body");
  const submitBtn = document.getElementById("submit-btn");
  const cancelBtn = document.getElementById("cancel-btn");

  // Soumission du formulaire (ajout ou modification)
  form.addEventListener("submit", function (e) {
    e.preventDefault();

    const annee = document.getElementById("annee").value;
    const dateDebut = document.getElementById("date-debut").value;
    const dateFin = document.getElementById("date-fin").value;
    const statut = document.getElementById("statut").value;
    const statutText = document.getElementById("statut").options[document.getElementById("statut").selectedIndex].text;
    
    // Récupérer les filières sélectionnées
    const filieresCheckboxes = document.querySelectorAll('input[type="checkbox"]:checked');
    const filieres = Array.from(filieresCheckboxes).map(cb => cb.value);
    const filieresData = JSON.stringify(filieres);
    
    // Formatage des filières pour l'affichage
    const filieresDisplay = filieres.map(f => {
      const parts = f.split(" - ");
      const nomCourt = parts[0].split(" ")[0] + (parts[0].includes("et") ? " " + parts[0].split("et")[1].trim().split(" ")[0] : "");
      const prof = parts[1].split(" ")[2];
      return `<span class="badge bg-light text-dark me-1">${nomCourt} (${prof})</span>`;
    }).join("");

    if (enModeEdition) {
      // Mettre à jour la ligne existante
      const row = document.querySelector(`tr[data-id="${currentEditId}"]`);
      row.cells[0].textContent = annee;
      row.cells[1].textContent = `${formatDate(dateDebut)} - ${formatDate(dateFin)}`;
      row.cells[2].innerHTML = `<span class="badge ${getStatutClass(statut)} badge-status">${statutText}</span>`;
      row.cells[3].innerHTML = filieresDisplay;
      row.setAttribute('data-filieres', filieresData);
      
      annulerModification();
    } else {
      // Ajouter une nouvelle ligne
      const newId = Date.now();
      const nouvelleLigne = document.createElement("tr");
      nouvelleLigne.setAttribute('data-id', newId);
      nouvelleLigne.setAttribute('data-filieres', filieresData);
      nouvelleLigne.innerHTML = `
        <td>${annee}</td>
        <td>${formatDate(dateDebut)} - ${formatDate(dateFin)}</td>
        <td data-statut="${statut}"><span class="badge ${getStatutClass(statut)} badge-status">${statutText}</span></td>
        <td>${filieresDisplay}</td>
        <td>
          <button class="btn btn-sm btn-warning me-1" onclick="modifierAnnee(this)">Modifier</button>
          <button class="btn btn-sm btn-danger" onclick="supprimerAnnee(this)">Supprimer</button>
        </td>
      `;
      tableBody.appendChild(nouvelleLigne);
      form.reset();
      resetFilieres();
    }
  });

  // Formater la date (JJ/MM/AAAA)
  function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('fr-FR');
  }

  // Classe CSS pour le statut
  function getStatutClass(statut) {
    const classes = {
      'planifie': 'bg-info',
      'encours': 'bg-success',
      'termine': 'bg-secondary'
    };
    return classes[statut];
  }

  // Réinitialiser les cases à cocher des filières
  function resetFilieres() {
    document.querySelectorAll('input[type="checkbox"]').forEach(cb => {
      cb.checked = false;
    });
  }

  // Modifier une année
  function modifierAnnee(bouton) {
    const row = bouton.closest("tr");
    
    // Remplir le formulaire
    document.getElementById("edit-id").value = row.getAttribute('data-id');
    document.getElementById("annee").value = row.cells[0].textContent;
    
    // Extraire les dates
    const dates = row.cells[1].textContent.split(" - ");
    document.getElementById("date-debut").value = formatDateForInput(dates[0]);
    document.getElementById("date-fin").value = formatDateForInput(dates[1]);
    
    // Statut
    document.getElementById("statut").value = row.cells[2].getAttribute('data-statut');
    
    // Filières
    resetFilieres();
    const filieres = JSON.parse(row.getAttribute('data-filieres'));
    filieres.forEach(f => {
      const checkbox = document.querySelector(`input[value="${f}"]`);
      if (checkbox) checkbox.checked = true;
    });
    
    // Passer en mode édition
    enModeEdition = true;
    currentEditId = row.getAttribute('data-id');
    submitBtn.textContent = "Mettre à jour";
    cancelBtn.style.display = "block";
    
    // Scroll vers le formulaire
    form.scrollIntoView({ behavior: 'smooth' });
  }

  // Formater la date pour l'input date (AAAA-MM-JJ)
  function formatDateForInput(dateString) {
    const [day, month, year] = dateString.split('/');
    return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`;
  }

  // Annuler la modification
  function annulerModification() {
    form.reset();
    resetFilieres();
    enModeEdition = false;
    currentEditId = null;
    submitBtn.textContent = "Enregistrer";
    cancelBtn.style.display = "none";
  }

  // Supprimer une année
  function supprimerAnnee(bouton) {
    if (confirm("Êtes-vous sûr de vouloir supprimer cette année académique ?")) {
      const row = bouton.closest("tr");
      row.remove();
      
      if (enModeEdition && row.getAttribute('data-id') === currentEditId) {
        annulerModification();
      }
    }
  }
</script>

</body>
</html>