<?php

require_once 'DonationUndo.php';

session_start();

$d = new DonationUndo();

$d->execute();

header("Location: ./ShowDonorsPage.php");
