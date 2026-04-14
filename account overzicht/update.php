<?php
session_start();

$index = $_GET['id'] ?? null;

if(!isset($_SESSION['users'][$index])){
    header("Location: index.php");
    exit();
}

$user = $_SESSION['users'][$index];

$errorMessage = "";

if(isset($_POST['update_user'])){

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $status = $_POST['status'];

    if(empty($username) || empty($email) || empty($phone)){
        $errorMessage = "Het account kan niet worden gewijzigd";
    } else {

        $_SESSION['users'][$index]['username'] = $username;
        $_SESSION['users'][$index]['email'] = $email;
        $_SESSION['users'][$index]['phone'] = $phone;
        $_SESSION['users'][$index]['status'] = $status;

        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
<meta charset="UTF-8">
<title>Account wijzigen</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<h1>Account wijzigen</h1>

<?php if($errorMessage): ?>
<p style="color:red;"><?= $errorMessage ?></p>
<?php endif; ?>

<form method="POST">

<input type="text" name="username" value="<?= $user['username'] ?>"><br><br>
<input type="email" name="email" value="<?= $user['email'] ?>"><br><br>
<input type="text" name="phone" value="<?= $user['phone'] ?>"><br><br>

<select name="status">
<option value="Actief" <?= $user['status']=="Actief"?'selected':'' ?>>Actief</option>
<option value="Inactief" <?= $user['status']=="Inactief"?'selected':'' ?>>Inactief</option>
</select><br><br>

<button type="submit" name="update_user">Opslaan</button>

</form>

<br>
<a href="index.php">← Terug</a>

</body>
</html>