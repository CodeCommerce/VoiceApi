<?php

namespace CodeCommerce\AlexaApi\Model;

class Template
{
    protected $type;
    protected $token;
    protected $backButton;
    protected $backgroundImage;
    protected $title;
    protected $textContent;

    const BODY_TEMPLATE_1_SIMPLE_TEXT_IMAGES = 'BodyTemplate1';
    const BODY_TEMPLATE_2_IMAGE_LIMITED_CENTERED_TEXT = 'BodyTemplate2';
    const BODY_TEMPLATE_3_IMAGE_LIMITED_LEFT_ALIGNED_TEXT = 'BodyTemplate3';
    const BODY_TEMPLATE_6_TEXT_OPTIONAL_BACKGROUND_IMAGE = 'BodyTemplate6';
    const BODY_TEMPLATE_7_SCALABLE_FOREGROUND_IMAGE_OPTIONAL_BACKGROUND_IMAGE = 'BodyTemplate7';
    const LIST_TEMPLATE_1_TEXT_LISTS_OPTIONAL_IMAGES = 'ListTemplate1';
    const LIST_TEMPLATE_2_IMAGES_LISTS_OPTIONAL_TEXT = 'ListTemplate2';

    const BACKBUTTON_VISIBLE = 'VISIBLE';
    const BACKBUTTON_HIDDEN = 'HIDDEN';

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBackButton()
    {
        return $this->backButton;
    }

    /**
     * @param mixed $backButton
     */
    public function setBackButton($backButton)
    {
        $this->backButton = $backButton;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBackgroundImage()
    {
        return $this->backgroundImage;
    }

    /**
     * @param mixed $backgroundImage
     */
    public function setBackgroundImage($backgroundImage)
    {
        $this->backgroundImage = $backgroundImage;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTextContent()
    {
        return $this->textContent;
    }

    /**
     * @param mixed $textContent
     */
    public function setTextContent($textContent)
    {
        $this->textContent = $textContent;

        return $this;
    }

    /**
     * @param $text
     * @return Template
     */
    public function setPrimaryText($text)
    {
        $this->textContent->primaryText->text = $text;

        return $this;
    }

    /**
     * @param $type
     * @return Template
     */
    public function setPrimaryType($type)
    {
        $this->textContent->primaryText->type = $type;

        return $this;
    }

    /**
     * @param $text
     * @param $type
     * @return Template
     */
    public function setPrimary($text, $type)
    {
        $this->setPrimaryText($text);
        $this->setPrimaryType($type);

        return $this;
    }

    /**
     * @param $text
     * @return Template
     */
    public function setSecondaryText($text)
    {
        $this->textContent->secondary->text = $text;

        return $this;
    }

    /**
     * @param $type
     * @return Template
     */
    public function setSecondaryType($type)
    {
        $this->textContent->secondary->type = $type;

        return $this;
    }

    /**
     * @param $text
     * @param $type
     * @return Template
     */
    public function setSecondary($text, $type)
    {
        $this->setPrimaryText($text);
        $this->setPrimaryType($type);

        return $this;
    }

    /**
     * @param $text
     * @return Template
     */
    public function setTertiaryText($text)
    {
        $this->textContent->tertiary->text = $text;

        return $this;
    }

    /**
     * @param $type
     * @return Template
     */
    public function setTertiaryType($type)
    {
        $this->textContent->tertiary->type = $type;

        return $this;
    }

    /**
     * @param $text
     * @param $type
     * @return Template
     */
    public function setTertiary($text, $type)
    {
        $this->setPrimaryText($text);
        $this->setPrimaryType($type);

        return $this;
    }
}