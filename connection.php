<?php
$newConnection = new Connection();

class Connection {
    private $server = "mysql:host=localhost;dbname=studentdb";
    private $username = "root";
    private $password = "";
    private $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ];
    protected $conn;

    public function openConnection(): PDO {
        try {
            $this->conn = new PDO($this->server,$this->username,$this->password,$this->options);
            return $this->conn;
        } catch (PDOException $e) {
            echo "There is a problem is the connection: ".$e->getMessage();   
        }
    }

    public function addStudent():void{
        if (isset($_POST['addStudent'])) {
    
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $gender = $_POST['gender'];
            $birthdate = $_POST['birthdate'];
            $country = $_POST['country'];
        
            
            try {
                $connection = $this->openConnection();
                $query = "INSERT INTO students_table (`first_name`, `last_name`, `email`, `gender`, `birthdate`, `country`) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $connection->prepare($query);
                $stmt->execute([$firstname, $lastname, $email, $gender, $birthdate, $country]);
        
                session_start();
                $_SESSION["out"] = "Student added successfully";
                
                header("Location: index.php");
                exit();
            } catch (PDOException $e) {
                session_start();
                $_SESSION["error"] = "Error: " . $e->getMessage();
        
                header("Location: index.php");
                exit();
            }
        }
    }

    public function editStudent() {
        if (isset($_POST['editStudent'])) {
    
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $gender = $_POST['gender'];
            $birthdate = $_POST['birthdate'];
            $country = $_POST['country'];
            $studentId = $_POST['student_id'];
    
            try {
                $connection = $this->openConnection();
                $query = "UPDATE students_table SET first_name = ?, last_name = ?, email = ?, gender = ?, birthdate = ?, country = ? WHERE id = ?";
                $stmt = $connection->prepare($query);
                $stmt->execute([$firstname, $lastname, $email, $gender, $birthdate, $country, $studentId]);
    
                session_start();
                $_SESSION["out"] = "Student updated successfully";
    
                header("Location: index.php");
                exit();
            } catch (PDOException $e) {
                session_start();
                $_SESSION["error"] = "Error: " . $e->getMessage();
    
                header("Location: index.php");
                exit();
            }
        }
    }    

    public function deleteStudent(){
        if(isset($_POST['delete_student'])){
            $id = $_POST['delete_student'];

            try {
                $connection = $this->openConnection();
                $query = "DELETE FROM students_table WHERE id = :id";
                $stmt = $connection->prepare($query);
                $stmt->execute(["id" => $id]);

                session_start();
                $_SESSION["out"] = "Student deleted successfully";
                
                header("Location: index.php");
                exit();
            } catch (PDOException $e) {
                session_start();
                $_SESSION["error"] = "Error: " . $e->getMessage();
        
                header("Location: index.php");
                exit();
            }
        }
    }
}