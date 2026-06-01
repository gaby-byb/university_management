<?php
include "database.php";
include "header.html";
$sql =
    "SELECT StudentID, UnivAdmitDate, BirthDate, TIMESTAMPDIFF(YEAR, BirthDate, CURDATE()) AS Age FROM student";
$stmt = $conn->query($sql);
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<main class="container py-5">
  <div class="card border-0 shadow-sm">
    <div class="card-header bg-white">
      <h2 class="h5 mb-0">Students</h2>
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
<?php include "footer.html"; ?>
