<?php

require_once 'IDonnable.php';
require_once 'IValidation.php';
require_once 'IAddToDB.php';

abstract class Item implements IDonnable, IValidation, IAddToDB
{
    protected int $id;
    protected string $name;
    protected int $quantity;
    protected float $itemValue;
    protected float $value;
    protected string $entryDate;

    public function donate(): bool
    {
        // TODO: @overridden in extending classes
    }

    public function getValue(): float
    {
        $this->value=$this->itemValue*$this->quantity;
        return $this->value;
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
    public function setId(int $id): void
    {
        $this->id = $id;
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
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): bool
    {
        if ($quantity<=0 || $quantity==null)
            return false;
        $this->quantity = $quantity;
        return true;
    }

    /**
     * @return float
     */
    public function getItemValue(): float
    {
        return $this->itemValue;
    }

    /**
     * @param float $itemValue
     */
    public function setItemValue(float $itemValue): bool
    {
        if ($itemValue<=0 || $itemValue==null)
            return false;
        $this->itemValue = $itemValue;
        return true;
    }

    /**
     * @return string
     */
    public function getEntryDate(): string
    {
        return $this->entryDate;
    }

    /**
     * @param string $entryDate
     */
    public function setEntryDate(string $entryDate): bool
    {
        if ($entryDate=="" || $entryDate==null)
            return false;
        $this->entryDate = $entryDate;
        return true;
    }



}