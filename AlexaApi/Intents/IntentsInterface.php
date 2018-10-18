<?php

namespace CodeCommerce\AlexaApi\Intents;

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
     */
    public function __construct(Request $request);

    /**
     * @return mixed
     */
    public function runIntent();
}
