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
            exit();
        }
    }
    if ($action === "add") {
        // set variables for all attributes
        //trim does lazy form validation
        $f_name = trim($_POST["f_name"] ?? "");
        $l_name = trim($_POST["l_name"] ?? "");
        $p_number = trim($_POST["phone"] ?? "");
        $email = trim($_POST["email"] ?? "");
        $hire_date = trim($_POST["hire_date"] ?? "");
        $birth_date = trim($_POST["birth_date"] ?? "");
        $dept_id = trim($_POST["dept_id"] ?? "");

        // FORM VALIDATION
        if (
            $f_name === "" ||
            $l_name === "" ||
            $p_number === "" ||
            $email === "" ||
            $hire_date === "" ||
            $birth_date === "" ||
            $dept_id === ""
        ) {
            header(
                "Location: ../pages/instructors.php?message=" .
                    urlencode("All fields are required"),
            );
            exit();
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header(
                "Location: ../pages/instructors.php?message=" .
                    urlencode("Invalid email address"),
            );
            exit();
        }

        if (strtotime($birth_date) > strtotime($hire_date)) {
            header(
                "Location: ../pages/instructors.php?message=" .
                    urlencode("Birth date cannot be after hire date"),
            );
            exit();
        }

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
            (InstructorID, FirstName, LastName, Email, Phone, InstBirthDate, InstHireDate, DeptID)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([
                $instructor_id,
                $f_name,
                $l_name,
                $email,
                $p_number,
                $birth_date,
                $hire_date,
                $dept_id,
            ]);
            header(
                "Location: ../pages/instructors.php?message=" .
                    urldecode("Instructor added"),
            );
            exit();
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
            exit();
        }
    }
    if ($action === "update") {
        try {
            $instructor_id = $_POST["instructor_id"] ?? "";
            $stmt = $conn->prepare(
                "UPDATE instructor
                SET
                    FirstName = ?, 
                    LastName = ?, 
                    InstHireDate = ?, 
                    InstBirthDate = ?, 
                    Email = ?, 
                    Phone = ?,  
                    DeptID = ?
                WHERE
                    InstructorID = ?",
            );
            $stmt->execute([
                $_POST["f_name"],
                $_POST["l_name"],
                $_POST["hire_date"],
                $_POST["birth_date"],
                $_POST["email"],
                $_POST["p_number"],
                $_POST["dept_id"],
                $instructor_id,
            ]);
            header(
                "Location: ../pages/instructors.php?message=" .
                    urlencode("Instructor Updated"),
            );
            exit();
        } catch (PDOException $e) {
            header(
                "Location: ../pages/instructors.php?message=" .
                    urlencode("Error updating instructor"),
            );
            exit();
        }
    }
}

?>
