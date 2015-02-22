<?php namespace Screeenly\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler {

	/**
	 * A list of the exception types that should not be reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		'Symfony\Component\HttpKernel\Exception\HttpException'
	];

	/**
	 * Report or log an exception.
	 *
	 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
	 *
	 * @param  \Exception  $e
	 * @return void
	 */
	public function report(Exception $e)
	{
		return parent::report($e);
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Exception  $e
	 * @return \Illuminate\Http\Response
	 */
	public function render($request, Exception $e)
	{
        $code = 0;

		/**
		 * Handle API Errors
		 */
		if ( $request->is('api/*') && $request->isMethod('post') ) {

            if (method_exists($e, 'getHeaders')) {
                $headers = $e->getHeaders();
            }

            if (method_exists($e, 'getStatusCode')) {
                $code = $e->getStatusCode();
            }

            if ($code == 0) {
            	$code = 400;
            }

            \Log::error($e);
            //Slack::sendMessage('API Application Error', $attachments);

            $headers['Access-Control-Allow-Origin'] = '*';

            $returnMessage = array(
                'title' => 'An error accoured',
                'message' => $e->getMessage()
            );

			return \Response::json($returnMessage, $code, $headers);

		}

		return parent::render($request, $e);




		// if ($e instanceof Exception) {

		//     return redirect()->route('home.landingpage')->withErrors(['error' => $e->getMessage()]);
		// }

	}

}
