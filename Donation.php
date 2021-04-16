<?php
require_once 'IAddToDB.php';
require_once 'DonationDetails.php';
require_once 'Clothes.php';
require_once 'Furniture.php';
require_once 'Food.php';
require_once 'Financial.php';
require_once 'Item.php';

class Donation implements IAddToDB
{
    private int $id;
    private int $donorId;
    private string $date;
//    private float $value;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Donation
     */
    public function setId(int $id): bool
    {
        if($id<=0||$id==null)
            return false;
        $this->id = $id;
        return true;
    }

    /**
     * @return int
     */
    public function getDonorId(): int
    {
        return $this->donorId;
    }

    /**
     * @param int $donorId
     * @return Donation
     */
    public function setDonorId(int $donorId): bool
    {
        if($donorId<=0||$donorId==null)
            return false;
        $this->donorId = $donorId;
        return true;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     * @return Donation
     */
    public function setDate(string $date): bool
    {
        if($date==""||$date==null)
            return false;
        $this->date = $date;
        return true;
    }

//    /**
//     * @return float
//     */
//    public function getValue(): float
//    {
//        return $this->value;
//    }
//
//    /**
//     * @param float $value
//     * @return Donation
//     */
//    public function setValue(float $value): bool
//    {
//        if($value<=0||$value==null)
//            return false;
//        $this->value = $value;
//        return true;
//    }

    public function donate($donationDetails): bool
    {
        if (count($donationDetails)==0)
        {
            return false;
        }
        $this->addToDB();

        for ($i=0;$i<count($donationDetails);$i++)
        {
            $item=$donationDetails[$i];
            $item->addToDB();
            $value= new DonationDetails();
            $value->setDonationId($this->id);
            $value->setItemId($item->getId());
            $value->addToDB();
        }
        return true;

    }

    public function getDonationDetails(): Array
    {
    //TODO
    }

    function addToDB(): bool
    {
        $query="INSERT INTO donations (donorId, date) VALUES('$this->donorId ', '$this->date')";
        $id=DataBase::ExcuteIdQuery($query);
        if ($id==false)
            return false;
        $this->id=$id;
        return true;

    }
}