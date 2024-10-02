<div class="modal fade" id="exampleModal<?= $row->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="" method="POST">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" value="<?= $row->id ?>" name="student_id">
                        <div class="col">
                            <label for="firstname" class="form-label">First Name</label>
                            <input type="text" class="form-control mb-2" id="firstname" name="firstname" required value="<?= $row->first_name ?>">
                            <label for="firstname" class="form-label">Gender</label>
                            <select class="form-select mb-2" aria-label="Default select example" name="gender" required>

                                <?php
                                if ($row->gender == 'Male') {
                                ?>
                                    <option value="Male" selected>Male</option>
                                    <option value="Female">Female</option>
                                <?php
                                } else {
                                ?>
                                    <option value="Male">Male</option>
                                    <option value="Female" selected>Female</option>
                                <?php
                                }
                                ?>

                            </select>
                        </div>
                        <div class="col">
                            <label for="lastname" class="form-label">Last Name</label>
                            <input type="text" class="form-control mb-2" id="lastname" name="lastname" required value="<?= $row->last_name ?>">
                            <label for="birthdate" class="form-label">Last Name</label>
                            <input type="date" class="form-control mb-2" id="birthdate" name="birthdate" required value="<?= $row->birthdate ?>">
                        </div>
                        <div class="col">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control mb-2" id="email" name="email" required value="<?= $row->email ?>">
                            <label for="country" class="form-label">Country</label>
                            <input type="text" class="form-control mb-2" id="country" name="country" required value="<?= $row->country ?>">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="editStudent">Save changes</button>
                </div>
            </div>
        </div>
    </form>
</div>