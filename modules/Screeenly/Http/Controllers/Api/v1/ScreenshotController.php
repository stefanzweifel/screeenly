<?php

namespace Screeenly\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Screeenly\Entities\Url;
use Screeenly\Http\Requests\CreateScreenshotRequest;
use Screeenly\Services\CaptureService;

class ScreenshotController extends Controller
{
    /**
     * @var Screeenly\Services\CaptureService
     */
    protected $captureService;

    public function __construct(CaptureService $captureService)
    {
        $this->captureService = $captureService;
    }

    public function store(CreateScreenshotRequest $request)
    {
        $apiKey = $request->user()->apiKeys()->where('key', $request->key)->first();
        $screenshot = $this->captureService
                        ->height($request->get('height', null))
                        ->width($request->get('width', null))
                        ->delay($request->get('delay', 1))
                        ->url(new Url($request->url))
                        ->capture();

        $apiKey->apiLogs()->create([
            'user_id' => $request->user()->id,
            'images' => $screenshot->getPath(),
        ]);

        return response()->json([
            'data' => [
                'path'       => $screenshot->getPublicUrl(),
                'base64'     => 'data:image/jpg;base64,'.base64_encode($screenshot->getBase64()),
                'base64_raw' => $screenshot->getBase64(),
            ],
        ]);
    }
}
