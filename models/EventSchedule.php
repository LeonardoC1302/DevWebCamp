<?php
namespace Model;

class EventSchedule extends ActiveRecord {
    protected static $table = 'events';
    protected static $columnsDB = ['id', 'categoryId', 'dayId', 'hourId'];

    public $id;
    public $categoryId;
    public $dayId;
    public $hourId;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->categoryId = $args['categoryId'] ?? null;
        $this->dayId = $args['dayId'] ?? null;
        $this->hourId = $args['hourId'] ?? null;
    }
}