<?php
$employes = [
    ["nom" => "mohamed", "poste" => "Développeur", "salaire" => 4500],
    ["nom" => "zitouni", "poste" => "réseaux", "salaire" => 4000],
    ["nom" => "Youssef", "poste" => "Ingenieur", "salaire" => 4800],
    ["nom" => "omar", "poste" => "Comptable", "salaire" => 6000],
    ["nom" => "hicham", "poste" => "Technicien", "salaire" => 3500]
];
function calculerSalaire($employes) {
    $sommeSalaire = 0;
    $nombreEmployes = count($employes);

    foreach ($employes as $employe) {
        $sommeSalaire += $employe["salaire"];
    }

    $salaireMoyen = $sommeSalaire / $nombreEmployes;
    return $salaireMoyen;
}
echo "Informations des employés :<br>";
foreach ($employes as $employe) {
    echo "Nom : " . $employe["nom"] . " | Poste : " . $employe["poste"] . " | Salaire : " . $employe["salaire"] . " MAD<br>";
}
$salaireMoyen = calculerSalaire($employes);
echo "<br>Salaire moyen des employés : " . number_format($salaireMoyen, 2) . " MAD";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche Employé</title>
</head>
<body>
    <h1>Recherche d'un employé</h1>
    <form method="POST">
        <label for="nom">Entrez le nom de l'employé :</label>
        <input type="text" id="nom" name="nom" required>
        <button type="submit">Rechercher</button>
    </form>

    <?php
    $employes = [
        ["nom" => "mohamed", "poste" => "Développeur", "salaire" => 4500],
        ["nom" => "zitouni", "poste" => "réseaux", "salaire" => 4000],
        ["nom" => "Youssef", "poste" => "Ingenieur", "salaire" => 4800],
        ["nom" => "omar", "poste" => "Comptable", "salaire" => 6000],
        ["nom" => "hicham", "poste" => "Technicien", "salaire" => 3500]
    ];

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nomRecherche = trim($_POST["nom"]); 
        $trouve = false;

        foreach ($employes as $employe) {
            if (strcasecmp($employe["nom"], $nomRecherche) === 0) {
                echo "<h2>Résultat de la recherche :</h2>";
                echo "Nom : " . $employe["nom"] . "<br>";
                echo "Poste : " . $employe["poste"] . "<br>";
                echo "Salaire : " . $employe["salaire"] . " MAD<br>";
                $trouve = true;
                break;
            }
        }

        if (!$trouve) {
            echo "<h2>Aucun employé trouvé avec le nom : " . htmlspecialchars($nomRecherche) . "</h2>";
        }
    }
    ?>
</body>
</html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Connexion</title>
</head>
<body>
    <h1>Connexion</h1>
    <form method="POST">
        <label for="email">Email :</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Mot de passe :</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">Se connecter</button>
    </form>

    <?php
    
    $utilisateurs = [
        ["email" => "mohamed@example.com", "password" => "12345"],
        ["email" => "zitouni@example.com", "password" => "12345"],
        ["email" => "youssef@example.com", "password" => "12345"],
        ["email" => "omar@example.com", "password" => "12345"],
        ["email" => "hicham@example.com", "password" => "12345"]
    ];

    
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);
        $connexionReussie = false;

        foreach ($utilisateurs as $utilisateur) {
            if ($utilisateur["email"] === $email && $utilisateur["password"] === $password) {
                $connexionReussie = true;
                break;
            }
        }

        if ($connexionReussie) {
            echo "<h2>Connexion réussie ! Bienvenue, " . $email . ".</h2>";
        } else {
            echo "<h2>Erreur : Email ou mot de passe incorrect.</h2>";
        }
    }
    ?>
</body>
</html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Système de Panier</title>
</head>
<body>
    <h1>Ajouter des produits au panier</h1>

    
    <form method="POST">
        <label for="nom">Nom du produit :</label><br>
        <input type="text" id="nom" name="nom" required><br><br>

        <label for="prix">Prix unitaire (MAD) :</label><br>
        <input type="number" id="prix" name="prix" step="0.01" required><br><br>

        <label for="quantite">Quantité :</label><br>
        <input type="number" id="quantite" name="quantite" min="1" required><br><br>

        <button type="submit">Ajouter au panier</button>
    </form>

    <h2>Votre panier</h2>
    <?php
    session_start();

    if (!isset($_SESSION["panier"])) {
        $_SESSION["panier"] = [];
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nom = trim($_POST["nom"]);
        $prix = (float) $_POST["prix"];
        $quantite = (int) $_POST["quantite"];

        $_SESSION["panier"][] = [
            "nom" => $nom,
            "prix" => $prix,
            "quantite" => $quantite
        ];
    }

    $total = 0;

    if (!empty($_SESSION["panier"])) {
        echo "<table border='1'>
                <tr>
                    <th>Produit</th>
                    <th>Prix Unitaire (MAD)</th>
                    <th>Quantité</th>
                    <th>Sous-total (MAD)</th>
                </tr>";
        
        foreach ($_SESSION["panier"] as $produit) {
            $sousTotal = $produit["prix"] * $produit["quantite"];
            $total += $sousTotal;

            echo "<tr>
                    <td>" . htmlspecialchars($produit["nom"]) . "</td>
                    <td>" . number_format($produit["prix"], 2) . "</td>
                    <td>" . $produit["quantite"] . "</td>
                    <td>" . number_format($sousTotal, 2) . "</td>
                </tr>";
        }

        echo "</table>";
        echo "<h3>Total : " . number_format($total, 2) . " MAD</h3>";
    } else {
        echo "<p>Votre panier est vide.</p>";
    }
    ?>
</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commentaires des Utilisateurs</title>
</head>
<body>
    <h1>Laissez un commentaire</h1>

    <form method="POST">
        <label for="nom">Votre nom :</label><br>
        <input type="text" id="nom" name="nom" required><br><br>

        <label for="commentaire">Votre commentaire :</label><br>
        <textarea id="commentaire" name="commentaire" rows="4" cols="50" required></textarea><br><br>

        <button type="submit">Soumettre</button>
    </form>

    <h2>Commentaires soumis</h2>
    <?php
    session_start();

    if (!isset($_SESSION["commentaires"])) {
        $_SESSION["commentaires"] = [];
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nom = trim($_POST["nom"]);
        $commentaire = trim($_POST["commentaire"]);
        $horodatage = date("Y-m-d H:i:s"); 

        $_SESSION["commentaires"][] = [
            "nom" => $nom,
            "commentaire" => $commentaire,
            "date" => $horodatage
        ];
    }

    if (!empty($_SESSION["commentaires"])) {
        foreach ($_SESSION["commentaires"] as $comment) {
            echo "<div style='border: 1px solid #ddd; padding: 10px; margin: 10px 0;'>";
            echo "<strong>" . htmlspecialchars($comment["nom"]) . "</strong> <em>(" . htmlspecialchars($comment["date"]) . ")</em><br>";
            echo "<p>" . nl2br(htmlspecialchars($comment["commentaire"])) . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p>Aucun commentaire pour le moment.</p>";
    }
    ?>
</body>
</html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ville avec la Température Maximale</title>
</head>
<body>
    <h1>Températures des Villes</h1>

    <?php
    $villes = [
        "Casablanca" => 23,
        "Marrakech" => 30,
        "Rabat" => 25,
        "Fès" => 28,
        "Agadir" => 27
    ];

    function villeTemperatureMax($villes) {
        $maxTemperature = max($villes); 
        $villeMax = array_search($maxTemperature, $villes); 
        return ["ville" => $villeMax, "temperature" => $maxTemperature];
    }

    $resultat = villeTemperatureMax($villes);

    echo "<h2>Températures actuelles :</h2>";
    echo "<ul>";
    foreach ($villes as $ville => $temperature) {
        echo "<li>" . htmlspecialchars($ville) . " : " . $temperature . "°C</li>";
    }
    echo "</ul>";

    echo "<h2>Ville avec la température la plus élevée :</h2>";
    echo "<p><strong>" . htmlspecialchars($resultat["ville"]) . "</strong> avec <strong>" . $resultat["temperature"] . "°C</strong></p>";
    ?>
</body>
</html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Importation de Produits</title>
</head>
<body>
    <h1>Importer un fichier CSV de produits</h1>

    <form method="POST" enctype="multipart/form-data">
        <label for="csvFile">Choisir un fichier CSV :</label><br>
        <input type="file" id="csvFile" name="csvFile" accept=".csv" required><br><br>
        <button type="submit">Importer</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["csvFile"])) {
        if ($_FILES["csvFile"]["error"] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES["csvFile"]["tmp_name"];

            $produits = [];
            if (($handle = fopen($fileTmpPath, "r")) !== false) {
                while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                    if (count($data) === 3) {
                        $produits[] = [
                            "nom" => $data[0],
                            "prix" => (float) $data[1],
                            "quantite" => (int) $data[2]
                        ];
                    }
                }
                fclose($handle);
            }

            if (!empty($produits)) {
                echo "<h2>Produits importés :</h2>";
                echo "<table border='1'>
                        <tr>
                            <th>Nom</th>
                            <th>Prix (MAD)</th>
                            <th>Quantité</th>
                        </tr>";
                foreach ($produits as $produit) {
                    echo "<tr>
                            <td>" . htmlspecialchars($produit["nom"]) . "</td>
                            <td>" . number_format($produit["prix"], 2) . "</td>
                            <td>" . $produit["quantite"] . "</td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "<p>Aucun produit valide trouvé dans le fichier CSV.</p>";
            }
        } else {
            echo "<p>Erreur lors du téléchargement du fichier. Veuillez réessayer.</p>";
        }
    }
    ?>
</body>
</html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier de Produits</title>
</head>
<body>
    <h1>Sélectionnez vos produits</h1>

    <form method="POST">
        <?php
        $produits = [
            "Pommes" => 5.50,
            "Bananes" => 4.20,
            "Oranges" => 6.30,
            "Poires" => 7.00,
            "Raisins" => 10.50
        ];

        foreach ($produits as $produit => $prix) {
            echo '<input type="checkbox" name="produits[]" value="' . htmlspecialchars($produit) . '"> ' . htmlspecialchars($produit) . ' - ' . number_format($prix, 2) . ' MAD<br>';
        }
        ?>
        <br>
        <button type="submit">Valider</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["produits"])) {
        $produitsSelectionnes = $_POST["produits"];
        $prixTotal = 0;

        echo "<h2>Produits sélectionnés :</h2>";
        echo "<ul>";

        foreach ($produitsSelectionnes as $produit) {
            if (isset($produits[$produit])) {
                $prixTotal += $produits[$produit];
                echo "<li>" . htmlspecialchars($produit) . " - " . number_format($produits[$produit], 2) . " MAD</li>";
            }
        }

        echo "</ul>";
        echo "<h3>Prix total : " . number_format($prixTotal, 2) . " MAD</h3>";
    } elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
        echo "<p>Veuillez sélectionner au moins un produit.</p>";
    }
    ?>
</body>
</html>
<?php
session_start();
if (!isset($_SESSION["utilisateurs"])) {
    $_SESSION["utilisateurs"] = [
        1 => ["nom" => "Alice", "email" => "alice@example.com"],
        2 => ["nom" => "Bob", "email" => "bob@example.com"],
        3 => ["nom" => "Charlie", "email" => "charlie@example.com"]
    ];
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST["action"] ?? "";

    if ($action === "ajouter") {
        $nom = trim($_POST["nom"]);
        $email = trim($_POST["email"]);

        if ($nom && $email) {
            $id = max(array_keys($_SESSION["utilisateurs"])) + 1;
            $_SESSION["utilisateurs"][$id] = ["nom" => $nom, "email" => $email];
            $message = "Utilisateur ajouté avec succès.";
        } else {
            $message = "Veuillez remplir tous les champs.";
        }
    } elseif ($action === "modifier") {
        $id = (int)$_POST["id"];
        $nom = trim($_POST["nom"]);
        $email = trim($_POST["email"]);

        if (isset($_SESSION["utilisateurs"][$id]) && $nom && $email) {
            $_SESSION["utilisateurs"][$id] = ["nom" => $nom, "email" => $email];
            $message = "Utilisateur modifié avec succès.";
        } else {
            $message = "Erreur : Utilisateur introuvable ou champs vides.";
        }
    } elseif ($action === "supprimer") {
        $id = (int)$_POST["id"];
        if (isset($_SESSION["utilisateurs"][$id])) {
            unset($_SESSION["utilisateurs"][$id]);
            $message = "Utilisateur supprimé avec succès.";
        } else {
            $message = "Erreur : Utilisateur introuvable.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Utilisateurs</title>
</head>
<body>
    <h1>Gestion des Utilisateurs</h1>

    <?php if ($message): ?>
        <p><strong><?php echo htmlspecialchars($message); ?></strong></p>
    <?php endif; ?>

    <form method="POST">
        <h2>Ajouter ou Modifier un Utilisateur</h2>
        <input type="hidden" name="action" value="ajouter">
        <label for="id">ID (pour modification) :</label>
        <input type="text" id="id" name="id" placeholder="Laisser vide pour ajouter"><br><br>
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required><br><br>
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required><br><br>
        <button type="submit">Valider</button>
    </form>

    <h2>Liste des Utilisateurs</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($_SESSION["utilisateurs"] as $id => $utilisateur): ?>
            <tr>
                <td><?php echo $id; ?></td>
                <td><?php echo htmlspecialchars($utilisateur["nom"]); ?></td>
                <td><?php echo htmlspecialchars($utilisateur["email"]); ?></td>
                <td>
                    <form method="POST" style="display: inline;">
                        <input type="hidden" name="action" value="supprimer">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <button type="submit">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
