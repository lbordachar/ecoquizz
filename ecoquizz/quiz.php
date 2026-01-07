<?php
// Démarrer la session pour sauvegarder les réponses
session_start();

// Liste des 10 questions du quiz
$questions = array(
    1 => array(
        'question' => 'Combien de fois par semaine utilisez-vous une voiture personnelle ?',
        'reponses' => array(
            'A' => array('texte' => 'Jamais, j\'utilise les transports en commun ou le vélo', 'points' => 10),
            'B' => array('texte' => '1 à 2 fois par semaine', 'points' => 7),
            'C' => array('texte' => '3 à 5 fois par semaine', 'points' => 4),
            'D' => array('texte' => 'Tous les jours', 'points' => 1)
        )
    ),
    2 => array(
        'question' => 'Quelle est votre consommation de viande ?',
        'reponses' => array(
            'A' => array('texte' => 'Je suis végétalien(ne)', 'points' => 10),
            'B' => array('texte' => 'Je suis végétarien(ne)', 'points' => 8),
            'C' => array('texte' => 'Quelques fois par semaine', 'points' => 5),
            'D' => array('texte' => 'Tous les jours', 'points' => 2)
        )
    ),
    3 => array(
        'question' => 'Comment gérez-vous vos déchets ?',
        'reponses' => array(
            'A' => array('texte' => 'Je trie et composte systématiquement', 'points' => 10),
            'B' => array('texte' => 'Je trie mes déchets recyclables', 'points' => 7),
            'C' => array('texte' => 'Je trie de temps en temps', 'points' => 4),
            'D' => array('texte' => 'Je ne trie pas', 'points' => 1)
        )
    ),
    4 => array(
        'question' => 'Quelle est votre consommation d\'eau ?',
        'reponses' => array(
            'A' => array('texte' => 'Je fais très attention (douches courtes, récupération d\'eau)', 'points' => 10),
            'B' => array('texte' => 'Je fais attention', 'points' => 7),
            'C' => array('texte' => 'Consommation normale', 'points' => 4),
            'D' => array('texte' => 'Je ne fais pas attention', 'points' => 1)
        )
    ),
    5 => array(
        'question' => 'Où achetez-vous vos produits alimentaires ?',
        'reponses' => array(
            'A' => array('texte' => 'Producteurs locaux et bio', 'points' => 10),
            'B' => array('texte' => 'Magasins bio', 'points' => 8),
            'C' => array('texte' => 'Supermarché classique', 'points' => 4),
            'D' => array('texte' => 'Supérette de proximité', 'points' => 3)
        )
    ),
    6 => array(
        'question' => 'Comment chauffez-vous votre logement ?',
        'reponses' => array(
            'A' => array('texte' => 'Énergies renouvelables', 'points' => 10),
            'B' => array('texte' => 'Chauffage économe (19-20°C)', 'points' => 7),
            'C' => array('texte' => 'Chauffage normal (21-22°C)', 'points' => 4),
            'D' => array('texte' => 'Chauffage élevé (>22°C)', 'points' => 1)
        )
    ),
    7 => array(
        'question' => 'Utilisez-vous des produits réutilisables ?',
        'reponses' => array(
            'A' => array('texte' => 'Toujours (gourde, sacs, contenants)', 'points' => 10),
            'B' => array('texte' => 'Souvent', 'points' => 7),
            'C' => array('texte' => 'Parfois', 'points' => 4),
            'D' => array('texte' => 'Jamais', 'points' => 1)
        )
    ),
    8 => array(
        'question' => 'Quelle est votre consommation de vêtements neufs ?',
        'reponses' => array(
            'A' => array('texte' => 'J\'achète principalement de seconde main', 'points' => 10),
            'B' => array('texte' => 'Très peu, seulement le nécessaire', 'points' => 8),
            'C' => array('texte' => 'Quelques pièces par saison', 'points' => 4),
            'D' => array('texte' => 'Régulièrement', 'points' => 1)
        )
    ),
    9 => array(
        'question' => 'Comment gérez-vous votre consommation électrique ?',
        'reponses' => array(
            'A' => array('texte' => 'J\'ai des panneaux solaires', 'points' => 10),
            'B' => array('texte' => 'J\'éteins tout systématiquement', 'points' => 8),
            'C' => array('texte' => 'Je fais attention', 'points' => 5),
            'D' => array('texte' => 'Consommation normale', 'points' => 2)
        )
    ),
    10 => array(
        'question' => 'Participez-vous à des actions écologiques ?',
        'reponses' => array(
            'A' => array('texte' => 'Je suis militant(e) actif(ve)', 'points' => 10),
            'B' => array('texte' => 'Je participe régulièrement', 'points' => 8),
            'C' => array('texte' => 'De temps en temps', 'points' => 5),
            'D' => array('texte' => 'Jamais', 'points' => 1)
        )
    )
);

// Initialiser
if (isset($_SESSION['numero_question']) && $_SESSION['numero_question'] > 10) {
    header('Location: resultat.php');
    exit;
}

// 2. Initialiser UNIQUEMENT si la session n'existe pas encore
// J'ai supprimé la condition "|| $_SESSION['numero_question'] > 10" qui causait le problème
if (!isset($_SESSION['numero_question'])) {
    $_SESSION['numero_question'] = 1;
    $_SESSION['reponses'] = array();
}

$numero_actuel = $_SESSION['numero_question'];

// Traiter la réponse si formulaire soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reponse'])) {
    // Sauvegarder la réponse
    $_SESSION['reponses'][$numero_actuel] = $_POST['reponse'];
    
    // Passer à la question suivante
    $_SESSION['numero_question']++;
    $numero_actuel = $_SESSION['numero_question'];
    
    // Si toutes les questions sont répondues, rediriger vers les résultats
    if ($numero_actuel > 10) {
        header('Location: ./resultat.php');
        exit;
    }
}

$question_actuelle = $questions[$numero_actuel];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz - Écoquizz</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/jpg" href="./img/logo.jpg">
</head>
<body>

    <div class="container">
        <a href="index.html" class="back-link">← Retour à l'accueil</a>
        
        <div class="quiz-card">
            <!-- Barre de progression -->
            <div class="progress-container">
                <p>Question <?php echo $numero_actuel; ?> sur 10</p>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: <?php echo ($numero_actuel / 10) * 100; ?>%"></div>
                </div>
            </div>

            <!-- Question -->
            <h2><?php echo $question_actuelle['question']; ?></h2>

            <!-- Formulaire de réponses -->
            <form method="POST">
                <?php foreach ($question_actuelle['reponses'] as $lettre => $reponse): ?>
                    <label class="radio-label">
                        <input type="radio" name="reponse" value="<?php echo $lettre; ?>" required>
                        <span><?php echo $reponse['texte']; ?></span>
                    </label>
                <?php endforeach; ?>
                
                <button type="submit" class="button button-primary">
                    <?php echo ($numero_actuel < 10) ? 'Question suivante →' : 'Voir mes résultats'; ?>
                </button>
            </form>
        </div>
    </div>

</body>
</html>