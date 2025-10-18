<?php

namespace App\Libraries;

/**
 * @context7 /codeigniter/library
 * @description PDF generation using mPDF
 * @example 
 * $pdf = new PdfGenerator();
 * $pdf->generate($html, 'filename.pdf');
 */
class PdfGenerator
{
    protected $pdf;

    /**
     * @context7 /codeigniter/library/method
     * @description Initialize mPDF with default settings
     */
    public function __construct()
    {
        $this->pdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'orientation' => 'P',
            'margin_top' => 10,
            'margin_right' => 20,
            'margin_bottom' => 10,
            'margin_left' => 20,
        ]);
    }

    /**
     * @context7 /codeigniter/library/method
     * @description Generate PDF from HTML
     * @param string $html HTML content
     * @param string $filename Output filename
     * @param bool $download Whether to download or display
     */
    public function generate($html, $filename = 'document.pdf', $download = true)
    {
        $this->pdf->WriteHTML($html);
        
        if ($download) {
            $this->pdf->Output($filename, 'D');
        } else {
            $this->pdf->Output($filename, 'I');
        }
    }

    /**
     * @context7 /codeigniter/library/method
     * @description Add page to PDF
     * @param string $html HTML content
     */
    public function addPage($html)
    {
        $this->pdf->AddPage();
        $this->pdf->WriteHTML($html);
    }
}