<?php
session_start();

// Foutmelding altijd eerst definieren
$error = "";

// Check of formulier verzonden is
if(isset($_POST['create_account'])){

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $role = $_POST['role'];
    $status = $_POST['status'];

    // Validatie (unhappy scenario)
    if(empty($username) || empty($email) || empty($phone)){
        $error = "Het account kan niet worden aangemaakt";
    } 
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = "Ongeldig emailadres";
    }
    elseif(strlen($phone) < 8){
        $error = "Telefoonnummer is te kort";
    }
    else {

        // Zorg dat users array bestaat
        if(!isset($_SESSION['users'])){
            $_SESSION['users'] = [];
        }

        // Account toevoegen
        $_SESSION['users'][] = [
            'username' => $username,
            'email' => $email,
            'phone' => $phone,
            'role' => $role,
            'status' => $status,
            'joined' => date('M d, Y')
        ];

        // Redirect naar overzicht
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
</head>

<body bgcolor="#f5f6fa" style="font-family: system-ui, sans-serif; padding:30px;">

<div style="background:#2563eb; color:white; padding:20px; border-radius:12px; margin-bottom:20px;">
    <h1 style="margin:0;">Nieuw account toevoegen</h1>
</div>

<?php if(!empty($error)): ?>
<div style="background:#fee2e2; color:#b91c1c; padding:20px; border-radius:10px; margin-bottom:15px;">
    <b>Foutmelding:</b><br>
    <?= $error ?>
</div>
<?php endif; ?>

<form method="POST" style="background:white; padding:20px; border-radius:10px; max-width:500px;">

<input type="text" name="username" placeholder="Naam"
style="width:100%; padding:10px; margin-bottom:10px; border:1px solid #93c5fd; border-radius:8px;" required>

<input type="email" name="email" placeholder="Email"
style="width:100%; padding:10px; margin-bottom:10px; border:1px solid #93c5fd; border-radius:8px;" required>

<input type="text" name="phone" placeholder="Telefoonnummer"
style="width:100%; padding:10px; margin-bottom:10px; border:1px solid #93c5fd; border-radius:8px;" required>

<select name="role"
style="width:100%; padding:10px; margin-bottom:10px; border:1px solid #93c5fd; border-radius:8px;">
<option value="User">User</option>
<option value="Admin">Admin</option>
</select>

<select name="status"
style="width:100%; padding:10px; margin-bottom:10px; border:1px solid #93c5fd; border-radius:8px;">
<option value="Actief">Actief</option>
<option value="Inactief">Inactief</option>
</select>

<button type="submit" name="create_account"
style="background:#2563eb; color:white; padding:10px 15px; border:none; border-radius:8px; width:100%; margin-top:10px;">
Account aanmaken
</button>

</form>

<br>
<a href="index.php" style="color:#2563eb;">← Terug naar overzicht</a>

</body>
</html>