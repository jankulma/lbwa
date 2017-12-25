<?php namespace App\Http\Controllers\Backend\Settings;

use App\FirstPageImage;
use App\Project;
use App\Http\Controllers\Backend\SettingsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomSettingsController extends SettingsController
{
    public function moveProject(Request $request)
    {
        $this->validate($request, [
            'fromId' => 'required|integer',
            'toId' => 'required|integer',
        ]);

        $fromId = $request->get('fromId');
        $toId = $request->get('toId');

        $toModel = Project::find($toId);
        $toModel->id = 999999;
        $toModel->save();

        $fromModel = Project::find($fromId);
        $fromModel->id = $toId;
        $fromModel->save();

        $toModel->id = $fromId;
        $toModel->save();

        return response()->json('OK');
    }

    public function getFirstPageImage()
    {
        return response()->json(FirstPageImage::first());
    }

    public function updateFirstPageImage(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image'
        ]);

        $url = Storage::url($request->file('image')->store('public'));

        if (! $url) {
            return response()->json([
                'message' => 'Problem updating image.'
            ], 422);
        }

        $firstPageImage = FirstPageImage::first();

        if (! $firstPageImage) {
            $firstPageImage = new FirstPageImage();
        }

        $firstPageImage->image = $url;
        $firstPageImage->save();

        return response()->json('OK');
    }
}
