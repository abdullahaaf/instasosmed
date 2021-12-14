<?php

namespace App\Models;

use CodeIgniter\Model;

class FeedModel extends Model
{
    protected $table = "posts";
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ["id", "userid", "post","image"];

    public function getAllFeed()
    {
        $sql = "SELECT * FROM view_feed";
        $query =  $this->db->query($sql);
        return $query->getResult('array');
    }
}
