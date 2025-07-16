<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function validateCertificate(Request $request)
    {
        $request->validate([
            'certificate' => 'required|file|mimes:pdf|max:2048',
        ]);
    
        $file = $request->file('certificate');
    
        $response = Http::attach(
            'file',
            file_get_contents($file->getRealPath()),
            $file->getClientOriginalName()
        )->post('http://localhost:8080/api/validate');
    
        if ($response->successful()) {
            $result = $response->json();
            
            // Save to DB, show to user, etc.
           

    return view('vendor.validation-result', compact('result'));
    
    
        return back()->withErrors(['validation_failed' => 'Could not validate PDF.']);
    }
    
}
}