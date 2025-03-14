<?php

// Connexion à la base de données
$host = 'localhost';
$db = 'sante';
$user = 'root';
$pass = '';

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    exit();
}

// Vérifier si l'ID du médecin est passé dans l'URL
if (isset($_GET['id'])) {
    $id_medecin = $_GET['id'];

    // Récupérer les informations du médecin
    $stmt = $pdo->prepare("SELECT * FROM medecin WHERE id_medecin = ?");
    $stmt->execute([$id_medecin]);
    $medecin = $stmt->fetch();

    if (!$medecin) {
        echo "Médecin non trouvé.";
        exit();
    }
} else {
    echo "Aucun médecin spécifié.";
    exit();
}

// Mise à jour des informations du médecin
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $specialite = $_POST['specialite'];
    $region = $_POST['region'];
    $telephone = $_POST['telephone'];
    $dates_disponibles = $_POST['dates_disponibles'];

    // Mise à jour dans la base de données
    $stmt = $pdo->prepare("UPDATE medecin SET Nom = ?, specialite = ?, Region = ?, telephone = ?, dates_disponibles = ? WHERE id_medecin = ?");
    $stmt->execute([$nom, $specialite, $region, $telephone, $dates_disponibles, $id_medecin]);

    // Redirection vers la page AfficherPublication.php après la mise à jour
    header("Location: AfficherPublication.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Médecin</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Bootstrap Datepicker CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <!-- jQuery et Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap Datepicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center">Modifier Médecin</h1>
        <form action="modifier_medecin.php?id=<?php echo htmlspecialchars($id_medecin); ?>" method="POST">
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo htmlspecialchars($medecin['Nom']); ?>" required>
            </div>
            
            <!-- Spécialité (liste déroulante) -->
            <div class="form-group">
                <label for="specialite">Spécialité :</label>
                <select id="specialite" name="specialite" class="form-control" required>
                    <option value="" disabled selected>Choisir une spécialité</option>
                    <option value="generaliste" <?php echo ($medecin['specialite'] == 'generaliste') ? 'selected' : ''; ?>>Généraliste</option>
                    <option value="gynécologue" <?php echo ($medecin['specialite'] == 'gynécologue') ? 'selected' : ''; ?>>Gynécologue</option>
                    <option value="cardiologue" <?php echo ($medecin['specialite'] == 'cardiologue') ? 'selected' : ''; ?>>Cardiologue</option>
                    <option value="dermatologue" <?php echo ($medecin['specialite'] == 'dermatologue') ? 'selected' : ''; ?>>Dermatologue</option>
                    <option value="pédiatre" <?php echo ($medecin['specialite'] == 'pédiatre') ? 'selected' : ''; ?>>Pédiatre</option>
                    <option value="orthopédiste" <?php echo ($medecin['specialite'] == 'orthopédiste') ? 'selected' : ''; ?>>Orthopédiste</option>
                    <!-- Ajoutez d'autres spécialités si nécessaire -->
                </select>
            </div>
            
            <!-- Région (liste déroulante) -->
            <div class="form-group">
                <label for="region">Région :</label>
                <select id="region" name="region" class="form-control" required>
                    <option value="" disabled selected>Choisir une région</option>
                    <option value="nantes" <?php echo ($medecin['Region'] == 'nantes') ? 'selected' : ''; ?>>Nantes</option>
                    <option value="limoges" <?php echo ($medecin['Region'] == 'limoges') ? 'selected' : ''; ?>>Limoges</option>
                    <option value="lyon" <?php echo ($medecin['Region'] == 'lyon') ? 'selected' : ''; ?>>Lyon</option>
                    <option value="paris" <?php echo ($medecin['Region'] == 'paris') ? 'selected' : ''; ?>>Paris</option>
                    <!-- Ajoutez d'autres régions si nécessaire -->
                </select>
            </div>
            
            <div class="form-group">
                <label for="telephone">Téléphone :</label>
                <input type="text" class="form-control" id="telephone" name="telephone" value="<?php echo htmlspecialchars($medecin['telephone']); ?>" required>
            </div>
            <div class="form-group">
                <label for="dates_disponibles">Dates Disponibles :</label>
                <input type="text" class="form-control" id="dates_disponibles" name="dates_disponibles" value="<?php echo htmlspecialchars($medecin['dates_disponibles']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        </form>
    </div>

    <!-- Script pour le Datepicker avec sélection multiple -->
    <script>
    $(document).ready(function() {
        $('#dates_disponibles').datepicker({
            format: "yyyy-mm-dd", // Format de la date
            multidate: true, // Permet la sélection de plusieurs dates
            todayHighlight: true, // Surligne la date actuelle
            clearBtn: true // Bouton pour effacer les dates sélectionnées
        });
    });
    </script>
</body>
</html>
