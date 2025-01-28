<?php

namespace App\Models;

use \PDO;
use stdClass;

class UserModel extends SqlConnect {
  public function get(int $id){
    $req = $this->db->prepare("SELECT * FROM user WHERE id = :id");
    $res->execute(["id" => $id]);

    return $req->rowCount() > 0 ? $req->fetch(PDO::FETCH_ASSOC) : new stdclass;
  }
}

//fetch assoc est un tableau associatif 
// dans les requets préparé on utilise plus ? mais :[notre-variable]
// stdclass permet de renvoyé un élément vide pour par la suite retourner une erreur ou une donnée 