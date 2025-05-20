<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Envoi d'Annonces</title>
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
    .recipient-badge {
      font-size: 0.85em;
      margin-right: 5px;
      margin-bottom: 5px;
    }
    #message {
      min-height: 150px;
    }
    .specialization-badge {
      background-color: #6f42c1;
      color: white;
    }
    .formateur-info {
      font-weight: 500;
      color: #0d6efd;
    }
    .recipient-group {
      border-left: 3px solid #0d6efd;
      padding-left: 10px;
      margin-bottom: 15px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2 class="my-4">📢 Cibler des annonces</h2>
    
    <!-- Formulaire d'envoi -->
    <div class="card">
      <div class="card-header bg-primary text-white">
        Nouvelle annonce
      </div>
      <div class="card-body">
        <form id="annonce-form">
          <!-- Destinataires -->
          <div class="mb-3">
            <label class="form-label">Destinataires</label>
            
            <div class="mb-2">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="all-students" checked>
                <label class="form-check-label" for="all-students">Tous les étudiants</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="all-trainers">
                <label class="form-check-label" for="all-trainers">Tous les formateurs</label>
              </div>
            </div>
            
            <div id="specific-recipients" class="d-none">
              <div class="recipient-group">
                <h6>Par Niveau</h6>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="licence-students">
                  <label class="form-check-label" for="licence-students">Tous les étudiants en Licence</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="master-students">
                  <label class="form-check-label" for="master-students">Tous les étudiants en Master</label>
                </div>
              </div>
              
              <div class="recipient-group">
                <h6>Par Spécialisation</h6>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="spec-aasri">
                  <label class="form-check-label" for="spec-aasri"><span class="badge specialization-badge">Admin. Systèmes & Réseaux</span> (Pr. Mohammed ERRAIS)</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="spec-asbdr">
                  <label class="form-check-label" for="spec-asbdr"><span class="badge specialization-badge">Admin. Systèmes, BD & Réseaux</span> (Pr. Khalid MOUSSAID)</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="spec-dwm">
                  <label class="form-check-label" for="spec-dwm"><span class="badge specialization-badge">Développement Web & Mobile</span> (Pr. Mohamed RIDA)</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="spec-bdc">
                  <label class="form-check-label" for="spec-bdc"><span class="badge specialization-badge">Big Data & Cloud</span> (Pr. Amina ELOMRI)</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="spec-cc">
                  <label class="form-check-label" for="spec-cc"><span class="badge specialization-badge">Cybersécurité</span> (Pr. Laila FETJAH)</label>
                </div>
              </div>
              
              <div class="recipient-group">
                <h6>Formateurs Spécifiques</h6>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="formateur1">
                  <label class="form-check-label" for="formateur1"><span class="formateur-info">Pr. Brahim RAOUYANE</span> (Développement Informatique)</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="formateur2">
                  <label class="form-check-label" for="formateur2"><span class="formateur-info">Pr. Noureddine ABGHOUR</span> (Full Stack & DevOps)</label>
                </div>
              </div>
            </div>
            
            <button type="button" class="btn btn-sm btn-outline-secondary mt-2" onclick="toggleSpecificRecipients()">
              Sélection avancée
            </button>
          </div>
          
          <!-- Objet et message -->
          <div class="mb-3">
            <label for="subject" class="form-label">Objet</label>
            <input type="text" class="form-control" id="subject" placeholder="Objet du message" required>
          </div>
          
          <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" id="message" required></textarea>
          </div>
          
          <!-- Pièce jointe -->
          <div class="mb-3">
            <label for="attachment" class="form-label">Pièce jointe (optionnel)</label>
            <input type="file" class="form-control" id="attachment">
          </div>
          
          <button type="submit" class="btn btn-primary">Envoyer l'annonce</button>
        </form>
      </div>
    </div>
    
    <!-- Historique -->
    <div class="card">
      <div class="card-header bg-success text-white">
        Historique des annonces
      </div>
      <div class="card-body">
        <div class="list-group">
          <div class="list-group-item">
            <div class="d-flex w-100 justify-content-between">
              <h6 class="mb-1">Maintenance des labos de cybersécurité</h6>
              <small>18/05/2025</small>
            </div>
            <p class="mb-1">Les laboratoires de cybersécurité seront indisponibles le 20/05 pour maintenance.</p>
            <small>Envoyé à: <span class="badge specialization-badge">Cybersécurité</span> (Pr. Laila FETJAH)</small>
          </div>
          
          <div class="list-group-item">
            <div class="d-flex w-100 justify-content-between">
              <h6 class="mb-1">Atelier DevOps avancé</h6>
              <small>15/05/2025</small>
            </div>
            <p class="mb-1">Atelier pratique sur les pipelines CI/CD le 22/05 à 14h.</p>
            <small>Envoyé à: <span class="badge specialization-badge">Full Stack & DevOps</span> (Pr. Noureddine ABGHOUR)</small>
          </div>
          
          <div class="list-group-item">
            <div class="d-flex w-100 justify-content-between">
              <h6 class="mb-1">Réunion des formateurs</h6>
              <small>12/05/2025</small>
            </div>
            <p class="mb-1">Réunion pédagogique le 18/05 à 10h en salle des professeurs.</p>
            <small>Envoyé à: Tous les formateurs</small>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Basculer entre tous/sélection spécifique
    function toggleSpecificRecipients() {
      const specificDiv = document.getElementById('specific-recipients');
      const allStudents = document.getElementById('all-students');
      const allTrainers = document.getElementById('all-trainers');
      
      specificDiv.classList.toggle('d-none');
      
      if (!specificDiv.classList.contains('d-none')) {
        allStudents.checked = false;
        allTrainers.checked = false;
      }
    }
    
    // Gestion du formulaire
    document.getElementById('annonce-form').addEventListener('submit', function(e) {
      e.preventDefault();
      
      // Récupérer les valeurs du formulaire
      const subject = document.getElementById('subject').value;
      const message = document.getElementById('message').value;
      const allStudents = document.getElementById('all-students').checked;
      const allTrainers = document.getElementById('all-trainers').checked;
      
      // Déterminer les destinataires
      let recipients = [];
      
      if (allStudents) {
        recipients.push("Tous les étudiants");
      } 
      else if (allTrainers) {
        recipients.push("Tous les formateurs");
      }
      else {
        // Vérifier les sélections par niveau
        if (document.getElementById('licence-students').checked) {
          recipients.push("Étudiants en Licence");
        }
        if (document.getElementById('master-students').checked) {
          recipients.push("Étudiants en Master");
        }
        
        // Vérifier les sélections par spécialisation
        const specializations = [
          { id: 'spec-aasri', name: 'Admin. Systèmes & Réseaux', formateur: 'Pr. Mohammed ERRAIS' },
          { id: 'spec-asbdr', name: 'Admin. Systèmes, BD & Réseaux', formateur: 'Pr. Khalid MOUSSAID' },
          { id: 'spec-dwm', name: 'Développement Web & Mobile', formateur: 'Pr. Mohamed RIDA' },
          { id: 'spec-bdc', name: 'Big Data & Cloud', formateur: 'Pr. Amina ELOMRI' },
          { id: 'spec-cc', name: 'Cybersécurité', formateur: 'Pr. Laila FETJAH' }
        ];
        
        specializations.forEach(spec => {
          if (document.getElementById(spec.id).checked) {
            recipients.push(`${spec.name} (${spec.formateur})`);
          }
        });
        
        // Vérifier les formateurs spécifiques
        if (document.getElementById('formateur1').checked) {
          recipients.push("Pr. Brahim RAOUYANE");
        }
        if (document.getElementById('formateur2').checked) {
          recipients.push("Pr. Noureddine ABGHOUR");
        }
      }
      
      // Créer la nouvelle entrée dans l'historique
      const newItem = document.createElement('div');
      newItem.className = 'list-group-item';
      
      // Formater les destinataires avec badges si nécessaire
      const formattedRecipients = recipients.map(r => {
        if (r.includes('Admin.') || r.includes('Big Data') || r.includes('Cybersécurité') || r.includes('Développement')) {
          const parts = r.split(' (');
          return `<span class="badge specialization-badge">${parts[0]}</span> (${parts[1]}`;
        }
        if (r.includes('Pr.')) {
          return `<span class="formateur-info">${r}</span>`;
        }
        return r;
      }).join(', ');
      
      newItem.innerHTML = `
        <div class="d-flex w-100 justify-content-between">
          <h6 class="mb-1">${subject}</h6>
          <small>${new Date().toLocaleDateString('fr-FR')}</small>
        </div>
        <p class="mb-1">${message}</p>
        <small>Envoyé à: ${formattedRecipients}</small>
      `;
      
      // Ajouter en haut de l'historique
      const historyList = document.querySelector('.list-group');
      historyList.insertBefore(newItem, historyList.firstChild);
      
      // Réinitialiser le formulaire
      this.reset();
      document.getElementById('all-students').checked = true;
      document.getElementById('specific-recipients').classList.add('d-none');
      
      // Message de confirmation
      alert('Annonce envoyée avec succès !');
    });
  </script>
</body>
</html>