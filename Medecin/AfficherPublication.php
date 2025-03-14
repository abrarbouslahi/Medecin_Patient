<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="icon" href="../img/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/affichermedecin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Liste des Médecins</title>
</head>
<body>
    <?php include "nav.php"; ?>

    <div class="container mt-4">
        <h1 class="text-center">Liste des Médecins</h1>
        <div class="row justify-content-center">
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

            // Récupérer les médecins de la table 'medecin'
            $sql = "SELECT * FROM medecin";
            $stmt = $pdo->query($sql);
            $medecins = $stmt->fetchAll();

            if (count($medecins) > 0): ?>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Spécialité</th>
                            <th>Région</th>
                            <th>Téléphone</th>
                            <th>Dates Disponibles</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($medecins as $medecin): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($medecin['Nom']); ?></td>
                                <td><?php echo htmlspecialchars($medecin['specialite']); ?></td>
                                <td><?php echo htmlspecialchars($medecin['Region']); ?></td>
                                <td><?php echo htmlspecialchars($medecin['telephone']); ?></td>
                                <td><?php echo htmlspecialchars($medecin['dates_disponibles']); ?></td>
                                <td>
                                    <form id="deleteForm_<?php echo htmlspecialchars($medecin['id_medecin']); ?>" method="POST" style="display:inline;">
                                        <input type="hidden" name="id_medecin" value="<?php echo htmlspecialchars($medecin['id_medecin']); ?>">
                                        <button type="button" class="btn btn-sm btn-danger" onclick="supprimerMedecin(<?php echo htmlspecialchars($medecin['id_medecin']); ?>)">
                                            <i class="fas fa-trash"></i> Supprimer
                                        </button>
                                    </form>
                                    <a href="modifier_medecin.php?id=<?php echo htmlspecialchars($medecin['id_medecin']); ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Modifier
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Aucun médecin trouvé.</p>
            <?php endif; ?>
        </div>
    </div>

    <script>
function supprimerMedecin(id_medecin) {
    if (confirm("Êtes-vous sûr de vouloir supprimer ce médecin ?")) {
        const formData = new FormData();
        formData.append('id_medecin', id_medecin);

        fetch('supprimer_medecin.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Erreur réseau');
            }
            return response.json(); // Attendre une réponse JSON
        })
        .then(data => {
            if (data.success) {
                alert(data.message);
                window.location.reload(); // Recharger la page après suppression
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert("Une erreur s'est produite. Veuillez réessayer.");
        });
    }
}
    </script>
</body>
</html>
