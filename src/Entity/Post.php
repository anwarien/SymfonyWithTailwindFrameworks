<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post
{
    
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     *  @ORM\Column(type="string",length=200)
     */
    private $title;

    /**
     *  @ORM\Column(type="string",length=500)
     */
    private $urldetail;

    /**
     *  @ORM\Column(type="string",length=500)
     */
    private $img;

    /**
     *  @ORM\Column(type="text",length=6000)
     */
    private $body;

    /**
     *  @ORM\Column(type="date")
     */
    private $time;


    /**
     * One user can have many or one post(s).
     * @ORM\ManyToOne(targetEntity="App\Entity\User",inversedBy="posts")
     * @ORM\JoinColumn()
     */
    private $user;

    public function getUser(){
        return $this->user;
    }
    public function setUser($user): self {
        $this->user = $user;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(){
        return $this->title;
    }
    public function setTitle($title): void{
        $this->title = $title;
    }

    public function getUrldetail(){
        return $this->urldetail;
    }
    public function setUrldetail($urldetail): void{
        $this->urldetail = $urldetail;
    }

    public function getImg(){
        return $this->img;
    }
    public function setImg($img): void {
        $this->img = $img;
    }

    public function getBody(){
        return $this->body;
    }
    public function setBody($body): void {
        $this->body = $body;
    }

    public function getTime(){
        return $this->time;
    }
    public function setTime($time): void {
        $this->time = $time;
    }


}
