<?php
require_once 'Item.php';
require_once 'DataBase.php';

class Clothes extends Item implements IAddToDB
{
    private string $size;

    function isValid(): bool
    {
        return true;
    }

    function calculateAge(): int
    {
        // TODO: Implement calculateAge() method.
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
        $query="INSERT INTO inkind (itemId, itemValue, quantity, type,name ) VALUES('$this->id','$this->itemValue','$this->quantity','2','$this->name')";
        $id=DataBase::ExcuteidQuery($query);
        if ($id==false)
        {
            return false;
        }
        $query="INSERT INTO clothes (inkindId, size) VALUES('$id','$this->size')";
        $id=DataBase::ExcuteidQuery($query);
        if ($id==false)
        {
            return false;
        }
        return true;
    }

    /**
     * @return string
     */
    public function getSize(): string
    {
        return $this->size;
    }

    /**
     * @param string $size
     */
    public function setSize(string $size): bool
    {
        if ($size==""||$size==null)
            return false;
        $this->size = $size;
        return true;
    }


}