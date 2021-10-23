<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use File;

use ZipArchive;

class ZipController extends Controller
{
    public function downloadZip()

    {
        // $zip = new ZipArchive;
        // $fileName = 'myNewFile.zip';
        // if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE)
        // {
        //     $files = File::files(public_path('myFiles'));
        //     foreach ($files as $key => $value) {
        //         $relativeNameInZipFile = basename($value);
        //         $zip->addFile($value, $relativeNameInZipFile);
        //     }
        //     $zip->close();
        // }
        // return response()->download(public_path($fileName));



        $zip_file = 'invoices.zip'; // Name of our archive to download

        // Initializing PHP class
        $zip = new \ZipArchive();
        $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        $invoice_file = 'Bella Ciao (Slow Version) - La Casa De Papel - Money Heist Season 4.mp4';

        // Adding file: second parameter is what will the path inside of the archive
        // So it will create another folder called "storage/" inside ZIP, and put the file there.
        $zip->addFile(storage_path('app/course/course-data/' . $invoice_file), $invoice_file);
        $zip->close();

        // We return the file immediately after download
        return response()->download($zip_file);

    }
}
