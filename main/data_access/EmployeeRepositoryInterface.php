<?php

// Define the interface for EmployeeRepository
interface EmployeeRepositoryInterface {
    /**
     * Get all employees
     *
     * @return array Array of employee data
     */
    public function getAllEmployees(): array;

    /**
     * Get an employee by their combined first name and last name (primary key)
     *
     * @param string $firstName First name of the employee
     * @param string $lastName Last name of the employee
     * @return array Employee data or null if not found
     */
    public function getEmployeeByName(string $firstName, string $lastName): array;

    /**
     * Add a new employee
     *
     * @param array $employee Associative array containing employee data
     * @return bool True if successful, false otherwise
     */
    public function addEmployee(array $employee): bool;

    /**
     * Update an existing employee's information
     *
     * @param array $employee Associative array containing updated employee data
     * @return bool True if successful, false otherwise
     */
    public function updateEmployee(array $employee): bool;

    /**
     * Delete an employee by their combined primary key: first name and last name
     *
     * @param string $firstName First name of the employee
     * @param string $lastName Last name of the employee
     * @return bool True if successful, false otherwise
     */
    public function deleteEmployeeByName(string $firstName, string $lastName): bool;
}

?>