<?php

require_once 'DonationUndo.php';
require_once 'DonorWithAccount.php';

session_start();

$d = new DonationUndo(new DonorWithAccount());

$d->execute();

header("Location: ./ShowDonorsPage.php");
