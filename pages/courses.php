<?php
include "../database.php";
include "../includes/header.html";

$stmt = $conn->query("
SELECT 
    CourseID, CourseName, CreditHours, DeptID
from course");
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="container py-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>

        <h1 class="h2 mb-1">Courses</h1>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add Course
        </button>
    </div>    
        <a class="btn btn-outline-primary" href="/University/index.php">Back to Home</a>
    </div>
    <!-- Add Course success message -->
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
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped align-middle mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th>ID</th>
                            <th>Course Name</th>
                            <th>Credit Hours</th>
                            <th>Department ID</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($courses as $course): ?>
                        <tr>
                            <td><?= htmlspecialchars(
                                $course["CourseID"],
                            ) ?></td>
                            <td><?= htmlspecialchars(
                                $course["CourseName"],
                            ) ?></td>
                            <td><?= htmlspecialchars(
                                $course["CreditHours"],
                            ) ?></td>
                            <td><?= htmlspecialchars($course["DeptID"]) ?></td>
                            <!-- DELETE COLUMN -->
                             <td>
                                <form 
                                action="../actions/course_actions.php"
                                method="post"
                                onsubmit="return confirm('Delete this course?')"
                                >
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="course_id" value="<?= htmlspecialchars(
                                    $course["CourseID"],
                                ) ?>">
                                <button type="submit" class="btn btn-danger">
                                    Delete
                                </button>
                                </form>
                             </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
</main>

<!-- CRUD MODAL -->
       <!-- Modal -->
       <form action="../actions/course_actions.php" method="post">

        <input type="hidden" name="action" value="add">

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">

                <h1 class="modal-title fs-5" id="exampleModalLabel">Course Information</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              
              </div>

              <div class="modal-body">
                  <div class="form-group">
                    <label>Course ID</label>
                    <input type="text" name="course_id" class="form-control">
                    <label>Course Name</label>
                    <input type="text" name="name" class="form-control">
                    <label>Credit Hours</label>
                    <input type="text" name="c_hours" class="form-control">
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
            setTimeout(() => alert.remove(), 150)
        }
    }, 3000)
</script>
