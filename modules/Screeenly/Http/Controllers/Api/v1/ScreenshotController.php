<?php

namespace Screeenly\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Exception;
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
     * @return Illuminate\Http\JsonResponse
     */
    public function store(CreateScreenshotRequest $request)
    {
        $apiKey = ApiKey::where('key', $request->key)->first();

        try {
            $screenshot = $this->captureService
                            ->height($request->get('height', null))
                            ->width($request->get('width', 1024))
                            ->delay($request->get('delay', 1))
                            ->url(new Url($request->url))
                            ->capture();

            $apiKey->apiLogs()->create([
                'user_id' => $apiKey->user->id,
                'images' => $screenshot->getPath(),
                'ip_address' => $request->ip(),
            ]);

            return response()->json([
                'path'       => $screenshot->getPublicUrl(),
                'base64'     => 'data:image/jpg;base64,'.base64_encode($screenshot->getBase64()),
                'base64_raw' => $screenshot->getBase64(),
            ]);
        } catch (Exception $e) {
            // \Sentry\captureException($e);

            return response()->json([
                'title' => 'An error accoured',
                'message' => 'An internal error accoured.',
                'error' => [
                    'status' => 500,
                    'detail' => $e->getMessage(),
                ],
            ], 500);
        }
    }
}
