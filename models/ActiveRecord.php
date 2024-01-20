<?php
namespace Model;
class ActiveRecord {

    protected static $db;
    protected static $table = '';
    protected static $columnsDB = [];

    protected static $alerts = [];
    
    public static function setDB($database) {
        self::$db = $database;
    }

    public static function setalert($type, $message) {
        static::$alerts[$type][] = $message;
    }

    public static function getAlerts() {
        return static::$alerts;
    }

    public function validate() {
        static::$alerts = [];
        return static::$alerts;
    }

    public static function querySQL($query) {
        $result = self::$db->query($query);

        $array = [];
        while($register = $result->fetch_assoc()) {
            $array[] = static::createObject($register);
        }
        $result->free();
        return $array;
    }

    protected static function createObject($register) {
        $object = new static;

        foreach($register as $key => $value ) {
            if(property_exists( $object, $key  )) {
                $object->$key = $value;
            }
        }
        return $object;
    }

    public function attributes() {
        $attributes = [];
        foreach(static::$columnsDB as $column) {
            if($column === 'id') continue;
            $attributes[$column] = $this->$column;
        }
        return $attributes;
    }

    public function sanitizeAttributes() {
        $attributes = $this->attributes();
        $sanitized = [];
        foreach($attributes as $key => $value ) {
            $sanitized[$key] = self::$db->escape_string($value);
        }
        return $sanitized;
    }

    public function sync($args=[]) { 
        foreach($args as $key => $value) {
          if(property_exists($this, $key) && !is_null($value)) {
            $this->$key = $value;
          }
        }
    }

    public function save() {
        $result = '';
        if(!is_null($this->id)) {
            $result = $this->update();
        } else {
            $result = $this->create();
        }
        return $result;
    }

    public static function all($order = 'DESC') {
        $query = "SELECT * FROM " . static::$table . " ORDER BY id $order";
        $result = self::querySQL($query);
        return $result;
    }

    public static function find($id) {
        $query = "SELECT * FROM " . static::$table  ." WHERE id = $id";
        $result = self::querySQL($query);
        return array_shift( $result ) ;
    }

    public static function get($limit) {
        $query = "SELECT * FROM " . static::$table . " ORDER BY id DESC LIMIT $limit" ;
        $result = self::querySQL($query);
        return $result;
    }

    public static function where($column, $value) {
        $query = "SELECT * FROM " . static::$table . " WHERE $column = '$value'";
        $result = self::querySQL($query);
        return array_shift( $result ) ;
    }

    public static function order($column, $order){
        $query = "SELECT * FROM " . static::$table . " ORDER BY $column $order";
        $result = self::querySQL($query);
        return $result;
    }

    public static function orderLimit($column, $order, $limit){
        $query = "SELECT * FROM " . static::$table . " ORDER BY $column $order LIMIT $limit";
        $result = self::querySQL($query);
        return $result;
    }

    public static function whereArray($array = []) {
        $query = "SELECT * FROM " . static::$table . " WHERE ";
        foreach($array as $key => $value) {
            if($key  == array_key_last($array)){
                $query .= "$key = '$value' ";
            } else{
                $query .= "$key = '$value' AND ";
            }
        }
        // $query = substr($query, 0, -4);
        $result = self::querySQL($query);
        return $result;
    }

    public function create() {
        $attributes = $this->sanitizeAttributes();
        $query = " INSERT INTO " . static::$table . " ( ";
        $query .= join(', ', array_keys($attributes));
        $query .= " ) VALUES (' "; 
        $query .= join("', '", array_values($attributes));
        $query .= " ') ";
        // debug($query);
        $result = self::$db->query($query);
        return [
           'result' =>  $result,
           'id' => self::$db->insert_id
        ];
    }

    public function update() {
        $attributes = $this->sanitizeAttributes();
        $values = [];
        foreach($attributes as $key => $value) {
            $values[] = "{$key}='{$value}'";
        }

        $query = "UPDATE " . static::$table ." SET ";
        $query .=  join(', ', $values );
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 "; 

        $result = self::$db->query($query);
        return $result;
    }

    public function delete() {
        $query = "DELETE FROM "  . static::$table . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $result = self::$db->query($query);
        return $result;
    }

    public static function count($column = '', $value = '') {
        $query = "SELECT COUNT(*) FROM " . static::$table;
        if($column && $value){
            $query .= " WHERE $column = '$value'";
        }
        $result = self::$db->query($query);
        $count = $result->fetch_array();
        return array_shift($count);
    }

    public static function totalArray($array = []) {
        $query = "SELECT COUNT(*) FROM " . static::$table . " WHERE ";
        foreach($array as $key => $value) {
            if($key  == array_key_last($array)){
                $query .= "$key = '$value' ";
            } else{
                $query .= "$key = '$value' AND ";
            }
        }
        $result = self::$db->query($query);
        $count = $result->fetch_array();
        return array_shift($count);
    }

    public static function paginate($per_page, $offset){
        $query = "SELECT * FROM " . static::$table . " ORDER BY id DESC LIMIT $per_page OFFSET $offset" ;
        $result = self::querySQL($query);
        return $result;
    }
}