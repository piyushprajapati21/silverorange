<?php

namespace silverorange\DevTest\Controller;

use silverorange\DevTest\Context;
use silverorange\DevTest\Template;
use silverorange\DevTest\Database;
use silverorange\DevTest\Config;

class PostIndex extends Controller
{
    private array $posts = [];

    public function getContext(): Context
    {
        //Fetch listing and display
        $config = new Config();
        $db = (new Database($config->dsn))->getConnection(); 
        $query = $db->prepare('SELECT * FROM posts ORDER BY `created_at` DESC'); 
        $query->execute();   
        $postsData=$query->fetchAll();  
        
        if(count($postsData)>0)
        {
            $postData = '<table class="order-summary"><tr><th>Name</th><th>Author Code</th><th></th></tr>';
            foreach($postsData as $data)
            {
                $postData .= '<tr><td>'.$data['title'].'</td><td>'.$data['author'].'</td><td><a href="/posts/'.$data['author'].'">View Details</a></td></tr>';
            }
            $postData .= '</table>';
        } 
        $context = new Context();
        $context->title = 'Posts';
        $context->postData = $postData; 
        return $context;
    }

    public function getTemplate(): Template\Template
    {
        return new Template\PostIndex();
    }

    protected function loadData(): void
    {
        // TODO: Load posts from database here.
        $this->posts = [];
    }
} 