<?php

require_once 'Item.php';

class Food extends Item implements IValidation,IAddToDB
{
    private int $validationPeriod;
    function isValid(): bool
    {
        // TODO: Implement isValid() method.
    }

    function calculateAge(): int
    {
        // TODO: Implement calculateAge() method.
    }

    /**
     * @return int
     */
    public function getValidationPeriod(): int
    {
        return $this->validationPeriod;
    }

    /**
     * @param int $validationPeriod
     */
    public function setValidationPeriod(int $validationPeriod): bool
    {
        if ($validationPeriod<=0 ||$validationPeriod==null)
            return false;
        $this->validationPeriod = $validationPeriod;
        return true;
    }

    function donate(): bool
    {
        parent::donate();
        if ($this->addToDB())
            return true;

        return false;
    }

    function addToDB(): bool
    {
        $query="INSERT INTO items (name, quantity, entryDate, type,itemPrice) VALUES('$this->name ', '$this->quantity','$this->entryDate','2', '$this->itemValue')";
        DataBase::ExcuteQuery($query);
        $query="SELECT MAX(id) FROM items";
        $this->id=DataBase::ExcuteRetreiveQuery($query);
        $query="INSERT INTO food (id, validationPeriod) VALUES('$this->id','$this->validationPeriod')";
        DataBase::ExcuteQuery($query);
        return true;
    }
}