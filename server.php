<pre>
    <?php

// DSN: Data Source Name
    $dsn = "mysql:host=localhost;dbname=pdo_db";
    print_r($_POST);
    $username = "root"; // nom du serveur
    $password = ""; // mot de passe

    // si le formulaire est passé par la méthode post
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $mail = $_POST["mail"];
        $a = $_POST["a"];
        $pwd = $_POST["pwd"];
    }

    // try { // vérifie si le bloc s'exécute sans erreur
    //     $con = new PDO($dsn, $username, $password);
    //     // Requête  à envoyer au serveur
    //     // $sql = "INSERT INTO users (user_first_name,	user_last_name,	user_email,	user_age) values ('$fname', '$lname', '$mail', $a)";
    //     // Exécution de la requête
    //     $con->exec($sql);
    //     header("Location: ./correction.php"); // redirige sur la page du formulaire
    // } catch (PDOException $e) { // s'exécute si le bloc précédant génère une erreur
    //     echo $e->getMessage();
    // }

    /**
     * REQUETES PREPAREE
     */

    try { // vérifie si le bloc s'exécute sans erreur
        $con = new PDO($dsn, $username, $password);
        $sql = "CREATE TABLE IF NOT EXISTS users(
            userId int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
            userFistName VARCHAR(50) NOT NULL,
            userLastName VARCHAR(50) NOT NULL,
            userEmail VARCHAR(50) NOT NULL,
            user_password VARCHAR(128),
            userAge int NOT NULL
        )";
        $con->exec($sql);
        // Requête  à envoyer au serveur
        
        // $sql = "INSERT INTO users (user_first_name,	user_last_name,	user_email,	user_age) values (?, ?, ?, ?)";
        $sql = "INSERT INTO users (user_first_name,	user_last_name,	user_email,	user_age, user_password) values (:firstname, :lastname, :email, :age, :userpassword)";
        //  Création de la requête préparée (prepared statement)
        $stmt = $con->prepare($sql); // génère un template de requête
        
        
        // Exécution de la requête
        $stmt->execute([
            // NB: les deux points sont facultatifs
            ":email" => $mail, // "email" => $mail
            ":lastname" => $lname, // "lastname" => $lastname
            ":firstname" => $fname, // "firsname" => $firsname
            ":age" => $a, // "age" => $age
            // "userpassword" => $pwd
            "userpassword" => password_hash($pwd, PASSWORD_DEFAULT)
        ]);



        header("Location: ./correction.php?msg=success"); // redirige sur la page du formulaire
    } catch (PDOException $e) { // s'exécute si le bloc précédant génère une erreur
        echo $e->getMessage();
        header("Location: ./correction.php?msg=failure"); // redirige sur la page du formulaire
    }

    ?>
</pre>