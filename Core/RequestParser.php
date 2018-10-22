<?php

namespace CodeCommerce\AlexaApi\Core;

use CodeCommerce\AlexaApi\Model\Intent;
use CodeCommerce\AlexaApi\Model\Slot;

/**
 * Class Request
 * @package CodeCommerce\AlexaApi\Core
 */
class RequestParser
{
    /**
     * @var object
     */
    protected $_jsonObject;

    /**
     * @var \CodeCommerce\AlexaApi\Model\Request
     */
    protected $_request;

    /**
     * @var Intent
     */
    protected $_intent;

    /**
     * Request constructor.
     * @param $jsonObject
     * @throws \Exception
     */
    public function __construct($jsonObject)
    {
        $this->_jsonObject = $jsonObject;
        $this->setIntent();
        $this->setRequestModel();
    }

    /**
     * @return bool
     */
    public function getIntent()
    {
        if (null !== $this->_intent) {
            return $this->_intent;
        }

        return false;
    }

    /**
     *  set intent of request
     */
    protected function setIntent()
    {

        if (property_exists($this->_jsonObject, 'intent')) {
            $this->setIntentAndSlots();
        } elseif ($this->_jsonObject->type == 'LaunchRequest') {
            $this->setLaunchRequestIntent();
        } else {
            throw new \Exception(var_export($this->_jsonObject) . 'Entschuldige, leider ist ein Fehler aufgetreten.');
        }
    }

    /**
     * @return \CodeCommerce\AlexaApi\Model\Request
     */
    public function getRequest()
    {
        return $this->_request;
    }

    /**
     * set request model
     */
    protected function setRequestModel()
    {
        $this->_request = new \CodeCommerce\AlexaApi\Model\Request();
        $this->_request->setLocale($this->_jsonObject->locale)
            ->setRequestId($this->_jsonObject->requestId)
            ->setTimestamp($this->_jsonObject->timestamp)
            ->setType($this->_jsonObject->type)
            ->setIntent($this->getIntent());
    }

    /**
     *
     */
    protected function setIntentAndSlots()
    {
        $this->_intent = new Intent();
        $this->_intent->setName($this->_jsonObject->intent->name)
            ->setConfirmationStatus($this->_jsonObject->intent->confirmationStatus);

        if (property_exists($this->_jsonObject->intent, 'slots')) {
            foreach ($this->_jsonObject->intent->slots as $jsonSlot) {
                $slot = new Slot();
                $slot->setName($jsonSlot->name)
                    ->setValue($jsonSlot->value)
                    ->setConfirmationStatus($jsonSlot->confirmationStatus)
                    ->setSource($jsonSlot->source);

                $this->_intent->setSlot($slot);
            }
        }
    }

    /**
     *
     */
    protected function setLaunchRequestIntent()
    {
        $this->_intent = new Intent();
        $this->_intent->setName('LaunchRequest');
    }
}