<?php
 include "navPatient.php";;
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sante";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection échouée: " . $conn->connect_error);
}

// Récupérer les réservations
$sql = "SELECT r.id_rdv, r.date_rdv, r.heure_rdv, r.modeReservation, m.Nom as nom_medecin, c.nom as nom_client
        FROM reservation r
        JOIN medecin m ON r.id_medecin = m.id_medecin
        JOIN client c ON r.id_client = c.id_client";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            margin-bottom: 20px;
            background-color: #ffffff; /* Couleur de fond de la carte */
            border-radius: 10px; /* Arrondir les coins */
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1); /* Ombre pour un effet 3D */
            transition: transform 0.2s, box-shadow 0.2s; /* Animation de transformation */
        }
        .card:hover {
            transform: translateY(-5px); /* Légère élévation au survol */
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.2); /* Ombre plus prononcée au survol */
        }
        .card-header {
            background-color: #007bff; /* Couleur de l'en-tête */
            color: #fff; /* Couleur du texte */
            border-top-left-radius: 10px; /* Arrondi du coin supérieur gauche */
            border-top-right-radius: 10px; /* Arrondi du coin supérieur droit */
        }
        .delete-btn {
            background: transparent;
            border: none;
            color: #ff0000; /* Couleur rouge pour le bouton de suppression */
            cursor: pointer;
        }
        .modify-btn {
            background-color: #ffc107; /* Couleur jaune pour le bouton de modification */
            color: #fff; /* Couleur du texte */
        }
        .card-title {
            font-weight: bold;
            font-size: 1.25rem;
        }
    </style>
    <title>Mes Réservations</title>
</head>
<body>

<div class="container mt-4">
    <h1 class="text-center text-primary">Mes Réservations</h1>

    <div class="row">
        <?php if ($result->num_rows >   0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            Réservation n° <?php echo htmlspecialchars($row['id_rdv']); ?>
                            <div>
                                <button class="delete-btn" onclick="deleteReservation(<?php echo $row['id_rdv']; ?>)">Supprimer</button>
                                <a href="ModifierReservation.php?id_rdv=<?php echo $row['id_rdv']; ?>" class="btn btn-warning float-right ml-2 modify-btn">Modifier</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Médecin : <?php echo htmlspecialchars($row['nom_medecin']); ?></h5>
                            <p class="card-text">Client : <?php echo htmlspecialchars($row['nom_client']); ?></p>
                            <p class="card-text">Date : <?php echo htmlspecialchars($row['date_rdv']); ?></p>
                            <p class="card-text">Heure : <?php echo htmlspecialchars($row['heure_rdv']); ?></p>
                            <p class="card-text">Mode de Réservation : <?php echo htmlspecialchars($row['modeReservation']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-warning text-center">Aucune réservation trouvée.</div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    // Fonction pour supprimer une réservation
    function deleteReservation(id_rdv) {
        if (confirm("Êtes-vous sûr de vouloir supprimer cette réservation ?")) {
            fetch('SupprimerReservation.php?id_rdv=' + id_rdv, {
                method: 'GET',
            })
            .then(response => response.text())
            .then(data => {
                if (data === 'success') {
                    alert('Réservation supprimée avec succès.');
                    location.reload(); // Recharger la page après suppression
                } else {
                    alert('Erreur lors de la suppression de la réservation.');
                }
            });
        }
    }
</script>

</body>
</html>
