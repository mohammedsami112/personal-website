<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectTech extends Model {
    use HasFactory, SoftDeletes;

    protected $table = 'projects_technologies';

    protected $fillable = ['project_id', 'tech'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];


}
