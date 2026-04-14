<?php
$conn = new mysqli("localhost", "root", "", "fitness");

// CHECK DATABASE
if ($conn->connect_error) {
    header("Location: lessen.php?error=Database fout");
    exit;
}

// CHECK POST
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $id = intval($_POST['id']);

    // DELETE QUERY
    $stmt = $conn->prepare(
        "DELETE FROM pakketten WHERE id=?"
    );

    if(!$stmt){
        header("Location: lessen.php?error=Query fout");
        exit;
    }

    $stmt->bind_param("i", $id);

    // RESULT
    if($stmt->execute()){
        header("Location: lessen.php");
    } else {
        header("Location: lessen.php?error=Verwijderen mislukt");
    }
}