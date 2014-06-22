<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| oAuth Config
	|--------------------------------------------------------------------------
	*/

	/**
	 * Storage
	 */
	'storage' => 'Session',

	/**
	 * Consumers
	 */
	'consumers' => array(

        /**
         * Facebook
         */
        'Facebook' => array(
            'client_id'     => '',
            'client_secret' => '',
            'scope'         => array(),
        ),

		/**
		 * Facebook
		 */
        'Github' => array(
            'client_id'     => $_ENV['github_client_id'],
            'client_secret' => $_ENV['github_secret'],
            'scope'         => array(''),
        ),

	)

);