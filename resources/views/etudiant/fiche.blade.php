<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>📄 Génération de Fiche Administrative</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card-header h2 {
            font-weight: 500;
        }
        fieldset {
            border: 1px solid #dee2e6;
            padding: 1.5rem;
            border-radius: 0.375rem;
        }
        legend {
            float: none;
            width: auto;
            padding: 0 0.5rem;
            font-size: 1.1rem;
            font-weight: 500;
            color: #0d6efd;
        }
        .form-label i {
            margin-right: 0.35rem;
        }
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                -webkit-print-color-adjust: exact !important;
                color-adjust: exact !important;
                background-color: #fff !important;
            }
        }
    </style>
</head>
<body>

<div class="container mt-5 mb-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center py-3">
            <h2 class="mb-0"><i class="bi bi-file-earmark-text-fill me-2"></i>Fiche Administrative</h2>
        </div>
        <div class="card-body p-4 p-md-5">
            <p class="text-center text-muted mb-4">
                Veuillez remplir les informations ci-dessous pour générer le document souhaité.
            </p>

            <form id="administrativeForm">
                <fieldset class="mb-4">
                    <legend class="h6">Informations Personnelles</legend>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nom" class="form-label"><i class="bi bi-person"></i>Nom <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nom" name="nom" placeholder="Votre nom de famille" required>
                            <div class="invalid-feedback">Veuillez saisir votre nom.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="prenom" class="form-label"><i class="bi bi-person"></i>Prénom <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Votre prénom" required>
                            <div class="invalid-feedback">Veuillez saisir votre prénom.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="cne" class="form-label"><i class="bi bi-person-vcard"></i>CNE <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="cne" name="cne" placeholder="Ex: G123456789" required>
                            <div class="invalid-feedback">Veuillez saisir votre CNE.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="cin" class="form-label"><i class="bi bi-person-badge"></i>CIN <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="cin" name="cin" placeholder="Ex: AB123456" required>
                            <div class="invalid-feedback">Veuillez saisir votre CIN.</div>
                        </div>
                        <div class="col-md-12">
                            <label for="date_naissance" class="form-label"><i class="bi bi-calendar-event"></i>Date de naissance <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="date_naissance" name="date_naissance" required>
                            <div class="invalid-feedback">Veuillez sélectionner votre date de naissance.</div>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="mb-4">
                    <legend class="h6">Document à Générer</legend>
                    <div>
                        <label for="type_document" class="form-label"><i class="bi bi-file-earmark-ruled"></i>Type de document <span class="text-danger">*</span></label>
                        <select class="form-select form-select-lg" id="type_document" name="type_document" required>
                            <option value="" selected disabled>Choisir un type de document...</option>
                            <option value="fiche_identite">Fiche d'identité</option>
                            <option value="certificat_scolarite">Certificat de scolarité</option>
                            <option value="attestation_inscription">Attestation d'inscription</option>
                        </select>
                        <div class="invalid-feedback">Veuillez sélectionner un type de document.</div>
                    </div>
                </fieldset>

                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="bi bi-file-earmark-arrow-down-fill me-2"></i>Générer le document
                    </button>
                </div>
            </form>
        </div>
        <div class="card-footer text-center text-muted small py-3">
            Assurez-vous que toutes les informations sont correctes avant de générer le document.
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function formatDate(dateString) {
        if (!dateString) return 'N/A';
        const [year, month, day] = dateString.split('-');
        return `${day}/${month}/${year}`;
    }

    function getAnneeAcademique() {
        const today = new Date();
        const currentYear = today.getFullYear();
        const startYear = today.getMonth() < 8 ? currentYear - 1 : currentYear;
        return `${startYear}/${startYear + 1}`;
    }

    function generateDocumentHTML(data) {
        const nomComplet = `${data.prenom} ${data.nom}`;
        const dateNaissanceFormattee = formatDate(data.date_naissance);
        const anneeAcademique = getAnneeAcademique();
        const dateGeneration = new Date().toLocaleDateString('fr-FR', { day: '2-digit', month: 'long', year: 'numeric' });
        const nomFaculte = "FACULTE DES SCIENCES AIN CHOCK";
        const universite = "UNIVERSITE HASSAN II DE CASABLANCA";
        const ville = "Casablanca";
        const logoUrl = "{{ asset('images/télécharger.png') }}"; // Remplacez par le vrai logo

        let documentTitle = "";
        let documentBodyContent = "";

        switch (data.type_document) {
            case 'fiche_identite':
                documentTitle = "FICHE D'IDENTITÉ ÉTUDIANT";
                documentBodyContent = `
                    <table class="table table-bordered">
                        <tbody>
                            <tr><th scope="row" style="width: 30%;">Nom Complet</th><td>${nomComplet}</td></tr>
                            <tr><th scope="row">Date de Naissance</th><td>${dateNaissanceFormattee}</td></tr>
                            <tr><th scope="row">CNE</th><td>${data.cne}</td></tr>
                            <tr><th scope="row">CIN</th><td>${data.cin}</td></tr>
                            <tr><th scope="row">Année Académique</th><td>${anneeAcademique}</td></tr>
                            <tr><th scope="row">Établissement</th><td>${nomFaculte}<br>${universite}</td></tr>
                        </tbody>
                    </table>
                `;
                break;
            case 'certificat_scolarite':
                documentTitle = "CERTIFICAT DE SCOLARITÉ";
                documentBodyContent = `
                    <p>Le Doyen de la ${nomFaculte} de l'${universite},</p>
                    <p class="mt-3">Certifie que l'étudiant(e) :</p>
                    <p class="text-center fw-bold">${nomComplet}</p>
                    <p>Né(e) le : ${dateNaissanceFormattee}</p>
                    <p>CNE : ${data.cne}</p>
                    <p>CIN : ${data.cin}</p>
                    <p class="mt-3">est régulièrement inscrit(e) à la ${nomFaculte} pour l'année universitaire ${anneeAcademique}.</p>
                    <p>Le présent certificat est délivré à l'intéressé(e) pour servir et valoir ce que de droit.</p>
                `;
                break;
            case 'attestation_inscription':
                documentTitle = "ATTESTATION D'INSCRIPTION";
                documentBodyContent = `
                    <p>Nous attestons par la présente que l'étudiant(e) :</p>
                    <p class="fs-5 text-center my-3 fw-bold">${nomComplet}</p>
                    <p>Né(e) le : ${dateNaissanceFormattee}</p>
                    <p>CNE : ${data.cne}</p>
                    <p>CIN : ${data.cin}</p>
                    <p class="mt-3">est dûment inscrit(e) à la ${nomFaculte} de l'${universite} pour l'année universitaire ${anneeAcademique}.</p>
                    <p>La présente attestation est établie à la demande de l'intéressé(e) pour les usages administratifs autorisés.</p>
                `;
                break;
            default:
                return "<p>Type de document non reconnu.</p>";
        }

        return `
            <!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <title>${documentTitle} - ${nomComplet}</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
                <style>
                    body { margin: 20px; font-family: 'Times New Roman', Times, serif; }
                    .document-container { max-width: 800px; margin: auto; }
                    .document-header { text-align: center; margin-bottom: 30px; }
                    .document-header img { max-height: 80px; margin-bottom: 10px; }
                    .document-header h1 { font-size: 1.2rem; margin-bottom: 5px; }
                    .document-header h2 { 
                        font-size: 1.4rem; 
                        font-weight: bold; 
                        text-transform: uppercase; 
                        margin-top: 15px;
                        padding-bottom: 5px;
                    }
                    .document-body { margin-top: 30px; font-size: 12pt; line-height: 1.6; }
                    .document-footer { margin-top: 60px; }
                    .signature-line { 
                        width: 250px; 
                        border-top: 1px solid #000; 
                        margin: 60px auto 5px auto;
                    }
                    .table { width: 100%; margin-bottom: 1rem; }
                    .table th { background-color: #f8f9fa; }
                    @media print {
                        body { margin: 0; padding: 20px; }
                        .document-container { max-width: 100%; }
                    }
                </style>
            </head>
            <body>
                <div class="document-container">
                    <header class="document-header">
                        <img src="${logoUrl}" alt="Logo Faculté">
                        <h1>${universite}</h1>
                        <h1>${nomFaculte}</h1>
                        <h2>${documentTitle}</h2>
                    </header>

                    <div class="document-body">
                        ${documentBodyContent}
                    </div>

                    <div class="document-footer text-center">
                        <p>Fait à ${ville}, le ${dateGeneration}</p>
                        <div class="signature-line"></div>
                        <p>Le Doyen de la Faculté</p>
                    </div>

                    <div class="text-center mt-5 no-print">
                        <button class="btn btn-primary" onclick="window.print()">
                            <i class="bi bi-printer-fill"></i> Imprimer
                        </button>
                        <button class="btn btn-secondary ms-2" onclick="window.close()">
                            <i class="bi bi-x-circle"></i> Fermer
                        </button>
                    </div>
                </div>
            </body>
            </html>
        `;
    }

    const form = document.getElementById('administrativeForm');
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        event.stopPropagation();

        if (!form.checkValidity()) {
            form.classList.add('was-validated');
            const firstInvalidField = form.querySelector(':invalid');
            if (firstInvalidField) firstInvalidField.focus();
            return;
        }

        const formData = {
            nom: document.getElementById('nom').value.trim(),
            prenom: document.getElementById('prenom').value.trim(),
            cne: document.getElementById('cne').value.trim(),
            cin: document.getElementById('cin').value.trim(),
            date_naissance: document.getElementById('date_naissance').value,
            type_document: document.getElementById('type_document').value
        };

        const documentHTMLContent = generateDocumentHTML(formData);
        const newWindow = window.open('', '_blank');
        if (newWindow) {
            newWindow.document.write(documentHTMLContent);
            newWindow.document.close();
            newWindow.focus();
        } else {
            alert("Impossible d'ouvrir un nouvel onglet. Veuillez vérifier les paramètres de votre navigateur.");
        }
    });

    Array.from(form.elements).forEach(element => {
        element.addEventListener('input', () => {
            if (form.classList.contains('was-validated')) {
                if (element.checkValidity()) {
                    element.classList.remove('is-invalid');
                    element.classList.add('is-valid');
                } else {
                    element.classList.remove('is-valid');
                    element.classList.add('is-invalid');
                }
            }
        });
    });
</script>
</body>
</html>