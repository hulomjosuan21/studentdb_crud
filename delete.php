<?php
include('connection.php');

$connection = $newConnection->openConnection();

if (isset($_GET['id'])) {
    $student_id = $_GET['id'];

    $query = "DELETE FROM students_table WHERE id = ?";

    try {
        $stmt = $connection->prepare($query);
        
        $stmt->execute([$student_id]);

        $_SESSION["delete"] = "Student deleted successfully";

        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        $_SESSION["error"] = "Error: " . $e->getMessage();

        header("Location: index.php");
        exit();
    }
} else {
    $_SESSION["error"] = "No student ID provided for deletion";
    header("Location: index.php");
    exit();
}
