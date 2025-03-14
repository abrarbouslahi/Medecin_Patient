<?php
// Connexion à la base de données
$host = 'localhost';
$db = 'sante'; // Nom de la base de données
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
    die('Erreur de connexion : ' . $e->getMessage());
}

// Récupérer les critères de recherche
$specialite_recherche = isset($_GET['specialite']) ? $_GET['specialite'] : '';
$region_recherche = isset($_GET['region']) ? $_GET['region'] : '';

// Initialiser les résultats de recherche
$medecins = [];

// Construction de la requête SQL uniquement si l'utilisateur a recherché
if (!empty($specialite_recherche) || !empty($region_recherche)) {
    // Construction de la requête SQL
    $sql = "SELECT * FROM medecin WHERE 1=1"; // Requête de base

    // Ajouter les conditions en fonction des critères
    if (!empty($specialite_recherche)) {
        $sql .= " AND specialite = :specialite";
    }
    if (!empty($region_recherche)) {
        $sql .= " AND region = :region";
    }

    $stmt = $pdo->prepare($sql);

    // Associer les paramètres à la requête
    if (!empty($specialite_recherche)) {
        $stmt->bindValue(':specialite', $specialite_recherche);
    }
    if (!empty($region_recherche)) {
        $stmt->bindValue(':region', $region_recherche);
    }

    // Exécuter la requête
    $stmt->execute();
    $medecins = $stmt->fetchAll(); // Récupération des résultats
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche de Médecins</title>
    <link rel="stylesheet" href="../css/AjouterMedecin.css"> <!-- Chemin vers votre fichier CSS -->
    <style>
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .card {
            border: 1px solid #007bff;
            border-radius: 8px;
            padding: 20px;
            width: 250px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .card h2 {
            font-size: 1.5em;
            color: #007bff;
            margin-bottom: 10px;
        }

        .card p {
            margin: 5px 0;
        }

        .btn {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Recherche de Médecins</h1>

        <!-- Formulaire de recherche -->
        <form action="" method="GET">
            <div class="form-group">
                <label for="specialite">Spécialité :</label>
                <select id="specialite" name="specialite">
                    <option value="">Toutes les spécialités</option>
                    <option value="generaliste">Généraliste</option>
                    <option value="gynécologue">Gynécologue</option>
                    <option value="cardiologue">Cardiologue</option>
                    <option value="dermatologue">Dermatologue</option>
                    <option value="pédiatre">Pédiatre</option>
                    <option value="orthopédiste">Orthopédiste</option>
                </select>
            </div>

            <div class="form-group">
                <label for="region">Région :</label>
                <select id="region" name="region">
                    <option value="">Toutes les régions</option>
                    <option value="nantes">Nantes</option>
                    <option value="limoges">Limoges</option>
                    <option value="lyon">Lyon</option>
                    <option value="paris">Paris</option>
                </select>
            </div>

            <button type="submit" class="btn">Rechercher</button>
        </form>

        <!-- Afficher les résultats de la recherche uniquement si des médecins sont trouvés -->
        <?php if (!empty($medecins)): ?>
            <h2>Résultats de la recherche :</h2>
            <div class="card-container">
                <?php foreach ($medecins as $medecin): ?>
                    <div class="card">
                        <h2><?php echo htmlspecialchars($medecin['nom']); ?></h2>
                        <p><strong>Spécialité :</strong> <?php echo htmlspecialchars($medecin['specialite']); ?></p>
                        <p><strong>Région :</strong> <?php echo htmlspecialchars($medecin['region']); ?></p>
                        <p><strong>Téléphone :</strong> <?php echo htmlspecialchars($medecin['telephone']); ?></p>
                        <a href="#" class="btn">Prendre rendez-vous</a> <!-- Bouton pour action supplémentaire -->
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>Aucun médecin trouvé pour les critères de recherche.</p>
        <?php endif; ?>
    </div>
</body>
</html>
