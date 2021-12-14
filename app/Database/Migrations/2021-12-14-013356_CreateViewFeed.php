<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateViewFeed extends Migration
{
    public function up()
    {
        //
        $db = \Config\Database::connect();
        $db->query("CREATE OR REPLACE VIEW view_feed AS SELECT posts.userid, users.first_name, users.last_name, posts.post, posts.image, posts.created_at FROM posts JOIN users ON posts.userid = users.id ORDER by posts.created_at DESC");
    }

    public function down()
    {
        //
        $db = \Config\Database::connect();
        $db->query('DROP VIEW view_feed');
    }
}
