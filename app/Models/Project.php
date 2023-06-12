<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model {
    use HasFactory, SoftDeletes;

    protected $table = 'projects';

    protected $guarded = [];

    protected $hidden = ['updated_at', 'deleted_at'];

    protected $with = ['images', 'technologies'];

    public function images() {
        return $this->hasMany(ProjectImage::class, 'project_id', 'id');
    }

    public function technologies() {
        return $this->hasMany(ProjectTech::class, 'project_id', 'id');
    }

}
