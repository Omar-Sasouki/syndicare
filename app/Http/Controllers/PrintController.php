<?php

namespace App\Http\Controllers;

use App\Models\PdfModel;
use Dompdf\Dompdf;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function print(Request $request)
    {
        // Retrieve the HTML from the request
        $html = $request->input('html');
 
        // Generate the PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->render();
        $pdf = $dompdf->output();
 
        // Store the PDF in the database
        $pdf_model = new PdfModel();
        $pdf_model->pdf = $pdf;
        $pdf_model->save();
 
        // Return a success response
        return response()->json(['message' => 'PDF stored in database successfully.']);
    }
}
