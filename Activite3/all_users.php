<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All users</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>

    <?php

    $host = 'localhost';
    $port = '8889'; // 3306 ?
    $db = 'my_activities';
    $user = 'root';
    $pass = 'root';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
    } catch (PDOException $e) {
        echo $e->getMessage() ;
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }

    ?>

    <h1>All Users</h1>

    <form method="POST" action="all_users.php">
        <label for="letter"></label>Entrez une lettre : <input type="text" id="lettre" name="lettre">

    <select name="status">
        <option value="active">Active</option>
        <option value="waiting">Waiting</option>
    </select>

    <button type="submit">Valider<button>


    <?php

    if(isset($_POST["letter"])) {
        $premiereLettre = $_POST['letter'];;
    }

    if(isset($_POST["status"])) {
        $premiereLettre = $_POST['status'];;
    }

    $stmt = $pdo->query("SELECT users.id as user_id, username, email, s.name as status from users join status s on users.status_id = s.id WHERE status.id = ' .&statusId. ' AND username LIKE '.$premiereLettre.'% ORDER BY username");
    ?>
    <table>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Email</th>
            <th>Status</th>
        </tr>
        <?php while ($row = $stmt->fetch()) { ?>
        <tr>
            <td><?php echo $row['user_id']?></td>
            <td><?php echo $row['username']?></td>
            <td><?php echo $row['email']?></td>
            <td><?php echo $row['status']?></td>
        </tr>
        <?php } ?>
    </table>


</body>
</html>