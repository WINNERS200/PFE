<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Gestion des Comptes - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .badge-status {
      font-size: 0.85em;
      padding: 0.35em 0.65em;
    }
    .action-btn {
      min-width: 80px;
    }
  </style>
</head>
<body class="bg-light">

<div class="container mt-5">
  <h2 class="text-center mb-4">👨‍💻 Gestion des comptes</h2>

  <div class="card shadow-sm p-4 mb-4">
    <form id="form-compte">
      <input type="hidden" id="edit-id">
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="nom" class="form-label">Nom complet</label>
          <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom et prénom" required>
        </div>

        <div class="col-md-6">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="exemple@domain.com" required>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-md-6">
          <label for="role" class="form-label">Rôle</label>
          <select class="form-select" id="role" name="role" required>
            <option value="" selected disabled>Choisir un rôle</option>
            <option value="admin">Administrateur</option>
            <option value="formateur">Formateur</option>
            <option value="etudiant">Étudiant</option>
          </select>
        </div>

        <div class="col-md-6">
          <label for="filiere" class="form-label">Filière (si étudiant)</label>
          <select class="form-select" id="filiere" name="filiere">
            <option value="">Non applicable</option>
            
            <!-- Options de Licence -->
            <optgroup label="Licence Informatique">
              <option value="Administration Avancée des Systèmes et Réseaux Informatiques - Pr. Mohammed ERRAIS">
                Administration Avancée des Systèmes et Réseaux Informatiques - Pr. Mohammed ERRAIS
              </option>
              <option value="Administration, Systèmes, Bases de Données et Réseaux - Pr. Khalid MOUSSAID">
                Administration, Systèmes, Bases de Données et Réseaux - Pr. Khalid MOUSSAID
              </option>
              <option value="Développement Informatique - Pr. Brahim RAOUYANE">
                Développement Informatique - Pr. Brahim RAOUYANE
              </option>
              <option value="Développement Web et Mobile - Pr. Mohamed RIDA">
                Développement Web et Mobile - Pr. Mohamed RIDA
              </option>
              <option value="Développement Full Stack et Devops - Pr. Noureddine ABGHOUR">
                Développement Full Stack et Devops - Pr. Noureddine ABGHOUR
              </option>
              <option value="Ingénierie Réseaux et Cloud Computing - Pr. Rim KOULALI">
                Ingénierie Réseaux et Cloud Computing - Pr. Rim KOULALI
              </option>
            </optgroup>
            
            <!-- Options de Master -->
            <optgroup label="Master Informatique">
              <option value="Big Data et Cloud Computing - Pr. Amina ELOMRI">
                Big Data et Cloud Computing - Pr. Amina ELOMRI
              </option>
              <option value="Business Intelligence et Sciences de Données - Pr. Tarik NAHHAL">
                Business Intelligence et Sciences de Données - Pr. Tarik NAHHAL
              </option>
              <option value="Management des Systèmes d'Information - Pr. Mounia MIYARA">
                Management des Systèmes d'Information - Pr. Mounia MIYARA
              </option>
              <option value="Cybersécurité et Cyberdéfense - Pr. Laila FETJAH">
                Cybersécurité et Cyberdéfense - Pr. Laila FETJAH
              </option>
            </optgroup>
          </select>
        </div>
      </div>

      <!-- Section Gestion des Accès -->
      <div class="card mb-3" id="access-section" style="display: none;">
        <div class="card-header bg-light">
          <h6 class="mb-0">Gestion des accès</h6>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="acces-planning">
                <label class="form-check-label" for="acces-planning">Accès planning</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="acces-notes">
                <label class="form-check-label" for="acces-notes">Gestion des notes</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="acces-financier">
                <label class="form-check-label" for="acces-financier">Accès financier</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="acces-admin">
                <label class="form-check-label" for="acces-admin">Accès admin</label>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="actif" checked>
        <label class="form-check-label" for="actif">Compte actif</label>
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-primary" id="submit-btn">Enregistrer</button>
        <button type="button" class="btn btn-secondary mt-2" id="cancel-btn" style="display:none;" onclick="annulerModification()">Annuler</button>
      </div>
    </form>
  </div>

  <div class="mt-4">
    <h5>📋 Liste des comptes</h5>
    <div class="input-group mb-3">
      <input type="text" class="form-control" placeholder="Rechercher un compte...">
      <button class="btn btn-outline-secondary" type="button">Filtrer</button>
    </div>
    
    <table class="table table-bordered table-hover mt-3 bg-white">
      <thead class="table-light">
        <tr>
          <th>Nom</th>
          <th>Email</th>
          <th>Rôle</th>
          <th>Filière</th>
          <th>Statut</th>
          <th>Accès</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="comptes-table-body">
        <tr data-id="1" data-role="admin" data-acces='{"planning":true,"notes":true,"financier":true,"admin":true}'>
          <td>Admin Dupont</td>
          <td>admin@ecole.fr</td>
          <td><span class="badge bg-danger">Admin</span></td>
          <td>-</td>
          <td><span class="badge bg-success badge-status">Actif</span></td>
          <td>Planning, Notes, Financier, Admin</td>
          <td>
            <button class="btn btn-sm btn-warning me-1 action-btn" onclick="modifierCompte(this)">Modifier</button>
            <button class="btn btn-sm btn-danger action-btn" onclick="supprimerCompte(this)">Supprimer</button>
          </td>
        </tr>
        <tr data-id="2" data-role="formateur" data-acces='{"planning":true,"notes":true,"financier":false,"admin":false}'>
          <td>Sophie Martin</td>
          <td>s.martin@ecole.fr</td>
          <td><span class="badge bg-warning text-dark">Formateur</span></td>
          <td>-</td>
          <td><span class="badge bg-success badge-status">Actif</span></td>
          <td>Planning, Notes</td>
          <td>
            <button class="btn btn-sm btn-warning me-1 action-btn" onclick="modifierCompte(this)">Modifier</button>
            <button class="btn btn-sm btn-danger action-btn" onclick="supprimerCompte(this)">Supprimer</button>
          </td>
        </tr>
        <tr data-id="3" data-role="etudiant" data-acces='{"planning":false,"notes":false,"financier":false,"admin":false}'>
          <td>Jean Dupont</td>
          <td>j.dupont@etudiant.fr</td>
          <td><span class="badge bg-primary">Étudiant</span></td>
          <td>Licence Info</td>
          <td><span class="badge bg-secondary badge-status">Inactif</span></td>
          <td>Aucun</td>
          <td>
            <button class="btn btn-sm btn-warning me-1 action-btn" onclick="modifierCompte(this)">Modifier</button>
            <button class="btn btn-sm btn-danger action-btn" onclick="supprimerCompte(this)">Supprimer</button>
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
  const form = document.getElementById("form-compte");
  const tableBody = document.getElementById("comptes-table-body");
  const submitBtn = document.getElementById("submit-btn");
  const cancelBtn = document.getElementById("cancel-btn");
  const accessSection = document.getElementById("access-section");

  // Afficher/masquer la section des accès selon le rôle
  document.getElementById("role").addEventListener("change", function() {
    const role = this.value;
    if (role === "admin" || role === "formateur") {
      accessSection.style.display = "block";
    } else {
      accessSection.style.display = "none";
    }
  });

  // Soumission du formulaire
  form.addEventListener("submit", function(e) {
    e.preventDefault();

    // Récupération des valeurs
    const nom = document.getElementById("nom").value;
    const email = document.getElementById("email").value;
    const role = document.getElementById("role").value;
    const roleText = document.getElementById("role").options[document.getElementById("role").selectedIndex].text;
    const filiere = document.getElementById("filiere").value;
    const actif = document.getElementById("actif").checked;
    
    // Récupération des accès
    const acces = {
      planning: role === "admin" ? true : document.getElementById("acces-planning").checked,
      notes: role === "admin" ? true : document.getElementById("acces-notes").checked,
      financier: role === "admin" ? true : document.getElementById("acces-financier").checked,
      admin: role === "admin" ? true : document.getElementById("acces-admin").checked
    };
    
    // Formatage des accès pour l'affichage
    const accesText = getAccessText(acces, role);

    if (enModeEdition) {
      // Mettre à jour la ligne existante
      const row = document.querySelector(`tr[data-id="${currentEditId}"]`);
      row.cells[0].textContent = nom;
      row.cells[1].textContent = email;
      row.cells[2].innerHTML = `<span class="badge ${getBadgeClass(role)}">${getRoleName(role)}</span>`;
      row.cells[3].textContent = role === 'etudiant' ? filiere : '-';
      row.cells[4].innerHTML = `<span class="badge ${actif ? 'bg-success' : 'bg-secondary'} badge-status">${actif ? 'Actif' : 'Inactif'}</span>`;
      row.cells[5].textContent = accesText;
      
      // Mettre à jour les data-attributs
      row.setAttribute('data-role', role);
      row.setAttribute('data-acces', JSON.stringify(acces));
      
      annulerModification();
    } else {
      // Ajouter une nouvelle ligne
      const newId = Date.now();
      const nouvelleLigne = document.createElement("tr");
      nouvelleLigne.setAttribute('data-id', newId);
      nouvelleLigne.setAttribute('data-role', role);
      nouvelleLigne.setAttribute('data-acces', JSON.stringify(acces));
      nouvelleLigne.innerHTML = `
        <td>${nom}</td>
        <td>${email}</td>
        <td><span class="badge ${getBadgeClass(role)}">${getRoleName(role)}</span></td>
        <td>${role === 'etudiant' ? filiere : '-'}</td>
        <td><span class="badge ${actif ? 'bg-success' : 'bg-secondary'} badge-status">${actif ? 'Actif' : 'Inactif'}</span></td>
        <td>${accesText}</td>
        <td>
          <button class="btn btn-sm btn-warning me-1 action-btn" onclick="modifierCompte(this)">Modifier</button>
          <button class="btn btn-sm btn-danger action-btn" onclick="supprimerCompte(this)">Supprimer</button>
        </td>
      `;
      tableBody.appendChild(nouvelleLigne);
      form.reset();
      accessSection.style.display = "none";
    }
  });

  // Modifier un compte
  function modifierCompte(bouton) {
    const row = bouton.closest("tr");
    const cells = row.cells;
    const acces = JSON.parse(row.getAttribute('data-acces'));
    
    // Remplir le formulaire
    document.getElementById("edit-id").value = row.getAttribute('data-id');
    document.getElementById("nom").value = cells[0].textContent;
    document.getElementById("email").value = cells[1].textContent;
    document.getElementById("role").value = row.getAttribute('data-role');
    document.getElementById("filiere").value = cells[3].textContent === '-' ? '' : cells[3].textContent;
    document.getElementById("actif").checked = cells[4].textContent.includes("Actif");
    
    // Remplir les accès
    if (row.getAttribute('data-role') === "admin" || row.getAttribute('data-role') === "formateur") {
      accessSection.style.display = "block";
      document.getElementById("acces-planning").checked = acces.planning;
      document.getElementById("acces-notes").checked = acces.notes;
      document.getElementById("acces-financier").checked = acces.financier;
      document.getElementById("acces-admin").checked = acces.admin;
    } else {
      accessSection.style.display = "none";
    }
    
    // Passer en mode édition
    enModeEdition = true;
    currentEditId = row.getAttribute('data-id');
    submitBtn.textContent = "Mettre à jour";
    cancelBtn.style.display = "block";
    
    // Scroll vers le formulaire
    form.scrollIntoView({ behavior: 'smooth' });
  }

  // Annuler la modification
  function annulerModification() {
    form.reset();
    enModeEdition = false;
    currentEditId = null;
    submitBtn.textContent = "Enregistrer";
    cancelBtn.style.display = "none";
    accessSection.style.display = "none";
  }

  // Supprimer un compte
  function supprimerCompte(bouton) {
    if (confirm("Êtes-vous sûr de vouloir supprimer ce compte ?")) {
      const row = bouton.closest("tr");
      row.remove();
      
      if (enModeEdition && row.getAttribute('data-id') === currentEditId) {
        annulerModification();
      }
    }
  }

  // Helper functions
  function getBadgeClass(role) {
    switch(role) {
      case 'admin': return 'bg-danger';
      case 'formateur': return 'bg-warning text-dark';
      case 'etudiant': return 'bg-primary';
      default: return 'bg-secondary';
    }
  }

  function getRoleName(role) {
    switch(role) {
      case 'admin': return 'Admin';
      case 'formateur': return 'Formateur';
      case 'etudiant': return 'Étudiant';
      default: return role;
    }
  }

  function getAccessText(acces, role) {
    if (role === "etudiant") return "Aucun";
    
    const permissions = [];
    if (acces.planning) permissions.push("Planning");
    if (acces.notes) permissions.push("Notes");
    if (acces.financier) permissions.push("Financier");
    if (acces.admin) permissions.push("Admin");
    
    return permissions.length > 0 ? permissions.join(", ") : "Aucun";
  }
</script>

</body>
</html>