<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>Activite 2</title>
  <link rel="stylesheet" href="style.css">
  <script src="script.js"></script>
</head>

<body>
    
    <?php 

        // Connection au serveur
        $host = 'localhost';
        $db   = ‘my-activities’;
        $user = 'root';
        $pass = 'root';
        $charset = 'utf8mb4';
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        
        try {
            $pdo = new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }

        $stmt = $pdo->query('SELECT users.id as user_id, username, email, FROM my_acticitie');
        while ($row = $stmt->fetch())
        {
            echo $row['*'] . "\n";
        }
    ?>

</body>
</html>
