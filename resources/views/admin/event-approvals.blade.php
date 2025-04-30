<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800">
            Event Approvals
        </h2>
    </x-slot>

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
            <h3 class="font-semibold text-lg text-gray-800">Pending Event Approvals</h3>
            <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full">{{ count($pendingEvents) ?? 0 }} Pending</span>
        </div>
        
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 mx-6 mt-6">
                <p>{{ session('success') }}</p>
            </div>
        @endif
        
        <div class="p-6">
            @if(count($pendingEvents) > 0)
                <div class="space-y-6">
                    @foreach($pendingEvents as $event)
                        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                            <div class="p-4 sm:p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h4 class="text-xl font-bold text-gray-900">{{ $event->title }}</h4>
                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Pending Approval</span>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Organizer</p>
                                        <p class="font-medium">{{ $event->organizer ?? 'Unknown' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Submitted On</p>
                                        <p class="font-medium">{{ $event->created_at->format('M d, Y H:i') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Event Date</p>
                                        <p class="font-medium">{{ $event->event_date ?? 'Not specified' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Location</p>
                                        <p class="font-medium">{{ $event->location ?? 'Not specified' }}</p>
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <p class="text-sm text-gray-500 mb-2">Description</p>
                                    <p class="text-gray-700">{{ $event->description ?? 'No description provided.' }}</p>
                                </div>
                                
                                <div class="flex flex-wrap space-x-3 pt-4 border-t border-gray-100">
                                    <a href="{{ route('stud.events.show', $event->id) }}" class="text-blue-600 hover:underline" target="_blank">Preview Event</a>
                                    
                                    <form action="{{ route('admin.events.approve', $event->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium px-4 py-2 rounded-lg">
                                            Approve
                                        </button>
                                    </form>
                                    
                                    <button type="button" onclick="showRejectModal('{{ $event->id }}')" class="bg-red-600 hover:bg-red-700 text-white font-medium px-4 py-2 rounded-lg">
                                        Reject
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900">No pending approvals</h3>
                    <p class="mt-1 text-gray-500">All events have been reviewed. Great job!</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Reject Modal -->
    <div id="reject-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
        <div class="bg-white rounded-lg max-w-md w-full mx-4">
            <div class="p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Reject Event</h3>
                <form id="reject-form" action="" method="POST">
                    @csrf
                    @method('PATCH')
                    
                    <div class="mb-4">
                        <label for="rejection-reason" class="block text-sm font-medium text-gray-700 mb-1">Reason for Rejection</label>
                        <textarea id="rejection-reason" name="reason" rows="4" class="w-full border border-gray-300 rounded-md px-3 py-2" placeholder="Provide feedback to the organizer about why the event was rejected"></textarea>
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="hideRejectModal()" class="border border-gray-300 bg-white text-gray-700 rounded-lg px-4 py-2">
                            Cancel
                        </button>
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-medium px-4 py-2 rounded-lg">
                            Reject Event
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showRejectModal(eventId) {
            const modal = document.getElementById('reject-modal');
            const form = document.getElementById('reject-form');
            form.action = `/admin/events/${eventId}/reject`;
            modal.classList.remove('hidden');
        }
        
        function hideRejectModal() {
            const modal = document.getElementById('reject-modal');
            modal.classList.add('hidden');
        }
        
        // Close modal when clicking outside
        document.getElementById('reject-modal').addEventListener('click', function(event) {
            if (event.target === this) {
                hideRejectModal();
            }
        });
    </script>
</x-admin-layout> 