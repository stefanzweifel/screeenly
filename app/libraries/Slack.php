<?php

class Slack
{

    public static function sendMessage($message = 'Default Message', $attachments = false)
    {

        //Attachments Template
        // $attachments = array([
        //     'fallback' => 'Message title goes here',
        //     'pretext'  => 'Message Title goes here',
        //     'color'    => '#ff6600',
        //     'fields'   => array(
        //         [
        //             'title' => 'Notes',
        //             'value' => 'This is much easier than i tought',
        //             'short' => true
        //         ],[
        //             'title' => 'Notes',
        //             'value' => 'This is much easier than i tought',
        //             'short' => true
        //         ],
        //         )
        // ]);

        //Payload
        $data = array(
            'channel'     => Config::get('slack.default_channel'),
            'username'    => Config::get('slack.bot_name'),
            'text'        => $message,
            'icon_emoji'  => Config::get('slack.icon'),
            'attachments' => $attachments
        );

        $payload = json_encode($data);

        $ch = curl_init('https://'.Config::get('slack.domain').'.slack.com/services/hooks/incoming-webhook?token='.Config::get('slack.token'));
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($payload))
            );

        //Execute CURL
        $result = curl_exec($ch);

        return $result;
    }

}