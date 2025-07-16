<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;


class VendorValidationUpload extends Component
{
    use WithFileUploads;

    public $certificate;
    public $result;

    public function uploadDocument()
{
    $this->validate([
        'certificate' => 'required|file|mimes:pdf|max:2048',
    ]);

    // Store file temporarily
    $path = $this->certificate->store('temp-certificates');
    $filePath = storage_path('app/' . $path);

    // Send to Java server
    $response = Http::attach(
        'file',
        fopen($filePath, 'r'),
        $this->certificate->getClientOriginalName()
    )->post('http://localhost:8080/api/validate');


    if (!$response->successful()) {
        \Log::error('Java API error', [
            'status' => $response->status(),
            'body' => $response->body(),
        ]);
    }



    if ($response->successful()) {
        $this->result = $response->json();
    } else {
        $this->result = 'Validation failed or Java server error.';
    }

    // Clean up
    Storage::delete($path);
}

    public function render()
    {
        return view('livewire.vendor-validation-upload');
    }
}

