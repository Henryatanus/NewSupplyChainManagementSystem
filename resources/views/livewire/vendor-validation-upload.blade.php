<div>
    <form wire:submit.prevent="uploadDocument" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="certificate" class="block font-semibold">Upload Certification (PDF):</label>
            <input type="file" wire:model="certificate" accept="application/pdf" class="mt-1 block w-full">
            @error('certificate') 
                <span class="text-red-500 text-sm">{{ $message }}</span> 
            @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Submit</button>

        @if ($result && is_array($result))
            <div class="mt-4 p-4 bg-gray-100 rounded">
                <strong>Validation Result:</strong>
                <p class="mt-2 font-semibold">{{ $result['message'] ?? 'No message' }}</p>

                <ul class="list-disc list-inside mt-2">
                    @foreach ($result['found_fields'] ?? [] as $field => $found)
                        <li>
                            {{ ucfirst(str_replace('_', ' ', $field)) }}: 
                            <span class="{{ $found ? 'text-green-600' : 'text-red-600' }}">
                                {{ $found ? 'Found' : 'Missing' }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @elseif($result)
            <div class="mt-4 p-4 bg-red-100 rounded text-red-700">
                {{ is_string($result) ? $result : json_encode($result) }}
            </div>
        @endif
    </form>
</div>

