<?php
// Inclure votre fichier de connexion à la base de données
include "navPatient.php";;
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sante";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection échouée: " . $conn->connect_error);
}

// Vérifier si un ID de réservation est fourni
if (isset($_GET['id_rdv'])) {
    $id_rdv = $_GET['id_rdv'];
    // Récupérer les informations de réservation
    $sql = "SELECT * FROM reservation WHERE id_rdv = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_rdv);
    $stmt->execute();
    $result = $stmt->get_result();
    $reservation = $result->fetch_assoc();
} else {
    die("ID de réservation non fourni.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les nouvelles données du formulaire
    $date_rdv = $_POST['date_rdv'];
    $heure_rdv = $_POST['heure_rdv'];
    $modeReservation = $_POST['modeReservation'];
    $id_medecin = $_POST['id_medecin']; // Assurez-vous que vous avez ce champ dans le formulaire

    // Mettre à jour la réservation
    $update_sql = "UPDATE reservation SET date_rdv = ?, heure_rdv = ?, modeReservation = ?, id_medecin = ? WHERE id_rdv = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssiii", $date_rdv, $heure_rdv, $modeReservation, $id_medecin, $id_rdv);
    
    if ($update_stmt->execute()) {
        header("Location: mesReservation.php"); // Rediriger après la mise à jour
        exit;
    } else {
        echo "Erreur lors de la mise à jour de la réservation.";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Modifier Réservation</title>
</head>
<body>

<div class="container mt-4">
    <h1>Modifier la Réservation n° <?php echo htmlspecialchars($reservation['id_rdv']); ?></h1>
    <form method="POST">
        <div class="form-group">
            <label for="date_rdv">Date</label>
            <input type="date" class="form-control" id="date_rdv" name="date_rdv" value="<?php echo htmlspecialchars($reservation['date_rdv']); ?>" required>
        </div>
        <div class="form-group">
            <label for="heure_rdv">Heure</label>
            <select class="form-control" id="heure_rdv" name="heure_rdv" required>
                <option value="<?php echo htmlspecialchars($reservation['heure_rdv']); ?>"><?php echo htmlspecialchars($reservation['heure_rdv']); ?></option>
                <option value="09:00">09:00</option>
                <option value="10:00">10:00</option>
                <option value="11:00">11:00</option>
                <option value="12:00">12:00</option>
                <option value="13:00">13:00</option>
                <option value="14:00">14:00</option>
                <option value="15:00">15:00</option>
                <option value="16:00">16:00</option>
                <option value="17:00">17:00</option>
            </select>
        </div>
        <div class="form-group">
            <label for="modeReservation">Mode de Réservation</label>
            <input type="text" class="form-control" id="modeReservation" name="modeReservation" value="<?php echo htmlspecialchars($reservation['modeReservation']); ?>" required>
        </div>
        <input type="hidden" name="id_medecin" value="<?php echo htmlspecialchars($reservation['id_medecin']); ?>">
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>

</body>
</html>
