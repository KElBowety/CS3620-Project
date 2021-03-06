<?php
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class ExcelGenerator implements \SplObserver
{
    private array $ids;
    private array $data;
    private string $fileName;

    public function __construct() {
        $this->ids = [];
        $this->data = array(array());

    }

    public function update(SplSubject $subject)
    {
        $this->getIds();
        $this->getData();
        $this->createSheet();
    }

    public function getIds()
    {
        for($i = 0; $i < count($_SESSION['ids']); $i++) {
            array_push($this->ids, $_SESSION['ids'][$i][0]);
        }
    }

    public function getData()
    {
        for($i = 0; $i < count($_SESSION['results']); $i++ ) {
            for ($j = 0; $j < count($_SESSION['ids']); $j++) {
                $this->data[$i][$j] = $_SESSION['results'][$i][$j];
            }
        }
    }

    public function createSheet()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->fromArray($this->ids);
        $sheet->fromArray($this->data, NULL, 'A2');

        $writer = new Xlsx($spreadsheet);
        header('Cache-Control: max-age=0');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="export.xlsx"');
        ob_end_clean();
        $writer->save('php://output');
    }
}