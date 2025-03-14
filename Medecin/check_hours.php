<?php
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

// Récupérer les variables de la requête AJAX
$date_rdv = $_GET['date_rdv'];
$id_medecin = intval($_GET['id_medecin']);

// Préparer la requête pour récupérer les heures déjà réservées pour la date sélectionnée
$sql = "SELECT heure_rdv FROM reservation WHERE id_medecin = ? AND date_rdv = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $id_medecin, $date_rdv);
$stmt->execute();
$result = $stmt->get_result();

// Créer un tableau pour stocker les heures réservées
$reserved_hours = [];
while ($row = $result->fetch_assoc()) {
    $reserved_hours[] = $row['heure_rdv'];
}

// Renvoyer les heures réservées au format JSON
echo json_encode(['reserved_hours' => $reserved_hours]);

$stmt->close();
$conn->close();
?>
