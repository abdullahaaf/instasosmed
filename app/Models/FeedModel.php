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

    public function storeLike($data)
    {
        return $this->db->table('likes')->insert($data);
    }

    public function removeLike($userid,$post_id)
    {
        return $this->db->table('likes')->delete([
            'userid' => $userid,
            'post_id' => $post_id
        ]);
    }

    public function getLikedPostByCurrentUser()
    {
        $sql = "SELECT post_id FROM likes where userid=".session()->get('userid');
        $query = $this->db->query($sql);
        return $query->getResult('array');
    }

}
