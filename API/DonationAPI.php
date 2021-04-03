<?php

require_once '..\Clothes.php';
require_once '..\Food.php';
require_once '..\Furniture.php';
require_once '..\DonationDetails.php';
require_once '..\DonationDetails.php';
require_once '..\Financial.php';

class DonationAPI
{
    public static function addFinancialDonation(float $amount) : string {
        if($amount < 0) {
            return json_encode("Donation Unsuccessful \nAmount must be larger than 0");
        }
        else {
            $donation = new Financial();
            $donation->setAmount($amount);
            $donation->donate();
            return json_encode("Donation Successful \nDonated $amount");
        }
    }

    public static function addItemDonation($names, $donationTypes, $values, $quantities) : string {
        if(is_array($names) && is_array($donationTypes) && is_array($values) && is_array($quantities)) {
            if(count($names) == count($donationTypes) && count($names) == count($values) && count($names) == count($quantities)) {

                for($i = 0; $i < count($names); $i++) {
                    if($donationTypes[$i] <= 0 || $donationTypes[$i] > 3 || $values[$i] <= 0 || $quantities[$i] <= 0) {
                        return json_encode("Donation Unsuccessful \nInvalid value entered");
                    }
                }

                for($i = 0; $i < count($names); $i++) {
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
            }
            else {
                return json_encode("Donation Unsuccessful \nAll arrays must be of same size");
            }
        }
        else {
            return json_encode("Donation Unsuccessful \nEnter donation fields in array forms");
        }
    }
}

DonationAPI::addItemDonation(["Test"], [2], [100], [2]);