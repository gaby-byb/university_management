<?php

include "../database.php";
include "../includes/header.html";

$sql =
    "SELECT InstructorID, InstBirthDate, InstHireDate, DeptID FROM instructor";
$stmt = $conn->query($sql);
$instructors = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="container py-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h1 class="h2 mb-1">Instructors</h1>
            <p class="text-secondary mb-0">Instructor birth dates, hire dates, and departments.</p>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add Instructor
            </button>
        </div>
        <a class="btn btn-outline-primary" href="/University/index.php">Back to Home</a>
    </div>
    
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
                    <label>Hire Date</label>
                    <input type="date" name="a_date" class="form-control">
                    <label>Date of Birth</label>
                    <input type="date" name="birth_date" class="form-control">
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
<?php include "../includes/footer.html"; ?>
