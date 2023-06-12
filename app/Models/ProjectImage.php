<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectImage extends Model {
    use HasFactory, SoftDeletes;

    protected $table = 'projects_images';

    protected $fillable = ['project_id', 'image'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];


}
