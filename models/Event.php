<?php
namespace Model;

class Event extends ActiveRecord {
    protected static $table = 'events';
    protected static $columnsDB = ['id', 'name', 'description', 'availables', 'categoryId', 'dayId', 'hourId', 'speakerId'];

    public $id;
    public $name;
    public $description;
    public $availables;
    public $categoryId;
    public $dayId;
    public $hourId;
    public $speakerId;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->availables = $args['availables'] ?? 0;
        $this->categoryId = $args['categoryId'] ?? null;
        $this->dayId = $args['dayId'] ?? null;
        $this->hourId = $args['hourId'] ?? null;
        $this->speakerId = $args['speakerId'] ?? null;
    }

    public function validate(){
        if(!$this->name) {
            self::$alerts['error'][] = 'Name is mandatory';
        }
        if(!$this->description) {
            self::$alerts['error'][] = 'Description is mandatory';
        }
        if(!$this->categoryId || !filter_var($this->categoryId, FILTER_VALIDATE_INT)) {
            self::$alerts['error'][] = 'Choose a Category';
        }
        if(!$this->dayId || !filter_var($this->dayId, FILTER_VALIDATE_INT)) {
            self::$alerts['error'][] = 'Choose the day of the Event';
        }
        if(!$this->hourId || !filter_var($this->hourId, FILTER_VALIDATE_INT)) {
            self::$alerts['error'][] = 'Choose the hour of the Event';
        }
        if(!$this->availables || !filter_var($this->availables, FILTER_VALIDATE_INT)) {
            self::$alerts['error'][] = 'Add the number of available spaces';
        }
        if(!$this->speakerId || !filter_var($this->speakerId, FILTER_VALIDATE_INT)) {
            self::$alerts['error'][] = 'Choose a Speaker';
        }

        return self::$alerts;
    }
}