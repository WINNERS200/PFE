<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Gestion des Filières</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <h2 class="text-center mb-4">🎓 Gestion des filières</h2>

  <div class="card shadow-sm p-4 mb-4">
    <form id="form-filiere">
      <input type="hidden" id="edit-id">
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="code" class="form-label">Code filière</label>
          <input type="text" class="form-control" id="code" name="code" placeholder="Ex: INFO" required>
        </div>

        <div class="col-md-6">
          <label for="nom" class="form-label">Nom complet</label>
          <input type="text" class="form-control" id="nom" name="nom" placeholder="Ex: Licence Informatique" required>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-md-6">
          <label for="niveau" class="form-label">Niveau</label>
          <select class="form-select" id="niveau" name="niveau" required>
            <option value="" selected disabled>Choisir un niveau</option>
            <option value="Licence">Licence</option>
            <option value="Master">Master</option>
          </select>
        </div>

        <div class="col-md-6">
          <label for="duree" class="form-label">Durée (années)</label>
          <input type="number" class="form-control" id="duree" name="duree" min="1" max="5" value="3" required>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-md-6">
          <label for="responsable" class="form-label">Responsable</label>
          <select class="form-select" id="responsable" name="responsable" required>
            <option selected disabled value="">Choisir un responsable</option>
            
            <!-- Options pour les responsables de Licence -->
            <optgroup label="Licence">
              <option value="Pr. Mohammed ERRAIS">Pr. Mohammed ERRAIS - Administration Avancée des Systèmes et Réseaux Informatiques</option>
              <option value="Pr. Khalid MOUSSAID">Pr. Khalid MOUSSAID - Administration, Systèmes, Bases de Données et Réseaux</option>
              <option value="Pr. Brahim RAOUYANE">Pr. Brahim RAOUYANE - Développement Informatique</option>
              <option value="Pr. Mohamed RIDA">Pr. Mohamed RIDA - Développement Web et Mobile</option>
              <option value="Pr. Noureddine ABGHOUR">Pr. Noureddine ABGHOUR - Développement Full Stack et Devops</option>
              <option value="Pr. Rim KOULALI">Pr. Rim KOULALI - Ingénierie Réseaux et Cloud Computing</option>
            </optgroup>
            
            <!-- Options pour les responsables de Master -->
            <optgroup label="Master">
              <option value="Pr. Amina ELOMRI">Pr. Amina ELOMRI - Big Data et Cloud Computing</option>
              <option value="Pr. Tarik NAHHAL">Pr. Tarik NAHHAL - Business Intelligence et Sciences de Données</option>
              <option value="Pr. Mounia MIYARA">Pr. Mounia MIYARA - Management des Systèmes d'Information</option>
              <option value="Pr. Laila FETJAH">Pr. Laila FETJAH - Cybersécurité et Cyberdéfense</option>
            </optgroup>
          </select>
        </div>

        <div class="col-md-6">
          <label for="specialite" class="form-label">Spécialité</label>
          <select class="form-select" id="specialite" name="specialite" required>
            <option value="" selected disabled>Choisir une spécialité</option>
            
            <!-- Options pour les spécialités de Licence -->
            <optgroup label="Licence Informatique">
              <option value="Administration Avancée des Systèmes et Réseaux Informatiques">Administration Avancée des Systèmes et Réseaux Informatiques</option>
              <option value="Administration, Systèmes, Bases de Données et Réseaux">Administration, Systèmes, Bases de Données et Réseaux</option>
              <option value="Développement Informatique">Développement Informatique</option>
              <option value="Développement Web et Mobile">Développement Web et Mobile</option>
              <option value="Développement Full Stack et Devops">Développement Full Stack et Devops</option>
              <option value="Ingénierie Réseaux et Cloud Computing">Ingénierie Réseaux et Cloud Computing</option>
            </optgroup>
            
            <!-- Options pour les spécialités de Master -->
            <optgroup label="Master Informatique">
              <option value="Big Data et Cloud Computing">Big Data et Cloud Computing</option>
              <option value="Business Intelligence et Sciences de Données">Business Intelligence et Sciences de Données</option>
              <option value="Management des Systèmes d'Information">Management des Systèmes d'Information</option>
              <option value="Cybersécurité et Cyberdéfense">Cybersécurité et Cyberdéfense</option>
            </optgroup>
          </select>
        </div>
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="2"></textarea>
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-primary" id="submit-btn">Enregistrer la filière</button>
        <button type="button" class="btn btn-secondary mt-2" id="cancel-btn" style="display:none;" onclick="annulerModification()">Annuler</button>
      </div>
    </form>
  </div>

  <div class="mt-4">
    <h5>📋 Liste des filières</h5>
    <div class="input-group mb-3">
      <input type="text" class="form-control" placeholder="Rechercher une filière...">
      <button class="btn btn-outline-secondary" type="button">Filtrer</button>
    </div>
    
    <table class="table table-bordered table-hover mt-3 bg-white">
      <thead class="table-light">
        <tr>
          <th>Code</th>
          <th>Nom</th>
          <th>Niveau</th>
          <th>Spécialité</th>
          <th>Responsable</th>
          <th>Durée</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="filieres-table-body">
        <tr data-id="1">
          <td>INFO-L</td>
          <td>Licence Informatique</td>
          <td>Licence</td>
          <td>Développement Informatique</td>
          <td data-responsable="Pr. Brahim RAOUYANE">Pr. Brahim RAOUYANE</td>
          <td data-duree="3">3 ans</td>
          <td>
            <button class="btn btn-sm btn-warning me-1" onclick="modifierFiliere(this)">Modifier</button>
            <button class="btn btn-sm btn-danger" onclick="supprimerFiliere(this)">Supprimer</button>
          </td>
        </tr>
        <tr data-id="2">
          <td>INFO-M</td>
          <td>Master Informatique</td>
          <td>Master</td>
          <td>Big Data et Cloud Computing</td>
          <td data-responsable="Pr. Amina ELOMRI">Pr. Amina ELOMRI</td>
          <td data-duree="2">2 ans</td>
          <td>
            <button class="btn btn-sm btn-warning me-1" onclick="modifierFiliere(this)">Modifier</button>
            <button class="btn btn-sm btn-danger" onclick="supprimerFiliere(this)">Supprimer</button>
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
  const form = document.getElementById("form-filiere");
  const tableBody = document.getElementById("filieres-table-body");
  const submitBtn = document.getElementById("submit-btn");
  const cancelBtn = document.getElementById("cancel-btn");

  // Soumission du formulaire (ajout ou modification)
  form.addEventListener("submit", function (e) {
    e.preventDefault();

    const code = document.getElementById("code").value;
    const nom = document.getElementById("nom").value;
    const niveau = document.getElementById("niveau").value;
    const responsable = document.getElementById("responsable").value;
    const specialite = document.getElementById("specialite").value;
    const duree = document.getElementById("duree").value;
    const description = document.getElementById("description").value;

    if (enModeEdition) {
      // Mettre à jour la ligne existante
      const row = document.querySelector(`tr[data-id="${currentEditId}"]`);
      row.cells[0].textContent = code;
      row.cells[1].textContent = nom;
      row.cells[2].textContent = niveau;
      row.cells[3].textContent = specialite;
      row.cells[4].textContent = responsable;
      row.cells[4].setAttribute('data-responsable', responsable);
      row.cells[5].textContent = duree + " ans";
      row.cells[5].setAttribute('data-duree', duree);
      
      annulerModification();
    } else {
      // Ajouter une nouvelle ligne
      const newId = Date.now(); // ID temporaire
      const nouvelleLigne = document.createElement("tr");
      nouvelleLigne.setAttribute('data-id', newId);
      nouvelleLigne.innerHTML = `
        <td>${code}</td>
        <td>${nom}</td>
        <td>${niveau}</td>
        <td>${specialite}</td>
        <td data-responsable="${responsable}">${responsable}</td>
        <td data-duree="${duree}">${duree} ans</td>
        <td>
          <button class="btn btn-sm btn-warning me-1" onclick="modifierFiliere(this)">Modifier</button>
          <button class="btn btn-sm btn-danger" onclick="supprimerFiliere(this)">Supprimer</button>
        </td>
      `;
      tableBody.appendChild(nouvelleLigne);
      form.reset();
    }
  });

  // Modifier une filière
  function modifierFiliere(bouton) {
    const row = bouton.closest("tr");
    const cells = row.cells;
    
    // Remplir le formulaire
    document.getElementById("edit-id").value = row.getAttribute('data-id');
    document.getElementById("code").value = cells[0].textContent;
    document.getElementById("nom").value = cells[1].textContent;
    document.getElementById("niveau").value = cells[2].textContent;
    document.getElementById("responsable").value = cells[4].getAttribute('data-responsable');
    document.getElementById("specialite").value = cells[3].textContent;
    document.getElementById("duree").value = cells[5].getAttribute('data-duree');
    
    // Passer en mode édition
    enModeEdition = true;
    currentEditId = row.getAttribute('data-id');
    submitBtn.textContent = "Mettre à jour";
    cancelBtn.style.display = "block";
    
    // Scroll vers le formulaire
    document.getElementById("form-filiere").scrollIntoView({ behavior: 'smooth' });
  }

  // Annuler la modification
  function annulerModification() {
    form.reset();
    enModeEdition = false;
    currentEditId = null;
    submitBtn.textContent = "Enregistrer la filière";
    cancelBtn.style.display = "none";
  }

  // Supprimer une filière
  function supprimerFiliere(bouton) {
    if (confirm("Êtes-vous sûr de vouloir supprimer cette filière ?")) {
      const row = bouton.closest("tr");
      row.remove();
      
      // Si on supprimait une filière en cours d'édition
      if (enModeEdition && row.getAttribute('data-id') === currentEditId) {
        annulerModification();
      }
    }
  }

  // Synchronisation entre niveau et options disponibles
  document.getElementById('niveau').addEventListener('change', function() {
    const niveau = this.value;
    const responsableSelect = document.getElementById('responsable');
    const specialiteSelect = document.getElementById('specialite');
    
    // Activer/désactiver les options en fonction du niveau
    for (let optgroup of responsableSelect.querySelectorAll('optgroup')) {
      optgroup.disabled = (optgroup.label !== niveau && optgroup.label !== 'Licence' && optgroup.label !== 'Master');
    }
    
    for (let optgroup of specialiteSelect.querySelectorAll('optgroup')) {
      optgroup.disabled = (optgroup.label !== niveau + ' Informatique');
    }
  });
</script>

</body>
</html>