<?php
include('connection.php');

$connection = $newConnection->openConnection();

if (isset($_POST['addStudent'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    $country = $_POST['country'];

    $query = "INSERT INTO students_table (`first_name`, `last_name`, `email`, `gender`, `birthdate`, `country`) VALUES (?, ?, ?, ?, ?, ?)";
    
    try {
        $stmt = $connection->prepare($query);
        
        $stmt->execute([$firstname, $lastname, $email, $gender, $birthdate, $country]);

        session_start();
        $_SESSION["create"] = "Student added successfully";
        
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        session_start();
        $_SESSION["error"] = "Error: " . $e->getMessage();

        header("Location: index.php");
        exit();
    }
}

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
