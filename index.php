<?php
include "includes/header.html";
include "database.php";
?>

<main class="container py-5">
  <div class="bg-white border rounded-3 shadow-sm p-4 p-md-5 mb-4">
    <h1 class="h2 mb-2">University System</h1>
    <p class="text-secondary mb-0">A simple dashboard for student and instructor records.</p>
  </div>

  <div class="row g-4">
    <div class="col-md-6">
      <div class="card h-100 border-0 shadow-sm">
        <div class="card-body p-4">
          <h2 class="h5 card-title">Students</h2>
          <p class="card-text text-secondary">View student admission dates, birth dates, and ages.</p>
          <a class="btn btn-primary" href="/University/pages/students.php">Open Students</a>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card h-100 border-0 shadow-sm">
        <div class="card-body p-4">
          <h2 class="h5 card-title">Instructors</h2>
          <p class="card-text text-secondary">View instructor birth dates, hire dates, and departments.</p>
          <a class="btn btn-primary" href="/University/pages/instructor.php">Open Instructors</a>
        </div>
      </div>
    </div>
      <div class="col-md-6">
      <div class="card h-100 border-0 shadow-sm">
        <div class="card-body p-4">
          <h2 class="h5 card-title">Departments</h2>
          <p class="card-text text-secondary">View departments and date established.</p>
          <a class="btn btn-primary" href="/University/pages/departments.php">Open Departments</a>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card h-100 border-0 shadow-sm">
        <div class="card-body p-4">
          <h2 class="h5 card-title">About</h2>
          <p class="card-text text-secondary">Learn more about this university CRUD application.</p>
          <a class="btn btn-outline-primary" href="/University/pages/about.php">Open About</a>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include "includes/footer.html"; ?>
