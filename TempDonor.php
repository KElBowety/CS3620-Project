<?php


class TempDonor extends Human
{
private string $phoneNumber;

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
}