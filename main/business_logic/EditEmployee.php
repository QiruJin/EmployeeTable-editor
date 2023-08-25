<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../data_access/EmployeeRepository.php';
require_once '../data_access/DatabaseConnection.php';

// Instantiate the DatabaseConnection class
$dbConnection = new DatabaseConnection();

// Instantiate the EmployeeRepository class with the database connection
$employeeRepository = new EmployeeRepository($dbConnection);

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'edit') {
    // Extract first name and last name from the request parameters
    $firstName = $_GET['firstName'];
    $lastName = $_GET['lastName'];
    // Retrieve employee data by first name and last name
    $employee = $employeeRepository->getEmployeeByName($firstName, $lastName);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Employee</title>
    <link rel="stylesheet" type="text/css" href="../persentation/styles.css">
</head>
<body>
    <h1>Edit Employee</h1>
    <form action='EditEmployee.php' method='post'>
        <!-- Hidden input fields to carry data forward in the form submission -->
        <input type='hidden' name='action' value='confirm'>
        <input type='hidden' name='firstName' value='<?php echo $employee['first_name']; ?>'>
        <input type='hidden' name='lastName' value='<?php echo $employee['last_name']; ?>'>
        
        <!--
            Create a table to display employee original information and edit allowed, 
            including First Name, Last Name, and Salary. 
            has confirm button to allow users submit the daat.
        -->
        <table>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Salary</th>
                    <th></th>
                </tr>
            </thead>
            <tr>
                <td><input type='text' name='new_first_name' value='<?php echo $employee['first_name']; ?>' required></td>
                <td><input type='text' name='new_last_name' value='<?php echo $employee['last_name']; ?>' required></td>
                <td><input type='text' name='new_salary' value='<?php echo $employee['salary']; ?>'></td>
                <td><button type='submit'>Confirm</button></td>
            </tr>
        </table>
    </form>
    <!-- Link for return to the Employee Table page -->
    <p style="background-color:seashell;text-align:center;"><a href="GetEmployeeTable.php" title="Employee Table"> Back To Employee Table </a></p>
</body>
</html>

<?php
// Check if the request is a POST request and the action is 'confirm'
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'confirm') {
    // Extract data from the form submission
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $newFirstName = $_POST['new_first_name'];
    $newLastName = $_POST['new_last_name'];
    $newSalary = $_POST['new_salary'];

    // Validate inputs
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
?>