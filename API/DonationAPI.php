<?php

require_once '..\Clothes.php';
require_once '..\Food.php';
require_once '..\Furniture.php';
require_once '..\DonationDetails.php';
require_once '..\DonationDetails.php';
require_once '..\Financial.php';
require_once '..\DataBase.php';

class DonationAPI
{
    public static function addFinancialDonation(float $amount): string
    {
        if ($amount < 0) {
            return json_encode("Donation Unsuccessful \nAmount must be larger than 0");
        } else {
            $donation = new Financial();
            $donation->setAmount($amount);
            $donation->donate();
            return json_encode("Donation Successful \nDonated $amount");
        }
    }

    public static function addItemDonation($names, $donationTypes, $values, $quantities): string
    {
        if (is_array($names) && is_array($donationTypes) && is_array($values) && is_array($quantities)) {
            if (count($names) == count($donationTypes) && count($names) == count($values) && count($names) == count($quantities)) {

                for ($i = 0; $i < count($names); $i++) {
                    if ($donationTypes[$i] <= 0 || $donationTypes[$i] > 3 || $values[$i] <= 0 || $quantities[$i] <= 0) {
                        return json_encode("Donation Unsuccessful \nInvalid value entered");
                    }
                }

                for ($i = 0; $i < count($names); $i++) {
                    $obj = NULL;
                    switch ($donationTypes[$i]) {
                        case 1:
                            $obj = new Clothes();
                            $obj->setSize('M');
                            break;
                        case 2:
                            $obj = new Food();
                            $obj->setValidationPeriod(15);
                            break;
                        case 3:
                            $obj = new Furniture();
                            $obj->setIsNew(true);
                            break;
                    }
                    $obj->setName($names[$i]);
                    $obj->setItemValue($values[$i]);
                    $obj->setQuantity($quantities[$i]);
                    $obj->setEntryDate(date('Y-m-d H:i:s'));
                    $obj->donate();
                }
                return json_encode("Donation Successful");
            } else {
                return json_encode("Donation Unsuccessful \nAll arrays must be of same size");
            }
        } else {
            return json_encode("Donation Unsuccessful \nEnter donation fields in array forms");
        }
    }
    public static function getFinancialDonation(string $date): string
    {
        $table = "";
        $query = "SELECT * FROM donations WHERE date='$date'";
        $result = DataBase::ExcuteRetreiveQuery($query);
        if ($result == false) {
            return json_encode("Donation not found");
        } else {
            foreach ($result as $record) {
                $table = $record['id'] + ' ' + $record['donorId'] + ' ' + $record['date'] + ' ' + $record['value'];
            }

            return json_encode("Donations of the date " + $date + " " + $table);
        }
    }
    public static function getItemDonation($type): string
    {
        $table = "";
        switch ($type) {
            case 1:
                $query = "SELECT * FROM clothes";
                $result = DataBase::ExcuteRetreiveQuery($query);
                foreach ($result as $record) {
                    $table = $record['id'] + ' ' + $record['size'];
                }
                break;
            case 2:
                $query = "SELECT * FROM food";
                $result = DataBase::ExcuteRetreiveQuery($query);
                foreach ($result as $record) {
                    $table = $record['id'] + ' ' + $record['validationPeriod'];
                }
                break;
            case 3:
                $query = "SELECT * FROM furniture";
                $result = DataBase::ExcuteRetreiveQuery($query);
                foreach ($result as $record) {
                    $table = $record['id'] + ' ' + $record['isNew'];
                }
                break;
        }
        if ($result == false) {
            return json_encode("Donation not found");
        } else {

            return json_encode("Donations of type " + $type + " are " + $table);
        }
    }
}

DonationAPI::addItemDonation(["Test"], [2], [100], [2]);
DonationAPI::getItemDonation(1);
