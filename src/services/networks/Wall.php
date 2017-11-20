<?php
    namespace src\services\networks;


    class Wall
    {
        public $group_id;
        public function __construct($name)
        {
            $pos = strripos($name, '.com');
            $name = substr($name, $pos+5);
            if(strpos($name, 'club')===0)
                $this->group_id = substr($name,4);
            else 
            {
                $group_id = @file_get_contents("https://api.vk.com/method/groups.getById?group_ids=".$name, false, stream_context_create(['http'=>['timeout'=>1]]));
                $group_id = json_decode($group_id);
                $this->group_id = $group_id->response[0]->gid;
            }
                
        }
        
        public function getWall()
        {
            $wall = @file_get_contents("https://api.vk.com/method/wall.get?owner_id=-".$this->group_id."&count=10&access_token=b79046f1b79046f1b79046f133b7c7c4debb790b79046f1ee919330eca7933515d33eab", false, stream_context_create(['http'=>['timeout'=>1]])); 
            $wall = json_decode($wall);
            return $wall->response;
        }
        
    }
?>