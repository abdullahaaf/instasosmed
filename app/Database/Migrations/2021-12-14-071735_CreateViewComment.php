<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateViewComment extends Migration
{
    public function up()
    {
        //
        $db =  \Config\Database::connect();
        $db->query("CREATE OR REPLACE VIEW view_comment AS SELECT
        comments.post_id, comments.userid, users.first_name, users.last_name,comments.comment, comments.created_at
        FROM comments
        JOIN users ON comments.userid = users.id
        ORDER BY comments.created_at ASC");
    }

    public function down()
    {
        //
        $db = \Config\Database::connect();
        $db->query("DROP VIEW view_comment");
    }
}
