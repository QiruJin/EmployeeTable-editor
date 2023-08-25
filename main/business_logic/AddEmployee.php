<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../data_access/EmployeeRepository.php';
require_once '../data_access/DatabaseConnection.php';

// Instantiate the DatabaseConnection class
$dbConnection = new DatabaseConnection();

// Instantiate the EmployeeRepository class with the database connection
$employeeRepository = new EmployeeRepository($dbConnection);

// Handle adding a new employee
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['new_first_name']) && isset($_GET['new_last_name']) && isset($_GET['new_salary'])) {
        $newFirstName = $_GET['new_first_name'];
        $newLastName = $_GET['new_last_name'];
        $newSalary = $_GET['new_salary'];

        // Validate First Name and Last Name are not empty since they are primary key
        if (empty($newFirstName) || empty($newLastName)) {
            echo "First Name and Last Name are required.";
        } elseif (!is_numeric($newSalary) || $newSalary < 0) {
            echo "Salary must be a valid number.";
        } else {
            // Add the new employee to the database
            $newEmployee = [
                'first_name' => $newFirstName,
                'last_name' => $newLastName,
                'salary' => $newSalary
            ];
            $employeeRepository->addEmployee($newEmployee);

            // Redirect to the employee list page
            header("Location: GetEmployeeTable.php");
            exit();
        }
    }
}
?>
