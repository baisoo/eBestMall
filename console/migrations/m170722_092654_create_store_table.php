<?php

use yii\db\Migration;

class m170722_092654_create_store_table extends Migration
{
    const TABLE_NAME = '{{%store}}';
    const TABLE_NAME_TAB = '店铺表';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT=' . "'" . self::TABLE_NAME_TAB . "'";
        }

        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey()->comment('自增ID'),
            'name' => $this->string()->notNull()->comment('店铺名称'),
            'is_proprietary' => $this->smallInteger(1)->notNull()->comment('是否自营:1-是,0-否'),
            'user_id' => $this->bigInteger()->notNull()->comment('用户id'),

        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}