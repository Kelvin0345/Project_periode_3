<?php  
session_start();

$errorMessage = "";

// users aanmaken als ze nog niet bestaan
if(!isset($_SESSION['users'])){
    $_SESSION['users'] = [
        [
            'username' => 'Jan van der Berg',
            'email' => 'jan.vanderberg@email.nl',
            'phone' => '0612345678',
            'role' => 'User',
            'status' => 'Actief',
            'joined' => 'Jan 15, 2024'
        ]
    ];
}

$users = &$_SESSION['users'];

/* UPDATE (in index verwerkt zoals jouw structuur) */
if(isset($_POST['update_user'])){
    $index = $_POST['index'];

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $status = $_POST['status'];

    if(empty($username) || empty($email) || empty($phone)){
        $errorMessage = "Het account kan niet worden gewijzigd";
    } else {
        $users[$index]['username'] = $username;
        $users[$index]['email'] = $email;
        $users[$index]['phone'] = $phone;
        $users[$index]['status'] = $status;
    }
}

$editUser = null;
$editIndex = null;

if(isset($_GET['edit'])){
    $editIndex = $_GET['edit'];

    if(isset($users[$editIndex])){
        $editUser = $users[$editIndex];
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
<meta charset="UTF-8">
<title>FitForFun Account Overzicht</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="header">
    <h1>FitForFun Accounts</h1>
    <a href="create.php"><button>+ Nieuw account</button></a>
</div>

<?php if($errorMessage): ?>
<p style="color:red;"><?= $errorMessage ?></p>
<?php endif; ?>

<h3>Aantal accounts: <?= count($users) ?></h3>

<table border="1" cellpadding="10">

<tr>
<th>Naam</th>
<th>Email</th>
<th>Telefoon</th>
<th>Rol</th>
<th>Status</th>
<th>Acties</th>
</tr>

<?php foreach($users as $index => $user): ?>
<tr>
<td><?= $user['username'] ?></td>
<td><?= $user['email'] ?></td>
<td><?= $user['phone'] ?></td>
<td><?= $user['role'] ?></td>
<td><?= $user['status'] ?></td>

<td>
<a href="update.php?id=<?= $index ?>">Edit</a>
<a href="delete.php?id=<?= $index ?>" onclick="return confirm('Weet je het zeker?')">Delete</a>
</td>

</tr>
<?php endforeach; ?>

</table>

<?php if($editUser): ?>

<h3>Account wijzigen</h3>

<form method="POST">

<input type="hidden" name="index" value="<?= $editIndex ?>">

<input type="text" name="username" value="<?= $editUser['username'] ?>"><br><br>
<input type="email" name="email" value="<?= $editUser['email'] ?>"><br><br>
<input type="text" name="phone" value="<?= $editUser['phone'] ?>"><br><br>

<select name="status">
<option value="Actief" <?= $editUser['status']=="Actief"?'selected':'' ?>>Actief</option>
<option value="Inactief" <?= $editUser['status']=="Inactief"?'selected':'' ?>>Inactief</option>
</select><br><br>

<button type="submit" name="update_user">Opslaan</button>

</form>

<?php endif; ?>

</body>
</html>