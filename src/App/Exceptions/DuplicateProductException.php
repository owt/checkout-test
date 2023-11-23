<?php
declare(strict_types=1);

namespace App\Exceptions;

class DuplicateProductException extends \Exception
{
    public function __construct(string $productCode)
    {
        parent::__construct("Product with code $productCode already exists in the basket");
    }
}
