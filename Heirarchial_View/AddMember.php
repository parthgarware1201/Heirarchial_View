<?php
require_once 'Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $parentname = $_POST['selectValue'];

    if (empty($name)) {
        echo "Name cannot be empty.";
    } else {
        $db = new Database();
        $conn = $db->connect();
        
        $query = "SELECT id  FROM members where name=:name";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(":name", $parentname);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $parent_id = $row['id'];
        // echo $parent_id;
        } else {
        echo "No matching record found for '$parentname'.";
        }
     
        $query = "INSERT INTO members (created_date, name, parent_id) VALUES (NOW(), :name, :parent_id)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":parent_id", $parent_id);
        
        if ($stmt->execute()) {
            echo "Member added successfully.";
        } else {
            echo "Error adding member.";
        }
    }
}
?>
