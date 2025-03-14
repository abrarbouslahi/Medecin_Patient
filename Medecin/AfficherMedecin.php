<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Icons -->
    <link rel="icon" href="../img/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="path/to/font-awesome/css/all.min.css"> <!-- Remplacez par le chemin réel -->

    <!-- CSS -->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/affichermedecin.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOM9BqL+XnP4xjbzddUOSG4FIPF6fcmc3FNBf2M" crossorigin="anonymous"></script>

    <?php
    include "navPatient.php";

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

    $specialite = isset($_POST['specialite']) ? $_POST['specialite'] : '';
    $region = isset($_POST['region']) ? $_POST['region'] : '';

    $sql = "SELECT * FROM medecin WHERE specialite LIKE :specialite AND Region LIKE :region";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':specialite' => "%$specialite%",
        ':region' => "%$region%"
    ]);
    $medecins = $stmt->fetchAll();
    ?>
</head>
<body>

<div class="container mt-4">
    <h1 class="text-center">Liste des Médecins</h1>

    <!-- Formulaire de recherche -->
    <form method="POST" class="mb-4">
        <div class="row">
            <div class="col-md-5">
                <input type="text" name="specialite" class="form-control" placeholder="Recherche par spécialité" value="<?php echo htmlspecialchars($specialite); ?>">
            </div>
            <div class="col-md-5">
                <input type="text" name="region" class="form-control" placeholder="Recherche par région" value="<?php echo htmlspecialchars($region); ?>">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Rechercher</button>
            </div>
        </div>
    </form>

    <style>
        /* Global Styles */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }

        h1 {
            color: #007bff;
            margin-bottom: 30px;
            font-weight: bold;
        }

        /* Formulaire de recherche */
        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        }

        input.form-control {
            border: 2px solid #007bff;
            border-radius: 5px;
            padding: 10px;
        }

        button.btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        button.btn-primary:hover {
            background-color: #0056b3;
        }

        /* Card Styles */
        .card.doctor-card {
            background-color: #fff;
            color: #333;
            border: none;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 20px;
        }

        .card.doctor-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.2);
        }

        .card-body.doctor-info {
            padding: 20px;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .card-title i {
            margin-right: 10px;
            color: #007bff; /* Couleur pour les icônes */
        }

        .specialty, .region, .telephone, .dates_disponibles {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
        }

        .specialty i, .region i, .telephone i, .dates_disponibles i {
            margin-right: 10px;
            color: #007bff; /* Couleur pour les icônes */
        }

        /* Button inside card */
        .btn-reserve {
            background-color: #000; /* Couleur noire pour le bouton */
            border: none;
            color: white;
            font-weight: bold;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-reserve:hover {
            background-color: #444; /* Couleur sombre au survol */
        }
    </style>

    <div class="row justify-content-center">
        <?php if (count($medecins) > 0): ?>
            <?php foreach ($medecins as $medecin): ?>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card doctor-card">
                        <div class="card-body doctor-info">
                            <h5 class="card-title">
                                <i class=""></i>
                                <?php echo htmlspecialchars($medecin['Nom']); ?>
                            </h5>
                            <p class="specialty">
                                <i class=""></i>
                                Spécialité : <?php echo htmlspecialchars($medecin['specialite']); ?>
                            </p>
                            <p class="region">
                                <i class=""></i>
                                Région : <?php echo htmlspecialchars($medecin['Region']); ?>
                            </p>
                            <p class="">
                                <i class=""></i>
                                Téléphone : <?php echo htmlspecialchars($medecin['telephone']); ?>
                            </p>
                            <p class="">
                                <i class=""></i>
                                Dates disponibles : <?php echo htmlspecialchars($medecin['dates_disponibles']); ?>
                            </p>
                            <a href="reservation.php?id_medecin=<?php echo $medecin['id_medecin']; ?>" class="btn btn-reserve">Réserver</a>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun médecin trouvé.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Font Awesome icons -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
