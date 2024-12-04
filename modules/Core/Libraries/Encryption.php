<?php
namespace Modules\Core\Libraries;

class Encryption
{
    public function encodePassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function checkPassword(string $password, string $checkPassword): bool
    {
        return password_verify($password, $checkPassword);
    }
}
