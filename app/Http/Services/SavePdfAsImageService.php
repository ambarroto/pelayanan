<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Storage;
use Spatie\PdfToImage\Pdf;

class SavePdfAsImageService
{
    /**
     * Menyimpan halaman pertama pdf sebagai gambar
     * 
     * @param \Spatie\PdfToImage\Pdf $pdf
     * @param string $pathToImage
     * @return bool
     */
    public static function saveImage(Pdf $pdf, string $pathToImage): bool
    {
        $page = 1;

        if (is_dir($pathToImage)) {
            $pathToImage = rtrim($pathToImage, '\/').DIRECTORY_SEPARATOR.$page.'.'.$pdf->getOutputFormat();
        }
        
        $imageData = $pdf->getImageData($pathToImage);

        return Storage::put($pathToImage, $imageData) !== false;
    }

    /**
     * Menyimpan semua halaman pdf sebagai gambar
     * 
     * @param \Spatie\PdfToImage\Pdf $pdf
     * @param string $directory
     * @param string $prefix
     * @return array
     */
    public static function saveAllPagesAsImages(Pdf $pdf, string $directory, string $prefix = ''): array
    {
        $numberOfPages = $pdf->getNumberOfPages();

        if ($numberOfPages === 0) {
            return [];
        }

        return array_map(function ($pageNumber) use ($pdf, $directory, $prefix) {
            $pdf->setPage($pageNumber);
            
            $destination = "{$directory}/{$prefix}-{$pageNumber}.{$pdf->getOutputFormat()}";

            self::saveImage($pdf, $destination);

            return $destination;
        }, range(1, $numberOfPages));
    }
}