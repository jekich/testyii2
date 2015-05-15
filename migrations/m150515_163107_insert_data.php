<?php

use yii\db\Schema;
use yii\db\Migration;

class m150515_163107_insert_data extends Migration
{
    public function up()
    {
        $this->execute("
            INSERT INTO `group` (`id`, `name`) VALUES
                (1, '1'),
                (2, '2'),
                (3, '3'),
                (4, '4');
            INSERT INTO `skill` (`id`, `name`) VALUES
                (1, 'a'),
                (2, 'b'),
                (3, 'c');
            INSERT INTO `staff` (`id`, `name`, `in_place`) VALUES
                (1, 'Test 1', 0),
                (2, 'Test 2', 1),
                (3, 'Test 3', 0),
                (4, 'Test 4', 0),
                (5, 'Test 5', 1),
                (6, 'Test 6', 0);
            INSERT INTO `staff_group` (`id`, `staff_id`, `group_id`) VALUES
                (1, 1, 2),
                (2, 1, 4),
                (3, 2, 3),
                (4, 6, 1),
                (5, 5, 2),
                (7, 4, 3),
                (8, 3, 4),
                (9, 5, 3),
                (10, 5, 4);
            INSERT INTO `staff_skill` (`id`, `staff_id`, `skill_id`) VALUES
                (1, 1, 2),
                (3, 2, 2),
                (4, 3, 2),
                (5, 3, 3),
                (6, 4, 1),
                (7, 5, 3),
                (8, 6, 2),
                (9, 1, 1),
                (10, 6, 1),
                (11, 6, 3);

        ");
    }

    public function down()
    {
        return false;
    }

}
