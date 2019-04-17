<?php

//gère les utilisateurs, rangs, etc
//modele inscription > ajouter utilisateur à la base

require_once("model/Manager.php");

class UserManager extends Manager
{

    public function getUserInfo($infoNeeded, $infoProvided, $userEmail)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT ' . $infoNeeded . ' FROM users WHERE ' . $infoProvided . '=?');
        $req->execute(array($userEmail));
        $userInfo = $req->fetch();
        return $userInfo;
    }
    public function getUserPassword($userId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT password FROM users WHERE id=?');
        $req->execute(array($userId));
        $userPassword = $req->fetch();
        return $userPassword;
    }

    public function addNewUser($userEmail, $userPassword, $userFirstName, $userLastName)
    {
        $db = $this->dbConnect();
        $user = $db->prepare('INSERT INTO users(email, password, firstname, lastname) VALUES(?, ?, ?, ?)');
        $addedUser = $user->execute(array($userEmail, $userPassword, $userFirstName, $userLastName));

        return $addedUser;
    }

    public function updateUser($userFirstName, $userLastName)
    {
        $db = $this->dbConnect();
        $user = $db->prepare('UPDATE `users` SET `id`=[value-1],`firstname`=[value-2],`lastname`=[value-3],`email`=[value-4],`password`=[value-5],`admin`=[value-6],`moderator`=[value-7] WHERE 1');
        $updatedUser = $user->execute(array($userFirstName, $userLastName));

        return $updatedUser;
    }
}