<?php
namespace Model;

class EventsXRegister extends ActiveRecord {
    protected static $table = 'eventsxregister';
    protected static $columnsDB = ['id', 'eventId', 'registerId'];

    public $id;
    public $eventId;
    public $registerId;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->eventId = $args['eventId'] ?? null;
        $this->registerId = $args['registerId'] ?? null;
    }
}