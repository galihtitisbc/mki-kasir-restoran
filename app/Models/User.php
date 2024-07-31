<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'username',
        'supervisor_id'
    ];
    protected $primaryKey = 'user_id';
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
    public function scopePegawaiByOutlet(Builder $query, $slug)
    {
        $query->whereHas('outletWorks', function (Builder $query) use ($slug) {
            $query->where('slug', '=', $slug);
        });
        $query->whereDoesntHave('roles', function (Builder $query) {
            $query->whereIn('name', ['SUPERADMIN', 'SUPERVISOR']);
        });
    }
    public function supervisorHasPegawai()
    {
        return $this->hasMany(User::class, 'supervisor_id');
    }
    public function pegawaiHasSupervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }
    public function suppliers()
    {
        return $this->hasMany(Supplier::class, 'user_id');
    }

    public function salesHistories()
    {
        return $this->hasMany(SalesHistory::class, 'user_id');
    }
    public function supervisorHasOutlets()
    {
        return $this->hasMany(Outlet::class, 'supervisor_id');
    }
    public function outletWorks()
    {
        return $this->belongsToMany(Outlet::class, 'user_outlets', 'user_id', 'outlet_id');
    }
    // many through
    public function outletHasCategory()
    {
        return $this->hasManyThrough(Category::class, Outlet::class, 'supervisor_id', 'outlet_id', 'user_id', 'outlet_id');
    }
    public function userHasOutletHasMeja()
    {
        return $this->hasManyThrough(Meja::class, Outlet::class, 'outlet_id', 'meja_id', 'user_id', 'outlet_id');
    }
}
