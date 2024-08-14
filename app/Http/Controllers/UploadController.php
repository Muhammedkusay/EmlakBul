<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\TemporaryFile;


class UploadController extends Controller
{

    public function upload(Request $request) {

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = $image->getClientOriginalName();
            $folder = uniqid('image-', true);
            $image->storeAs('images/tmp/'. $folder, $fileName);

            TemporaryFile::create([
                'folder' => $folder,
                'file' => $fileName,
            ]);
            return $folder;
        }
        return '';

    }

    public function delete() {
        $temporaryImage = TemporaryFile::where('folder', request()->getContent())->first();
        if($temporaryImage) {
            Storage::deleteDirectory('images/tmp/'.$temporaryImage->folder);
            $temporaryImage->delete();
        }
        return response()->noContent();
    }
}
