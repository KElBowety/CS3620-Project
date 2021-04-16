<?php

require_once 'IAddToDB.php';
require_once 'Human.php';
require_once 'DataBase.php';
class TempDonor extends Human implements IAddToDB
{
private string $phoneNumber;
private string $nationalId;
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
        if ($id<=0 || $id==null)
            return false;
        $this->id = $id;
        return true;
    }

    public function getNationalId(): int
    {
        return $this->nationalId;
    }

    /**
     * @param int $id
     */
    public function setNationalId(int $id): bool
    {
        if ($id<=0 || $id==null)
            return false;
        $this->nationalId = $id;
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
        if ($name=="" || $name==null)
            return false;
        $this->name = $name;
        return true;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber(string $phoneNumber): bool
    {
        if ($phoneNumber=="" || $phoneNumber==null)
            return false;
        $this->phoneNumber = $phoneNumber;
        return true;
    }

    public function donate(Donation $d, DonationDetails $ddArray): void
    {
        $d->setDonorId($this->id);
        $d->setDate(date("Y-m-d H:i:s"));
        $d->donate($ddArray);
    }

    public function addToDB(): bool
    {
        $query="INSERT INTO human(name, type) VALUES ('$this->name', '1')";
        $check1=DataBase::ExcuteIdQuery($query);
        if ($check1==false)
        {
            return false;
        }
        $this->id=$check1;
        $query="INSERT INTO tempdonor(phoneNumber,nationalId,humanId) VALUES ('$this->phoneNumber',$this->nationalId,'$this->id')";
        $check2=DataBase::ExcuteQuery($query);
        if ($check2==false)
        {
            return false;
        }
        return true;
    }

    public function showAllData()
    {
    }
}