<?php
include "../database.php";
include "../includes/header.html";
$sql =
    "SELECT StudentID, UnivAdmitDate, BirthDate, TIMESTAMPDIFF(YEAR, BirthDate, CURDATE()) AS Age FROM student";
$stmt = $conn->query($sql);
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<main class="container py-5">
  <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
      <h1 class="h2 mb-1">Students</h1>
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">ADD STUDENTS</button>
      

      <p class="text-secondary mb-0">Student admission dates, birth dates, and ages.</p>
    </div>
    <a class="btn btn-outline-primary" href="/University/index.php">Back to Home</a>
  </div>

  <div class="card border-0 shadow-sm">
    <div class="card-header bg-white">
      <h2 class="h5 mb-0">Student List</h2>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover table-bordered table-striped align-middle mb-0">
          <thead class="table-primary">
            <tr>
              <th>ID</th>
              <th>Admission Date</th>
              <th>Date of Birth</th>
              <th>Age</th>
            </tr>
          </thead>

          <tbody>
            <?php foreach ($students as $student): ?>
              <tr>
                <td><?= htmlspecialchars($student["StudentID"]) ?></td>
                <td><?= htmlspecialchars($student["UnivAdmitDate"]) ?></td>
                <td><?= htmlspecialchars($student["BirthDate"]) ?></td>
                <td><?= htmlspecialchars($student["Age"]) ?></td>
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
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form>
                  <div class="form-group">
                    <label>Admission Date</label>
                    <input type="text" name="a_date" class="form-control">
                    <label>Date of Birth</label>
                    <input type="date" name="birth_date" class="form-control">
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
<?php include "../includes/footer.html"; ?>
