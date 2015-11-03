<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 *  =======================================
*  Author     : Muhammad Surya Ikhsanudin
*  License    : Protected
*  Email      : mutofiyah@gmail.com
*
*  Dilarang merubah, mengganti dan mendistribusikan
*  ulang tanpa sepengetahuan Author
*  =======================================
*/
require_once APPPATH . "/third_party/PHPExcel.php";

class Excel extends PHPExcel
{

    var $alphas = array();
    var $headings = array();
    var $filename = "excel";

    public function __construct()
    {
        parent::__construct();
        $this->alphas = range('A', 'Z');
    }

    /**
     * Export excel
     * @param unknown_type $config
     */
    public function export_excel($config = array())
    {
        $this->headings = $config['headings'];
        $values = $config['values'];
        $this->filename = (isset($config['filename']) ? $config['filename'] : "excel");
        $last_column = $this->alphas[count($this->headings)];

        //activate worksheet number 1
        $this->setActiveSheetIndex(0);
        //name the worksheet
        $this->getActiveSheet()->setTitle($this->filename);
        //set cell A1 content with some text
        $this->getActiveSheet()->setCellValue('A1', 'SN');
        $i = 1;
        foreach ($this->headings as $heading) {
            $this->getActiveSheet()->setCellValue($this->alphas[$i] . '1', $heading);
            $i++;
        }

        $this->getActiveSheet()->getStyle('A1:' . $last_column . '1')->getFont()->setBold(true);
        /* WRITE USER DETAILS TO EXCEL */

        $ind = 2;
        $m = 0;
        foreach ($values as $value) {
            $i = 1;
            $this->getActiveSheet()->setCellValue('A' . $ind, $m + 1);
            foreach ($this->headings as $key => $val) {
                $this->getActiveSheet()->setCellValue($this->alphas[$i] . $ind, (is_object($value) ? $value->$key : $value[$key]));
                $i++;
            }
            $ind = $ind + 1;
            $m++;
        }
        $this->filename = $this->filename . '.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $this->filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this, 'Excel5');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }
}