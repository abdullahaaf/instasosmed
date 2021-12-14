<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'auto_increment' => true,
                'unsigned' => true
            ],
            'post_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true
            ],
            'userid' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true
            ],
            'comment' => [
                'type' => 'varchar',
                'constraint' => 255
            ],
            'created_at datetime default current_timestamp',
			'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('post_id','posts','id','RESTRICT','RESTRICT');
        $this->forge->addForeignKey('userid','users','id','RESTRICT','RESTRICT');
        $this->forge->createTable('comments');
    }

    public function down()
    {
        //
        $this->forge-dropTable('comments');
    }
}
