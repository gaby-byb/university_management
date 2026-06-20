<?php
include "../database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST["action"];
    $courseID = $_POST["course_id"] ?? "";

    if ($action === "add") {
        try {
            $name = trim($_POST["name"] ?? "");
            $c_hours = trim($_POST["c_hours"] ?? "");
            $dept_id = trim($_POST["dept_id"] ?? "");

            if ($name === "" || $c_hours === "" || $dept_id === "") {
                header(
                    "Location: ../pages/courses.php?message=" .
                        urlencode("All fields are required"),
                );
                exit();
            }

            $stmt = $conn->prepare(
                "INSERT into course
                (CourseID, CourseName, CreditHours, DeptID)
                VALUES (?,?,?,?)",
            );
            $stmt->execute([$courseID, $name, $c_hours, $dept_id]);

            header(
                "Location: ../pages/courses.php?message=" .
                    urlencode("Course Added Succesfully"),
            );
            exit();
        } catch (PDOException $e) {
            die($e->getMessage());
            header(
                "Location: ../pages/courses.php?message=" .
                    urlencode("Cannot add course"),
            );
            exit();
        }
    }
    if ($action === "delete") {
        try {
            $stmt = $conn->prepare("DELETE from course WHERE CourseID=?");
            $stmt->execute([$courseID]);

            header(
                "Location: ../pages/courses.php?message=" .
                    urlencode("Course deleted"),
            );
            exit();
        } catch (PDOException $e) {
            echo $e->getmessage();
            header(
                "Location: ../pages/courses.php?message=" .
                    urlencode("Cannot delete course"),
            );
            exit();
        }
    }
}

?>
