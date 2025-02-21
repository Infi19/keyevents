<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:subscribers,email'
        ]);

        Subscriber::create($validated);

        return back()->with('success', 'You have successfully subscribed to event notifications!');
    }

    public function unsubscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email'
        ]);

        $subscriber = Subscriber::where('email', $validated['email'])->first();
        
        if ($subscriber) {
            $subscriber->update(['is_active' => false]);
            return back()->with('success', 'You have been unsubscribed from event notifications.');
        }

        return back()->with('error', 'Email not found in our subscription list.');
    }
}
