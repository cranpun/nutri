<?php
namespace App\U;

class DBResult {
    private bool $success;
    private string $message;

    public function __construct(bool $success, string $message)
    {
        $this->success = $success;
        $this->message = $message;
    }

    public function message(): string {
        return $this->message;
    }
    public function success(): bool {
        return $this->success;
    }
    public function error(): bool {
        return !$this->success;
    }
}