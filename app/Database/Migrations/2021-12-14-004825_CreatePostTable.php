<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePostTable extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id' => [
                'type' => 'bigint',
                'constraint' => 20,
                'auto_increment' => true,
                'unsigned' => true
            ],
            'userid' => [
                'type' => 'bigint',
                'constraint' => 20,
                'unsigned' => true
            ],
            'post' => [
                'type' => 'varchar',
                'constraint' => 255
            ],
            'image' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true
            ],
            'created_at datetime default current_timestamp',
			'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addKey('id',true);
        $this->forge->addForeignKey('userid','users','id','RESTRICT','RESTRICT');
        $this->forge->createTable('posts');
    }

    public function down()
    {
        //
    }
}
