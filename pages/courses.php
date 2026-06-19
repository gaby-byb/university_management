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
        <h1 class="h2 mb-1">Courses</h1>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add Instructor
            </button>
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
                            <th>Course Name</th>
                            <th>Credit Hours</th>
                            <th>Department ID</th>
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
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
</main>
