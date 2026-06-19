<?php

include "../database.php";
// get the value of action (add) and set action
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST["action"] ?? ""; //if not use an empty string

    if ($action === "delete") {
        try {
            $instructor_id = $_POST["instructor_id"] ?? "";

            $stmt = $conn->prepare(
                "DELETE from instructor where InstructorID = ? ",
            );
            $stmt->execute([$instructor_id]);

            header(
                "Location: ../pages/instructors.php?message=" .
                    urlencode("Instructor deleted"),
            );

            exit();
        } catch (PDOException $e) {
            header(
                "Location: ../pages/instructors.php?message=" .
                    urlencode("Cannot delete instructor"),
            );
        }
    }
    if ($action === "add") {
        // set variables for all attributes
        $birth_date = $_POST["birth_date"];
        $hire_date = $_POST["hire_date"];
    }
}

?>
