<?php

namespace CodeCommerce\AlexaApi\Model;

class ListItem
{
    const TEXT_TYPE_PLAINTEXT = 'PlainText';

    /**
     * @var string
     */
    protected $token;
    /**
     * @var BackgroundImage
     */
    protected $image;
    /**
     * @var array
     */
    protected $textContent = [];

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     * @return ListItem
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     * @return ListItem
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return array
     */
    public function getTextContent()
    {
        return $this->textContent;
    }

    /**
     * @param array $textContent
     * @return ListItem
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
        $this->textContent['primaryText']['text'] = $text;

        return $this;
    }

    /**
     * @param $type
     * @return Template
     */
    public function setPrimaryType($type)
    {
        $this->textContent['primaryText']['type'] = $type;

        return $this;
    }

    /**
     * @param $text
     * @param $type
     * @return Template
     */
    public function setPrimary($text, $type = self::TEXT_TYPE_PLAINTEXT)
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
        $this->textContent['secondaryText']['text'] = $text;

        return $this;
    }

    /**
     * @param $type
     * @return Template
     */
    public function setSecondaryType($type)
    {
        $this->textContent['secondaryText']['type'] = $type;

        return $this;
    }

    /**
     * @param $text
     * @param $type
     * @return Template
     */
    public function setSecondary($text, $type = self::TEXT_TYPE_PLAINTEXT)
    {
        $this->setSecondaryText($text);
        $this->setSecondaryType($type);

        return $this;
    }

    /**
     * @param $text
     * @return Template
     */
    public function setTertiaryText($text)
    {
        $this->textContent['tertiaryText']['type'] = $text;

        return $this;
    }

    /**
     * @param $type
     * @return Template
     */
    public function setTertiaryType($type)
    {
        $this->textContent['tertiaryText']['type'] = $type;

        return $this;
    }

    /**
     * @param $text
     * @param $type
     * @return Template
     */
    public function setTertiary($text, $type = self::TEXT_TYPE_PLAINTEXT)
    {
        $this->setPrimaryText($text);
        $this->setPrimaryType($type);

        return $this;
    }

    /**
     * @param      $url
     * @param null $description
     * @return Template
     */
    public function addBackgroundImage($url, $description = null)
    {
        $backgroundImage = new BackgroundImage();
        $backgroundImage->setSources($url);
        if (null !== $description) {
            $backgroundImage->setContentDescription($description);
        }

        $this->setImage($backgroundImage);

        return $this;
    }
}
