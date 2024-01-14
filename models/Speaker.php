<?php
namespace Model;

class Speaker extends ActiveRecord {
    protected static $table = 'speakers';
    protected static $columnsDB = ['id', 'name', 'lastName', 'city', 'country', 'image', 'tags', 'socials'];

    public $id;
    public $name;
    public $lastName;
    public $city;
    public $country;
    public $image;
    public $tags;
    public $socials;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->lastName = $args['lastName'] ?? '';
        $this->city = $args['city'] ?? '';
        $this->country = $args['country'] ?? '';
        $this->image = $args['image'] ?? '';
        $this->tags = $args['tags'] ?? '';
        $this->socials = $args['socials'] ?? '';
    }

    public function validate() {
        if(!$this->name) {
            self::$alerts['error'][] = 'The name is mandatory';
        }
        if(!$this->lastName) {
            self::$alerts['error'][] = 'The last name is mandatory';
        }
        if(!$this->city) {
            self::$alerts['error'][] = 'The city is mandatory';
        }
        if(!$this->country) {
            self::$alerts['error'][] = 'The country is mandatory';
        }
        if(!$this->image) {
            self::$alerts['error'][] = 'The profile picture is mandatory';
        }
        if(!$this->tags) {
            self::$alerts['error'][] = 'At least one tag is mandatory';
        }
    
        return self::$alerts;
    }
}