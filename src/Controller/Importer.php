<?php

namespace silverorange\DevTest\Controller;

use silverorange\DevTest\Context;
use silverorange\DevTest\Template;
use silverorange\DevTest\Model; 
use silverorange\DevTest\Post;
use silverorange\DevTest\Database;
use silverorange\DevTest\Config;  

class Importer extends Controller
{
    //private ?Model\Post $post = null;

    public function getContext(): Context
    {
        $context = new Context(); 

        $config = new Config();
        $db = (new Database($config->dsn))->getConnection();            
        // Import functionality start
        $handle = opendir('data/'); 
        if ($handle) {
            while (($entry = readdir($handle)) !== FALSE) {
                if($entry!='' && strlen($entry)>20) {
                    
                    $json = file_get_contents('data/'.$entry);  
                    // Decode the JSON file
                    $json_data = json_decode($json,true);
                      
                    $prep = array();
                    /*foreach($json_data as $k => $v ) 
                    {
                        $prep[':'.$k] = $v;
                        echo $v;
                    }*/
                    $id = $json_data['id'];
                    $title = $json_data['title'];
                    $body = $json_data['body'];
                    $created_at = $json_data['created_at'];
                    $modified_at = $json_data['modified_at'];
                    $author = $json_data['author'];

                    $data = [
                               'id' => $id,
                                'title' =>  $title,
                                'body' => $body,
                                'created_at' => $created_at,
                                'modified_at' => $modified_at,
                                'author' => $author,
                            ];
                    $query = $db->prepare('SELECT * FROM posts where id="'.$id.'"'); 
                    $query->execute();   
                    $postData=$query->fetch();   
                     
                    if(!isset($postData['id']))
                    {
                        $sql = "INSERT INTO posts (id, title, body,created_at,modified_at,author) VALUES (:id, :title, :body, :created_at, :modified_at, :author)";
                        $stmt= $db->prepare($sql);
                        $stmt->execute($data); 
                    }
                }
            }
        }  
        closedir($handle);
        // end 
        return $context;           
    }
    public function getTemplate(): Template\Template
    {        
        return new Template\Importer();
    }
    public function getStatus(): string
    {        
        return $_SERVER['SERVER_PROTOCOL'] . ' 200 OK';
    } 
}
