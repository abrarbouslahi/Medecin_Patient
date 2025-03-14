

<?php
include "nav.php";

// Connexion à la base de données
$host = 'localhost';
$db = 'sante'; // nom de la base de données
$user = 'root';
$pass = ''; // mot de passe de votre base de données (vide si non défini)

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die('Erreur de connexion : ' . $e->getMessage());
}

// Traitement des données du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $specialite = $_POST['specialite'];
    $region = $_POST['region'];
    $dates_disponibles = $_POST['dates_disponibles'];
    $telephone = $_POST['telephone'];

    // Préparer la requête SQL d'insertion
    $sql = "INSERT INTO medecin (nom, specialite, region, dates_disponibles, telephone) VALUES (:nom, :specialite, :region, :dates_disponibles, :telephone)";
    $stmt = $pdo->prepare($sql);

    // Exécuter la requête avec les données du formulaire
    $stmt->execute([
        ':nom' => $nom,
        ':specialite' => $specialite,
        ':region' => $region,
        ':dates_disponibles' => $dates_disponibles,
        ':telephone' => $telephone
    ]);

    // Message de succès
    echo "Le médecin a été ajouté avec succès.";

    // Option de redirection (décommentez si vous souhaitez rediriger)
    // header('Location: confirmation.php');
    // exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Médecin</title>
    <link rel="stylesheet" href="../css/AjouterMedecin.css"> <!-- Lien vers votre fichier CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"> <!-- CSS de flatpickr -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> <!-- JS de flatpickr -->
</head>
<body>
    <div class="container">
        <h1>Ajouter un Médecin</h1>
        <div class="form-container">
        <!-- Form for Adding Doctor -->
        <form action="AjouterMedecin.php" method="post" class="form" onsubmit="return redirectToPublication();">
            <div class="form-groupMedecin">
                <label for="nom" class="label">Nom du Médecin :</label>
                <input type="text" id="nom" name="nom" class="input" required placeholder="Entrez le nom">
            </div>
            <div class="form-groupMedecin">
                <label for="specialite" class="label">Spécialité :</label>
                <select id="specialite" name="specialite" class="select" required>
                    <option value="" disabled selected>Choisir une spécialité</option>
                    <option value="ophtalmologue">Ophtalmologue</option>
<option value="psychiatre">Psychiatre</option>
<option value="radiologue">Radiologue</option>
<option value="endocrinologue">Endocrinologue</option>
<option value="neurochirurgien">Neurochirurgien</option>
<option value="oncologue">Oncologue</option>
<option value="urologue">Urologue</option>
<option value="gastro-entérologue">Gastro-entérologue</option>
<option value="infectiologue">Infectiologue</option>
<option value="chirurgien-plastique">Chirurgien plastique</option>

                </select>
            </div>
            <div class="form-groupMedecin">
                <label for="region" class="label">Région :</label>
                <select id="region" name="region" class="select" required>
                    <option value="" disabled selected>Choisir une région</option>
                    <option value="nantes">Nantes</option>
                    <option value="limoges">Limoges</option>
                    <option value="lyon">Lyon</option>
                    <option value="paris">Paris</option>
                </select>
            </div>
            <div class="form-groupMedecin">
                <label for="dates_disponibles" class="label">Dates Disponibles :</label>
                <input type="text" id="dates_disponibles" name="dates_disponibles" class="input" required placeholder="Sélectionner les dates" readonly>
            </div>
            <div class="form-groupMedecin">
                <label for="telephone" class="label">Téléphone :</label>
                <input type="text" id="telephone" name="telephone" class="input" placeholder="Entrez le numéro de téléphone">
            </div>
            <button type="submit" class="button" onclick="window.location.href='AfficherPublication.php';">Ajouter Médecin</button>

        </form>
    </div>
    
    
        
    <script>
        function redirectToPublication(event) {
            // Empêcher l'envoi du formulaire classique
            event.preventDefault();
    
            // Envoyer les données du formulaire
            const form = document.querySelector('.form');
            const formData = new FormData(form);
    
            // Utiliser fetch pour envoyer les données du formulaire
            fetch(form.action, {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    // Rediriger vers la page des publications
                    window.location.href = 'AfficherPublication.php';
                } else {
                    alert("Erreur lors de l'ajout du médecin.");
                }
            })
            .catch(error => {
                console.error("Erreur:", error);
                alert("Erreur lors de l'ajout du médecin.");
            });
    
            return false;
        
        }
    </script>

<script>
    flatpickr("#dates_disponibles", {
        mode: "multiple", // Mode de sélection multiple
        dateFormat: "Y-m-d", // Format de la date
        allowInput: true, // Permet d'écrire directement dans le champ
        disable: [
            function(date) {
                return (date.getDay() === 0 || date.getDay() === 6); // Désactive les dimanches et samedis
            }
        ],
        onClose: function(selectedDates, dateStr, instance) {
            // Met à jour la valeur du champ avec les dates sélectionnées
            const dates = selectedDates.map(date => instance.formatDate(date, "Y-m-d")).join(", ");
            document.getElementById('dates_disponibles').value = dates; // Affiche les dates dans le champ
        }
    });
</script>


        <style>

/* Style du conteneur du formulaire */
.form-container {
    max-width: 600px; /* Largeur maximale du conteneur */
    margin: 20px auto; /* Centrer le conteneur */
    padding: 20px; /* Espacement intérieur */
    border-radius: 8px; /* Coins arrondis */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15); /* Ombre douce */
    background-color: #f9f9f9; /* Couleur de fond légèrement grise */
}

/* Style général du formulaire */
form {
    display: flex;
    flex-direction: column;
}

/* Style des étiquettes de champ */
form label {
    font-weight: bold; /* Met le texte en gras */
    margin-bottom: 6px; /* Ajoute de l'espace en dessous de l'étiquette */
    font-size: 1rem; /* Taille de police augmentée */
    color: #333; /* Couleur du texte */
}

/* Style des champs de saisie (inputs) */
form input[type="text"],
form select {
    padding: 12px; /* Espacement intérieur augmenté */
    border: 1px solid #ccc; /* Bordure grise */
    border-radius: 4px; /* Coins arrondis */
    margin-bottom: 15px; /* Espace entre les champs */
    transition: border-color 0.3s; /* Transition pour le changement de couleur de bordure */
    font-size: 1rem; /* Taille de police augmentée pour les champs de saisie */
    width: 100%; /* Largeur à 100% pour remplir le conteneur */
    box-sizing: border-box; /* Inclut le padding et la bordure dans la largeur totale */
}

/* Style des champs au focus */
form input[type="text"]:focus,
form select:focus {
    border-color: #007bff; /* Couleur de bordure au focus */
    outline: none; /* Enlève le contour par défaut */
}

/* Style des boutons */
form button {
    padding: 12px 15px; /* Espacement intérieur augmenté */
    background-color: #000; /* Couleur noire */
    color: white; /* Couleur du texte */
    border: none; /* Enlève la bordure */
    border-radius: 4px; /* Coins arrondis */
    cursor: pointer; /* Change le curseur au survol */
    font-size: 1rem; /* Taille de police standard */
    transition: background-color 0.3s; /* Transition pour la couleur de fond */
}

form button:hover {
    background-color: #444; /* Couleur au survol */
}

/* Style pour les boutons dans le conteneur */
.button-container .button {
    margin-top: 10px; /* Ajoute un espace au-dessus du bouton */
}


        </style>
    </div>
<!--footer-->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 indent maxheight2 wow fadeInUp">
                <p class="title">copyright</p>
                <p class="prev">&copy; <em id="copyright-year"></em> <a href="index-5.html">Privacy Policy</a></p>
                <ul class="follow_icon2">
                    <!--<li><a href="#" class="fa fa-facebook"></a></li>
                    <li><a href="#" class="fa fa-google-plus"></a></li>
                    <li><a href="#" class="fa fa-rss"></a></li>
                    <li><a href="#" class="fa fa-pinterest"></a></li>
                    <li><a href="#" class="fa fa-linkedin"></a></li>-->
                </ul>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 maxheight2 wow fadeInUp" data-wow-delay="0.1s">
                <p class="title">LIENS IMPORTANTS</p>
                <!--<ul class="list1">
                    <li><a href="#">Affiliate Program</a></li>
                    <li><a href="#">Special Promotions</a></li>
                    <li><a href="#">Newsletter</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>-->
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 maxheight2 wow fadeInUp" data-wow-delay="0.2s">
                <p class="title">AIDE</p>
                <ul class="list1">
                    <li><a href="MdpOublie.html">MOT DE PASSE OUBLIÉ ?</a></li>
                    <li><a href="visu-cpte-pat.html">MON COMPTE</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 maxheight2 wow fadeInUp" data-wow-delay="0.3s">
                <p class="title">À PROPOS DE NOUS</p>
                <ul class="list1">
                    <li><a href="index-5.html">NOTRE ÉQUIPE</a></li>
                   
                </ul>
            </div>
        </div>
    </div>
  <!-- {%FOOTER_LINK} -->
</footer>
<script src="js/bootstrap.min.js"></script>
<script src="js/tm-scripts.js"></script>
</body>
</html>
