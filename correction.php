<?php 
// Null Coalescing Opérator : sucre syntaxique pour écrire le code de la ligne 6
    $msg = $_GET["msg"] ?? ""; // undefined, null, ""
    echo "la valeur de msg ===> ". $msg;
    // 
    // if (isset($_GET["msg"])) {
    //     $msg = $_GET["msg"];
    // } else {
    //     $msg = "";
    // }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire</title>
    <style>
        .info {
            color: White;
            font-weight: bold;
            padding: 2rem;
            border: 2px solid gray;
            background-color: lightgreen;
            margin-bottom: 2rem;
        }

        .failure {
            background-color: red;
        }
    </style>
</head>
<body>
<!-- Si succès -->
    <?php if ($msg === "success"): ?>
        <div class="info success">Vous avez bien été enrégistré</div>
    <?php endif; ?>
    <!-- Si echec -->
    <?php if ($msg === "failure"): ?>
        <div class="info failure">désolé veuillez reessayer svp.</div>
    <?php endif; ?>
    <form action="./server.php" method="post">

    <label for="lname">LastName</label>
    <input type="text" name="lname" id="lname">
    
    <label for="fname">FirstName</label>
    <input type="text" name="fname" id="fname">
    
    <label for="mail">Email</label>
    <input type="email" name="mail" id="mail">
    
    
    <label for="pwd">Mot de passe</label>
    <input type="password" name="pwd" id="pwd">
    
    <label for="a">Age</label>
    <input type="number" name="a" id="a">
    <button type="submit">Valider</button>
    </form>

</body>
</html>