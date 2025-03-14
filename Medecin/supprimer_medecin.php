<?php
// Connexion à la base de données (même code que précédemment)
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
    echo json_encode(['success' => false, 'message' => 'Erreur de connexion à la base de données.']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_medecin'])) {
    $id_medecin = $_POST['id_medecin'];

    // Préparez et exécutez la requête de suppression
    $sql = "DELETE FROM medecin WHERE id_medecin = :id_medecin";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_medecin', $id_medecin, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Médecin supprimé avec succès.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de la suppression du médecin.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Requête invalide.']);
}
?>
