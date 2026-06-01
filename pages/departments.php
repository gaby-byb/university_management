<?php
include "../includes/header.html";
include "../database.php";

$sql = "SELECT DeptID, DeptName, DeptDateEst FROM department";
$stmt = $conn->query($sql);

$departments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="container py-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h1 class="h2 mb-1">Departments</h1>
            <p class="text-secondary mb-0">Department names and date established</p>
        </div>
        <a class="btn btn-outline-primary" href="/University/index.php">Back to Home</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white">
            <h2 class="h5 mb-0">Department List</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped align-middle mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Date Established</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($departments as $department): ?>
                        <tr>
                            <td><?= htmlspecialchars(
                                $department["DeptID"],
                            ) ?></td>
                            <td><?= htmlspecialchars(
                                $department["DeptName"],
                            ) ?></td>
                            <td><?= htmlspecialchars(
                                $department["DeptDateEst"],
                            ) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<?php include "../includes/footer.html"; ?>
