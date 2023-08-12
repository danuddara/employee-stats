<?php
require_once ('CRUD.php');

/**
 * Abstract class of model which also implements crud functionalities
 */
abstract class Model implements CRUD {

    protected Database $db;
    protected string $table;
    protected array $columns;

    public function __construct(string $table,array $columns)
    {
        $this->table = $table;
        $this->columns = $columns;
        $this->db = new Database();
    }

    protected function prepareParamsForMultiple($columns): array
    {
        $values = array_map(function (){
            return '?';
        },$columns);
        return [$columns,$values];
    }


    protected function prepareParamsForUpdate($record): array
    {
        return array_map(function ($column){
            return "$column=:$column";
        },array_keys($record));
    }

    /**
     * Records will be created if passes as an array
     *
     * Array values should be inorder as same when you define the columns
     *
     * @param array $records
     * @return void
     * @throws Exception
     */
    public function create(array $records): void
    {
        $conn = $this->db->conn();
        list ($columnKeys,$parameters)= $this->prepareParamsForMultiple($this->columns);
        $columnKeysString = implode(',',$columnKeys);
        $parametersKeysString = implode(',',$parameters);
        $query = "INSERT INTO {$this->table} ($columnKeysString) VALUES ($parametersKeysString)";
        $stmt = $conn->prepare($query);
        try {
            $conn->beginTransaction();
            foreach ($records as $row)
            {
                $stmt->execute($row);
            }
            $conn->commit();
        }catch (Exception $e) {
            $conn->rollback();
            throw $e;
        }
    }

    /**
     * Update record
     * @param array $record [column_name => value ,column_name2 => value]
     * @param $id
     * @return bool|void
     */
    public function update(array $record,$id)
    {
        $conn = $this->db->conn();
        $columnKeys  = $this->prepareParamsForUpdate($record);
        $columnKeysString = implode(',',$columnKeys);

        $query ="UPDATE {$this->table} SET $columnKeysString WHERE id =:id";

        $stmt = $conn->prepare($query);
        $parameters = array_merge($record,['id'=>(int) $id]);
        if ($stmt->execute($parameters)) {
            return true;
        } else {
            return;
        }
    }

    public function findAll(): bool|array
    {
        $data = [];
        $conn = $this->db->conn();
        $stmt = $conn->prepare("SELECT * FROM {$this->table} ORDER BY id ASC");
        if ($stmt->execute()) {
            $data = $stmt->fetchAll();
        }

        return $data;
    }

    public function delete($id)
    {
        $conn = $this->db->conn();
        $stmt = $conn->prepare("DELETE FROM {$this->table} WHERE id =:id");
        if ($stmt->execute(['id'=>$id])) {
            return true;
        } else {
            return;
        }
    }

    public function findOne($id)
    {
        $data = [];

        $conn = $this->db->conn();
        $stmt = $conn->prepare("SELECT * FROM {$this->table} WHERE id =:id");
        if ($stmt->execute(['id'=>$id])) {
            $data = $stmt->fetch();
        }

        return $data;
    }

    public function lastInserted(): bool|string
    {
        $con = $this->db->conn();
        return $con->lastInsertId();
    }

    public function select($query): bool|array
    {
        $con =  $this->db->conn();
        $stmt= $con->query($query);
        return $stmt->fetchAll();
    }
}