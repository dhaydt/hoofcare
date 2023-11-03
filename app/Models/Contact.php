<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'f_name',
        'l_name',
        'business_name',
        'zipcode',
        'country',
        'services',
        'certifications',
        'online_link_1',
        'online_link_2',
        'preferred_contact_method',
        'phone',
        'email',
        'text',
        'messenger',
        'category_id'
    ];

    /**
     * Get the service that owns the ContaTo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    /**
     * The service that belong to the Contact
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function service(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'services', 'services', 'service_id');
    }
}
