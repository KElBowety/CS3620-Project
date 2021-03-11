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
    private float $value;
    private int $donnableId;
    private int $type;
    private $donnable;

    /**
     * @return IDonnable
     */
    public function getDonnable(): IDonnable
    {
        return $this->donnable;
    }

    /**
     * @param IDonnable $donnable
     */
    public function setDonnable(IDonnable $donnable): void
    {
        $this->donnable = $donnable;
    }


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

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @param float $value
     */
    public function setValue(float $value): bool
    {
        if ($value<=0||$value==null)
            return false;
        $this->value = $value;
        return true;
    }

    function donate(): bool
    {
        if($this->donnable==null)
            return false;
        $this->donnable->donate();

        $this->donnableId=$this->donnable->getId();
        $this->value=$this->donnable->getValue();
        if ($this->donnable instanceof Item)
        {
            $this->type=2;
        }else
        {
            $this->type=1;
        }
        $this->addToDB();
        return true;


    }

    function addToDB(): bool
    {
        $this->donnableId=$this->donnable->getId();
        $query="INSERT INTO donationdetails (donationdID, value, type, donnableID) VALUES('$this->donationId','$this->value','$this->type','$this->donnableId')";
        DataBase::ExcuteQuery($query);
        return true;
    }
}