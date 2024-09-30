<?php
require_once('connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Student Database CRUD</title>
</head>

<body>
    <div class="container mt-2">
        <form action="process.php" method="POST">
            <div class="row">
                <div class="col">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" class="form-control mb-2" id="firstname" name="firstname" value="Josuan Leonardo">
                    <label for="firstname" class="form-label">Gender</label>
                    <select class="form-select mb-2" aria-label="Default select example" name="gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="col">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input type="text" class="form-control mb-2" id="lastname" name="lastname" value="Hulom">
                    <label for="birthdate" class="form-label">Last Name</label>
                    <input type="date" class="form-control mb-2" id="birthdate" name="birthdate" value="2004-02-21">
                </div>
                <div class="col">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control mb-2" id="email" name="email" value="test@email.com">
                    <label for="country" class="form-label">Country</label>
                    <input type="text" class="form-control mb-2" id="country" name="country" value="Philippines">
                </div>
            </div>
            <div class="row">
                <div class="col text-end">
                    <button type="submit" class="btn btn-primary" name="addStudent">Add</button>
                </div>
            </div>
        </form>
    </div>

    <div class="container">
        <?php
        session_start();
        if (isset($_SESSION["create"])) {
        ?>
          <div class="alert alert-success">
            <?php
            echo $_SESSION["create"];
            unset($_SESSION["create"]);
            ?>
          </div>
        <?php
        }
        ?>
    </div>

    <div class="container mt-2">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Lastname</th>
                    <th scope="col">Email</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Birthdate</th>
                    <th scope="col">Country</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $connection = $newConnection->openConnection();
                $stmt = $connection->prepare('SELECT * FROM students_table');
                $stmt->execute();
                $result = $stmt->fetchAll();

                if ($result) {
                    foreach ($result as $row) {
                        ?>
                        <tr>
                            <td><?php echo $row->id ?></td>
                            <td><?php echo $row->first_name ?></td>
                            <td><?php echo $row->last_name ?></td>
                            <td><?php echo $row->email ?></td>
                            <td><?php echo $row->gender ?></td>
                            <td><?php echo $row->birthdate ?></td>
                            <td><?php echo $row->country ?></td>
                            <td>
                                <form action="delete.php" method="POST">
                                    <input type="hidden" value="<?php echo $row->id; ?>" name="id">
                                    <button type="submit" class="btn btn-danger" name="deleteStudent">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>