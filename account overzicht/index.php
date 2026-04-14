<?php
session_start();

$errorMessage = "";

/* USERS INIT */
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

/* DELETE */
if(isset($_GET['delete'])){
    $id = intval($_GET['delete']);

    if(isset($users[$id])){
        unset($users[$id]);
        $_SESSION['users'] = array_values($users);
        header("Location: index.php");
        exit;
    }
}

/* UPDATE */
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

/* EDIT SELECT */
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

<div class="container">

<div class="header">
    <h1>FitForFun Accounts</h1>
    <a href="create.php"><button class="button">+ Nieuw account</button></a>
</div>

<?php if($errorMessage): ?>
<p style="color:red; text-align:center;"><?= $errorMessage ?></p>
<?php endif; ?>

<div class="stats-container">
    <div class="stats">
        <h3><?= count($users) ?></h3>
        <p>Aantal accounts</p>
    </div>
</div>

<div class="table-wrapper">
<table>

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

<td class="<?= $user['status'] == 'Actief' ? 'status-actief' : 'status-inactief' ?>">
    <?= $user['status'] ?>
</td>

<td>
<a class="edit-btn" href="?edit=<?= $index ?>">Edit</a>
<a class="delete-btn" href="?delete=<?= $index ?>" onclick="return confirm('Weet je het zeker?')">Delete</a>
</td>

</tr>
<?php endforeach; ?>

</table>
</div>

<?php if($editUser): ?>

<div class="edit-form">
<h3>Account wijzigen</h3>

<form method="POST">

<input type="hidden" name="index" value="<?= $editIndex ?>">

<input type="text" name="username" value="<?= $editUser['username'] ?>" placeholder="Naam">
<input type="email" name="email" value="<?= $editUser['email'] ?>" placeholder="Email">
<input type="text" name="phone" value="<?= $editUser['phone'] ?>" placeholder="Telefoon">

<select name="status">
<option value="Actief" <?= $editUser['status']=="Actief"?'selected':'' ?>>Actief</option>
<option value="Inactief" <?= $editUser['status']=="Inactief"?'selected':'' ?>>Inactief</option>
</select>

<button class="button" type="submit" name="update_user">Opslaan</button>

</form>
</div>

<?php endif; ?>

</div>
</body>
</html>