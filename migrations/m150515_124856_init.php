<?php

use yii\db\Schema;
use yii\db\Migration;

class m150515_124856_init extends Migration
{
    public function up()
    {
        $this->createTable('staff', [
            'id' => 'int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'name' => 'varchar(255) NOT NULL',
            'in_place' => 'TINYINT(1) NOT NULL DEFAULT \'0\''
        ]);

        $this->createTable('group', [
            'id' => 'int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'name' => 'varchar(255) NOT NULL'
        ]);

        $this->createTable('skill', [
            'id' => 'int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'name' => 'varchar(255) NOT NULL'
        ]);

        $this->createTable('staff_group', [
            'id' => 'int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'staff_id' => 'int(11) unsigned NOT NULL',
            'group_id' => 'int(11) unsigned NOT NULL'
        ]);

        $this->createTable('staff_skill', [
            'id' => 'int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'staff_id' => 'int(11) unsigned NOT NULL',
            'skill_id' => 'int(11) unsigned NOT NULL'
        ]);

        $this->addForeignKey('FK_staff_group_staff', 'staff_group', 'staff_id', 'staff', 'id', 'cascade', 'cascade');
        $this->addForeignKey('FK_staff_group_group', 'staff_group', 'group_id', 'group', 'id', 'cascade', 'cascade');

        $this->addForeignKey('FK_staff_skill_staff', 'staff_skill', 'staff_id', 'staff', 'id', 'cascade', 'cascade');
        $this->addForeignKey('FK_staff_skill_skill', 'staff_skill', 'skill_id', 'skill', 'id', 'cascade', 'cascade');
    }

    public function down()
    {
        $this->dropTable('staff_group');
        $this->dropTable('staff_skill');
        $this->dropTable('skill');
        $this->dropTable('group');
        $this->dropTable('staff');
    }
}
