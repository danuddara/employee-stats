<?php

/**
 * Employee entity
 */
class Employee extends Model {

    /**
     * Get Average salary by company
     * @return bool|array
     */
    public function getAverageSalaryByCompany(): bool|array
    {
        $query = "SELECT company_name, ROUND(AVG(salary) ,2) AS average_salary FROM {$this->table} GROUP BY company_name;";
        return $this->select($query);

    }
}