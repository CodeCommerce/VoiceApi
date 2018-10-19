<?php

namespace CodeCommerce\AlexaApi\Model;

/**
 * Class User
 * @package CodeCommerce\AlexaApi\Model
 */
class User
{
    protected $userId;

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     * @return User
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }
}
