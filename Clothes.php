<?php

require_once 'Item.php';

class Clothes extends Item implements IValidation,IAddToDB
{
    private string $size;

    function isValid(): bool
    {
        // TODO: Implement isValid() method.
    }

    function calculateAge(): int
    {
        // TODO: Implement calculateAge() method.
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
        $query="INSERT INTO items (name, quantity, entryDate, type,itemPrice) VALUES('$this->name ', '$this->quantity','$this->entryDate','3', '$this->itemValue')";
        DataBase::ExcuteQuery($query);
        $query="SELECT MAX(id) FROM items";
        $this->id=DataBase::ExcuteRetreiveQuery($query);
        $query="INSERT INTO clothes (id, size) VALUES('$this->id','$this->size')";
        DataBase::ExcuteQuery($query);
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