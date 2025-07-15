<div class="p-4 border rounded shadow">
    <h2 class="text-lg font-semibold mb-4">Chat with {{ $receiver->name }}</h2>

    <!-- Chat message list -->
    <div class="h-64 overflow-y-scroll border mb-3 p-3 bg-gray-100 rounded">
        @foreach($messages as $msg)
            <div class="mb-2 flex {{ $msg['sender_id']=== auth()->id() ? 'justify-end' : 'justify-start' }}">
                <div class="px-3 py-2 rounded-lg max-w-xs break-words
                    {{ $msg['sender_id'] === auth()->id() ? 'bg-blue-500 text-white' : 'bg-gray-300 text-gray-900' }}">
                    {{ $msg['message'] }}
                </div>
            </div>
        @endforeach
    </div>

    <!-- Message input form -->
    <form wire:submit.prevent="sendMessage" class="flex items-center space-x-2">
        <input
            wire:model.defer="message"
            type="text"
            class="flex-1 px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
            placeholder="Type your message..."
        />
        <button
            type="submit"
            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
        >
            Send
        </button>
    </form>
</div>

