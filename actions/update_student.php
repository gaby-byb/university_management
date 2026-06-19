<?php
include "../database.php";

$student_id = $_GET["student_id"] ?? "";
$stmt = $conn->prepare("SELECT 
    StudentID, FirstName, LastName, UnivAdmitDate, BirthDate, Email, Phone 
    from student 
    where StudentID = ?");
$stmt->execute([$student_id]);

$student = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$student) {
    header(
        "Location: ../pages/students.php?message=" .
            urlencode("Student not found"),
    );
    exit();
}
include "../includes/header.html";
?>
<!-- PREFILL THE FORM (POST WILL SEND THE INFO TO STUDENTS ACTIONS)-->
<main class="container py-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h1 class="h2 mb-1">Update Student</h1>
            <p class="text-secondary mb-0">
                Edit the record for <?= htmlspecialchars(
                    $student["FirstName"] . " " . $student["LastName"],
                ) ?>.
            </p>
        </div>
        <a class="btn btn-outline-primary" href="/University/pages/students.php">
            Back to Students
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white">
            <h2 class="h5 mb-0">Student Information</h2>
        </div>
        <div class="card-body p-4">
            <form action="../actions/student_actions.php" method="post">

                <input type="hidden" name="action" value="update">

                <input
                    type="hidden"
                    name="student_id"
                    value="<?= htmlspecialchars($student["StudentID"]) ?>"
                >

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">First Name</label>
                        <input
                            type="text"
                            name="f_name"
                            class="form-control"
                            value="<?= htmlspecialchars($student["FirstName"]) ?>"
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Last Name</label>
                        <input
                            type="text"
                            name="l_name"
                            class="form-control"
                            value="<?= htmlspecialchars($student["LastName"]) ?>"
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="<?= htmlspecialchars($student["Email"]) ?>"
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Phone</label>
                        <input
                            type="text"
                            name="phone"
                            class="form-control"
                            value="<?= htmlspecialchars($student["Phone"]) ?>"
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Birth Date</label>
                        <input
                            type="date"
                            name="birth_date"
                            class="form-control"
                            value="<?= htmlspecialchars($student["BirthDate"]) ?>"
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Admission Date</label>
                        <input
                            type="date"
                            name="a_date"
                            class="form-control"
                            value="<?= htmlspecialchars(
                                $student["UnivAdmitDate"],
                            ) ?>"
                        >
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a class="btn btn-secondary" href="/University/pages/students.php">
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
