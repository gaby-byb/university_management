<?php
include "../database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST["action"];

    if ($action === "delete") {
        try {
            $courseID = $_POST["course_id"] ?? "";
            $stmt = $conn->prepare("DELETE from course WHERE CourseID=?");
            $stmt->execute([$courseID]);

            header(
                "Location: ../pages/courses.php?message=" .
                    urlencode("Course deleted"),
            );
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
