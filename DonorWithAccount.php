<?php
require_once ('Human.php');
require_once ('IAddToDB.php');
require_once ('DataBase.php');
require_once ('IShowAll.php');
require_once ('IUpdateInDB.php');
require_once ('IRemoveFromDB.php');

class DonorWithAccount extends Human implements IAddToDB, IShowAll, IUpdateInDB,IRemoveFromDB
{
    private int $age;
    private string $address;
    private string $lastPayment;
    private float $subscriptionAmount;
    private int $subscriptionType;


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): bool
    {
        if ($id<=0||$id==null)
            return false;
        $this->id = $id;
        return true;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): bool
    {
        if ($name=="" ||$name==null)
            return false;
        $this->name = $name;
        return true;
    }

    /**
     * @return string
     */



    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @param int $age
     */
    public function setAge(int $age): bool
    {
        if ($age>=150||$age<=1)
            return false;
        $this->age=$age;
        return true;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): bool
    {
        if($address=="" || $address==null)
        {
            return false;
        }
        $this->address = $address;
        return true;
    }

    /**
     * @return string
     */
    public function getLastPayment(): string
    {
        return $this->lastPayment;
    }

    /**
     * @param string $lastPayment
     */
    public function setLastPayment(string $lastPayment): bool
    {
        if ($lastPayment==""||$lastPayment==null)
            return false;
        $this->lastPayment = $lastPayment;
        return true;
    }

    /**
     * @return float
     */
    public function getSubscriptionAmount(): float
    {
        return $this->subscriptionAmount;
    }

    /**
     * @param float $subscriptionAmount
     */
    public function setSubscriptionAmount(float $subscriptionAmount): bool
    {
        if ($subscriptionAmount<=0 || $subscriptionAmount==null)
            return false;
        $this->subscriptionAmount = $subscriptionAmount;
        return true;
    }

    /**
     * @return int
     */
    public function getSubscriptionType(): int
    {
        return $this->subscriptionType;
    }

    /**
     * @param int $subscriptionType
     */
    public function setSubscriptionType(int $subscriptionType): bool
    {
        if($subscriptionType<=0||$subscriptionType>2)
            return false;
        $this->subscriptionType = $subscriptionType;
        return true;
    }





    public function addToDB(): bool
    {
        $query="INSERT INTO human(name, type) VALUES ('$this->name', '2')";
        $check1=DataBase::ExcuteIdQuery($query);
        if ($check1==false)
        {
            return false;
        }
        $this->id=$check1;
        $query="INSERT INTO donorwithaccount(age, city, subscriptionType, subscriptionAmount, humanId) VALUES ('$this->age','$this->address','$this->subscriptionType','$this->subscriptionAmount','$this->id')";
        $check2=DataBase::ExcuteQuery($query);
        if (!$check2)
        {
            $this->removeWrongInserted();
            return false;
        }
        return true;
    }

    public static function showAllData()
    {
        $query="SELECT human.id, name, age,city,subscriptionType,subscriptionAmount, lastPayment FROM human INNER JOIN donorWithAccount ON donorWithAccount.id = human.id;";
        $result=DataBase::ExcuteRetreiveQuery($query);
        if ($result==false)
            return false;
        return $result;

    }

    public function updateInDB(): bool
    {
        $query= "UPDATE donoraccounts SET subscriptionType='$this->subscriptionType', subscriptionAmount='$this->subscriptionAmount' WHERE id='$this->id'";
        DataBase::ExcuteQuery($query);
        return true;
    }

    public function removeFromDB(): bool
    {
        $query= "DELETE FROM donoraccounts WHERE id='$this->id'";
        DataBase::ExcuteQuery($query);
        $query= "DELETE FROM people WHERE id='$this->id'";
        DataBase::ExcuteQuery($query);
        return true;
    }
    private function removeWrongInserted(): void
    {
        $query= "DELETE FROM human WHERE id='$this->id'";
        DataBase::ExcuteQuery($query);
    }


}