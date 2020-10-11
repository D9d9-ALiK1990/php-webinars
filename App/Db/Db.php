<?php

namespace App\Db;

use App\Db\DbExp;

class Db {
    
    private static $host = 'localhost';
    private static $user = 'root';
    private static $password = '';
    private static $database = 'timur';
    
    private static $connect;
    
    public static function getConnect() {
        if (is_null(static::$connect)) {
            static::$connect = static::connect();
        }
        return static::$connect;
    }
    
    public static function query($query){
        $conn = static::getconnect();
        $result1 = mysqli_query($conn, $query);
//echo var_dump($result1);
//exit;
        if (mysqli_errno($conn)) {
            var_dump(mysqli_error($conn));
            exit;
        }

        return $result1;
    }
    
    public static function fetchAll (string $query): array {
        $result = static::query($query);
        $data = [];
        while ($row = static::fetchAssoc($result)) {
            $data[] = $row; 
        }
        return $data;
    }
    
    public static function fetchAssoc($result): ?array {
        return mysqli_fetch_assoc($result);
    }
    
    public static function fetchRow (string $query): array {
        $result = static::query($query);
        $data = mysqli_fetch_assoc($result);
        if (is_null($data)) {
            $data = [];
        }
        return $data;
    }
    
    public static function fetchOnce (string $query): string {
        $result = static::query($query);
        $row = mysqli_fetch_row($result);
        return (string) ($row[0] ?? '');
    }
    
    public static function affectedRows() {
        $connect = static::getConnect();
        
        return mysqli_affected_rows($connect);
    }
    
    public static function delete(string $table_name, string $where) {
        $query = 'DELETE FROM ' . $table_name;
        if ($where) {
            $query .= (' WHERE ' . $where);
        }
        static::query($query);
        return static::affectedRows();
    }
    
    public static function update(string $table_name, array $fields, string $where) {
        $set_fields = [];
        
        foreach ($fields as $field_name => $field_value) {
            if ($field_value instanceof DbExp) {
                $set_fields[] = "$field_name = $field_value";
            } else {
                $field_value = Db::escape($field_value);
                $set_fields[] = "$field_name = '$field_value'";
            }
        }
        $set_fields = implode(',', $set_fields);
        $query = "UPDATE $table_name SET $set_fields WHERE $where";
        $query = Db::query($query);
        return static::affectedRows();
    }

    public static function insert(string $table_name, array $fields): int {
        $name_fields = [];
        $value_fields = [];
//        echo "<pre>";
//        var_dump($fields);
//        echo "</pre>";
//        exit;
        foreach ($fields as $field_name => $field_value) {
            $name_fields[] = "$field_name";
            
            if ($field_value instanceof DbExp) {
                $value_fields[] = "$field_value";
                
//                     echo "<pre>";var_dump($field_values); echo "</pre>"; 
//        exit;

            } else {
                dump($field_value);
                $field_value = Db::escape($field_value);
                $value_fields[] = "'$field_value'";
            } 
        }
//         echo "<pre>";var_dump($field_values); echo "</pre>"; 
//        exit;
        $name_fields = implode(',', $name_fields);
        $value_fields = implode(',', $value_fields);
        $query = "INSERT INTO $table_name($name_fields) VALUES ($value_fields)";   
//        echo "<pre>";var_dump($query); echo "</pre>"; 
//        exit;
        $query = Db::query($query);
        return static::lastIntegerId();
    }
    
    public static function lastIntegerId() {
        return mysqli_insert_id(static::$connect);
    }
    
    public static function escape(string $value) {
        $connect = static::getConnect();
        return mysqli_real_escape_string($connect, $value);
    }
    
    public static function expr(string $value) {
        return new DbExp($value);
    }
    
    
    
    private static function connect() {
        $connect=mysqli_connect(static::$host, static::$user, static::$password, static::$database);

        if (mysqli_connect_errno()) {
           $error = mysqli_connect_error();
           echo 'Ошибка';
           var_dump($error);
           exit;
        }

        return $connect;
    }

}
