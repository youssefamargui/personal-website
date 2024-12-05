<?php
$etudiant = array(
    'nom' => ' AMARGUI ',
    'prenom' => 'Youssef',
    'matricule' => '20041026',
    'note' => 20,
);
echo "Nom : " . $etudiant['nom'] . "<br>";
echo "Prénom : " . $etudiant['prenom'] . "<br>";
echo "Matricule : " . $etudiant['matricule'] . "<br>";
echo "Note : " . $etudiant['note'] . "<br>";
$produit = [
    'Produit1' => ["nom" =>"Chaussures","prix" => 1000],
    'Produit2' => ["nom" =>"vetement","prix" =>2000],
    'Produit3' => ["nom" =>"telephone","prix" =>1400]
];
foreach($produit as $produit){
    echo "Nom :" . $produit['nom'] . ", Prix : " . $produit['prix'] . "MAD<br>";
}
$etudiants = [
    "Bouras" => 15,
    "fatima" => 18,
    "yassine" => 12,
    "Hicham" => 17,
    "taha" => 19
];

$totalScores = array_sum($etudiants);
$nomberEtudiants = count($etudiants);
$moyenne = $totalScores / $nomberEtudiants;
echo "<h4>Scores des étudiants :</h4>";
foreach ($etudiants as $nom => $score) {
    echo "Etudiant : $nom, Score : $score<br>";
}
echo "Moyenne des scores :" . number_format($moyenne,2);
echo "<br>";
$pays = [
    "Maroc" => 1277268,
    "France" => 12753552,
    "etats-unis" => 12873162376,
    "Allemagne" => 1762376736600,
    "Espagne" => 761266216
    ];
arsort ($pays);
echo "<h4>Pays avec l'ordre decroissant de population :</h4>";
foreach ($pays as $nomPays => $population) {
    echo "pays : $nomPays - Population :" .number_format($population,2)." millions<br>";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>formulaire</h2>
    <form method="POST">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" required><br><br>
        
        <label for="age">age:</label>
        <input type="number" id="age" name="age" required><br><br>

        <button type ="submit">Envoyer</button>
        </form>
    <h3>Resultat</h3>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if (isset($_POST["nom"]) && isset($_POST["age"])) {
                $nom = $_POST["nom"]; 
                $age = $_POST["age"];

            }
            if ($age && $age > 0) {
                echo "bienvenue, $nom, vous avez $age ans.";
            } else {
                echo "Erreur : l'age doit etre un entier supérieur à 0";
            }
        }  
    ?>
<hr>
<h2>Choisir une couleur préférée</h2>
<form method="POST">
<label for="couleur">Couleur préférée :</label>
        <select name="couleur" id="couleur">
            <option value="rouge">Rouge</option>
            <option value="vert">Vert</option>
            <option value="bleu">Bleu</option>
        </select><br><br>
        <button type="submit" name="submit_couleur">Envoyer</button>
    </form>
    <?php
    if (isset($_POST['submit_couleur'])) {
        $couleur = $_POST["couleur"];
        echo "Votre couleur préférée est : $couleur";
    }
    ?>
</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculer la Somme</title>
</head>
<body>
    <h2>Calculer la Somme de Deux Nombres</h2>
    <form method="GET">
        <label for="nombre1">Premier nombre :</label>
        <input type="number" name="nombre1" id="nombre1" required><br><br>
        <label for="nombre2">Deuxième nombre :</label>
        <input type="number" name="nombre2" id="nombre2" required><br><br>
        <button type="submit" name="submit_somme">Calculer</button>
    </form>
    <?php
    if (isset($_GET['submit_somme'])) {
        $nombre1 = $_GET["nombre1"];
        $nombre2 = $_GET["nombre2"];

        $somme = $nombre1 + $nombre2;
        echo "La somme de $nombre1 et $nombre2 est : $somme";
    }
    ?>
</body>
</html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choisir un Type de Compte</title>
</head>
<body>
    <h2>Choisissez votre type de compte</h2>
    <form method="POST">
        <label for="compte">Type de compte :</label>
        <select name="compte" id="compte">
            <option value="administrateur">Administrateur</option>
            <option value="utilisateur">Utilisateur</option>
        </select><br><br>
        <button type="submit" name="submit_compte">Envoyer</button>
    </form>
    <?php
    if (isset($_POST['submit_compte'])) {
        $compte = $_POST["compte"];  
        if ($compte == "administrateur") {
            echo "<p>Bienvenue, administrateur ! Vous avez les droits d'accès complets.</p>";
        } elseif ($compte == "utilisateur") {
            echo "<p>Bienvenue, utilisateur simple ! Accès limité activé.</p>";
        } else {
            echo "<p>Erreur : Type de compte non reconnu.</p>";
        }
    }
    ?>
</body>
</html>
