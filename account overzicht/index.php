<?php 
session_start();

// Unhappy scenario trigger
$error = isset($_GET['error']);

// Gebruikerslijst
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

// Gebruiker toevoegen
if(isset($_POST['add_user'])){
    $users[] = [
        'username' => $_POST['username'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'role' => $_POST['role'],
        'status' => $_POST['status'],
        'joined' => date('M d, Y')
    ];
}

// Gebruiker aanpassen
if(isset($_POST['update_user'])){
    $index = $_POST['index'];

    $users[$index]['username'] = $_POST['username'];
    $users[$index]['email'] = $_POST['email'];
    $users[$index]['phone'] = $_POST['phone'];
    $users[$index]['status'] = $_POST['status'];
}

// Edit setup
$editUser = null;
$editIndex = null;

if(isset($_GET['edit'])){
    $editIndex = $_GET['edit'];
    $editUser = $users[$editIndex];
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
<meta charset="UTF-8">
<title>Account Overzicht</title>
</head>

<body bgcolor="#f5f6fa" style="font-family: system-ui, sans-serif; padding:30px;">

<table bgcolor="#eff6ff" border="2" bordercolor="#3b82f6" cellpadding="15" width="100%">
<tr>
<td>

<h1 style="margin:0; color:#1e3a8a;">Account Overzicht</h1>

<div style="color:#6b7280;">Overzicht van alle accounts</div>

</td>
</tr>
</table>

<br>

<?php if($error): ?>

<div style="background:#fee2e2; color:#b91c1c; padding:20px; border-radius:10px; border:1px solid #fca5a5;">

<b>Foutmelding</b><br><br>

Kan het account overzicht niet laden omdat er geen verbinding kan worden gemaakt met de database.  
Probeer het later opnieuw.

</div>

<?php else: ?>

<table width="100%" cellspacing="15">
<tr>

<td>
<table bgcolor="white" border="1" bordercolor="#dbeafe" cellpadding="15" width="100%">
<tr>
<td>

<b style="color:#3b82f6;">Aantal gebruikers</b><br>

<span style="font-size:24px; color:#1e40af;">
<?= count($users) ?>
</span>

</td>
</tr>
</table>
</td>

<td>
<table bgcolor="white" border="1" bordercolor="#dbeafe" cellpadding="15" width="100%">
<tr>
<td>

<b style="color:#3b82f6;">Actieve gebruikers</b><br>

<span style="font-size:24px; color:#1e40af;">
<?php 
$active = 0;
foreach($users as $u){
if($u['status'] == "Actief") $active++;
}
echo $active;
?>
</span>

</td>
</tr>
</table>
</td>

</tr>
</table>

<br>

<table width="100%" border="1" bordercolor="#dbeafe" cellspacing="0" cellpadding="10" bgcolor="white">

<thead bgcolor="#eff6ff">
<tr>

<th align="left" style="color:#1e3a8a;">Naam</th>

<th align="left" style="color:#1e3a8a;">Contact</th>

<th align="left" style="color:#1e3a8a;">Rol</th>

<th align="left" style="color:#1e3a8a;">Status</th>

<th align="left" style="color:#1e3a8a;">Lid sinds</th>

<th align="left" style="color:#1e3a8a;">Manage</th>

</tr>
</thead>

<tbody>

<?php foreach($users as $index => $user): ?>

<tr>

<td>
<?= $user['username'] ?>
</td>

<td>
<?= $user['email'] ?><br>
Tel: <?= $user['phone'] ?>
</td>

<td>
<b style="color:#2563eb;">
<?= $user['role'] ?>
</b>
</td>

<td>

<?php if($user['status']=="Actief"){ ?>

<b style="color:#16a34a;">Actief</b>

<?php }else{ ?>

<b style="color:#dc2626;">Inactief</b>

<?php } ?>

</td>

<td>
<?= $user['joined'] ?>
</td>

<td>

<a href="?edit=<?= $index ?>">

<button style="background:#16a34a; color:white; border:none; padding:6px 10px; border-radius:6px;">
Edit
</button>

</a>

</td>

</tr>

<?php endforeach; ?>

</tbody>
</table>

<?php endif; ?>

<?php if($editUser): ?>

<br>

<div style="background:white; padding:20px; border:1px solid #dbeafe; border-radius:10px;">

<h3 style="color:#1e3a8a;">Gegevens aanpassen</h3>

<form method="POST">

<input type="hidden" name="index" value="<?= $editIndex ?>">

<input type="text" name="username" value="<?= $editUser['username'] ?>" required
style="width:100%; padding:10px; margin-bottom:10px; border:1px solid #93c5fd; border-radius:8px;">

<input type="email" name="email" value="<?= $editUser['email'] ?>" required
style="width:100%; padding:10px; margin-bottom:10px; border:1px solid #93c5fd; border-radius:8px;">

<input type="text" name="phone" value="<?= $editUser['phone'] ?>" required
style="width:100%; padding:10px; margin-bottom:10px; border:1px solid #93c5fd; border-radius:8px;">

<select name="status"
style="width:100%; padding:10px; margin-bottom:10px; border:1px solid #93c5fd; border-radius:8px;">

<option value="Actief" <?= $editUser['status']=="Actief"?'selected':'' ?>>Actief</option>

<option value="Inactief" <?= $editUser['status']=="Inactief"?'selected':'' ?>>Inactief</option>

</select>

<button type="submit" name="update_user"
style="background:#2563eb; color:white; border:none; padding:10px 15px; border-radius:8px;">
Opslaan
</button>

</form>

</div>

<?php endif; ?>

</body>
</html>