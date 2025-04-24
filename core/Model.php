<?php

namespace Core;

use mysqli;
use Exception;

abstract class Model
{
    protected mysqli $db;
    protected string $table;

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
            throw new Exception("Error de conexión MySQL: " . $this->db->connect_error);
        }
    }

    public function __destruct()
    {
        $this->db->close();
    }

    public function all(): array
    {
        $result = $this->db->query("SELECT * FROM {$this->table}");

        if (!$result) {
            throw new Exception("Error en la consulta: " . $this->db->error);
        }

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ? LIMIT 1");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc() ?: null;
    }

    public function save(array $params): bool
    {
        $columns = implode(', ', array_keys($params));
        $placeholders = implode(', ', array_fill(0, count($params), '?'));
        $types = $this->getParamTypes($params);
        $values = array_values($params);

        $query = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param($types, ...$values);

        return $stmt->execute();
    }

    public function update(int $id, array $params): bool
    {
        $fields = implode(', ', array_map(fn($key) => "$key = ?", array_keys($params)));
        $types = $this->getParamTypes($params) . 'i'; // 'i' para el id
        $values = array_values($params);
        $values[] = $id;

        $query = "UPDATE {$this->table} SET {$fields} WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param($types, ...$values);

        return $stmt->execute();
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    private function getParamTypes(array $params): string
    {
        return implode('', array_map(function ($val) {
            return is_int($val) ? 'i' : (is_float($val) ? 'd' : 's');
        }, $params));
    }
}
