<?php

namespace App\Starter\Users;

use App\Starter\BaseApp\Traits\CreatedBy;
use App\Starter\BaseApp\Traits\HasAttach;
use App\Starter\Users\Models\Role;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Laratrust\Traits\LaratrustUserTrait;
use Laravel\Scout\Searchable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use SoftDeletes, Searchable, LaratrustUserTrait, HasAttach, Notifiable;

    protected static $attachFields = [
        'profile_picture' => [
            'sizes' => ['small' => 'crop,400x300', 'large' => 'resize,800x600'],
            'path' => 'uploads'
        ],
    ];
    protected $table = "users";
    protected $fillable = [
        'name',
        'type',
        'email',
        'mobile_number',
        'password',
        'is_active',
        'profile_picture',
        'governorate',
        'city',
        'birth_date',
        'lang_age',
        'move_age',
        'think_age',
        'social_age',
        'self_age',
        'test_age',
        'age',
    ];

    public function setPasswordAttribute($value)
    {
        if (trim($value)) {
            $this->attributes['password'] = bcrypt(trim($value));
        }
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', '=', 1)->where('confirmed', 1);
    }

    public function getUserTypes()
    {
        return UserEnums::userTypes();
    }

    public function getRoles()
    {
        return Role::get();
    }

    public function scopeNotSuperAdmin($query)
    {
        return $query->where('super_admin', '=', 0);
    }

    public function scopeWithoutLoggedUser($query)
    {
        return $query->where('id', '!=', auth()->id());
    }

    public function getData()
    {
        $query = $this->withoutLoggedUser()
            ->when(request('type'), function ($q) {
                return $q->where('type', request('type'));
            })
            ->when(request('mobile_number'), function ($q) {
             return $q->where('mobile_number', request('mobile_number'));
            });
        return $query;
    }

    public function export($rows, $fileName)
    {
        if ($rows) {
            foreach ($rows as $row) {
                unset($object);
                $object['id'] = $row->id;
                $object['Name'] = $row->name;
                $object['Email'] = $row->email;
                $object['Mobile'] = $row->mobile_number;
                $object['Is Admin'] = ($row->is_admin) ? 'Yes' : 'No';
                $object['Created at'] = $row->created_at;
                $labels = array_keys($object);
                $data[] = $object;
            }
            export($data, $labels, $fileName);
        }
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return $this->toArray();
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}
