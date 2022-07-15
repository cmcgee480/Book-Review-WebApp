
<?php

class User
{

    public $fullName;
    public $email;
    public $username;
    public $password;




    public function __construct(string $fullName, string $email, string $username, string $password)
    {

        $this->fullName = $fullName;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
    }


}



?>
