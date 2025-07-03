<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\VendorApplication;



class VendorApplicationController extends Controller
{
    public function index()
{
    return view('vendor_applications.index', [
        'applications' => VendorApplication::with('user')->get(),
    ]);
}

public function store(Request $request)
{
    $request->validate([
        'pdf_path' => 'required|file|mimes:pdf',
    ]);

    $pdfPath = $request->file('pdf_path')->store('vendor_pdfs');

    VendorApplication::create([
        'user_id' => auth()->id(),
        'pdf_path' => $pdfPath,
        'status' => 'pending',
    ]);

    return redirect()->back()->with('success', 'Application submitted.');
}

public function update(Request $request, VendorApplication $vendorApplication)
{
    $vendorApplication->update([
        'financial_score' => $request->financial_score,
        'reputation_score' => $request->reputation_score,
        'regulatory_clearance' => $request->regulatory_clearance,
        'status' => $request->status,
    ]);

    return redirect()->back()->with('success', 'Application updated.');
}

public function destroy(VendorApplication $vendorApplication)
{
    $vendorApplication->delete();

    return redirect()->back()->with('success', 'Deleted.');
}
}
