<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EditController;
use App\Http\Controllers\SubscriberController;
use App\Http\Middleware\CheckRole;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\OrganizerController;

// Public routes accessible to all users
Route::get('/', [HomeController::class, 'index'])->name('stud.home');
Route::get('/event/{id}', [EventController::class, 'show'])->name('stud.events.show');

// Auth routes for all authenticated users
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Subscription routes
    Route::post('/subscribe', [SubscriberController::class, 'subscribe'])->name('subscribe');
    Route::post('/unsubscribe', [SubscriberController::class, 'unsubscribe'])->name('unsubscribe');
    
    // Main dashboard route - will redirect to proper dashboard based on role
    Route::get('/dashboard', [EventController::class, 'dashboard'])->name('dashboard');
    
    // Redirect old routes to new ones for backward compatibility
    Route::get('/setup', function () {
        return redirect()->route('setup.form');
    });
});

// Student only routes
Route::middleware(['auth', CheckRole::class . ':student'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('stud.dashboard');
    Route::get('/student/my-events', [StudentController::class, 'myEvents'])->name('my.events');
    Route::get('/student/certificates', [StudentController::class, 'certificates'])->name('certificates');
    Route::get('/student/notifications', [StudentController::class, 'notifications'])->name('notifications');
    
    // Event registration routes
    Route::post('/events/{id}/register', [RegistrationController::class, 'register'])->name('event.register');
    Route::delete('/events/{id}/cancel', [RegistrationController::class, 'cancel'])->name('event.cancel');
    Route::get('/my-registrations', [RegistrationController::class, 'myRegistrations'])->name('stud.registrations');
});

// Organizer only routes
Route::middleware(['auth', CheckRole::class . ':organizer'])->group(function () {
    // New organizer dashboard
    Route::get('/organizer/dashboard', [OrganizerController::class, 'dashboard'])->name('organizer.dashboard');
    // My Events page
    Route::get('/organizer/my-events', [OrganizerController::class, 'myEvents'])->name('organizer.my-events');
});

// Admin and Organizer shared routes
Route::middleware(['auth', CheckRole::class . ':organizer,admin'])->group(function () {
    // Event creation for both admins and organizers
    Route::get('/organizer/setup', function () {
        return view('admin.setup');
    })->name('setup.form');
    Route::post('/organizer/setup', [EventController::class, 'store'])->name('setup.submit');
});

// Admin only routes
Route::middleware(['auth', CheckRole::class . ':admin'])->group(function () {
    // User management
    Route::get('/edit', [EditController::class, 'index'])->name('admin.edit');
    
    // Admin Dashboard
    Route::get('/admin/dashboard', function () {
        $events = \App\Models\Event::latest()->take(5)->get();
        return view('admin.dashboard', compact('events'));
    })->name('admin.dashboard');
    
    // User management
    Route::get('/admin/users', function () {
        $users = \App\Models\User::all();
        return view('admin.users', compact('users'));
    })->name('admin.users');
    
    Route::get('/admin/users/create', [RegisteredUserController::class, 'createByAdmin'])
        ->name('admin.users.create');
    
    Route::get('/admin/users/{id}/edit', function ($id) {
        $user = \App\Models\User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    })->name('admin.users.edit');
    
    Route::patch('/admin/users/{id}/role', function ($id) {
        $user = \App\Models\User::findOrFail($id);
        $user->role = request('role');
        $user->save();
        
        return redirect()->route('admin.users')->with('success', 'User role updated successfully.');
    })->name('admin.users.update-role');
    
    Route::patch('/admin/users/{id}/toggle-ban', function ($id) {
        $user = \App\Models\User::findOrFail($id);
        
        if (isset($user->banned_at)) {
            $user->banned_at = null;
            $message = 'User has been unbanned successfully.';
        } else {
            $user->banned_at = now();
            $message = 'User has been banned successfully.';
        }
        
        $user->save();
        
        return redirect()->route('admin.users')->with('success', $message);
    })->name('admin.users.toggle-ban');
    
    // Event management
    Route::get('/admin/events', function () {
        $events = \App\Models\Event::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.events', compact('events'));
    })->name('admin.events');
    
    // Event approvals
    Route::get('/admin/event-approvals', function () {
        $pendingEvents = \App\Models\Event::where('status', 'pending')->orderBy('created_at', 'desc')->get();
        return view('admin.event-approvals', compact('pendingEvents'));
    })->name('admin.event-approvals');
    
    Route::patch('/admin/events/{id}/approve', function ($id) {
        $event = \App\Models\Event::findOrFail($id);
        $event->status = 'approved';
        $event->save();
        
        return redirect()->route('admin.event-approvals')->with('success', 'Event has been approved successfully.');
    })->name('admin.events.approve');
    
    Route::patch('/admin/events/{id}/reject', function ($id) {
        $event = \App\Models\Event::findOrFail($id);
        $event->status = 'rejected';
        $event->rejection_reason = request('reason');
        $event->save();
        
        return redirect()->route('admin.event-approvals')->with('success', 'Event has been rejected successfully.');
    })->name('admin.events.reject');
    
    // Feedback management
    Route::get('/admin/feedback', function () {
        $feedback = \App\Models\Feedback::with(['user', 'event'])->orderBy('created_at', 'desc')->paginate(15);
        $events = \App\Models\Event::orderBy('title')->get();
        return view('admin.feedback', compact('feedback', 'events'));
    })->name('admin.feedback');
    
    // Club management
    Route::get('/admin/clubs', function () {
        return view('admin.clubs');
    })->name('admin.clubs');
    
    // Announcements management
    Route::get('/admin/announcements', function () {
        return view('admin.announcements');
    })->name('admin.announcements');
    
    // Settings
    Route::get('/admin/settings', function () {
        return view('admin.settings');
    })->name('admin.settings');
    
    // Reports
    Route::get('/admin/reports', function () {
        return view('admin.reports');
    })->name('admin.reports');
    
    // Quick role update from dashboard
    Route::post('/admin/quick-role-update', function () {
        $email = request('email');
        $role = request('role');
        
        $user = \App\Models\User::where('email', $email)->first();
        
        if (!$user) {
            return redirect()->route('admin.dashboard')->with('role-error', 'User with email ' . $email . ' not found.');
        }
        
        $user->role = $role;
        $user->save();
        
        return redirect()->route('admin.dashboard')->with('role-success', 'Role for ' . $email . ' has been updated to ' . $role . ' successfully.');
    })->name('admin.quick-role-update');
});

require __DIR__.'/auth.php';
