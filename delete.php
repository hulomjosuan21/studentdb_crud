<?php
include('connection.php');

$connection = $newConnection->openConnection();

if (isset($_POST['deleteStudent'])) { 
    $id = $_POST['id'];
    
    $query = "DELETE FROM students_table WHERE id = ?";
    $stmt = $connection->prepare($query);
    $stmt->execute([$id]);

    session_start();
    $_SESSION["create"] = "Student deleted successfully";
    
    header("Location: index.php");
    exit();
}