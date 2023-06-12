<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\ProjectTech;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class projectsController extends Controller {

    public function getProjects() {
        $projects = Project::paginate(10);
        return $this->successResponse('Get Projects Successfully', $projects);
    }

    public function createProject(Request $request) {

        $validate = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'preview_link' => 'url|nullable',
            'thumbnail' => 'required|image|mimes:jpeg,jpg,png',
            'technologies' => 'required'
        ]);

        if ($validate->fails()) {
            return $this->failResponse('Validation Error', $validate->errors());
        }

        // Upload Thumbnail
        $thumbnail = $request->file('thumbnail');
        $thumbnailNewName = $request->title .'_'. rand(0, 999999999999) . '.' . $thumbnail->getClientOriginalExtension();
        $thumbnail->move('projects/thumbnails', $thumbnailNewName);

        // Upload Images
        $projectImages = [];
        if ($request->file('images')) {
            $images = $request->file('images');
            $destinationPath = storage_path() . '/projects/images/';
            
            foreach($images as $image) {
                $imageName = $request->title .'_'. rand(0, 999999999999);
                $imageExtension = $image->getClientOriginalExtension();
                $storedName = $imageName . '.' . $imageExtension;
                $image->move('projects/images', $storedName);
                $projectImages[] = $storedName;
            }
        }

        // Create Project
        $project = Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'preview_link' => $request->preview_link,
            'thumbnail' => $thumbnailNewName
        ]);

        // Add Images
        if (count($projectImages) > 0) {
            foreach($projectImages as $image) {
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image' => $image
                ]);
            }
        }

        // Add Technologies
        foreach($request->technologies as $tech) {
            ProjectTech::create([
                'project_id' => $project->id,
                'tech' => $tech
            ]);
        }


        return $this->successResponse('Project Added Successfully');

    }

}
