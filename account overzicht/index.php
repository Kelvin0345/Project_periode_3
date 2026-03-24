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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Account Overzicht</title>
<style>
body {
    font-family: system-ui, sans-serif;
    background-color: #f5f6fa;
    margin: 0;
    padding: 30px;
}

/* Header */
.header {
    background-color: #2563eb;
    color: white;
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 20px;
}

.header h1 {
    margin: 0;
}

.header p {
    margin: 5px 0 0;
}

/* Knop */
.button {
    background-color: white;
    color: #2563eb;
    border: none;
    padding: 10px 15px;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
    margin-top: 10px;
}

/* Statistieken */
.stats-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 20px;
}

.stats {
    background-color: white;
    padding: 20px;
    border-radius: 10px;
    flex: 1 1 200px;
}

/* Tabel */
table {
    width: 100%;
    border-collapse: collapse;
    background-color: white;
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 20px;
}

thead {
    background-color: #eff6ff;
}

th, td {
    text-align: left;
    padding: 12px;
}

tr {
    border-top: 1px solid #e5e7eb;
}

.status-actief {
    color: green;
    font-weight: bold;
}

.status-inactief {
    color: red;
    font-weight: bold;
}

.role {
    color: #2563eb;
    font-weight: bold;
}

.edit-button {
    background-color: #16a34a;
    color: white;
    border: none;
    padding: 6px 10px;
    border-radius: 6px;
    cursor: pointer;
}

/* Edit formulier */
.edit-form {
    background-color: white;
    padding: 20px;
    border-radius: 10px;
}

.edit-form input, .edit-form select, .edit-form button {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 8px;
    border: 1px solid #93c5fd;
}

.edit-form button {
    background-color: #2563eb;
    color: white;
    border: none;
    cursor: pointer;
}

/* Responsive */
@media(max-width: 768px) {
    .stats-container {
        flex-direction: column;
    }
}
</style>
</head>

<body>

<!-- Header + knop -->
<div class="header">
    <h1>Account Overzicht</h1>
    <p>Overzicht van alle accounts</p>
    <a href="create.php"><button class="button">+ Nieuw account toevoegen</button></a>
</div>

<?php if($error): ?>
<div style="background:#fee2e2; color:#b91c1c; padding:20px; border-radius:10px; border:1px solid #fca5a5; margin-bottom:20px;">
    <b>Foutmelding</b><br>
    Kan het account overzicht niet laden.
</div>
<?php endif; ?>

<!-- Statistieken -->
<div class="stats-container">
    <div class="stats">
        <b>Aantal gebruikers</b><br>
        <span style="font-size:24px;"><?= count($users) ?></span>
    </div>
    <div class="stats">
        <b>Actieve gebruikers</b><br>
        <span style="font-size:24px;">
            <?php 
            $active = 0;
            foreach($users as $u){
                if($u['status'] == "Actief") $active++;
            }
            echo $active;
            ?>
        </span>
    </div>
</div>

<!-- Tabel accounts -->
<table>
<thead>
<tr>
<th>Naam</th>
<th>Contact</th>
<th>Rol</th>
<th>Status</th>
<th>Lid sinds</th>
<th>Manage</th>
</tr>
</thead>
<tbody>
<?php foreach($users as $index => $user): ?>
<tr>
<td><?= $user['username'] ?></td>
<td><?= $user['email'] ?><br>Tel: <?= $user['phone'] ?></td>
<td class="role"><?= $user['role'] ?></td>
<td>
<?php if($user['status']=="Actief"){ ?>
<span class="status-actief">Actief</span>
<?php } else { ?>
<span class="status-inactief">Inactief</span>
<?php } ?>
</td>
<td><?= $user['joined'] ?></td>
<td><a href="?edit=<?= $index ?>"><button class="edit-button">Edit</button></a></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<!-- Edit formulier -->
<?php if($editUser): ?>
<div class="edit-form">
<h3>Gegevens aanpassen</h3>
<form method="POST">
<input type="hidden" name="index" value="<?= $editIndex ?>">
<input type="text" name="username" value="<?= $editUser['username'] ?>" required>
<input type="email" name="email" value="<?= $editUser['email'] ?>" required>
<input type="text" name="phone" value="<?= $editUser['phone'] ?>" required>
<select name="status">
<option value="Actief" <?= $editUser['status']=="Actief"?'selected':'' ?>>Actief</option>
<option value="Inactief" <?= $editUser['status']=="Inactief"?'selected':'' ?>>Inactief</option>
</select>
<button type="submit" name="update_user">Opslaan</button>
</form>
</div>
<?php endif; ?>

</body>
</html>