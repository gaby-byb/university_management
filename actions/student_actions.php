<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);

include "../database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST["action"] ?? "";

    if ($action === "delete") {
        $student_id = $_POST["student_id"] ?? "";

        $stmt = $conn->prepare("DELETE from student where StudentID = ?");
        $stmt->execute([$student_id]);

        header(
            "location: ../pages/students.php?message=" .
                urlencode("Student deleted"),
        );
        exit();
    }
    if ($action === "add") {
        $f_name = $_POST["f_name"];
        $l_name = $_POST["l_name"];

        $p_number = $_POST["p_number"];
        $email = $_POST["email"];
        $a_date = $_POST["a_date"];
        $birth_date = $_POST["birth_date"];

        if ($f_name == "" || empty($f_name)) {
            header(
                "location:../students/index.php?message=First name cannot be empty",
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
}

?>
