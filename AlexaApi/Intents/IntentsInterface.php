<?php

namespace CodeCommerce\AlexaApi\Intents;

use CodeCommerce\AlexaApi\Model\System;
use CodeCommerce\AlexaApi\Model\Request;

/**
 * Interface IntentsInterface
 * @package CodeCommerce\AlexaApi\Intents
 */
interface IntentsInterface
{
    /**
     * IntentsInterface constructor.
     * @param Request $request
     * @param System  $system
     */
    public function __construct(Request $request, System $system);

    /**
     * @return mixed
     */
    public function runIntent();
}
