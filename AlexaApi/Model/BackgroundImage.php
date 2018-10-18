<?php
/**
 * Created by PhpStorm.
 * User: Chris
 * Date: 18.10.18
 * Time: 16:19
 */

namespace CodeCommerce\AlexaApi\Model;


class BackgroundImage
{
    protected $contentDescription;
    protected $sources = [];
    protected $title;

    /**
     * @return mixed
     */
    public function getContentDescription()
    {
        return $this->contentDescription;
    }

    /**
     * @param mixed $contentDescription
     * @return BackgroundImage
     */
    public function setContentDescription($contentDescription)
    {
        $this->contentDescription = $contentDescription;

        return $this;
    }

    /**
     * @return array
     */
    public function getSources(): array
    {
        return $this->sources;
    }

    /**
     * @param array $sources
     * @return BackgroundImage
     */
    public function setSources($sources): BackgroundImage
    {
        $this->sources[]['url'] = $sources;

        return $this;
    }


}