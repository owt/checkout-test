<?php
declare(strict_types=1);

namespace App\Exceptions;

class ItemNotFoundException extends \Exception
{
    public function __construct(string $code)
    {
        parent::__construct("Item with code $code was not found in the database");
    }
}
