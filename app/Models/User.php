<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    /**
     * Check if the user is an admin
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
    
    /**
     * Check if the user is an organizer
     *
     * @return bool
     */
    public function isOrganizer(): bool
    {
        return $this->role === 'organizer';
    }
    
    /**
     * Check if the user is a student
     *
     * @return bool
     */
    public function isStudent(): bool
    {
        return $this->role === 'student';
    }
    
    /**
     * Get the events created by this user
     */
    public function events()
    {
        return $this->hasMany(Event::class);
    }
    
    /**
     * Get the subscriptions by this user
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscriber::class);
    }
    
    /**
     * Get the events this user is subscribed to
     */
    public function subscribedEvents()
    {
        return $this->belongsToMany(Event::class, 'subscribers');
    }
    
    /**
     * Get the registrations by this user
     */
    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
    
    /**
     * Get the events this user is registered for
     */
    public function registeredEvents()
    {
        return $this->belongsToMany(Event::class, 'registrations');
    }
}
