<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Devis;
use App\Models\User;
use App\Notifications\DevisNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

use function GuzzleHttp\Promise\all;

class DevisController extends Controller
{
    public function index()
    {
        $devis = Devis::latest('created_at')->firstOrFail();
        return view('admin.devis.devis', compact('devis'));
    }

    public function create()

    {
        $authUserId = auth()->id();
        $users = User::where('id', '!=', $authUserId)->pluck('name', 'id');;
        return view('admin.devis.devisCreation', compact('users'));
    }

    public function store(Request $request)
    {

        try {
            $validation = $request->validate([
                'user_id' => 'required',
                'price' => 'required',
                'item' => 'required',
                'Quantity' => 'required',
            ]);
        
            $devis = new Devis();
        
            $devis->user_id = $request->user_id;
            $devis->price = $request->price;
            $devis->item = $request->item;
            $devis->Quantity = $request->Quantity;
            $devis->save();
        
            $notification = array(
                'message' => 'Devis Created Successfully',
                'alert-type' => 'success'
            );
        
            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            // Log the error message
            Log::error($e->getMessage());
        
            $notification = array(
                'message' => 'An error occurred while creating the Devis.',
                'alert-type' => 'error'
            );
        
            return redirect()->back()->with($notification);
        }
    }        

    public function showall()
    {
        $devis = Devis::orderByDesc('created_at')->get();
        return view('admin.devis.showall', compact('devis'));
    }

    public function destory($id)
    {
        Devis::where('id', $id)->delete();
        return back()->with('message', 'Devis Deleted Successfuly ');
    }

    public function show($id)
    {
        $devis = Devis::findOrFail($id);
        return view('admin.devis.pdf', ['devis' => $devis]);
    }

   /*  public function generatePdf($id)
    {
        // Find the Devis by ID
        $devis = Devis::findOrFail($id);
        $user = User::find($devis->user_id);
        // Generate the PDF using Dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('admin.devis.pdf', compact('devis'))->render());
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $pdfContents = $dompdf->output();

        // Save the PDF in the database
        $devis->pdf = $devis->id . '.pdf';
        Storage::disk('public')->put('upload/devis/' . $devis->pdf, $pdfContents);
        $devis->save();
        $notification = array(

            'message' =>    'PDF generated and stored successfully.is Created Successfuly',
            'alert-type' => 'success'
        );
        $user->notify(new DevisNotification($devis));
        
        // Redirect back to the Devis show page with a success message
        return redirect()->back()->with($notification);
    }
    public function getPdfPath()
    {
        $user_id = auth()->id();
        $devis = Devis::where('user_id', $user_id)->latest()->first();
        if (!$devis) {
            return response()->json(['message' => 'No devis found for this user.'], 404);
        }
        
        // Get the file path
        $pdfUrl = url('storage/upload/devis/' . $devis->pdf);
        
        // Set the response headers
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . basename($pdfUrl) . '"',
        ];
        
        // Return the PDF file as a response
        return response()->json([
            'id' => $devis->id,
            'item' => $devis->item,
            'user_id' => $devis->user_id,
            'price' => $devis->price,
            'quantity' => $devis->Quantity,
            'pdf_url' => $pdfUrl,
        ]);
        
    } */

    public function generatePdf($id)
    {
        // Find the Devis by ID
        $devis = Devis::findOrFail($id);
        $user = User::find($devis->user_id);
        
        // Generate the PDF using Dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('admin.devis.pdf', compact('devis'))->render());
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $pdfContents = $dompdf->output();
    
        // Save the PDF in the database with a unique filename based on the user's name
        $pdfName = $user->name . '_' . time() . '.pdf';
        $pdfPath = public_path('devis/' . $pdfName);
        file_put_contents($pdfPath, $pdfContents);
        $devis->pdf = $pdfName;
        $devis->save();
    
        $notification = array(
            'message' => 'PDF generated and stored successfully.',
            'alert-type' => 'success'
        );
        $user->notify(new DevisNotification($devis));
            
        // Redirect back to the Devis show page with a success message
        return redirect()->back()->with($notification);
    }
    
    public function getPdfPath()
    {
        $user_id = auth()->id();
        $devis = Devis::where('user_id', $user_id)->latest()->first();
        if (!$devis) {
            return response()->json(['message' => 'No devis found for this user.'], 404);
        }
        
        $pdfUrl = url('devis/' . $devis->pdf);

        // Return the PDF path as a JSON response
        return response()->json([
            'path' => $pdfUrl
        ]);
    }
}
