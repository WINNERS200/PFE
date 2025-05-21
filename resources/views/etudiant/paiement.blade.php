<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Paiements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .payment-card {
            transition: transform 0.3s ease;
        }
        .payment-card:hover {
            transform: translateY(-5px);
        }
        .badge-payment {
            font-size: 0.85em;
            padding: 0.5em 0.75em;
        }
        .nav-tabs .nav-link.active {
            font-weight: 500;
            border-bottom: 3px solid #198754; /* Maintenir la couleur verte pour l'onglet actif */
        }
        #cardDetails {
            transition: all 0.3s ease;
        }
        .tranche-payee {
            background-color: #d1e7dd; /* Vert clair pour payé */
        }
        .tranche-a-payer {
            background-color: #fff3cd; /* Jaune clair pour à payer */
        }
    </style>
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow-sm mb-5">
        <div class="card-header bg-success text-white">
            <h2 class="mb-0 text-center"><i class="bi bi-credit-card me-2"></i>Gestion des Paiements</h2>
        </div>

        <div class="card-body">
            <!-- L'onglet unique "Nouveau Paiement" reste, mais plus de nav-tabs nécessaires s'il n'y a qu'un seul contenu principal -->
            <!-- On peut simplifier et enlever la structure des onglets si l'historique est parti -->

            <div id="payment-form-section">
                <h3 class="mb-4"><i class="bi bi-plus-circle me-1"></i>Nouveau Paiement</h3>
                <form id="payment-form">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="cne" class="form-label">CNE <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="cne" required>
                                <div class="invalid-feedback">Veuillez saisir un CNE valide</div>
                            </div>

                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nom" required>
                            </div>

                            <div class="mb-3">
                                <label for="prenom" class="form-label">Prénom <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="prenom" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="niveau" class="form-label">Niveau <span class="text-danger">*</span></label>
                                <select class="form-select" id="niveau" onchange="updateMontant()" required>
                                    <option value="" selected disabled>Choisir...</option>
                                    <option value="licence">Licence</option>
                                    <option value="master">Master</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="montant" class="form-label">Montant (DH) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="montant" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="tranches" class="form-label">Nombre de tranches <span class="text-danger">*</span></label>
                                <select class="form-select" id="tranches" required>
                                    <option value="1">1 tranche (100%)</option>
                                    <option value="2">2 tranches (50% + 50%)</option>
                                    <option value="3">3 tranches (40% + 30% + 30%)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Mode de paiement <span class="text-danger">*</span></label>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="form-check card border p-3 h-100 payment-card">
                                    <input class="form-check-input" type="radio" name="modePaiement" id="especes" value="especes" checked onclick="togglePaymentFields()">
                                    <label class="form-check-label w-100 text-center" for="especes">
                                        <i class="bi bi-cash-coin fs-3 mb-2 d-block"></i>
                                        Espèces
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check card border p-3 h-100 payment-card">
                                    <input class="form-check-input" type="radio" name="modePaiement" id="cheque" value="cheque" onclick="togglePaymentFields()">
                                    <label class="form-check-label w-100 text-center" for="cheque">
                                        <i class="bi bi-wallet2 fs-3 mb-2 d-block"></i>
                                        Chèque
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check card border p-3 h-100 payment-card">
                                    <input class="form-check-input" type="radio" name="modePaiement" id="carte" value="carte" onclick="togglePaymentFields()">
                                    <label class="form-check-label w-100 text-center" for="carte">
                                        <i class="bi bi-credit-card fs-3 mb-2 d-block"></i>
                                        Carte Bancaire
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Champs conditionnels -->
                    <div id="paymentFields" class="mb-4 p-3 border rounded bg-light" style="display: none;">
                        <div id="chequeFields" style="display: none;">
                            <h6 class="mb-3">Détails du chèque</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="chequeNum" class="form-label">Numéro de chèque</label>
                                    <input type="text" class="form-control" id="chequeNum">
                                </div>
                                <div class="col-md-6">
                                    <label for="chequeBank" class="form-label">Banque</label>
                                    <input type="text" class="form-control" id="chequeBank">
                                </div>
                            </div>
                        </div>

                        <div id="carteFields" style="display: none;">
                             <h6 class="mb-3">Détails de la carte</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="cardNum" class="form-label">Numéro de carte</label>
                                    <input type="text" class="form-control" id="cardNum" placeholder="1234 5678 9012 3456">
                                </div>
                                <div class="col-md-3">
                                    <label for="cardExp" class="form-label">Expiration</label>
                                    <input type="text" class="form-control" id="cardExp" placeholder="MM/AA">
                                </div>
                                <div class="col-md-3">
                                    <label for="cardCvv" class="form-label">CVV</label>
                                    <input type="text" class="form-control" id="cardCvv" placeholder="123">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="bi bi-check-circle me-1"></i> Enregistrer le paiement
                        </button>
                    </div>
                </form>
            </div>

            <!-- Section de confirmation de paiement (initiallement masquée) -->
            <div id="payment-confirmation-section" class="mt-5" style="display: none;">
                <div class="card border-success">
                    <div class="card-header bg-success text-white">
                        <h3 class="mb-0"><i class="bi bi-check-circle-fill me-2"></i>Paiement Enregistré avec Succès !</h3>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h5>Informations de l'étudiant</h5>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><strong>CNE:</strong> <span id="conf-cne"></span></li>
                                    <li class="list-group-item"><strong>Nom:</strong> <span id="conf-nom"></span></li>
                                    <li class="list-group-item"><strong>Prénom:</strong> <span id="conf-prenom"></span></li>
                                    <li class="list-group-item"><strong>Niveau:</strong> <span id="conf-niveau"></span></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h5>Détails du Paiement</h5>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><strong>Date du 1er paiement:</strong> <span id="conf-date"></span></li>
                                    <li class="list-group-item"><strong>Montant total:</strong> <span id="conf-montant-total"></span> DH</li>
                                    <li class="list-group-item"><strong>Mode de paiement (1ère tranche):</strong> <span id="conf-mode-paiement"></span></li>
                                    <li class="list-group-item" id="conf-cheque-details" style="display:none;">
                                        <strong>N° Chèque:</strong> <span id="conf-cheque-num"></span>, <strong>Banque:</strong> <span id="conf-cheque-bank"></span>
                                    </li>
                                     <li class="list-group-item" id="conf-carte-details" style="display:none;">
                                        <strong>N° Carte (4 derniers chiffres):</strong> <span id="conf-carte-num"></span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <h5>Échéancier des Tranches</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Tranche</th>
                                        <th>Montant (DH)</th>
                                        <th>Date Limite de Paiement</th>
                                        <th>Statut</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="conf-tranches-tbody">
                                    <!-- Les lignes de tranches seront ajoutées ici par JS -->
                                </tbody>
                            </table>
                        </div>
                        <div id="cash-receipt-button-container" class="mt-3" style="display: none;">
                             <button class="btn btn-primary" onclick="downloadCashReceipt()">
                                <i class="bi bi-download me-1"></i> Télécharger Reçu (1ère Tranche Espèces)
                            </button>
                        </div>

                        <hr class="my-4">
                        <button class="btn btn-primary" onclick="effectuerNouveauPaiement()">
                            <i class="bi bi-arrow-left-circle me-1"></i> Effectuer un nouveau paiement
                        </button>
                         <button class="btn btn-secondary ms-2" onclick="imprimerRecuComplet()">
                            <i class="bi bi-printer me-1"></i> Imprimer Reçu Complet
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Le Modal Détails Paiement n'est plus directement utilisé par un bouton "Voir" de l'historique.
     On pourrait le réutiliser pour "Imprimer Reçu Complet" ou le supprimer si la section de confirmation suffit.
     Pour l'instant, je le commente pour simplifier. -->
<!--
<div class="modal fade" id="paymentDetailsModal" tabindex="-1" aria-hidden="true">
    ... (contenu du modal) ...
</div>
-->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const niveauMontants = {
        licence: 25000,
        master: 54000
    };

    const tranchesConfig = {
        '1': [{ percent: 100, label: "1/1" }],
        '2': [{ percent: 50, label: "1/2" }, { percent: 50, label: "2/2" }],
        '3': [{ percent: 40, label: "1/3" }, { percent: 30, label: "2/3" }, { percent: 30, label: "3/3" }]
    };

    let currentPaymentData = null; // Pour stocker les données du paiement actuel pour l'impression

    document.addEventListener("DOMContentLoaded", function() {
        updateMontant();
        // Activer les tooltips (s'il y en a, bien que nous ayons supprimé ceux de l'historique)
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });

    function updateMontant() {
        const niveau = document.getElementById("niveau").value;
        if (niveau) {
            document.getElementById("montant").value = niveauMontants[niveau].toLocaleString('fr-FR');
        } else {
            document.getElementById("montant").value = "";
        }
    }

    function togglePaymentFields() {
        const mode = document.querySelector('input[name="modePaiement"]:checked').value;
        const fieldsContainer = document.getElementById("paymentFields");
        
        document.getElementById("chequeFields").style.display = "none";
        document.getElementById("carteFields").style.display = "none";
        
        if (mode === "cheque") {
            fieldsContainer.style.display = "block";
            document.getElementById("chequeFields").style.display = "block";
        } else if (mode === "carte") {
            fieldsContainer.style.display = "block";
            document.getElementById("carteFields").style.display = "block";
        } else {
            fieldsContainer.style.display = "none";
        }
    }

    document.getElementById("payment-form").addEventListener("submit", function(e) {
        e.preventDefault();
        
        if (!this.checkValidity()) {
            e.stopPropagation();
            this.classList.add('was-validated');
            return;
        }
        
        currentPaymentData = {
            cne: document.getElementById("cne").value,
            nom: document.getElementById("nom").value,
            prenom: document.getElementById("prenom").value,
            niveau: document.getElementById("niveau").value,
            niveauLibelle: document.getElementById("niveau").options[document.getElementById("niveau").selectedIndex].text,
            montantTotal: niveauMontants[document.getElementById("niveau").value],
            nbTranches: document.getElementById("tranches").value,
            modePaiement: document.querySelector('input[name="modePaiement"]:checked').value,
            datePaiement: new Date() // Garder l'objet Date pour les calculs
        };
        
        if (currentPaymentData.modePaiement === "cheque") {
            currentPaymentData.chequeNum = document.getElementById("chequeNum").value;
            currentPaymentData.chequeBank = document.getElementById("chequeBank").value;
        } else if (currentPaymentData.modePaiement === "carte") {
            currentPaymentData.cardNum = document.getElementById("cardNum").value;
            currentPaymentData.cardExp = document.getElementById("cardExp").value;
            currentPaymentData.cardCvv = document.getElementById("cardCvv").value;
        }
        
        console.log("Paiement à enregistrer:", currentPaymentData);
        
        // Afficher la section de confirmation
        displayPaymentConfirmation(currentPaymentData);

        // Cacher le formulaire et afficher la confirmation
        document.getElementById("payment-form-section").style.display = "none";
        document.getElementById("payment-confirmation-section").style.display = "block";
        window.scrollTo(0, 0); // Remonter en haut de page
    });

    function displayPaymentConfirmation(data) {
        document.getElementById("conf-cne").textContent = data.cne;
        document.getElementById("conf-nom").textContent = data.nom;
        document.getElementById("conf-prenom").textContent = data.prenom;
        document.getElementById("conf-niveau").textContent = data.niveauLibelle;
        document.getElementById("conf-date").textContent = data.datePaiement.toLocaleDateString('fr-FR');
        document.getElementById("conf-montant-total").textContent = data.montantTotal.toLocaleString('fr-FR');
        
        let modePaiementText = "";
        switch(data.modePaiement) {
            case "especes": modePaiementText = "Espèces"; break;
            case "cheque": modePaiementText = "Chèque"; break;
            case "carte": modePaiementText = "Carte Bancaire"; break;
        }
        document.getElementById("conf-mode-paiement").textContent = modePaiementText;

        // Afficher détails spécifiques au mode de paiement
        document.getElementById("conf-cheque-details").style.display = "none";
        document.getElementById("conf-carte-details").style.display = "none";
        if (data.modePaiement === "cheque") {
            document.getElementById("conf-cheque-num").textContent = data.chequeNum;
            document.getElementById("conf-cheque-bank").textContent = data.chequeBank;
            document.getElementById("conf-cheque-details").style.display = "list-item";
        } else if (data.modePaiement === "carte" && data.cardNum) {
            document.getElementById("conf-carte-num").textContent = "**** **** **** " + data.cardNum.slice(-4);
            document.getElementById("conf-carte-details").style.display = "list-item";
        }


        const tbody = document.getElementById("conf-tranches-tbody");
        tbody.innerHTML = ""; // Vider les anciennes tranches

        const tranchesAAfficher = tranchesConfig[data.nbTranches];
        let cumulativeDelayDays = 0;

        tranchesAAfficher.forEach((trancheInfo, index) => {
            const row = tbody.insertRow();
            const montantTranche = data.montantTotal * (trancheInfo.percent / 100);
            
            const dateLimite = new Date(data.datePaiement);
            if (index > 0) { // La première tranche est payée aujourd'hui
                cumulativeDelayDays += 30; // Ajoute 30 jours pour chaque tranche suivante
                dateLimite.setDate(dateLimite.getDate() + cumulativeDelayDays);
            }

            row.insertCell().textContent = trancheInfo.label;
            row.insertCell().textContent = montantTranche.toLocaleString('fr-FR');
            row.insertCell().textContent = dateLimite.toLocaleDateString('fr-FR');

            const statutCell = row.insertCell();
            const actionCell = row.insertCell();

            if (index === 0) { // Première tranche, considérée payée
                statutCell.innerHTML = `<span class="badge bg-success badge-payment">Payée</span>`;
                row.classList.add('tranche-payee');
                if (data.modePaiement === "especes") {
                     actionCell.innerHTML = `<button class="btn btn-sm btn-outline-primary" onclick="downloadCashReceiptForTranche(${montantTranche})">
                                                <i class="bi bi-download"></i> Reçu Tranche
                                            </button>`;
                } else {
                    actionCell.innerHTML = '-';
                }
            } else {
                statutCell.innerHTML = `<span class="badge bg-warning text-dark badge-payment">À Payer</span>`;
                row.classList.add('tranche-a-payer');
                actionCell.innerHTML = '-'; // Pas d'action pour tranches futures pour l'instant
            }
        });

        // Afficher le bouton de reçu espèces si paiement en espèces et 1ère tranche
        const cashReceiptContainer = document.getElementById("cash-receipt-button-container");
        if (data.modePaiement === "especes") {
            cashReceiptContainer.style.display = "block";
        } else {
            cashReceiptContainer.style.display = "none";
        }
    }
    
    function downloadCashReceiptForTranche(montant) {
        alert(`Simulation: Téléchargement du reçu pour la tranche de ${montant.toLocaleString('fr-FR')} DH payée en espèces.`);
        // Ici, vous généreriez un PDF ou autre format de reçu.
    }

    function downloadCashReceipt() {
        if (currentPaymentData && currentPaymentData.modePaiement === 'especes') {
            const premiereTrancheConfig = tranchesConfig[currentPaymentData.nbTranches][0];
            const montantPremiereTranche = currentPaymentData.montantTotal * (premiereTrancheConfig.percent / 100);
            alert(`Simulation: Téléchargement du reçu pour la 1ère tranche de ${montantPremiereTranche.toLocaleString('fr-FR')} DH payée en espèces.\nÉtudiant: ${currentPaymentData.nom} ${currentPaymentData.prenom}\nDate: ${currentPaymentData.datePaiement.toLocaleDateString('fr-FR')}`);
            // Ici, vous généreriez un PDF ou autre format de reçu.
        } else {
            alert("Aucun paiement en espèces détecté pour la première tranche ou données de paiement manquantes.");
        }
    }

    function effectuerNouveauPaiement() {
        document.getElementById("payment-form-section").style.display = "block";
        document.getElementById("payment-confirmation-section").style.display = "none";
        
        // Réinitialiser le formulaire
        const form = document.getElementById("payment-form");
        form.reset();
        form.classList.remove('was-validated');
        document.getElementById("paymentFields").style.display = "none";
        updateMontant();
        currentPaymentData = null; // Effacer les données du paiement précédent
    }

    function imprimerRecuComplet() {
        if (!currentPaymentData) {
            alert("Aucun détail de paiement à imprimer.");
            return;
        }
        // Simuler l'impression en ouvrant une nouvelle fenêtre avec le contenu formaté
        // Vous pouvez améliorer cela en créant une page d'impression dédiée
        let printContents = `
            <html>
            <head>
                <title>Reçu de Paiement</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
                <style>
                    body { font-family: Arial, sans-serif; margin: 20px; }
                    .receipt-header { text-align: center; margin-bottom: 20px; }
                    .receipt-table { width: 100%; border-collapse: collapse; margin-bottom: 20px;}
                    .receipt-table th, .receipt-table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                    .list-group-item { border: none; padding: .25rem 0; }
                </style>
            </head>
            <body>
                <div class="receipt-header">
                    <h2>Reçu de Paiement</h2>
                    <p><strong>École XYZ</strong> - Date d'émission: ${new Date().toLocaleDateString('fr-FR')}</p>
                </div>

                <div class="container">
                    <div class="row mb-4">
                        <div class="col-6">
                            <h5>Informations de l'étudiant</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>CNE:</strong> ${currentPaymentData.cne}</li>
                                <li class="list-group-item"><strong>Nom:</strong> ${currentPaymentData.nom}</li>
                                <li class="list-group-item"><strong>Prénom:</strong> ${currentPaymentData.prenom}</li>
                                <li class="list-group-item"><strong>Niveau:</strong> ${currentPaymentData.niveauLibelle}</li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <h5>Détails du Paiement</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Date du 1er paiement:</strong> ${currentPaymentData.datePaiement.toLocaleDateString('fr-FR')}</li>
                                <li class="list-group-item"><strong>Montant total:</strong> ${currentPaymentData.montantTotal.toLocaleString('fr-FR')} DH</li>
                                <li class="list-group-item"><strong>Mode de paiement (1ère tranche):</strong> ${
                                    (currentPaymentData.modePaiement === 'especes' ? 'Espèces' : 
                                    (currentPaymentData.modePaiement === 'cheque' ? 'Chèque' : 'Carte Bancaire'))
                                }</li>
                                ${currentPaymentData.modePaiement === 'cheque' ? `<li class="list-group-item"><strong>N° Chèque:</strong> ${currentPaymentData.chequeNum}, <strong>Banque:</strong> ${currentPaymentData.chequeBank}</li>` : ''}
                                ${currentPaymentData.modePaiement === 'carte' && currentPaymentData.cardNum ? `<li class="list-group-item"><strong>N° Carte (4 derniers chiffres):</strong> **** **** **** ${currentPaymentData.cardNum.slice(-4)}</li>` : ''}
                            </ul>
                        </div>
                    </div>

                    <h5>Échéancier des Tranches</h5>
                    <table class="receipt-table">
                        <thead>
                            <tr>
                                <th>Tranche</th>
                                <th>Montant (DH)</th>
                                <th>Date Limite de Paiement</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>`;

        const tranchesAAfficher = tranchesConfig[currentPaymentData.nbTranches];
        let cumulativeDelayDaysPrint = 0;
        tranchesAAfficher.forEach((trancheInfo, index) => {
            const montantTranche = currentPaymentData.montantTotal * (trancheInfo.percent / 100);
            const dateLimite = new Date(currentPaymentData.datePaiement);
            if (index > 0) {
                cumulativeDelayDaysPrint += 30;
                dateLimite.setDate(dateLimite.getDate() + cumulativeDelayDaysPrint);
            }
            printContents += `
                            <tr>
                                <td>${trancheInfo.label}</td>
                                <td>${montantTranche.toLocaleString('fr-FR')}</td>
                                <td>${dateLimite.toLocaleDateString('fr-FR')}</td>
                                <td>${index === 0 ? 'Payée' : 'À Payer'}</td>
                            </tr>`;
        });

        printContents += `
                        </tbody>
                    </table>
                    <p class="text-muted small mt-4">Ceci est un reçu généré automatiquement.</p>
                </div>
            </body></html>`;
        
        const printWindow = window.open('', '_blank');
        printWindow.document.write(printContents);
        printWindow.document.close();
        printWindow.focus(); // Nécessaire pour certains navigateurs comme Safari
        // Attendre que le contenu soit chargé avant d'imprimer
        setTimeout(() => {
            printWindow.print();
            // printWindow.close(); // Optionnel: fermer la fenêtre après impression
        }, 500); // Un délai pour s'assurer que tout est chargé, surtout les styles Bootstrap
    }

</script>

</body>
</html>