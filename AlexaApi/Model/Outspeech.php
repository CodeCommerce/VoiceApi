<?php

namespace CodeCommerce\AlexaApi\Model;

/**
 * Class Outspeech
 * @package CodeCommerce\AlexaApi\Model
 */
class Outspeech
{
    const PLAY_BEHAVIOR_ENQUEUE = 'ENQUEUE';
    const PLAY_BEHAVIOR_REPLACE_ALL = 'REPLACE_ALL';
    const PLAY_BEHAVIOR_REPLACE_ENQUEUED = 'REPLACE_ENQUEUED';
    const TYPE_PLAIN_TEXT = 'PlainText';
    const TYPE_SSML = 'SSML';

    /**
     * @var
     */
    protected $type;

    /**
     * @var
     */
    protected $text;

    /**
     * @var
     */
    protected $ssml;

    /**
     * @var
     */
    protected $playBehavior;

    public function __construct()
    {
        $this->setType(self::TYPE_PLAIN_TEXT);
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return Outspeech
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     * @return Outspeech
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSsml()
    {
        return $this->ssml;
    }

    /**
     * @param mixed $ssml
     * @return Outspeech
     */
    public function setSsml($ssml)
    {
        $this->ssml = $ssml;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPlayBehavior()
    {
        return $this->playBehavior;
    }

    /**
     * @param mixed $playBehavior
     * @return Outspeech
     */
    public function setPlayBehavior($playBehavior)
    {
        $this->playBehavior = $playBehavior;

        return $this;
    }
}