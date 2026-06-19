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
$departments = $dept_stmt->fetch(PDO::FETCH_ASSOC);

include "../includes/header.html";
?>
<!-- PREFILL THE FORM (POST WILL SEND THE INFO TO instructor ACTIONS)-->
<form action="../pages/instructor_actions.php" method="post">
    <input type="hidden" name="action" value="update">
    <input 
        type="hidden"
        name="instructor_id"
        value="<?= htmlspecialchars($instructor["InstructorID"]) ?>"
    >
    <label>First Name</label>
    <input
        type="text"
        name="f_name"
        value="<?= htmlspecialchars($instructor["FirstName"]) ?>"
    >
    <label>Last Name</label>
    <input
        type="text"
        name="l_name"
        value="<?= htmlspecialchars($instructor["LastName"]) ?>"
    >
    <label>Email</label>
    <input
        type="text"
        name="email"
        value="<?= htmlspecialchars($instructor["Email"]) ?>"
    >
    <label>Phone Number</label>
    <input
        type="text"
        name="phone"
        value="<?= htmlspecialchars($instructor["Phone"]) ?>"
    >
    <label>Birth Date</label>
    <input
        type="date"
        name="birth_date"
        value="<?= htmlspecialchars($instructor["InstBirthDate"]) ?>"
    >
    <label>Hire Date</label>
    <input
        type="date"
        name="hire_date"
        value="<?= htmlspecialchars($instructor["InstHireDate"]) ?>"
    >
    <label>Department</label>
    <select name="dept_id">

        <?php foreach ($departments as $department): ?>
        <!-- Value that will be submitted when the form is saved -->
        <!-- If this is the instructor's current department,
        automatically select it in the dropdown -->
        <option
            value="<?= htmlspecialchars($department["DeptID"]) ?>"
            <?= $department["DeptID"] == $instructor["DeptID"]
                ? "selected"
                : "" ?>
        >
            <?= htmlspecialchars($department["DeptID"]) ?>
            -
            <?= htmlspecialchars($department["DeptName"]) ?>
        </option>

        <?php endforeach; ?>
        
    </select>


</form>