<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        .container {
            max-width: 50em;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>PHP PDO</h1>
        <form class="row g-3" method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
            <div class="row g-3">
                <div class="col">
                    <input type="text" class="form-control" placeholder="First name" aria-label="First name" name="firstname">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Last name" aria-label="Last name" name="lastname">
                </div>
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" class="form-control" id="inputEmail4" name="email">
            </div>
            <div class="col-md-6">
                <label for="age" class="form-label">Age</label>
                <input type="number" class="form-control" id="age" name="age">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary" name="connect">Sign in</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <?php

        if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['connect'])) {
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $age = $_POST['age'];

            print_r($_POST);

            try {
                $conn = new PDO("mysql:host=localhost;dbname=pdo_db;", "root", "");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "Connected to pdo_db...";

                // Créer la table users si elle n'existe pas
                $conn->exec("CREATE TABLE IF NOT EXISTS users(
                    userId int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    userFirstName VARCHAR(50) NOT NULL,
                    userLastName VARCHAR(50) NOT NULL,
                    userEmail VARCHAR(50) NOT NULL,
                    userAge int NOT NULL
                );");
                // Insérer les données de l'utilisateur s'ils n'existent pas
                $conn->exec("INSERT INTO `pdo_db`.users (userFirstName, userLastName, userEmail, userAge)
                    VALUES ('$firstname', '$lastname', '$email', $age);
                ");
                
            }
            catch (PDOException $e) {
                echo "Error !!! " . $e->getMessage();
            }
        }
    
    ?>
</body>

</html>