<?php

interface CRUD {

    public function __construct(string $table,array $columns);

    public function create(array $records);

    public function update(array $record,$id);

    public function delete($id);

    public function findOne($id);

    public function lastInserted();

    public function select($query);

}