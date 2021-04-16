<?php

require_once ('IDonnable.php');
require_once ('IAddToDB.php');
class Financial implements IDonnable,IAddToDB
{
    private float $amount;
    private int $id;
    private string $currency;
    private string $date;

    public function donate(): bool
    {
        if ($this->addToDB())
            return true;

        return false;
    }

    public function setCurrency(string $cur): bool
    {
        if ($cur==null)
            return false;
        $this->currency=$cur;
        return true;
    }
    public function getCurrency(): string
    {
        return $this->currency;
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
        $query="INSERT INTO financial (value, type, entryDate) VALUES('$this->amount','1',now())";
        $this->id=DataBase::ExcuteIdQuery($query);
        if ($this->id== false)
            return false;
        $query="INSERT INTO financial (itemId, currency ) VALUES('$this->id','$this->currency')";
        if (DataBase::ExcuteQuery($query)==false)
            return false;
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