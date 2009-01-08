<?php

class Framework_Module_Welcome_Foo extends Framework_Auth_No
{
    public $controllers = array('CLI');
    public function __default()
    {
        $sql = 'SELECT * FROM users';

        $users = $this->db->getAll($sql);
        foreach ($users as $u) {
            echo $u['userID'] . "\t" . $u['username'] . "\n";
        }
    }

    public function hello() 
    {
        echo "Hello World!\n";
    }
}

?>
