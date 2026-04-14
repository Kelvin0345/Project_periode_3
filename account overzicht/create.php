<?php
session_start();

$error = "";

if(isset($_POST['create_account'])){

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $role = $_POST['role'];
    $status = $_POST['status'];

    if(empty($username) || empty($email) || empty($phone)){
        $error = "Het account kan niet worden aangemaakt";
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = "Ongeldig emailadres";
    }
    else {

        $_SESSION['users'][] = [
            'username' => $username,
            'email' => $email,
            'phone' => $phone,
            'role' => $role,
            'status' => $status,
            'joined' => date('d M Y')
        ];

        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
<meta charset="UTF-8">
<title>Nieuw Account</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<h1>Account aanmaken</h1>

<?php if($error): ?>
<p style="color:red;"><?= $error ?></p>
<?php endif; ?>

<form method="POST">

<input type="text" name="username" placeholder="Naam" required><br><br>
<input type="email" name="email" placeholder="Email" required><br><br>
<input type="text" name="phone" placeholder="Telefoon" required><br><br>

<select name="role">
<option>User</option>
<option>Admin</option>
</select><br><br>

<select name="status">
<option>Actief</option>
<option>Inactief</option>
</select><br><br>

<button type="submit" name="create_account">Aanmaken</button>

</form>

<br>
<a href="index.php">← Terug</a>

</body>
</html>