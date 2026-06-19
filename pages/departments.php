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
            <!-- Button Trigger Modal -->
             <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add Department 
             </button>
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
<!-- CRUD MODAL -->
       <!-- Modal -->
       <form action="../actions/department_actions.php" method="post">

        <input type="hidden" name="action" value="add">

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">

                <h1 class="modal-title fs-5" id="exampleModalLabel">Department Information</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              
              </div>

              <div class="modal-body">
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control">
                    <label>Date Established</label>
                    <input type="date" name="date_est" class="form-control">
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
