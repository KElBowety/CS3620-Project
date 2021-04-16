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
        $query="INSERT INTO item(entryDate, type,value) VALUES('$this->entryDate','2','$this->itemValue')";
        $id=DataBase::ExcuteidQuery($query);
        if ($id==false)
        {
            return false;
        }
        $this->id=$id;
        $query="INSERT INTO inkind (itemId, itemValue, quantity, type,name ) VALUES('$this->id','$this->itemValue','$this->quantity','3','$this->name')";
        $id=DataBase::ExcuteidQuery($query);
        if ($id==false)
        {
            return false;
        }
        $query="INSERT INTO clothes (inkindId, isNew) VALUES('$id','$this->isNew')";
        $id=DataBase::ExcuteidQuery($query);
        if ($id==false)
        {
            return false;
        }
        return true;
    }
}