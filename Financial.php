<?php

require_once ('IDonnable.php');
require_once ('IAddToDB.php');
class Financial implements IDonnable,IAddToDB
{
    private float $amount;
    private int $id;

    public function donate(): bool
    {
        if ($this->addToDB())
            return true;

        return false;
    }

    public function getValue(): float
    {
        return $this->amount;
    }
    public function setAmount($amount): bool
    {
        if ($amount<=0)
            return false;
        $this->amount=$amount;
        return true;
    }

    function addToDB(): bool
    {
        $query="INSERT INTO entries (amount, type ) VALUES('$this->amount','1')";
        DataBase::ExcuteQuery($query);
        $query="SELECT MAX(id) FROM entries";
        $temp=DataBase::ExcuteRetreiveQuery($query);
        $this->id=$temp[0][0];
        return true;
    }
    public function getId():int
    {
        return $this->id;
    }
    public function setId(int $id):bool
    {
        if ($id<=0||$id==null)
        {
            return false;
        }
        $this->id=id;
        return true;
    }
}