<?php


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
        $query="INSERT INTO enteries (amount, type ) VALUES('$this->amount','1')";
        DataBase::ExcuteQuery($query);
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