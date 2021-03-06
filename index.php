<?php
require 'functions.php';

$historyStep = filter_input(INPUT_POST, 'choice', FILTER_SANITIZE_STRING);
$historyValidate = filter_input(INPUT_POST, 'validate', FILTER_SANITIZE_STRING);
$historyTexts = array( // Struct => array(
                       //           - array(headerText, questionText, leftImageLink, rightImageLink, leftText, rightText, leftChoice, rightChoice)
                       //           );
    "greetings" => ["Bienvenue sur HeroStory !", "A chaque question, il vous sera proposé deux choix."
        . " Vos choix auront un impact sur la fin de l'histoire !", null, null, null, null, null, null
        ],

    "start" => ["Situation de départ", "Vous êtes tombé dans un puits. Après vous être remis de vos émotions,"
        . " vous remarquez une corde posée sur une pierre, et l'entrée d'un tunnel. "
        . "Que faites-vous ?", "img/corde.jpg", "img/tunnel.jpg", "Vous escaladez", "Vous continuez dans le tunnel", "corde", "tunnel"
        ],

    "corde" => [ "Vous avez choisi d'escalader", "Après être tombé plusieurs fois, vous réussissez à remonter."
        .  " Vous trouvez un vélo rouillé mais avec des pneus gonflés, et une trotinette qui semble en bon état",
        "img/velo.jpg", "img/trottinette.jpg", "Vous prenez le vélo", "Vous prenez la trottinette", "velo", "trottinette"
        ],

    "velo" => [ "Vous avez pris le vélo", "Vous avez parcouru quelques kilomètres, quand soudain le pneu avant de votre vélo crève.",
                "img/repair.jpg", "img/walk.jpg", "Vous réparez le pneu", "Vous continuez à pied", "reparer", "pied"
        ],

    "reparer" => [ "Vous avez réussi !", "C'était le bon choix ! Vous êtes rentré chez vous sans encombre.", null, null, null, null, null, null
        ],

    "pied" => [ "Vous êtes mort", "En marchant sur le côté de la route, vous vous êtes fait percuté par une voiture ! Ca vous apprendra à ne pas"
        . " marcher derrière la rambarde de sécurité !", null, null, null, null, null, null
        ],

    "trottinette" => [ "Vous avez pris la trottinette", "Vous vous apercevez que celle-ci est en train de s'endommager au fur et à mesure que vous l'utilisez.",
            "img/continue.jpg", "img/walk.jpg", "Vous continuez", "Vous abandonnez la trottinette et continuez à pied", "continuetrot", "reparer"
        ],

    "continuetrot" => [ "La trottinette casse", "Ce que vous attendiez arriva : la trottinette casse, et un bout de métal vous blesse au ventre. Vous saignez abondamment",
            "img/wait.jpg", "img/walk.jpg", "Vous attendez en espérant que quelqu'un passe", "Vous marchez le reste du chemin", "wait", "pied"
        ],

    "wait" => [ "Heureusement que vous avez attendu", "Par chance, une voiture vous voit et s'arrête, puis vous emmène à l'hôpital !", null, null, null, null, null, null
        ],

    "tunnel" => [ "Vous êtes entré dans le tunnel", "Après quelques minutes de marche, vous rencontrez votre premier obstacle : le tunnel se sépare en deux chemins."
        . " Lequel choisissez-vous ?", "img/left.png", "img/right.png", "Vous prenez le chemin de gauche", "Vous prenez le chemin de droite", "leftpath", "rightpath"
        ],
    
    "leftpath" => [ "Vous avez pris le chemin de gauche", "En marchant le long du chemin, vous remarquez une ouverture, assez grande pour que vous puissiez vous y glisser."
        . " Il semble y avoir de la lumière au bout. Que faites-vous ?", "img/opening.jpg", "img/continue.jpg", "Vous rentrez dans l'ouverture", "Vous continuez votre chemin",
        "opening", "continuewalk"
        ],
    
    "opening" => [ "Vous êtes écrasé par une roche !", "Et oui, en marchant dans cet espace étroit, vous déstabilisez la structure et une roche vous écrase... c'est dommage", null, null, null, null, null, null
        ],
    
    "continuewalk" => ["Vous avez réussi !", "Après avoir marché 30 minutes, vous arrivez à trouver la sortie. Bien joué !", null, null, null, null, null, null
        ],
    
    "rightpath" => [ "Vous avez pris le chemin de droite", "Vous voyez soudain un chemin avec de la lumière émanant au bout. Que faites-vous ?", "img/shortcut.jpg", "img/continue.jpg",
        "Vous prenez le raccourci", "Vous continuez votre chemin", "bear", "continuewalk"
        ],
    
    "bear" => [ "Vous sortez de la grotte mais...", "Vous vous faites manger par un ours qui était à proximité de la sortie. C'est dommage :p", null, null, null, null, null, null ]
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
                    echo "<div id='idImgContainer'>";
                    echo "<img id='id$leftImage' src='$leftImage' alt='$leftImage'>";
                    echo "<img id='id$rightImage' src='$rightImage' alt='$rightImage'>";
                    echo "</div>";
                    echo "<br>";

                    echo "<div id='idRadioContainer'>";
                    echo "<input type=radio id='idRadioLeft' name='choice' value='$leftChoice'><label for='idRadioLeft'>$leftText</label>";
                    echo "<input type=radio id='idRadioRight' name='choice' value='$rightChoice'><label for='idRadioRight'>$rightText</label>";
                    echo "</div>";
                    echo "<br>";
                }
                echo "<input type=submit name='validate' value='Continuer'>";
                ?>
            </form>
        </div>
    </body>
</html>
