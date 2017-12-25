<?php namespace App\Http\Controllers\Backend\Cms;

use App\Http\Controllers\Backend\CMSController;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;

class PartialController extends CMSController
{
    protected $files = [

        'en' => [
            'contact' => [
                'address' => 'storage/app/public/cms/en/contact/address.html',
                'content' => 'storage/app/public/cms/en/contact/content.html'
            ]
        ],

        'pl' => [
            'contact' => [
                'address' => 'storage/app/public/cms/pl/contact/address.html',
                'content' => 'storage/app/public/cms/pl/contact/content.html'
            ]
        ]
    ];

    public function index()
    {
        return response()->json([
            'partials' => $this->files
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'fileContents' => 'string'
        ]);

        $path = $this->getPath($request->get('id'));

        $success = file_put_contents($path, $request->get('fileContents'));

        if (! $success) {
            return response()->json([
                'message' => 'Problem occured when saving new data.'
            ], 422);
        }

        return response()->json('', 200);
    }

    public function edit($id)
    {
        $file = $this->getFile($id);

        return response()->json([
            'file' => $file
        ]);
    }

    private function getFile($id)
    {
        $path = $this->getPath($id);

        return file_get_contents($path);
    }

    private function getPath($id)
    {
        $relativePath = Arr::get($this->files, $id);

        return base_path($relativePath);
    }
}
