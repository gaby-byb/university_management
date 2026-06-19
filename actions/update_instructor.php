<!-- this file prefills the update form with the current instructors information
    it receives the GET request from instructor.php (because we're only asking for a page)
    sends a POST to instructor_actions (here we actually make changes to the database)
-->
<?php
include "../database.php";

//Get instructor by ID
$instructor_id = $_GET["instructor_id"] ?? "";
$stmt = $conn->prepare("
    SELECT 
    InstructorID, FirstName, LastName, Email, Phone, InstBirthDate, InstHireDate, DeptID
    from instructor
    where InstructorID = ?");
$stmt->execute([$instructor_id]);
// Convert the query result into an associative array
$instructor = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$instructor) {
    header(
        "Location: ../pages/instructor.php?message=" .
            urlencode("Instructor not found"),
    );
    exit();
}
// Get all departments from the database
// We need this to populate the dropdown menu
$dept_stmt = $conn->query("
    SELECT DeptID, DeptName
    FROM department
");
// Convert the query result into an associative array
$departments = $dept_stmt->fetchAll(PDO::FETCH_ASSOC);

include "../includes/header.html";
?>
<!-- PREFILL THE FORM (POST WILL SEND THE INFO TO instructor ACTIONS)-->
<main class="container py-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h1 class="h2 mb-1">Update Instructor</h1>
            <p class="text-secondary mb-0">
                Edit the record for <?= htmlspecialchars(
                    $instructor["FirstName"] . " " . $instructor["LastName"],
                ) ?>.
            </p>
        </div>
        <a class="btn btn-outline-primary" href="/University/pages/instructors.php">
            Back to Instructors
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white">
            <h2 class="h5 mb-0">Instructor Information</h2>
        </div>
        <div class="card-body p-4">
            <form action="../actions/instructor_actions.php" method="post">
                <input type="hidden" name="action" value="update">
                <input 
                    type="hidden"
                    name="instructor_id"
                    value="<?= htmlspecialchars($instructor["InstructorID"]) ?>"
                >

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">First Name</label>
                        <input
                            type="text"
                            name="f_name"
                            class="form-control"
                            value="<?= htmlspecialchars(
                                $instructor["FirstName"],
                            ) ?>"
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Last Name</label>
                        <input
                            type="text"
                            name="l_name"
                            class="form-control"
                            value="<?= htmlspecialchars(
                                $instructor["LastName"],
                            ) ?>"
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="<?= htmlspecialchars(
                                $instructor["Email"],
                            ) ?>"
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Phone Number</label>
                        <input
                            type="text"
                            name="p_number"
                            class="form-control"
                            value="<?= htmlspecialchars(
                                $instructor["Phone"],
                            ) ?>"
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Birth Date</label>
                        <input
                            type="date"
                            name="birth_date"
                            class="form-control"
                            value="<?= htmlspecialchars(
                                $instructor["InstBirthDate"],
                            ) ?>"
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Hire Date</label>
                        <input
                            type="date"
                            name="hire_date"
                            class="form-control"
                            value="<?= htmlspecialchars(
                                $instructor["InstHireDate"],
                            ) ?>"
                        >
                    </div>

                    <div class="col-12">
                        <label class="form-label">Department</label>
                        <select name="dept_id" class="form-select">

                            <?php foreach ($departments as $department): ?>
                            <!-- Value that will be submitted when the form is saved -->
                            <!-- If this is the instructor's current department,
                            automatically select it in the dropdown -->
                            <option
                                value="<?= htmlspecialchars(
                                    $department["DeptID"],
                                ) ?>"
                                <?= $department["DeptID"] ==
                                $instructor["DeptID"]
                                    ? "selected"
                                    : "" ?>
                            >
                                <?= htmlspecialchars($department["DeptID"]) ?>
                                -
                                <?= htmlspecialchars($department["DeptName"]) ?>
                            </option>

                            <?php endforeach; ?>
                            
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a class="btn btn-secondary" href="/University/pages/instructors.php">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<?php include "../includes/footer.html"; ?>
