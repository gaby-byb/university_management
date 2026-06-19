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
<form action="../actions/student_actions.php" method="post">

    <input type="hidden" name="action" value="update">

    <input
        type="hidden"
        name="student_id"
        value="<?= htmlspecialchars($student["StudentID"]) ?>"
    >

    <label>First Name</label>
    <input
        type="text"
        name="f_name"
        value="<?= htmlspecialchars($student["FirstName"]) ?>"
    >

    <label>Last Name</label>
    <input
        type="text"
        name="l_name"
        value="<?= htmlspecialchars($student["LastName"]) ?>"
    >
    <label>Email</label>
    <input
        type="text"
        name="email"
        value="<?= htmlspecialchars($student["Email"]) ?>"
    >
    <label>Phone</label>
    <input
        type="text"
        name="phone"
        value="<?= htmlspecialchars($student["Phone"]) ?>"
    >
    <label>Birth Date</label>
    <input
        type="date"
        name="birth_date"
        value="<?= htmlspecialchars($student["BirthDate"]) ?>"
    >
    <label>Admission Date</label>
    <input
        type="date"
        name="a_date"
        value="<?= htmlspecialchars($student["UnivAdmitDate"]) ?>"
    >
    <button type="submit">
        Save Changes
    </button>

</form>
