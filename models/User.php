<?php

namespace Model;

class User extends ActiveRecord {
    protected static $table = 'users';
    protected static $columnsDB = ['id', 'name', 'lastName', 'email', 'password', 'confirmed', 'token', 'admin'];

    public $id;
    public $name;
    public $lastName;
    public $email;
    public $password;
    public $password2;
    public $confirmed;
    public $token;
    public $admin;

    public $current_password;
    public $new_password;

    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['nombre'] ?? '';
        $this->lastName = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->confirmed = $args['confirmado'] ?? 0;
        $this->token = $args['token'] ?? '';
        $this->admin = $args['admin'] ?? '';
    }

    public function validateLogin() {
        if(!$this->email) {
            self::$alerts['error'][] = 'The email is mandatory';
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alerts['error'][] = 'Invalid email';
        }
        if(!$this->password) {
            self::$alerts['error'][] = 'The password is mandatory';
        }
        return self::$alerts;

    }

    public function validateAccount() {
        if(!$this->name) {
            self::$alerts['error'][] = 'The name is mandatory';
        }
        if(!$this->lastName) {
            self::$alerts['error'][] = 'The last name is mandatory';
        }
        if(!$this->email) {
            self::$alerts['error'][] = 'The email is mandatory';
        }
        if(!$this->password) {
            self::$alerts['error'][] = 'The password is mandatory';
        }
        if(strlen($this->password) < 6) {
            self::$alerts['error'][] = 'The password must be at least 6 characters';
        }
        if($this->password !== $this->password2) {
            self::$alerts['error'][] = 'The passwords do not match';
        }
        return self::$alerts;
    }

    public function validateEmail() {
        if(!$this->email) {
            self::$alerts['error'][] = 'The email is mandatory';
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alerts['error'][] = 'Invalid email';
        }
        return self::$alerts;
    }

    public function validatePassword() {
        if(!$this->password) {
            self::$alerts['error'][] = 'The password is mandatory';
        }
        if(strlen($this->password) < 6) {
            self::$alerts['error'][] = 'The password must be at least 6 characters';
        }
        return self::$alerts;
    }

    public function newPassword() : array {
        if(!$this->current_password) {
            self::$alerts['error'][] = 'The current password is mandatory';
        }
        if(!$this->new_password) {
            self::$alerts['error'][] = 'The new password is mandatory';
        }
        if(strlen($this->new_password) < 6) {
            self::$alerts['error'][] = 'The new password must be at least 6 characters';
        }
        return self::$alerts;
    }

    public function checkPassword() : bool {
        return password_verify($this->current_password, $this->password );
    }

    public function hashPassword() : void {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function createToken() : void {
        $this->token = uniqid();
    }
}