<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonResume extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'required_position', 'education_level_id', 'obs', 'file', 'host_ip_address'];
    public function educationLevel()
    {
        return $this->belongsTo(EducationLevel::class);
    }
}
