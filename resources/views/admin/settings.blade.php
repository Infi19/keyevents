<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800">
            Settings
        </h2>
    </x-slot>

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="font-semibold text-lg text-gray-800">System Settings</h3>
        </div>
        
        <div class="p-6">
            <form action="#" method="POST">
                @csrf
                
                <div class="space-y-6">
                    <!-- Site Information -->
                    <div>
                        <h4 class="text-md font-medium text-gray-700 mb-4">Site Information</h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="site_name" class="block text-sm font-medium text-gray-700 mb-1">Site Name</label>
                                <input type="text" id="site_name" name="site_name" class="w-full border border-gray-300 rounded-md px-3 py-2" value="EventHub">
                            </div>
                            
                            <div>
                                <label for="site_email" class="block text-sm font-medium text-gray-700 mb-1">Contact Email</label>
                                <input type="email" id="site_email" name="site_email" class="w-full border border-gray-300 rounded-md px-3 py-2" value="admin@eventhub.com">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Registration Settings -->
                    <div>
                        <h4 class="text-md font-medium text-gray-700 mb-4">Registration Settings</h4>
                        
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <input type="checkbox" id="allow_registration" name="allow_registration" class="h-4 w-4 text-blue-600 rounded" checked>
                                <label for="allow_registration" class="ml-2 block text-sm text-gray-700">Allow User Registration</label>
                            </div>
                            
                            <div class="flex items-center">
                                <input type="checkbox" id="email_verification" name="email_verification" class="h-4 w-4 text-blue-600 rounded" checked>
                                <label for="email_verification" class="ml-2 block text-sm text-gray-700">Require Email Verification</label>
                            </div>
                            
                            <div>
                                <label for="default_role" class="block text-sm font-medium text-gray-700 mb-1">Default User Role</label>
                                <select id="default_role" name="default_role" class="w-full max-w-xs border border-gray-300 rounded-md px-3 py-2">
                                    <option value="student" selected>Student</option>
                                    <option value="organizer">Organizer</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Event Settings -->
                    <div>
                        <h4 class="text-md font-medium text-gray-700 mb-4">Event Settings</h4>
                        
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <input type="checkbox" id="event_approval" name="event_approval" class="h-4 w-4 text-blue-600 rounded" checked>
                                <label for="event_approval" class="ml-2 block text-sm text-gray-700">Require Admin Approval for New Events</label>
                            </div>
                            
                            <div>
                                <label for="pagination_count" class="block text-sm font-medium text-gray-700 mb-1">Events Per Page</label>
                                <input type="number" id="pagination_count" name="pagination_count" class="w-32 border border-gray-300 rounded-md px-3 py-2" value="10">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg">
                            Save Settings
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout> 