<?php
include "../database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST["action"] ?? "";

    if ($action === "add") {
        try {
            $name = trim($_POST["name"] ?? "");
            $date_est = trim($_POST["date_est"] ?? "");

            if ($name === "" || $date_est === "") {
                header(
                    "Location: ../pages/department.php?message=" .
                        urlencode("All fields are required"),
                );
                exit();
            }
            $idStmt = $conn->query(
                "SELECT DeptID
                FROM department
                ORDER BY DeptID
                LIMIT 1",
            );
            //find the last id added and adds 1
            $newID = ($idStmt->fetchColumn() ?? 0) + 1;
            try {
                $stmt = $conn->prepare(
                    "INSERT INTO department
                    (DeptID, DeptName, DeptDateEst)
                    VALUES (?, ?, ?)",
                );
                $stmt->execute([$newID, $name, $date_est]);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        } catch (PDOException $e) {
            header(
                "Location: ../pages/department.php?message=" .
                    urlencode("Cannot add department"),
            );
            echo $e->getMessage();
            exit();
        }
    }
}
?>
