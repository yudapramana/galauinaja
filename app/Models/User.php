<?php

namespace App\Models;

use App\Enums\RoleType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    //     'role',
    //     'avatar',
    //     'organization_id',
    // ];

    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $appends = [
        'formatted_created_at',
        'org_id',
        'org_name',
        'nip_name'
    ];

    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->format(setting('date_format'));
    }

    public function role(): Attribute
    {
        return Attribute::make(
            get: fn($value) => RoleType::from($value)->name,
        );
    }

    public function avatar(): Attribute
    {
        // return Attribute::make(
        //     get: fn($value) => asset(Storage::url($value) ?? 'noimage.png'),
        // );

        return Attribute::make(
            get: fn($value) => $value ?? "http://res.cloudinary.com/kemenagpessel/image/upload/v1709086972/profile_picture_pegawai/ijf9mhs8e1m2mjjgz69l.png",
        );
        
    }

    public function org()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function getOrgNameAttribute()
    {
        return $this->org ? $this->org->name : '-';
    }

    public function getOrgIdAttribute()
    {
        return $this->org ? $this->org->id : '-';
    }

    public function getNipNameAttribute()
    {
        return $this->username . ' - ' . $this->name;
    }

    public function employee()
    {
        return $this->belongsTo('App\Models\Employee', 'id_employee', 'id');
    }
}
