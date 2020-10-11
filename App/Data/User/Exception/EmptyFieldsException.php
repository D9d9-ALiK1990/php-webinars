<?php


namespace App\Data\User\Exception;


use App\Exception\AbstractAppExeption;

class EmptyFieldsException extends AbstractAppExeption
{
    private $emptyFields = [];

    public function addEmptyFields(string $alias)
    {
        $this->emptyFields[$alias] = true;
    }

    public function getEmptyFields(): array
    {
        return $this->emptyFields;
    }

}