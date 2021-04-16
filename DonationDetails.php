<?php
require_once 'IAddToDB.php';
require_once 'IDonnable.php';
require_once 'Financial.php';
require_once 'Furniture.php';
require_once 'Clothes.php';
require_once 'Food.php';



class DonationDetails implements IAddToDB
{
    private int $id;
    private int $donationId;
    private int $itemId;

//    /**
//     * @return IDonnable
//     */
//    public function getDonnable(): IDonnable
//    {
//        return $this->donnable;
//    }
//
//    /**
//     * @param IDonnable $donnable
//     */
//    public function setDonnable(IDonnable $donnable): void
//    {
//        $this->donnable = $donnable;
//    }


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

    public function getItemId(): int
    {
        return $this->itemId;
    }

    /**
     * @param int $id
     */
    public function setItemId(int $id): bool
    {
        if ($id<=0||$id==null)
            return false;
        $this->itemId = $id;
        return true;
    }


    /**
     * @return int
     */
    public function getDonationId(): int
    {
        return $this->donationId;
    }

    /**
     * @param int $donationId
     */
    public function setDonationId(int $donationId): bool
    {
        if ($donationId<=0||$donationId==null)
            return false;
        $this->donationId = $donationId;
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
//     */
//    public function setValue(float $value): bool
//    {
//        if ($value<=0||$value==null)
//            return false;
//        $this->value = $value;
//        return true;
//    }



    function addToDB(): bool
    {
        $query="INSERT INTO donationdetails (donationID, itemId) VALUES('$this->donationId','$this->itemId')";
        if(DataBase::ExcuteQuery($query)==false)
            return false;
        return true;
    }
}