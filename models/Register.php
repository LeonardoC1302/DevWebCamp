<?php
namespace Model;

class Register extends ActiveRecord {
    protected static $table = 'registers';
    protected static $columnsDB = ['id', 'packageId', 'paymentId', 'token', 'userId', 'giftId'];

    public $id;
    public $packageId;
    public $paymentId;
    public $token;
    public $userId;
    public $giftId;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->packageId = $args['packageId'] ?? null;
        $this->paymentId = $args['paymentId'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->userId = $args['userId'] ?? null;
        $this->giftId = $args['giftId'] ?? 1;
    }
}