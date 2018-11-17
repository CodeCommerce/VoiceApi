<?php

namespace CodeCommerce\AlexaApi\Model;

/**
 * Class Response
 * @package CodeCommerce\AlexaApi\Model
 */
class Response
{
    /**
     * @var Outspeech
     */
    protected $outputSpeech;

    /**
     * @var
     */
    protected $reprompt;

    /**
     * @var bool
     */
    protected $shouldEndSession;

    /**
     * @var Directives
     */
    protected $directives = [];

    /**
     * Response constructor.
     * @param Outspeech|null $outputSpeech
     */
    public function __construct($outputSpeech = null)
    {
        if (null !== $outputSpeech) {
            $this->outputSpeech = $outputSpeech;
        }
        $this->shouldEndSession = true;
    }

    /**
     * @return mixed
     */
    public function getDirectives()
    {
        return $this->directives;
    }

    /**
     * @param mixed $directives
     * @return Response
     */
    public function setDirectives($directives)
    {
        $this->directives[] = $directives;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOutputSpeech()
    {
        return $this->outputSpeech;
    }

    /**
     * @param mixed $outputSpeech
     * @return Response
     */
    public function setOutputSpeech(Outspeech $outputSpeech)
    {
        $this->outputSpeech = $outputSpeech;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getReprompt()
    {
        return $this->reprompt;
    }

    /**
     * @param mixed $reprompt
     * @return Response
     */
    public function setReprompt(Reprompt $reprompt)
    {
        $this->reprompt = $reprompt;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getShouldEndSession()
    {
        return $this->shouldEndSession;
    }

    /**
     * @param mixed $shouldEndSession
     * @return Response
     */
    public function setShouldEndSession($shouldEndSession)
    {
        $this->shouldEndSession = $shouldEndSession;

        return $this;
    }

    /**
     * @param $name
     */
    public function unsetVariable($name)
    {
        if (property_exists($this, $name)) {
            unset($this->{$name});
        }
    }

    /**
     * adds directives with new template
     *
     * @param Template $template
     * @return Template
     */
    public function addTemplate(Template $template)
    {
        $directive = new Directives();
        $directive->setTemplate($template);
        $this->setDirectives($directive);

        return $template;
    }
}
