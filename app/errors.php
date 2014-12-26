<?php

/**
 * Error Handling
 */

App::error(function(Exception $e, $code)
{
    $headers = $e->getHeaders();

    $attachments = array([
        'fallback' => 'An error accoured on Screeenly',
        'pretext'  => 'An error accoured on Screeenly.',
        'color'    => '#c0392b',
        'fields'   => array(
            [
                'title' => 'Request URL',
                'value' => Request::url(),
                'short' => true
            ],
            [
                'title' => 'HTTP Code',
                'value' => $code,
                'short' => true
            ],
            [
                'title' => 'Exception',
                'value' => $e->getMessage(),
                'short' => false
            ]
        )
    ]);

    if (Request::is('api/*')) {

        Log::error($e);
        Slack::sendMessage('API Application Error', $attachments);

        $returnMessage = array(
            'title' => 'An error accoured',
            'message' => $e->getMessage()
        );

        return Response::json($returnMessage, $code, $headers);

    }
    else {

        if (App::environment() == 'live') {

            switch ($code) {

                case 403:
                    return Response::view('404', array(), 403);
                    break;

                case 404:
                    return Response::view('404', array(), 404);
                    break;

                default:
                    Log::error($e);
                    Slack::sendMessage('Frontend Application Error', $attachments);
                    return Response::view('500', array(), 500, $headers);
                    break;
            }

        }
        else {
            Log::error($e);
        }

    }

});