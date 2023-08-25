<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../data_access/EmployeeRepository.php';
require_once '../data_access/DatabaseConnection.php';

// Instantiate the DatabaseConnection class
$dbConnection = new DatabaseConnection();

// Instantiate the EmployeeRepository class with the database connection
$employeeRepository = new EmployeeRepository($dbConnection);

// Delete an employee
// Delete the employee from the database
$firstName = $_GET['firstName'];
$lastName = $_GET['lastName'];
$employeeRepository->deleteEmployeeByName($firstName, $lastName);

// Redirect back to the employee list page
header("Location: GetEmployeeTable.php");
exit;

?>
