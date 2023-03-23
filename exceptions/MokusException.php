<?php

class MokusException extends Exception {
    public function __construct($uzenet) {
        parent::__construct($uzenet);
    }
}