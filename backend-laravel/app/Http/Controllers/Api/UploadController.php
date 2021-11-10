<?php

namespace App\Http\Controllers\Api;

use App\RealWorld\Transformers\FileTransformer;
use App\File;
use Illuminate\Http\Request;

class UploadController extends ApiController
{
    /**
     * FeedController constructor.
     *
     * @param FileTransformer $transformer
     */
    public function __construct(FileTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function store(Request $request) {
        $document = null;

        if ($files = $request->file('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $fileName = time().'.'.$extension;
            $path = public_path().'/files';
            $uplaod = $file->move($path, $fileName);

            $document = new File();
            $document->name = $request->file->getClientOriginalName();
            $document->slug = $fileName;
            $document->save();

            $document->slug = $this->transformer->publicFilesUrl() . $fileName;
        }

        return $this->respondWithTransformer($document);
    }
}