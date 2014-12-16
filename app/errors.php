<?php

/**
 * Error Handling
 */

App::error(function($exception, $code)
{
    if (App::environment('live')) {

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
                    'value' => $exception->getMessage(),
                    'short' => false
                ]

                )
        ]);

        switch ($code)
        {
            //We don't need messages for the following HTTP Codes
            case 200:
                break;

            case 403:
                return Response::view('404', array(), 403);

            case 404:
                return Response::view('404', array(), 404);

            case 500:
                Slack::sendMessage('Application Error', $attachments);
                return Response::view('500', array(), 500);

            default:
                Slack::sendMessage('Application Error', $attachments);
                return Response::view('500', array(), $code);
        }

    }

});