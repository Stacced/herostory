<?php
session_start();
require 'functions.php';

$historyStep = 0; // 0 => loaded site for 1st time ; 1 => first question and so on
$historyTexts = array( // Struct => array(
                       //           - array(headerText, questionText, leftImageLink, rightImageLink)
                       //           );
    array("Bienvenue sur HeroStory !", "A chaque question, il vous sera proposé deux choix."
        . " Vos choix auront un impact sur la fin de l'histoire !"),
    array("Question numéro 1", "Vous êtes tombé dans un puits. Après vous être remis de vos émotions,"
        . " vous remarquez une corde posée sur une pierre, et l'entrée d'un tunnel. "
        . "Que faites-vous ?", "img/corde.jpg", "img/tunnel.jpg")
);
        
if (!isset($_SESSION['startedHistory'])) {
    $_SESSION['startedHistory'] = true;
    $_SESSION['historyStep'] = 0;
    $historyStep = $_SESSION['historyStep'];
} else {
    $_SESSION['historyStep']++;
    $historyStep = $_SESSION['historyStep'];
}

$questionHeaderText = $historyTexts[$historyStep][0];
$questionText = $historyTexts[$historyStep][1];

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>HeroStory | PHP Project</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id="idQuestion">
            <h2><?= $questionHeaderText ?></h2>
            <h3><?= $questionText ?></h3>
            <?php
            if (isset($historyTexts[$historyStep][2]) && isset($historyTexts[$historyStep][3])) {
                echo "<img src='" . $historyTexts[$historyStep][2] . "' alt='left image'>";
                echo "<img src='" . $historyTexts[$historyStep][3] . "' alt='right image'>";
            }
            ?>
        </div>
    </body>
</html>