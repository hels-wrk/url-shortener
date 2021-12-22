<?php

namespace App\DTO;

class GetShortLinkRequestDTO
{
    private $user_id;
    private $link;
    private $lifetime;
    private $secret;

    public function __construct($user_id, $link, $lifetime, $secret)
    {
        $this->user_id = $user_id;
        $this->link = $link;
        $this->lifetime = $lifetime;
        $this->secret = $secret;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @return mixed
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @return mixed
     */
    public function getLifetime()
    {
        return $this->lifetime;
    }
}
