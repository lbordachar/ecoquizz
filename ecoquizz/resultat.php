<?php
// Démarrer la session
session_start();

// Vérifier qu'il y a des réponses
if (!isset($_SESSION['reponses']) || empty($_SESSION['reponses'])) {
    header('Location: quiz.php');
    exit;
}

// Les points pour chaque réponse
$points = array(
    1 => array('A' => 10, 'B' => 7, 'C' => 4, 'D' => 1),
    2 => array('A' => 10, 'B' => 8, 'C' => 5, 'D' => 2),
    3 => array('A' => 10, 'B' => 7, 'C' => 4, 'D' => 1),
    4 => array('A' => 10, 'B' => 7, 'C' => 4, 'D' => 1),
    5 => array('A' => 10, 'B' => 8, 'C' => 4, 'D' => 3),
    6 => array('A' => 10, 'B' => 7, 'C' => 4, 'D' => 1),
    7 => array('A' => 10, 'B' => 7, 'C' => 4, 'D' => 1),
    8 => array('A' => 10, 'B' => 8, 'C' => 4, 'D' => 1),
    9 => array('A' => 10, 'B' => 8, 'C' => 5, 'D' => 2),
    10 => array('A' => 10, 'B' => 8, 'C' => 5, 'D' => 1)
);

// Calculer le score total
$score = 0;
foreach ($_SESSION['reponses'] as $numero => $reponse) {
    $score += $points[$numero][$reponse];
}

// Déterminer le niveau selon le score
if ($score >= 85) {
    $niveau = 'Éco-héros';
    $emoji = '🌟';
    $couleur = 'excellent';
    $description = 'Félicitations ! Vous êtes un modèle en matière d\'écologie. Votre mode de vie est exemplaire et inspirant pour votre entourage.';
    $conseil1 = 'Partagez vos bonnes pratiques avec votre entourage';
    $conseil2 = 'Rejoignez des associations écologiques locales';
    $conseil3 = 'Devenez ambassadeur du développement durable';
} elseif ($score >= 70) {
    $niveau = 'Éco-citoyen confirmé';
    $emoji = '🌱';
    $couleur = 'bon';
    $description = 'Excellent ! Vous avez adopté de nombreux gestes écologiques. Vous êtes sur la bonne voie pour un mode de vie durable.';
    $conseil1 = 'Continuez vos efforts et explorez de nouvelles pratiques';
    $conseil2 = 'Sensibilisez votre entourage à l\'écologie';
    $conseil3 = 'Participez à des initiatives locales écologiques';
} elseif ($score >= 50) {
    $niveau = 'En transition';
    $emoji = '🌿';
    $couleur = 'moyen';
    $description = 'Bien ! Vous avez commencé à adopter des habitudes écologiques. Il reste encore du potentiel pour améliorer votre impact.';
    $conseil1 = 'Privilégiez les transports en commun ou le vélo';
    $conseil2 = 'Réduisez votre consommation de viande';
    $conseil3 = 'Triez systématiquement vos déchets';
} else {
    $niveau = 'Débutant écologique';
    $emoji = '🌾';
    $couleur = 'debutant';
    $description = 'Vous débutez dans la démarche écologique. Pas de panique, chaque petit geste compte ! Notre guide vous aidera à progresser.';
    $conseil1 = 'Commencez par le tri des déchets';
    $conseil2 = 'Utilisez des sacs réutilisables';
    $conseil3 = 'Réduisez votre consommation d\'eau et d\'électricité';
}

// Bouton recommencer
if (isset($_GET['recommencer'])) {
    session_destroy();
    header('Location: quiz.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats - Écoquizz</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">
        <a href="index.html" class="back-link">← Retour à l'accueil</a>
        
        <div class="result-card">
            <div class="result-header">
                <div class="result-emoji"><?php echo $emoji; ?></div>
                <h1>Vos résultats</h1>
                <div class="badge badge-<?php echo $couleur; ?>"><?php echo $niveau; ?></div>
            </div>

            <div class="score-section">
                <p>Votre score écologique</p>
                <h2 class="score"><?php echo $score; ?> / 100</h2>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: <?php echo $score; ?>%"></div>
                </div>
            </div>

            <p class="description"><?php echo $description; ?></p>

            <div class="stats">
                <div class="stat-box">
                    <h3>🌍</h3>
                    <p>Impact environnemental</p>
                    <strong><?php echo ($score >= 70) ? 'Faible' : (($score >= 50) ? 'Modéré' : 'Élevé'); ?></strong>
                </div>
                <div class="stat-box">
                    <h3>📊</h3>
                    <p>Niveau actuel</p>
                    <strong><?php echo $niveau; ?></strong>
                </div>
                <div class="stat-box">
                    <h3>🎯</h3>
                    <p>Potentiel</p>
                    <strong><?php echo (100 - $score); ?> points</strong>
                </div>
            </div>

            <div class="recommendations">
                <h3>Recommandations personnalisées</h3>
                <ul>
                    <li>✓ <?php echo $conseil1; ?></li>
                    <li>✓ <?php echo $conseil2; ?></li>
                    <li>✓ <?php echo $conseil3; ?></li>
                </ul>
            </div>

            <div class="result-actions">
                <a href="?recommencer=1" class="button button-secondary">Refaire le quiz</a>
                <a href="guide.html" class="button button-primary">Voir le guide pratique</a>
            </div>
        </div>
    </div>

</body>
</html>
