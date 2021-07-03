<?php

namespace Core;

use mysqli;

abstract class Model
{
    protected $db;
    protected $table;

    public function __construct()
    {
        $this->db = new mysqli(
            $_ENV['DB_HOST'],
            $_ENV['DB_USERNAME'],
            $_ENV['DB_PASSWORD'],
            $_ENV['DB_DATABASE'],
            $_ENV['DB_PORT']
        );

        if ($this->db->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
            exit();
        }

    }

    public function __destruct()
    {
        $this->db->close();
    }

    public function all()
    {
        $query = "SELECT * from {$this->table}";
        return $this->db->query($query);
        //return mysqli_fetch_all($result, MYSQLI_ASSOC);
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
        return $this->db->query($query);
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
        return $this->db->query($query);
    }

    public function delete($id)
    {
        $id = $this->db->real_escape_string($id);
        $query = "DELETE FROM {$this->table} WHERE id = {$id}";
        return $this->db->query($query);
    }
}
