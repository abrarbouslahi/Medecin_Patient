<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sante";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection échouée: " . $conn->connect_error);
}

if (isset($_GET['id_rdv'])) {
    $id_rdv = intval($_GET['id_rdv']); // Récupérer l'ID de réservation
    
    // Requête pour supprimer la réservation
    $sql = "DELETE FROM reservation WHERE id_rdv = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_rdv);
    
    if ($stmt->execute()) {
        echo 'success'; // Réservation supprimée avec succès
    } else {
        echo 'error'; // Erreur lors de la suppression
    }
    
    $stmt->close(); // Fermer la déclaration
}

$conn->close(); // Fermer la connexion
?>
