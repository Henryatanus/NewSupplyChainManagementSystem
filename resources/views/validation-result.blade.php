@extends('layouts.app') {{-- Or your main layout --}}

@section('content')
<div class="container mt-5">
    <h2>Vendor Certificate Validation Result</h2>

    @if ($result['valid'])
        <div class="alert alert-success">
            Certificate is <strong>valid</strong>.
        </div>
    @else
        <div class="alert alert-danger">
             Certificate is <strong>invalid</strong>.
        </div>
    @endif

    <h4>Extracted Fields</h4>
    <ul class="list-group">
        <li class="list-group-item">Name: {{ $data['found_fields']['name'] ? 'Found' : 'Missing' }}</li>
        <li class="list-group-item">Certification Number: {{ $data['found_fields']['certificate_number'] ? 'Found' : 'Missing' }}</li>
        <li class="list-group-item">Expiry Date: {{ $data['found_fields']['expiry_date'] ? 'Found' : 'Missing' }}</li>
        <li class="list-group-item">License Type: {{ $data['found_fields']['license_type'] ? 'Found' : 'Missing' }}</li>
    </ul>

    @if (!empty($result['message']))
        <p class="mt-3">{{ $result['message'] }}</p>
    @endif

    <a href="{{ route('vendor.form') }}" class="btn btn-primary mt-3">Validate Another</a>
</div>
@endsection
