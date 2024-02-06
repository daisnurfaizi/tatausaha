<?php

namespace App\Helper;

use App\Models\Surat\Template;
use Dompdf\Dompdf;
use Dompdf\Options;

class GeneratePdfHelper
{
    public static function generate($view, $request)
    {
        // Ambil konten yang dimasukkan dari CKEditor
        $content = $request->input('content');
        $perihal = $request->input('perihal');

        // Konfigurasi dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);

        // Render HTML dari view
        // Make sure the view correctly integrates the 'content'
        $kop = Template::where('name', 'kop')->first();
        $html = view($view, compact('content', 'kop'))->render();
        $dompdf->loadHtml($html);

        // Setup font (optional)
        // ... (your font setup code here, if necessary)

        // Render PDF
        $dompdf->render();
        $pdfPath = public_path('pdfs');
        // Ensure the 'pdfs' directory exists
        if (!file_exists($pdfPath)) {
            mkdir($pdfPath, 0755, true);
        }
        $pdfName = $perihal . '_' . uniqid() . '.pdf'; // Ensure a unique name for the PDF file
        $pdfFullPath = $pdfPath . '/' . $pdfName;
        // Save the PDF to the public directory
        file_put_contents($pdfFullPath, $dompdf->output());

        // Generate the URL for the saved PDF
        $pdfUrl = url('pdfs/' . $pdfName);
        return $pdfUrl;

        // Mengembalikan output PDF sebagai response
        // return $dompdf->stream('output.pdf');
    }
}
