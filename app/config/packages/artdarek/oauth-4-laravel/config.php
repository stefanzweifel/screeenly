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
         * GitHub
         */
        'GitHub' => array(
            'client_id'     => $_ENV['github_client_id'],
            'client_secret' => $_ENV['github_secret'],
            'scope'         => array(''),
        ),

	)

);