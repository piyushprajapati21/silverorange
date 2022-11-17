<?php

namespace silverorange\DevTest\Controller;

use silverorange\DevTest\Context;
use silverorange\DevTest\Template;
use silverorange\DevTest\Model; 
use silverorange\DevTest\Author;
use silverorange\DevTest\Database;
use silverorange\DevTest\Config;  

class PostDetails extends Controller
{
    //private ?Model\Post $post = null;

    public function getContext(): Context
    {
        $context = new Context(); 
        
        if ($this->post === null) {
            $context->title = 'Not Found';
            $context->content = "A post with id {$this->params[0]} was not found.";
        } else {
            $context->authorData = $this->post;
             $context->title = 'Post Details';
        }
        return $context;
    }

    public function getTemplate(): Template\Template
    {
        if ($this->post === null) {
            return new Template\NotFound();
        }

        return new Template\PostDetails();
    }

    public function getStatus(): string
    {
        if ($this->post === null) {
            return $_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found';
        }

        return $_SERVER['SERVER_PROTOCOL'] . ' 200 OK';
    }

    protected function loadData(): void
    {
        // TODO: Load post from database here. $this->params[0] is the post id.
        $config = new Config();
        $db = (new Database($config->dsn))->getConnection(); 
        $query = $db->prepare('SELECT authors.*,post.title,post.body FROM authors as authors inner join posts as post on post.author=authors.id where authors.id="'.$this->params[0].'"'); 
        $query->execute();   
        $postData=$query->fetch();          
        $this->post = $postData; //$this->params[0];
    }
}
