<?php

namespace Screeenly\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use Screeenly\Entities\Url;
use Screeenly\Http\Requests\CreateScreenshotRequest;
use Screeenly\Models\ApiKey;
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

    /**
     * Create a new Screenshot.
     * @param  CreateScreenshotRequest $request
     * @return Illuminate\Http\Response
     */
    public function store(CreateScreenshotRequest $request)
    {
        $apiKey = ApiKey::where('key', $request->key)->first();

        $screenshot = $this->captureService
                        ->height($request->get('height', null))
                        ->width($request->get('width', null))
                        ->delay($request->get('delay', 1))
                        ->url(new Url($request->url))
                        ->capture();

        $apiKey->apiLogs()->create([
            'user_id' => $apiKey->user->id,
            'images' => $screenshot->getPath(),
            'ip_address' => $request->ip(),
        ]);

        return response()->json([
            'data' => [
                'path' => $screenshot->getPublicUrl(),
                'base64' => $screenshot->getBase64(),
            ],
        ]);
    }
}
