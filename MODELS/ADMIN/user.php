<?php
class User {
    private $users = [
        ['email'=>'admin@site.com','password'=>'123456','role'=>'admin'],
        ['email'=>'user1@site.com','password'=>'123','role'=>'client']
    ];

    public function loginAdmin($email, $password){
        foreach($this->users as $user){
            if($user['email']==$email && $user['password']==$password && $user['role']=='admin'){
                return true;
            }
        }
        return false;
    }

    public function getUsers(){
        return array_filter($this->users, fn($u)=>$u['role']=='client');
    }
}
