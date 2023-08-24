<?php

require_once 'EmployeeRepositoryInterface.php';
require_once 'DatabaseConnectionInterface.php';

class EmployeeRepository implements EmployeeRepositoryInterface {
    private $conn;

    public function __construct(DatabaseConnectionInterface $dbConnection) {
        $this->conn = $dbConnection->getConnection();
    }

    /**
     * Get all employees
     * This function retrieves all employee records from the database.
     * 
     * @return array Array of employee data, containing 'first_name', 'last_name', and 'salary'
     */
    public function getAllEmployees() {
        try {
            // SQL query to retrieve all employees from employees table
            $query = "SELECT * FROM employees";
            // Prepare the query statement and execute later
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            // Fetch all employee records as an associative array
            $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $employees;
        } catch (PDOException $e) {
            // Handle the exception or displaying an error message
            // might log the error and provide a user-friendly message later
            throw new PDOException("Error fetching employees: " . $e->getMessage());
        }
    }

    /**
     * Get an employee by their combined first name and last name (primary key)
     *
     * @param string $firstName First name of the employee
     * @param string $lastName Last name of the employee
     * @return array Employee data or null if not found
     */
    public function getEmployeeByName($firstName, $lastName){
        try {
            // SQL query to retrieve an employee using their first name and last name
            $query = "SELECT * FROM employees WHERE first_name = :first_name AND last_name = :last_name";
            // Prepare the query statement and execute later
            $stmt = $this->conn->prepare($query);
            // Bind parameters from input to the prepared statement
            $stmt->bindParam(':first_name', $firstName);
            $stmt->bindParam(':last_name', $lastName);
            $stmt->execute();
            // Fetch the employee data as an associative array
            $employee = $stmt->fetch(PDO::FETCH_ASSOC);
            return $employee;
        } catch (PDOException $e) {
            // Throw an exception with a custom error message
            throw new PDOException("Error retrieving employee data: " . $e->getMessage());
        }
    }

    /**
     * Add a new employee
     *
     * @param array $employee Associative array containing employee data
     *              Example: ['first_name' => 'John', 'last_name' => 'Doe', 'salary' => 50000]
     * @return bool True if successful, false otherwise
     */
    public function addEmployee($employee){
        try {
            // SQL query to insert new employee data
            $query = "INSERT INTO employees (first_name, last_name, salary) VALUES (:first_name, :last_name, :salary)";
            // Prepare the query statement and execute later
            $stmt = $this->conn->prepare($query);
            // Bind parameters from input to the prepared statement
            $stmt->bindParam(':first_name', $employee['first_name']);
            $stmt->bindParam(':last_name', $employee['last_name']);
            $stmt->bindParam(':salary', $employee['salary']);
    
            if (!$stmt->execute()) {
                throw new PDOException("Error adding employee: " . $stmt->errorInfo()[2]);
            }
    
            return true;
        } catch (PDOException $e) {
            // Handle the exception
            return false;
        }
    }

    /**
     * Update an existing employee's information
     *
     * @param array $employee Associative array containing updated employee data
     *              Example: ['first_name' => 'John', 'last_name' => 'Doe', 'salary' => 50000]
     * @return bool True if successful, false otherwise
     */
    public function updateEmployee($employee) {
        try {
            // SQL query to update new employee data
            $query = "UPDATE employees SET salary = :salary WHERE first_name = :first_name AND last_name = :last_name";
            
            // Prepare the query statement
            $stmt = $this->conn->prepare($query);
            
            // Bind parameters from input to the prepared statement
            $stmt->bindParam(':salary', $employee['salary']);
            $stmt->bindParam(':first_name', $employee['first_name']);
            $stmt->bindParam(':last_name', $employee['last_name']);
            
            // Execute the prepared statement
            if ($stmt->execute()) {
                return true;
            } else {
                // Handle error and return false
                return false;
            }
        } catch (PDOException $e) {
            // Handle exception (error) and return false
            return false;
        }
    }

    /**
     * Delete an employee by their combined primary key: first name and last name
     *
     * @param string $firstName First name of the employee
     * @param string $lastName Last name of the employee
     * @return bool True if successful, false otherwise
     */
    public function deleteEmployeeByName($firstName, $lastName) {
        try {
            // SQL query to delete employee data
            $query = "DELETE FROM employees WHERE first_name = :first_name AND last_name = :last_name";
            // Prepare the query statement and execute later
            $stmt = $this->conn->prepare($query);
            // Bind parameters from input to the prepared statement
            $stmt->bindParam(':first_name', $firstName);
            $stmt->bindParam(':last_name', $lastName);

            // Execute the statement
            if ($stmt->execute()) {
                return true;
            } else {
                throw new PDOException("Error deleting employee");
            }
        } catch (PDOException $e) {
            // Handle the exception (e.g., log the error, display a user-friendly message)
            // You can also rethrow the exception to propagate it further if needed
            return false;
        }
    }
}

?>