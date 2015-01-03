<?php namespace Screeenly\Api;

use JonnyW\PhantomJs\Client;
use Response, User, Input, File, App, Config, Str;

/**
 * Contains all methods to create those screenshots.
 *
 * @author  Stefan Zweifel
 */
class ScreenshotBuilder
{
    protected $url;
    protected $user;
    protected $width;
    protected $height;
    protected $client;
    protected $storagePath;
    protected $filename;
    protected $assetPath;

    protected $header;

    protected $viewportHeight = 768;

    /**
     * Validation Rules
     * @var array
     */
    private static $rules = [
        'key'    => 'required' ,
        'url'    => 'required|url',
        'width'  => 'integer',
        'height' => 'integer'
    ];

    function __construct(array $header)
    {
        $this->header = $header;

        new RequestValidator();

        $this->saveInput();
        $this->generateFilename();
        $this->buildClient();
    }

    /**
     * Store Input Data to Object
     * @return void
     */
    private function saveInput()
    {
        $this->url    = Input::get('url', 'http://screeenly.com');
        $this->user   = User::getUserByKey( Input::get('key') );
        $this->width  = Input::get('width', 1024);
        $this->height = Input::get('height');
    }

    /**
     * Create new filename for request
     * @return void
     */
    private function generateFilename()
    {
        $this->filename    = uniqid() . Str::random(20) . '.jpg';
        $storageFolder     = Config::get('api.storage_path');
        $this->storagePath = public_path() . '/' . $storageFolder . $this->filename;
        $this->assetPath   = asset($storageFolder . $this->filename);
    }

    /**
     * Initialize PhantomJS Client
     * @return JonnyW\PhantomJs\Client
     */
    private function buildClient()
    {
        $client = Client::getInstance();
        $client->setBinDir(base_path() . '/bin');
        $client->addOption('--load-images=true');
        $client->addOption('--ignore-ssl-errors=true');
        $client->addOption('--ssl-protocol=any');

        return $this->client = $client;
    }

    /**
     * Use PhantomJS Client to take Screenshot of given URL
     * @return void
     */
    private function takeScreenshot()
    {
        $viewportHeight = 768;

        $request = $this->client->getMessageFactory()->createCaptureRequest($this->url, 'GET');
        $request->setCaptureFile($this->storagePath);
        $request->setViewportSize($this->width, $viewportHeight);

        /**
         * If height is set by user, crop the image
         */
        if (isset($this->height)) {
            $request->setCaptureDimensions($this->width, $this->height, 0, 0);
        }

        $request->setTimeout(1000);
        $request->setDelay(1); // Delay Rendering for 1 sec (Animations etc.)

        $response = $this->client->getMessageFactory()->createResponse();
        $this->client->send($request, $response);

        try {
            $file = File::get($this->storagePath);
        } catch (Exception $e) {
            App::abort(500, 'Screenshot can\'t be generated for URL: ' . $this->url, $this->header);
        }

        $this->bas64 = base64_encode($file);

        return;
    }

    /**
     * Create Log in Database
     * @return void
     */
    private function createLog()
    {
        $log = new \APILog;
        $log->images   = $this->filename;
        $log->user()->associate($this->user);
        $log->save();
    }

    /**
     * Main function to execute Screenshot Capture Command
     * @return Illuminate\Http\Response
     */
    public function execute()
    {
        $this->takeScreenshot();

        $result = [
            'path'       => $this->assetPath ,
            'base64'     => 'data:image/jpg;base64,' . $this->bas64,
            'base64_raw' => $this->bas64
        ];

        $this->createLog();

        return Response::json($result, 201, $this->header);
    }

}