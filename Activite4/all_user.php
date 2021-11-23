<!DOCTYPE html>
<html lang=en>
<head>
    meta charset=UTF-8
    titleAll userstitle
    style
        table {
            border-collapse collapse;
            width 100%;
        }

        th, td {
            padding 8px;
            text-align left;
            border-bottom 1px solid #ddd;
        }
    style
<head>
body

php

$host = 'localhost';
$port = '3306';  8889 
$db = 'my_activities';
$user = 'root';
$pass = 'root';
$charset = 'utf8mb4';

$dsn = mysqlhost=$host;port=$port;dbname=$db;charset=$charset;
$options = [
    PDOATTR_ERRMODE = PDOERRMODE_EXCEPTION,
    PDOATTR_DEFAULT_FETCH_MODE = PDOFETCH_ASSOC,
    PDOATTR_EMULATE_PREPARES = false,
];
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    echo $e-getMessage() ;
    throw new PDOException($e-getMessage(), (int)$e-getCode());
}



h1All Usersh1



form method=POST action=all_users.php
label for=letterlabelstart with letter  input type=text name=letter id=letter

select name=status
    option value=2Active accountoption
    option value=1Waiting for account validationoption
    
select
 button type=submitOKbutton

form


php

if (isset($_POST['letter'])) {
    $debutUsername = $_POST['letter'];


} 
if (isset($_POST['status'])) {
    $statutId = $_POST[status];
}

 Mettre les bon parametre dans la requete a espace reserve nommé 
$stmt = $pdo-query(SELECT users.id as user_id, username, email, s.name as status from users join status s on users.status_id = s.id WHERE s.id = $statutId AND username LIKE '$debutUsername%' ORDER BY username);
$stmt = $pdo-prepare(SELECT  FROM users WHERE email = email AND status=status);
$stmt-execute(['email' = $email, 'status' = $status]);



table
    tr
        thIdth
        thUsernameth
        thEmailth
        thStatusth
    tr
    php while ($row = $stmt-fetch()) { 
    tr
        tdphp echo $row['user_id']td
        tdphp echo $row['username']td
        tdphp echo $row['email']td
        tdphp echo $row['status']td
    tr
    php } 
table


body
html