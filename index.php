<?php
include "header.html";
include "database.php";
?>

<main class="container py-5">
  <div class="row g-4">
    <div class="col-md-6">
      <div class="card h-100 border-0 shadow-sm">
        <div class="card-body">
          <h2 class="h5 card-title">Students</h2>
          <p class="card-text text-secondary">View student admission dates, birth dates, and ages.</p>
          <a class="btn btn-primary" href="students.php">Open Students</a>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card h-100 border-0 shadow-sm">
        <div class="card-body">
          <h2 class="h5 card-title">Instructors</h2>
          <p class="card-text text-secondary">View instructor birth dates, hire dates, and departments.</p>
          <a class="btn btn-primary" href="instructor.php">Open Instructors</a>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card h-100 border-0 shadow-sm">
        <div class="card-body">
          <h2 class="h5 card-title">About</h2>
          <p class="card-text text-secondary">Learn more about this university CRUD application.</p>
          <a class="btn btn-outline-primary" href="about.php">Open About</a>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include "footer.html"; ?>
