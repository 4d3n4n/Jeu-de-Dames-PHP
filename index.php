<?php
$plateau = array(array());
$deplacement = '';
$pionRow = null;
$pionColumn = null;

// Player 1
$p1 = '';
$compteurP1 = 0;
$tempComptP1 = 0;

// Player 2
$p2 = '';
$compteurP2 = 0;
$tempComptP2 = 0;

$joueurEnJeu = '';
$coordonneesPion = null;
$hautGauche = null;
$hautDroite = null;
$basGauche = null;
$basDroite = null;
$play = "N";



function customPion() {
    global $p1, $p2;
    $p1 = readline('Choisir une lettre ou un charactere speciale pour les pions blanc: ');
    while (strlen($p1) > 1) {
        echo "\n";
        echo "Erreur! Saisir une seule lettre ou un seul charactere speciale\n";
        echo "\n";
        $p1 = readline('Choisir une lettre ou un charactere speciale pour les pions blanc: ');
    }

    $p2 = readline('Choisir une lettre ou un charactere speciale pour les pions noir: ');
    while (strlen($p2) > 1) {
        echo "\n";
        echo "Erreur! Saisir une seule lettre ou un seul charactere speciale\n";
        echo "\n";
        $p2 = readline('Choisir une lettre ou un charactere speciale pour les pions noir: ');
    }
}

customPion();


function pionsBlancs() {
    global $plateau, $p1;
    $plateau[1][1] = '[ ]'; $plateau[1][2] = '[' . $p1 . ']'; $plateau[1][3] = '[ ]'; $plateau[1][4] = '[' . $p1 . ']'; $plateau[1][5] = '[ ]'; $plateau[1][6] = '[' . $p1 . ']'; $plateau[1][7] = '[ ]'; $plateau[1][8] = '[' . $p1 . ']';
    $plateau[2][1] = '[' . $p1 . ']'; $plateau[2][2] = '[ ]'; $plateau[2][3] = '[' . $p1 . ']'; $plateau[2][4] = '[ ]'; $plateau[2][5] = '[' . $p1 . ']'; $plateau[2][6] = '[ ]'; $plateau[2][7] = '[' . $p1 . ']'; $plateau[2][8] = '[ ]';
    $plateau[3][1] = '[ ]'; $plateau[3][2] = '[' . $p1 . ']'; $plateau[3][3] = '[ ]'; $plateau[3][4] = '[' . $p1 . ']'; $plateau[3][5] = '[ ]'; $plateau[3][6] = '[' . $p1 . ']'; $plateau[3][7] = '[ ]'; $plateau[3][8] = '[' . $p1 . ']';
}


function plateau() {
    global $plateau;
    for ($i = 0; $i < 9; $i++) {
        for ($j = 0; $j < 9; $j++) {
            $plateau[$i][$j] = '[ ]';
        }
    }
}


function pionsNoires() {
    global $plateau, $p2;
    $plateau[6][1] = '[' . $p2 . ']'; $plateau[6][2] = '[ ]'; $plateau[6][3] = '[' . $p2 . ']'; $plateau[6][4] = '[ ]'; $plateau[6][5] = '[' . $p2 . ']'; $plateau[6][6] = '[ ]'; $plateau[6][7] = '[' . $p2 . ']'; $plateau[6][8] = '[ ]';
    $plateau[7][1] = '[ ]'; $plateau[7][2] = '[' . $p2 . ']'; $plateau[7][3] = '[ ]'; $plateau[7][4] = '[' . $p2 . ']'; $plateau[7][5] = '[ ]'; $plateau[7][6] = '[' . $p2 . ']'; $plateau[7][7] = '[ ]'; $plateau[7][8] = '[' . $p2 . ']';
    $plateau[8][1] = '[' . $p2 . ']'; $plateau[8][2] = '[ ]'; $plateau[8][3] = '[' . $p2 . ']'; $plateau[8][4] = '[ ]'; $plateau[8][5] = '[' . $p2 . ']'; $plateau[8][6] = '[ ]'; $plateau[8][7] = '[' . $p2 . ']'; $plateau[8][8] = '[ ]';
}

function indicesPlateau() {
    global $plateau;
    $plateau[0][0] = '(#)';
    
    $plateau[0][1] = '{1}'; $plateau[0][2] = '{2}'; $plateau[0][3] = '{3}'; $plateau[0][4] = '{4}'; $plateau[0][5] = '{5}'; $plateau[0][6] = '{6}'; $plateau[0][7] = '{7}'; $plateau[0][8] = '{8}';
    $plateau[1][0] = '{1}'; $plateau[2][0] = '{2}'; $plateau[3][0] = '{3}'; $plateau[4][0] = '{4}'; $plateau[5][0] = '{5}'; $plateau[6][0] = '{6}'; $plateau[7][0] = '{7}'; $plateau[8][0] = '{8}';
}

function plateauEtPions() {
    plateau();
    pionsBlancs();
    pionsNoires();
    indicesPlateau();
}

plateauEtPions();

function afficherPlateau() {
    global $plateau;
    for ($i = 0; $i < 9; $i++) {
        echo "\n";
        for ($j = 0; $j < 9; $j++) {
            echo $plateau[$i][$j] . '  ';
        }
        echo "\n";
    }
    echo "\n";
}


function tour() {
    global $joueurEnJeu, $p1, $p2;
    $joueurEnJeu = '[' . readline('Choisir quelle joueur commence (' . $p1 . ': blanc / ' . $p2 . ': noir): ') . ']';

    while ($joueurEnJeu !== '[' . $p1 . ']' && $joueurEnJeu !== '[' . $p2 . ']') {
        echo "\n";
        echo "Erreur! Saisir un des 2 joueurs possibles ($p1 ou $p2)\n";
        $joueurEnJeu = '[' . readline('CHoisir quelle joueur commence (' . $p1 . ': blanc / ' . $p2 . ': noir): ') . ']';
    }
}

tour();

afficherPlateau();

function directionUpdate() {
    global $plateau, $pionRow, $pionColumn, $hautGauche, $hautDroite, $basGauche, $basDroite;
    $hautGauche = $plateau[$pionRow - 1][$pionColumn - 1];
    $hautDroite = $plateau[$pionRow - 1][$pionColumn + 1];
    $basGauche = $plateau[$pionRow + 1][$pionColumn - 1];
    $basDroite = $plateau[$pionRow + 1][$pionColumn + 1];
}

function choixPion() {
    global  $plateau, $pionRow, $pionColumn, $coordonneesPion, $joueurEnJeu,
            $compteurP1, $compteurP2, $tempComptP1, $tempComptP2;

    $pionRow = readline('Entrez le numero de la ligne du pion: ');
    $pionColumn = readline('Entrez le numero de la colonne du pion: ');

    $coordonneesPion = $plateau[$pionRow][$pionColumn];
    directionUpdate();

    if ($coordonneesPion !== $joueurEnJeu) {
        do {
            echo "\n";
            echo "la cellule chosie ne contiens pas de pion, resaisir!\n";
            echo "\n";
            $pionRow = readline('Entrez le numero de la ligne du pion: ');
            $pionColumn = readline('Entrez le numero de la colonne du pion: ');
            $coordonneesPion = $plateau[$pionRow][$pionColumn];
            directionUpdate();
        } while ($coordonneesPion !== $joueurEnJeu);
    }

    $tempComptP1 = $compteurP1;
    $tempComptP2 = $compteurP2;
}

choixPion();


function typeDeplacement() {
    global $deplacement;
    echo "\n";
    $deplacement = readline('Entrez le deplacement que vous voulez effectuer (1: en haut à gauche / 2: en haut à droite / 3: en bas à gauche / 4: en bas à droite): ');
}


function controleDeSaisie() {
    global $deplacement;
    typeDeplacement();

    if (!ctype_digit($deplacement) || !in_array($deplacement, ['1', '2', '3', '4'])) {
        do {
            echo "\n";
            echo "Erreur! Saisir un des 4 deplacement possibles (1 - 2 - 3 - 4)\n";
            echo "\n";
            typeDeplacement();
        } while (!ctype_digit($deplacement) || !in_array($deplacement, ['1', '2', '3', '4']));
    }
}

controleDeSaisie();


function messageErreur() {
    echo "\n";
    echo "Erreur! il n'est pas possible deplacer le pions dans cette case. Resaisir le pions et son deplacement!\n";
    echo "\n";
}

function erreurSaisieCordonnee() {
    global  $compteurP1, $compteurP2, $tempComptP1, $tempComptP2;
    if ($compteurP1 > $tempComptP1 || $compteurP2 > $tempComptP2) {
        echo "\n";
        echo "Erreur! il n'est pas possible deplacer le pions dans cette case. Resaisir son deplacement!\n";
        echo "\n";
        directionUpdate();
        controleDeSaisie();
        deplacements();
    } else {
        messageErreur();
        choixPion();
        controleDeSaisie();
        deplacements();
    }
}

function gagnePoint() {
    global $compteurP1, $compteurP2, $joueurEnJeu, $p1, $p2;
    if ($joueurEnJeu == '[' . $p1 . ']') {
        $compteurP1++;
    } elseif ($joueurEnJeu == '[' . $p2 . ']') {
        $compteurP2++;
    }
}


function deplacements() {
    global $deplacement, $hautGauche, $hautDroite,
            $basGauche, $basDroite, $plateau, $pionRow, $pionColumn, $joueurEnJeu,
            $compteurP1, $compteurP2, $tempComptP1, $tempComptP2;

    if ($deplacement == 1) {
        if ($pionRow - 1 > 0 && $pionColumn - 1 > 0 && $hautGauche == '[ ]') {
            $plateau[$pionRow][$pionColumn] = '[ ]';
            $plateau[$pionRow - 1][$pionColumn - 1] = $joueurEnJeu;
            $tempComptP1 = $compteurP1;
            $tempComptP2 = $compteurP2;
            afficherPlateau();
        } elseif    ($pionRow - 2 > 0 && $pionColumn - 2 > 0 &&
                    ($hautGauche != '[' . $joueurEnJeu . ' ]' && $hautGauche != '[ ]') &&
                    ($plateau[$pionRow - 2][$pionColumn - 2] == '[ ]')) {
            $plateau[$pionRow][$pionColumn] = '[ ]';
            $plateau[$pionRow - 1][$pionColumn - 1] = '[ ]';
            $plateau[$pionRow - 2][$pionColumn - 2] = $joueurEnJeu;
            $pionRow = $pionRow - 2;
            $pionColumn = $pionColumn - 2;
            afficherPlateau();
            gagnePoint();
        } else {
            erreurSaisieCordonnee();
        }
    } elseif ($deplacement == 2) {
        if ($pionRow - 1 > 0 && $pionColumn + 1 < 9 && $hautDroite == '[ ]') {
            $plateau[$pionRow][$pionColumn] = '[ ]';
            $plateau[$pionRow - 1][$pionColumn + 1] = $joueurEnJeu;
            $tempComptP1 = $compteurP1;
            $tempComptP2 = $compteurP2;
            afficherPlateau();
        } elseif    ($pionRow - 2 > 0 && $pionColumn + 2 < 9 &&
                    ($hautDroite != '[' . $joueurEnJeu . ' ]' && $hautDroite != '[ ]') &&
                    ($plateau[$pionRow - 2][$pionColumn + 2] == '[ ]')) {
            $plateau[$pionRow][$pionColumn] = '[ ]';
            $plateau[$pionRow - 1][$pionColumn + 1] = '[ ]';
            $plateau[$pionRow - 2][$pionColumn + 2] = $joueurEnJeu;
            $pionRow = $pionRow - 2;
            $pionColumn = $pionColumn + 2;
            afficherPlateau();
            gagnePoint();
        } else {
            erreurSaisieCordonnee();
        }
    } elseif ($deplacement == 3) {
        if ($pionRow + 1 < 9 && $pionColumn - 1 > 0 && $basGauche == '[ ]') {
            $plateau[$pionRow][$pionColumn] = '[ ]';
            $plateau[$pionRow + 1][$pionColumn - 1] = $joueurEnJeu;
            $tempComptP1 = $compteurP1;
            $tempComptP2 = $compteurP2;
            afficherPlateau();
        } elseif    ($pionRow + 2 < 9 && $pionColumn - 2 > 0 &&
                    ($basGauche != '[' . $joueurEnJeu . ' ]' && $basGauche != '[ ]') &&
                    ($plateau[$pionRow + 2][$pionColumn - 2] == '[ ]')) {
            $plateau[$pionRow][$pionColumn] = '[ ]';
            $plateau[$pionRow + 1][$pionColumn - 1] = '[ ]';
            $plateau[$pionRow + 2][$pionColumn - 2] = $joueurEnJeu;
            $pionRow = $pionRow + 2;
            $pionColumn = $pionColumn - 2;
            afficherPlateau();
            gagnePoint();
        } else {
            erreurSaisieCordonnee();
        }
    } elseif ($deplacement == 4) {
        if ($pionRow + 1 < 9 && $pionColumn + 1 < 9 && $basDroite == '[ ]') {
            $plateau[$pionRow][$pionColumn] = '[ ]';
            $plateau[$pionRow + 1][$pionColumn + 1] = $joueurEnJeu;
            $tempComptP1 = $compteurP1;
            $tempComptP2 = $compteurP2;
            afficherPlateau();
        } elseif    ($pionRow + 2 < 9 && $pionColumn + 2 < 9 &&
                    ($basDroite != '[' . $joueurEnJeu . ' ]' && $basDroite != '[ ]') &&
                    ($plateau[$pionRow + 2][$pionColumn + 2] == '[ ]')) {
            $plateau[$pionRow][$pionColumn] = '[ ]';
            $plateau[$pionRow + 1][$pionColumn + 1] = '[ ]';
            $plateau[$pionRow + 2][$pionColumn + 2] = $joueurEnJeu;
            $pionRow = $pionRow + 2;
            $pionColumn = $pionColumn + 2;
            afficherPlateau();
            gagnePoint();
        } else {
            erreurSaisieCordonnee();
        }
    }
}

deplacements();



function nextPlayer() {
    global  $joueurEnJeu, $p1, $p2, $compteurP1, $compteurP2, $tempComptP1,
            $tempComptP2;
    if ($joueurEnJeu == '[' .  $p1 . ']') {
        echo "Le joueur blanc ($p1) a $compteurP1 points\n";
        echo "Le joueur noir ($p2) a $compteurP2 points\n";
        if ($compteurP1 > $tempComptP1) {
            $joueurEnJeu = '[' . $p1 . ']';
            echo "\n";
            echo "+1 point le joueur blanc ($p1)! c'est toujours à lui de jouer\n";

            // Mise à jours des positions afin de pouvoir manger plusieurs pions
            // Je mettais à jour le tableau avec les nouvelles positions du pion mais cela ne marchais pas
            directionUpdate();
            controleDeSaisie();
            deplacements();
            } else {
            $joueurEnJeu = '[' . $p2 . ']';
            echo "\n";
            echo "C'est au tour du joueur noir ($p2)!\n";
            choixPion();
            controleDeSaisie();
            deplacements();
        }
    } elseif ($joueurEnJeu == '[' .  $p2 . ']') {
        echo "Le joueur blanc ($p1) a $compteurP1 points\n";
        echo "Le joueur noir ($p2) a $compteurP2 points\n";
        if ($compteurP2 > $tempComptP2) {
            $joueurEnJeu = '[' . $p2 . ']';
            echo "\n";
            echo "+1 point le joueur blanc ($p2)! c'est toujours à lui de jouer\n";

            // Mise à jours des positions afin de pouvoir manger plusieurs pions
            // Je mettais à jour le tableau avec les nouvelles positions du pion mais cela ne marchais pas
            directionUpdate();
            controleDeSaisie();
            deplacements();
        } else {
            $joueurEnJeu = '[' . $p1 . ']';
            echo "\n";
            echo "C'est au tour du joueur blanc ($p1)!\n";
            choixPion();
            controleDeSaisie();
            deplacements();
        }
    }
}

nextPlayer();



function playAgain() {
    global $play, $compteurP1, $compteurP2;

    $play = readline( "Voulez-vous rejouer? (O/N): ");
    echo "\n";

    while ($play !== 'O' && $play !== 'N') {
        echo "\n";
        echo "Erreur! Saisir O ou N\n";
        $play = readline( "Voulez-vous rejouer? (O/N): ");
    }

    if ($play == 'O') {
        $compteurP1 = 0;
        $compteurP2 = 0;
        customPion();
        plateauEtPions();
        afficherPlateau();
        tour();
        choixPion();
        controleDeSaisie();
        deplacements();
        nextPlayer();
        endGame();
        playAgain(); //recursive
    } else {
        echo "\n";
        echo "Merci d'avoir joué!\n";
        echo "\n";
    }
}



function endGame() {
    global $compteurP1, $compteurP2, $p1, $p2;

    while ($compteurP1 < 12 && $compteurP2 < 12) {
        nextPlayer();
    }

    if ($compteurP1 == 12) {
        echo "\n";
        echo "Le joueur blanc ($p1) a gagné!\n";
        echo "\n";
        playAgain();
    } elseif ($compteurP2 == 12) {
        echo "\n";
        echo "Le joueur noir ($p2) a gagné!\n";
        echo "\n";
        playAgain();
    }
}

endGame();
?>
