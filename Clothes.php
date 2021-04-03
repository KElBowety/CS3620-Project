<?php
require_once 'Item.php';
require_once 'DataBase.php';

class Clothes extends Item
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
        $query="INSERT INTO items (name, quantity, entryDate, type,itemPrice) VALUES('$this->name','$this->quantity','$this->entryDate','3','$this->itemValue')";
        $_SESSION['errorMessage']=$query;
        DataBase::ExcuteQuery($query);
        //header("Location: ./confirmDonationPage.php");
        $query="SELECT MAX(id) FROM items";
        $temp=DataBase::ExcuteRetreiveQuery($query);
        $this->id=$temp[0][0];
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