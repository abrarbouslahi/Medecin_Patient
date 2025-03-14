<?php
include "nav.php";
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
        .table th, .table td {
            vertical-align: middle;
        }
        .confirm-btn, .cancel-btn {
            margin-right: 5px;
        }
    </style>
    <title>Mes Réservations</title>
</head>
<body>

<div class="container mt-4">
    <h1 class="text-center text-primary">Mes Réservations</h1>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                  
                  
                    <th>Client</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Mode de Réservation</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                           
                          
                            <td><?php echo htmlspecialchars($row['nom_client']); ?></td>
                            <td><?php echo htmlspecialchars($row['date_rdv']); ?></td>
                            <td><?php echo htmlspecialchars($row['heure_rdv']); ?></td>
                            <td><?php echo htmlspecialchars($row['modeReservation']); ?></td>
                            <td>
    <!-- Bouton Confirmer qui redirige vers email.php avec l'ID de la réservation -->
    <button class="btn btn-success confirm-btn" onclick="window.location.href='../mail.php?id_rdv=<?php echo $row['id_rdv']; ?>'">Confirmer</button>
    <button class="btn btn-danger cancel-btn" onclick="cancelReservation(<?php echo $row['id_rdv']; ?>)">Annuler</button>
</td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">Aucune réservation trouvée.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    // Fonction pour confirmer une réservation
    function confirmReservation(id_rdv) {
        if (confirm("Êtes-vous sûr de vouloir confirmer cette réservation ?")) {
            // Code pour confirmer la réservation
            alert('Réservation confirmée avec succès.');
            // Ici, vous pouvez faire une requête pour mettre à jour le statut de la réservation dans la base de données.
        }
    }

    // Fonction pour annuler une réservation
    function cancelReservation(id_rdv) {
        if (confirm("Êtes-vous sûr de vouloir annuler cette réservation ?")) {
            // Code pour annuler la réservation
            alert('Réservation annulée avec succès.');
            // Ici, vous pouvez faire une requête pour mettre à jour le statut de la réservation dans la base de données.
        }
    }
</script>

</body>
</html>
