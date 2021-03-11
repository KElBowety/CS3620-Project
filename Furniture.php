<?php

require_once 'Item.php';

class Furniture extends Item
{
    private bool $isNew;

    function isValid(): bool
    {
        // TODO: Implement isValid() method.
    }

    function calculateAge(): int
    {
        // TODO: Implement calculateAge() method.
    }

    /**
     * @return bool
     */
    public function isNew(): bool
    {
        return $this->isNew;
    }

    /**
     * @param bool $isNew
     */
    public function setIsNew(bool $isNew): void
    {
        $this->isNew = $isNew;
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
        $query="INSERT INTO items (name, quantity, entryDate, type,itemPrice) VALUES('$this->name ', '$this->quantity','$this->entryDate','1', '$this->itemValue')";
        DataBase::ExcuteQuery($query);
        $query="SELECT MAX(id) FROM items";
        $temp=DataBase::ExcuteRetreiveQuery($query);
        $this->id=$temp[0][0];
        $query="INSERT INTO furniture (id, isNew) VALUES('$this->id','$this->isNew')";
        DataBase::ExcuteQuery($query);
        return true;
    }
}