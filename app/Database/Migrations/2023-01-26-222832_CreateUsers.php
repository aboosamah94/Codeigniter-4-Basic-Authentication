<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUser extends Migration
{
    public function up()
    {

        // users table

        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => false,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => false,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
            'password_hash' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
            'is_active' => [
                'type' => 'BOOLEAN',
                'null' => false,
                'default' => false
            ],
            'is_admin' => [
                'type' => 'BOOLEAN',
                'null' => false,
                'default' => false
            ],
            'role_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null' => false,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'bio' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'profile_image' => [
                'type' => 'VARCHAR',
                'constraint' => '128',
                'null' => true,
            ],
            'activation_hash' => [
                'type' => 'VARCHAR',
                'constraint' => '64',
                'unique' => true,
                'null' => true,
            ],
            'reset_hash' => [
                'type' => 'VARCHAR',
                'constraint' => '64',
                'unique' => true,
                'null' => true,
            ],
            'reset_expires_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null
            ]
        ]);
        $this->forge->addPrimaryKey('id')->addUniqueKey('email')->addUniqueKey('username');
        $this->forge->addForeignKey('role_id', 'roles', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('users');

        // remembered_login table

        $this->forge->addField([
            'token_hash' => [
                'type' => 'VARCHAR',
                'constraint' => '64'
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true
            ],
            'expires_at' => [
                'type' => 'DATETIME'
            ]
        ]);

        $this->forge->addPrimaryKey('token_hash')
            ->addForeignKey('user_id', 'user', 'id', 'CASCADE', 'CASCADE')
            ->addKey('expires_at');

        $this->forge->createTable('remembered_login');

        // roles table        

        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'group' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'default' => 'default'
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('roles');

        // permissions table

        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'controller_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'role_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null' => false,
            ],
            'list_all' => [
                'type' => 'BOOLEAN',
                'default' => false
            ],
            'list' => [
                'type' => 'BOOLEAN',
                'default' => false
            ],
            'add' => [
                'type' => 'BOOLEAN',
                'default' => false
            ],
            'edit' => [
                'type' => 'BOOLEAN',
                'default' => false
            ],
            'delete' => [
                'type' => 'BOOLEAN',
                'default' => false
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('role_id', 'roles', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('permissions');
    }

    //--------------------------------------

    public function down()
    {
        $this->forge->dropTable('users');
        $this->forge->dropTable('remembered_login');
        $this->forge->dropTable('roles');
        $this->forge->dropTable('permissions');

    }
}