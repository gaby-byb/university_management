<?php

include "database.php";
include "header.html";

$sql =
    "SELECT InstructorID, InstBirthDate, InstHireDate, DeptID FROM instructor";
$stmt = $conn->query($sql);
$instructors = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="container py-5">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white">
            <h2 class="h5 mb-0">Instructors</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped align-middle mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th>ID</th>
                            <th>Birth date</th>
                            <th>Hire Date</th>
                            <th>Department ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($instructors as $instructor): ?>
                        <tr>
                            <td><?= htmlspecialchars(
                                $instructor["InstructorID"],
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
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<?php include "footer.html"; ?>
