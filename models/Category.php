<?php
namespace Model;

class Category extends ActiveRecord {
    protected static $table = 'categories';
    protected static $columnsDB = ['id', 'name'];

    public $id;
    public $name;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
    }
}