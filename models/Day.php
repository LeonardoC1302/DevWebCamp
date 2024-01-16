<?php
namespace Model;

class Day extends ActiveRecord {
    protected static $table = 'days';
    protected static $columnsDB = ['id', 'name'];

    public $id;
    public $name;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
    }
}