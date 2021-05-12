<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FavoriteCompany
 *
 * @ORM\Table(name="users_token")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserTokenRepository")
 */
class UserToken
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer", length=10, nullable=false)
     */
    private $userId;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=100, nullable=false)
     */
    private $token;

    /**
     * @var \DateTime
     * @ORM\Column(name="last_login", type="datetime", nullable=true)
     */
    private $last_login;
    

    /**
     * Get the value of id
     *
     * @return  int
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of userId
     *
     * @return  int
     */ 
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     *
     * @param  int  $userId
     *
     * @return  self
     */ 
    public function setUserId(int $userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get the value of user
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of token
     *
     * @return  string
     */ 
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set the value of token
     *
     * @param  string  $token
     *
     * @return  self
     */ 
    public function setToken(string $token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get the value of last_login
     *
     * @return  \DateTime
     */ 
    public function getLast_login()
    {
        return $this->last_login;
    }

    /**
     * Set the value of last_login
     *
     * @param  \DateTime  $last_login
     *
     * @return  self
     */ 
    public function setLast_login(\DateTime $last_login)
    {
        $this->last_login = $last_login;

        return $this;
    }
}
