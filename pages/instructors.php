<?php

include "../database.php";
include "../includes/header.html";

$sql =
    "SELECT InstructorID, InstBirthDate, InstHireDate, DeptID, FirstName, LastName, Email, Phone FROM instructor";
$stmt = $conn->query($sql);
$instructors = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="container py-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h1 class="h2 mb-1">Instructors</h1>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add Instructor
            </button>
        </div>
        <a class="btn btn-outline-primary" href="/University/index.php">Back to Home</a>
    </div>
    <!-- ADD instructor success message -->
    <?php if (isset($_GET["message"])): ?>
        <div id="success-alert" class="alert alert-success alert-dismissible fade show">
            <?= htmlspecialchars($_GET["message"]) ?>
            <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            >
            </button>
        </div>
        <?php endif; ?>
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white">
            <h2 class="h5 mb-0">Instructor List</h2>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped align-middle mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Birth date</th>
                            <th>Hire Date</th>
                            <th>Department ID</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($instructors as $instructor): ?>
                        <tr>
                            <td><?= htmlspecialchars(
                                $instructor["InstructorID"],
                            ) ?></td>
                            <td><?= htmlspecialchars(
                                $instructor["FirstName"] .
                                    " " .
                                    $instructor["LastName"],
                            ) ?></td>
                            <td><?= htmlspecialchars(
                                $instructor["Phone"],
                            ) ?></td>
                            <td><?= htmlspecialchars(
                                $instructor["Email"],
                            ) ?></td>
                            <td><?= htmlspecialchars(
                                $instructor["InstBirthDate"],
                            ) ?></td>
                            <td><?= htmlspecialchars(
                                $instructor["InstHireDate"],
                            ) ?></td>
                            <td><?= htmlspecialchars(
                                $instructor["DeptID"],
                            ) ?></td>
                            
                            <!-- UPDATE INSTRUCTOR / SEND ID -->
                            <td>
                                <form action="../actions/update_instructor.php" method="get">
                                <input 
                                type="hidden"
                                name="instructor_id"
                                value="<?= htmlspecialchars(
                                    $instructor["InstructorID"],
                                ) ?>">
                                <button type="submit" class="btn btn-success">
                                    Update
                                </button>
                                </form>

                            </td>

                            <!-- DELETE INSTRUCTOR / SENDS ID -->
                            <td>
                                <form action="../actions/instructor_actions.php"
                                method="post"
                                onsubmit="return confirm('Delete this instructor?')">

                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="instructor_id" 
                                value="<?= htmlspecialchars(
                                    $instructor["InstructorID"],
                                ) ?>">
                                    <button type="submit" class="btn btn-danger">
                                    Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<!-- CRUD MODAL -->
       <!-- Modal -->
       <form action="../actions/instructor_actions.php" method="post">

        <input type="hidden" name="action" value="add">

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">

                <h1 class="modal-title fs-5" id="exampleModalLabel">Instructor Information</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              
              </div>

              <div class="modal-body">
                  <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="f_name" class="form-control">
                    <label>Last Name</label>
                    <input type="text" name="l_name" class="form-control">
                    <label>Phone Number</label>
                    <input type="text" name="p_number" class="form-control">
                    <label>Email </label>
                    <input type="text" name="email" class="form-control">
                    <label>Hire Date</label>
                    <input type="date" name="hire_date" class="form-control">
                    <label>Date of Birth</label>
                    <input type="date" name="birth_date" class="form-control">
                    
                    <!-- Generate Departments / fetch from table -->
                    <?php
                    $stmt = $conn->query("
                    SELECT DeptID, DeptName
                    FROM department
                    ORDER BY DeptID
                    ");
                    $departments = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    ?>

                    <label>Department</label>
                    <select name="dept_id" class="form-control">
                        <option value=""> Select a Department
                        <?php foreach ($departments as $department): ?>
                            <option value="<?= htmlspecialchars(
                                $department["DeptID"],
                            ) ?>">
                            <?= htmlspecialchars($department["DeptID"]) ?>
                            -
                            <?= htmlspecialchars($department["DeptName"]) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>

                </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <input type="submit" class="btn btn-primary green" name="add_student" value="Add"></input>
                </div>

              </div>
            </div>
          </div>
        </form>

<script>
    setTimeout(() => {
        const alert = document.getElementById("success-alert")
        if (alert) {
            alert.classList.remove("show");
            setTimeout(() => alert.remove, 150)
        }
    }, 3000)
</script>
<?php include "../includes/footer.html"; ?>
