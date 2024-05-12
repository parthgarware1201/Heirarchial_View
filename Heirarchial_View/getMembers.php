<?php
require_once 'Database.php';

$db = new Database();
$conn = $db->connect();

$query = "SELECT *  FROM members";
$stmt = $conn->prepare($query);
$stmt->execute();

$options = array();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $options[] = array(        
        'name' => $row['name']
    );
}

echo json_encode(array('options' => $options));
?>
