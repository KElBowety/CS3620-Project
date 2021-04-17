<?php

require_once 'Item.php';

class Food extends Item implements IAddToDB
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
        $query="INSERT INTO item(entryDate, type,value) VALUES('$this->entryDate','2','$this->itemValue')";
        $id=DataBase::ExcuteidQuery($query);
        if ($id==false)
        {
            return false;
        }
        $this->id=$id;
        $query="INSERT INTO inkind (itemId, itemValue, quantity, type,name ) VALUES('$this->id','$this->itemValue','$this->quantity','1','$this->name')";
        $id=DataBase::ExcuteidQuery($query);
        if ($id==false)
        {
            return false;
        }
        $query="INSERT INTO food (inkindId, validationPeriod) VALUES('$id','$this->validationPeriod')";

        $id=DataBase::ExcuteidQuery($query);
        if ($id==false)
        {
            return false;
        }
        return true;
    }

}