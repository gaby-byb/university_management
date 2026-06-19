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
        $f_name = $_POST["f_name"];
        $l_name = $_POST["l_name"];
        $p_number = $_POST["phone"];
        $email = $_POST["email"];
        $hire_date = $_POST["hire_date"];
        $birth_date = $_POST["birth_date"];

        $idStmt = $conn->query("
        SELECT InstructorID
        FROM instructor
        ORDER BY CAST(SUBSTRING(InstructorID, 2) AS UNSIGNED) DESC
        LIMIT 1
        ");

        $lastId = $idStmt->fetchColumn();
        if ($lastId) {
            /*Take the last student ID, 
            remove the S, turn the rest into a number, 
            then add 1.*/
            $num = intval(substr($lastId, 1)) + 1;
        } else {
            $num = 1;
        }
        $instructor_id = "I" . str_pad($num, 3, "0", STR_PAD_LEFT);

        try {
            $stmt = $conn->prepare("
            INSERT INTO instructor
            (InstructorID, FirstName, LastName, Email, Phone, InstBirthDate, InstHireDate)
            VALUES (?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([
                $instructor_id,
                $f_name,
                $l_name,
                $email,
                $p_number,
                $birth_date,
                $hire_date,
            ]);
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
            exit();
        }
    }
}

?>
