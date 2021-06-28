<?php

namespace Core;

use mysqli;

abstract class Model
{
    protected $db;
    protected $table;

    public function __construct()
    {
        $mysqli = new mysqli(
            $_ENV['DB_HOST'],
            $_ENV['DB_USERNAME'],
            $_ENV['DB_PASSWORD'],
            $_ENV['DB_DATABASE'],
            $_ENV['DB_PORT']
        );

        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
            exit();
        }

        $this->db = $mysqli;
    }

    public function __destruct()
    {
        $this->db->close();
    }
    
    public function all()
    {
        $query = "SELECT * from {$this->table}";
        return $this->db->query($query)->data_seek(0);
    }

    public function findById($id)
    {
        $id = $this->db->real_escape_string($id);
        $query = "SELECT * from {$this->table} WHERE id = {$id} lIMIT 1";
        return $this->db->query($query)->fetch_assoc();
    }

    public function save(array $params)
    {
        $count = 0;
        $fields = '';
        foreach ($params as $col => $val) {
            if ($count++ != 0) $fields .= ', ';
            $col = $this->db->real_escape_string($col);
            $val = is_string($val) ? "'{$this->db->real_escape_string($val)}'" : $this->db->real_escape_string($val);
            $fields .= "{$col} = {$val}";
        }
        $query = "INSERT INTO {$this->table} SET {$fields};";
        echo $query;
        $this->db->query($query);
    }

    public function update($id, $params)
    {
        $count = 0;
        $fields = '';
        foreach ($params as $col => $val) {
            if ($count++ != 0) $fields .= ', ';
            $col = $this->db->real_escape_string($col);
            $val = is_string($val) ? "'{$this->db->real_escape_string($val)}'" : $this->db->real_escape_string($val);
            $fields .= "{$col} = {$val}";
        }
        $query = "UPDATE {$this->table} SET {$fields} WHERE id = {$id};";
        echo $query;
        $this->db->query($query);
    }

    public function delete($id)
    {
        $id = $this->db->real_escape_string($id);
        $query = "DELETE FROM {$this->table} WHERE id = {$id}";
        $this->db->query($query);
    }
}