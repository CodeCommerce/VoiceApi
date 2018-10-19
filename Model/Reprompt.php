<?php

namespace CodeCommerce\AlexaApi\Model;

/**
 * Class Reprompt
 * @package CodeCommerce\AlexaApi\Model
 */
class Reprompt
{
    /**
     * @var Outspeech
     */
    protected $outputSpeech;

    /**
     * @return mixed
     */
    public function getOutputSpeech()
    {
        return $this->outputSpeech;
    }

    /**
     * @param mixed $outputSpeech
     * @return Reprompt
     */
    public function setOutputSpeech(Outspeech $outputSpeech)
    {
        $this->outputSpeech = $outputSpeech;

        return $this;
    }
}
