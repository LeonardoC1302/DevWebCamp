<?php
namespace Model;

class Hour extends ActiveRecord {
    protected static $table = 'hours';
    protected static $columnsDB = ['id', 'hour'];

    public $id;
    public $hour;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->hour = $args['hour'] ?? '';
    }
}