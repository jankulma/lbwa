<?php

namespace App\Http\Controllers\Frontend;

use App\Project;
use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;

class ProjectController extends FrontendController
{
    public function index()
    {
        return response()->json([
            'projects' => Project::all(),
            'locale' => app()->getLocale(),
            'baseUrl' => url('/'),
        ]);
    }

    public function store(Request $request)
    {
        $images = $this->storeImages($request);

        $data = array_merge($request->only([
            'title_pl', 'title_en', 'description_pl', 'description_en', 'images'
        ]), ['images' => json_encode($images)]);

        if ($id = $request->get('id')) {
            $project = Project::where('id', $id)
                ->update($data);
        } else {
            $project = Project::create($data);
        }


        return response()->json($project);
    }

    private function storeImages($request)
    {
        $images = [];

        foreach ($request->all() as $key => $value) {
            if (is_int($key)) {
                if (is_string($request->$key)) {
                    $images[$key] = $request->$key;
                } else {
                    $images[$key] = $request->$key->store('project-title', 'projects');
                }
            }
        }

        ksort($images);

        return $images;
    }

    public function destroy($id)
    {
        return response()->json(
            Project::destroy($id)
        );
    }
}
