<?php
include "navPatient.php";

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

// Récupérer l'ID du médecin à partir de l'URL
$id_medecin = isset($_GET['id_medecin']) ? intval($_GET['id_medecin']) : 0;

// Gérer la soumission du formulaire de réservation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_client = $_POST['id_client']; // ID du client sélectionné
    $date_rdv = $_POST['date_rdv'];
    $heure_rdv = $_POST['heure_rdv']; // Heure sélectionnée
    $modeReservation = $_POST['modeReservation']; // Mode de réservation sélectionné

    // Déboguer les valeurs reçues
    error_log("Mode de réservation: " . $modeReservation); // Ajoutez cette ligne pour vérifier la valeur

    // Vérifier si l'heure est déjà réservée
    $check_sql = "SELECT * FROM reservation WHERE id_medecin = ? AND date_rdv = ? AND heure_rdv = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("iss", $id_medecin, $date_rdv, $heure_rdv);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        // L'heure est déjà réservée
        $message = "Cette heure est déjà réservée. Veuillez choisir une autre heure.";
    } else {
        // Insérer la réservation dans la base de données
        $sql = "INSERT INTO reservation (id_medecin, id_client, date_rdv, heure_rdv, modeReservation) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iisss", $id_medecin, $id_client, $date_rdv, $heure_rdv, $modeReservation);

        if ($stmt->execute()) {
            // Afficher un message de succès avec un peu de design
            $message = "Votre réservation est enregistrée. Attendez-vous à recevoir un email de confirmation.";
            $alert_class = "alert-success"; // Bootstrap alert class for success
            $icon = "✔️"; // Success icon
        }
    }
}

// Récupérer les médecins avec leurs spécialités
$sql_medecins = "SELECT * FROM medecin";
$result_medecins = $conn->query($sql_medecins);

// Récupérer tous les clients
$sql_clients = "SELECT * FROM client";
$result_clients = $conn->query($sql_clients);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Réservation de Médecin</title>
</head>
<body>

<div class="container mt-4">
    <h1 class="text-center">Réservation de Médecin</h1>

    <?php if (isset($message)): ?>
        <div class="alert <?php echo $alert_class; ?> d-flex align-items-center" role="alert">
            <span class="mr-2"><?php echo $icon; ?></span>
            <strong><?php echo $message; ?></strong>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Réserver un rendez-vous</h5>
                    <form method="POST">
                        <!-- Sélectionner un médecin par nom et spécialité -->
                        

                        <!-- Sélectionner un client -->
                        <div class="form-group">
                            <label for="id_client">Sélectionnez un client :</label>
                            <select class="form-control" id="id_client" name="id_client" required>
                                <?php while ($client = $result_clients->fetch_assoc()): ?>
                                    <option value="<?php echo $client['id_client']; ?>">
                                        <?php echo htmlspecialchars($client['nom']); ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <!-- Sélectionner une date -->
                        <div class="form-group">
                            <label for="date_rdv">Sélectionnez une date :</label>
                            <input type="date" class="form-control" id="date_rdv" name="date_rdv" required>
                        </div>

                        <!-- Sélectionner une heure -->
                        <div class="form-group">
                            <label for="heure_rdv">Sélectionnez une heure :</label>
                            <select class="form-control" id="heure_rdv" name="heure_rdv" required>
                                <option value="" disabled selected>Sélectionnez une heure</option>
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

                        <!-- Mode de réservation -->
                        <div class="form-group">
                            <label for="modeReservation">Mode de réservation :</label>
                            <select class="form-control" id="modeReservation" name="modeReservation" required>
                                <option value="en ligne">En ligne</option>
                                <option value="présentiel">Présentiel</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Réserver</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
