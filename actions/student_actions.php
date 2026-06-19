<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);

include "../database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST["action"] ?? "";

    if ($action === "delete") {
        try {
            $student_id = $_POST["student_id"] ?? "";

            $stmt = $conn->prepare("DELETE from student where StudentID = ?");
            $stmt->execute([$student_id]);

            header(
                "location: ../pages/students.php?message=" .
                    urlencode("Student deleted"),
            );
            exit();
        } catch (PDOException $e) {
            header(
                "Location: ../pages/students.php?message=" .
                    urlencode(
                        "Cannot delete student because related record exists",
                    ),
            );
        }
    }
    if ($action === "add") {
        $f_name = trim($_POST["f_name"] ?? "");
        $l_name = trim($_POST["l_name"] ?? "");
        $p_number = trim($_POST["p_number"] ?? "");
        $email = trim($_POST["email"] ?? "");
        $a_date = trim($_POST["a_date"] ?? "");
        $birth_date = trim($_POST["birth_date"] ?? "");

        if (
            $f_name === "" ||
            $l_name === "" ||
            $p_number === "" ||
            $email === "" ||
            $a_date === "" ||
            $birth_date === ""
        ) {
            header(
                "location:../students/index.php?message=" .
                    urldecode("All fields must be filled"),
            );
            exit();
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header(
                "location:../students/index.php?message=" .
                    urldecode("Invalid email address"),
            );
            exit();
        }
        if (strtotime($birth_date) > strtotime($a_date)) {
            header(
                "Location: ../pages/instructors.php?message=" .
                    urlencode("Birth date cannot be after hire date"),
            );
            exit();
        }

        // Generate an unique Student ID (ADD FORM)
        $idStmt = $conn->query("
            SELECT StudentID
            FROM student
            ORDER BY CAST(SUBSTRING(StudentID, 2) AS UNSIGNED) DESC
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

        $student_id = "S" . str_pad($num, 3, "0", STR_PAD_LEFT);

        try {
            $stmt = $conn->prepare("
                INSERT INTO student
                (StudentID, FirstName, LastName, Email, Phone, UnivAdmitDate, BirthDate)
                VALUES (?, ?, ?, ?, ?, ?, ?)
                ");
            $stmt->execute([
                $student_id,
                $f_name,
                $l_name,
                $email,
                $p_number,
                $a_date,
                $birth_date,
            ]);
            header(
                "Location: ../pages/students.php?message=Student added successfully",
            );
            exit();
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
            exit();
        }
    }
    if ($action === "update") {
        $student_id = $_POST["student_id"] ?? "";
        $stmt = $conn->prepare(
            "UPDATE student
        SET 
            FirstName = ?, 
            LastName = ?, 
            UnivAdmitDate = ?, 
            BirthDate = ?, 
            Email = ?, 
            Phone = ?   
        where StudentID = ?",
        );

        $stmt->execute([
            $_POST["f_name"],
            $_POST["l_name"],
            $_POST["a_date"],
            $_POST["birth_date"],
            $_POST["email"],
            $_POST["phone"],
            $student_id,
        ]);
        header("Location: ../pages/students.php?message=Student Updated");
        exit();
    }
}

?>
