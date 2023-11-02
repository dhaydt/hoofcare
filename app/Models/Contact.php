<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
