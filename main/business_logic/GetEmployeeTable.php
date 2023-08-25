<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../data_access/EmployeeRepository.php'; 
require_once '../data_access/DatabaseConnection.php';

// Instantiate the DatabaseConnection class
$dbConnection = new DatabaseConnection();

// Instantiate the EmployeeRepository class with the database connection
$employeeRepository = new EmployeeRepository($dbConnection);

// Get data of all employees
$employees = $employeeRepository->getAllEmployees();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee List</title>
    <link rel="stylesheet" type="text/css" href="../persentation/styles.css">
</head>
<body>
    <!--
        Create a table to display employee information, 
        including First Name, Last Name, and Salary. 
        Each row also has Edit and Delete links to allow users to manage employee data.
    -->
    <h1>Employee List</h1>
    <table>
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Salary</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <!-- Iterates through the list of employees and generates a table row for each employee -->
            <!-- Display each employee's first name, last name, and salary -->
            <?php foreach ($employees as $employee): ?>
                <tr>
                    <td><?php echo $employee['first_name'] ?></td>
                    <td><?php echo $employee['last_name'] ?></td>
                    <td>$<?php echo $employee['salary'] ?></td>
                    <td><a href='EditEmployee.php?action=edit&firstName=<?php echo $employee['first_name']; ?>&lastName=<?php echo $employee['last_name']; ?>'>Edit</a></td>
                    <td>
                        <form action='DeleteEmployee.php' method='get'>
                            <input type='hidden' name='action' value='delete'>
                            <input type='hidden' name='firstName' value='<?php echo $employee['first_name']; ?>'>
                            <input type='hidden' name='lastName' value='<?php echo $employee['last_name']; ?>'>
                            <button type='submit' class='delete-button'>Delete</button>
                        </form>
                    </td>                
                </tr>
            <?php endforeach; ?>
            <!-- Add Empty row for user to add employee -->
            <tr>
            <form action="../business_logic/AddEmployee.php" method="get">
            <td><input type="text" name="new_first_name" placeholder="First Name" required></td>
            <td><input type="text" name="new_last_name" placeholder="Last Name" required></td>
            <td><input type="number" name="new_salary" placeholder="Salary"></td>
            <td colspan="2"><button type="submit" class='add-button'>Add Employee</button></td>
            </form>
            </tr>
        </tbody>
    </table>
    <p style="background-color:seashell;text-align:center;"><a href="../persentation/HomePage.html" title="Home Page"> Back To Home Page </a></p>
</body>
</html>