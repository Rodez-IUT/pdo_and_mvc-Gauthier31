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
$port = '3306';
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
    echo $e->getMessage();
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

function get($name) {
    return isset($_GET[$name]) ? $_GET[$name] : null;
}

?>

<h1>All Users</h1>

<form action="all_users2.php" method="get">
    Start with letter:
    <input name="start_letter" type="text" value="<?php echo get("start_letter") ?>">
    and status is:
    <select name="status_id">
        <option value="1" <?php if (get("status_id") == 1) echo 'selected' ?>>Waiting for account validation</option>
        <option value="2" <?php if (get("status_id") == 2) echo 'selected' ?>>Active account</option>
        <option value="3" <?php if (get("status_id") == 3) echo 'selected' ?>>Waiting for account validation</option>
    </select>
    <input type="submit" value="OK" onclick="envoiModification()">
</form>

<?php
$start_letter = htmlspecialchars(get("start_letter").'%');
$status_id = (int)get("status_id");
$sql = "SELECT users.id AS user_id, username, email, s.name AS status 
        FROM users 
        JOIN status s on users.status_id = s.id 
        WHERE username LIKE ? AND status_id = ? 
        ORDER BY username";
$stmt = $pdo->prepare($sql);
$stmt->execute([$start_letter, $status_id]);
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
            <td><?php echo $row['user_id'] ?></td>
            <td><?php echo $row['username'] ?></td>
            <td><?php echo $row['email'] ?></td>
            <td><?php echo $row['status'] ?></td>
            <td>
                <?php 
                    if ($row['status'] != "Waiting for account validation") {
                        echo '<a href="all_users2.php?status=3&user_id="'.$row['user_id'].'"&action=askDeletion">Ask deletion</a>';
                    } 
                ?>
            </td>
        </tr>
    <?php } ?>
</table>


<?php
$start_letter = htmlspecialchars(get("start_letter").'%');
$status_id = (int)get("status_id");
$sql = "DELETE
        FROM user 
        WHERE user_id = ? ";
$stmt = $pdo->prepare($sql);
$stmt->execute([$row['user_id']]);
?>


</body>
</html>