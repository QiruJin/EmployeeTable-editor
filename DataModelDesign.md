## Data Model Design Document

### Table: Employee

**Description:** This table stores information about employees.

**Fields:**

1. `first_name`
   - Data Type: VARCHAR(50)
   - Description: First name of the employee.
   
2. `last_name`
   - Data Type: VARCHAR(50)
   - Description: Last name of the employee.
   
3. `salary`
   - Data Type: INT
   - Description: Salary of the employee in CAD.

**Sample Data:**

| first_name | last_name | salary  |
|------------|-----------|---------|
| Lewis      | Burson    | 40700   |
| Ian        | Malcolm   | 70000   |
| Ellie      | Sattler   | 102000  |
| Dennis     | Nedry     | 52000   |
| John       | Hammond   | 89600   |
| Ray        | Arnold    | 45000   |
| Laura      | Burnett   | 80000   |

**Constraints:**

- The combination of `first_name` and `last_name` serves as a composite primary key.
- `salary` must be a non-negative integer.

**Indexes:**

- Primary Key: (`first_name`, `last_name`)

---

### Notes:

- The data model now uses a composite primary key consisting of both `first_name` and `last_name`.
- Each employee is uniquely identified by their full name.
- The sample data demonstrates how the composite primary key is used to uniquely identify employees.
- The primary key index ensures fast retrieval and uniqueness of employee records based on their names.
- Additional fields or indexes can be added based on specific requirements or optimizations.