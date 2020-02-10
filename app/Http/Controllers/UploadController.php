<?php
namespace App\Http\Controllers;

use App\Models\Media;
use App\Services\UploadService;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Pion\Laravel\ChunkUpload\Handler\AbstractHandler;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class UploadController extends Controller
{
    /**
     * Handles the file upload
     *
     * @param Request $request
     *
     * @param UploadService $service
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws UploadMissingFileException
     * @throws \Pion\Laravel\ChunkUpload\Exceptions\UploadFailedException
     */
    public function upload(Request $request, UploadService $service)
    {
        $receiver = new FileReceiver("file", $request, HandlerFactory::classFromRequest($request));

        if ($receiver->isUploaded() === false) {
            throw new UploadMissingFileException();
        }
        $save = $receiver->receive();

        // check if the upload has finished (in chunk mode it will send smaller files)
        if ($save->isFinished()) {
            return $service->saveFile($save->getFile());
        }

        /** @var AbstractHandler $handler */
        $handler = $save->handler();

        return response()->json([
            "done" => $handler->getPercentageDone(),
            'status' => true
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function history(Request $request)
    {
        $media = Media::paginate(15);
        return view('history', compact('media'));
    }

    /**
     * @param $hash
     * @return string
     */
    public function download($hash)
    {
        $hashIds = new Hashids();
        $hashArr = $hashIds->decode($hash);
        if (!empty($hashArr) && $mediaId = Arr::get($hashArr, 0)) {
            $media = Media::find($mediaId);
            if ($media) {
                return Storage::download($media->url);
            }
        }
        return 'The media dose not exists';
    }
}