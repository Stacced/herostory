<?php
require 'functions.php';

$historyStep = filter_input(INPUT_POST, 'choice', FILTER_SANITIZE_STRING);
echo $historyStep;
$historyValidate = filter_input(INPUT_POST, 'validate', FILTER_SANITIZE_STRING);
$historyTexts = array( // Struct => array(
                       //           - array(headerText, questionText, leftImageLink, rightImageLink, leftText, rightText, leftChoice, rightChoice)
                       //           );
    "greetings" => ["Bienvenue sur HeroStory !", "A chaque question, il vous sera proposé deux choix."
        . " Vos choix auront un impact sur la fin de l'histoire !", null, null, null, null, null, null],
    
    "start" => ["Question numéro 1", "Vous êtes tombé dans un puits. Après vous être remis de vos émotions,"
        . " vous remarquez une corde posée sur une pierre, et l'entrée d'un tunnel. "
        . "Que faites-vous ?", "corde", "tunnel", "Vous escaladez", "Vous continuez dans le tunnel", "corde", "tunnel"],
    
    "corde" => [ "Vous avez choisi d'escalader", "Après être tombé plusieurs fois, vous réussissez à remonter."
        .  " Vous trouvez un vélo rouillé mais avec des pneus gonflés, et une trotinette" ]
);

if (!isset($historyStep) && !isset($historyValidate)) {
    $historyStep = "greetings";
} else if (!isset($historyStep)) {
    $historyStep = "start";
}

$questionHeaderText = $historyTexts[$historyStep][0];
$questionText = $historyTexts[$historyStep][1];

$leftImage = $historyTexts[$historyStep][2];
$rightImage = $historyTexts[$historyStep][3];

$leftText = $historyTexts[$historyStep][4];
$rightText = $historyTexts[$historyStep][5];

$leftChoice = $historyTexts[$historyStep][6];
$rightChoice = $historyTexts[$historyStep][7];
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
            <form action="index.php" method="POST">
                <?php
                if (isset($leftImage) && isset($rightImage)) {
                    echo "<img style='margin-right: 30px' src='img/" . $leftImage . ".jpg' alt='left image'>";
                    echo "<img style='margin-left: 30px' src='img/" . $rightImage . ".jpg' alt='right image'>";
                    echo "<br>";
                    echo "<input type=radio name='choice' value='$leftChoice'>$leftText";
                    echo "<input type=radio name='choice' value='$rightChoice'>$rightText";
                    echo "<br>";
                }
                echo "<input type=submit name='validate' value='Continuer'>";
                ?>
            </form>
        </div>
    </body>
</html>