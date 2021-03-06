<?php

use yii\db\Migration;

/**
 * 团队表
 * Class m180115_085452_team
 * @author wuzhc
 * @since 2018-01-15
 */
class m180115_085452_team extends Migration
{
    public $tableName = '{{%Team}}';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT="团队表"';
        }

        $this->createTable($this->tableName, [
            'id'            => $this->primaryKey(11)->unsigned(),
            'fdName'        => $this->string(32)->notNull()->comment('项目名称'),
            'fdCreatorID'   => $this->integer(11)->notNull()->comment('创建者,对应tbUser.id'),
            'fdCompanyID'   => $this->integer(11)->notNull()->comment('公司,对应tbCompany.id'),
            'fdDescription' => $this->string(255)->comment('描述'),
            'fdStatus'      => $this->smallInteger(1)->defaultValue(0)->comment('1可用，2已删除'),
            'fdOrder'       => $this->smallInteger(10)->defaultValue(0)->comment('排序，值越大排越前'),
            'fdCreate'      => $this->dateTime()->notNull()->comment('创建时间'),
            'fdUpdate'      => $this->dateTime()->comment('更新时间'),
        ], $tableOptions);

        $this->createIndex('creatorID', $this->tableName, 'fdCreatorID');
        $this->createIndex('companyID', $this->tableName, 'fdCompanyID');

        $this->batchInsert($this->tableName, ['fdName', 'fdCreatorID', 'fdCompanyID', 'fdStatus', 'fdOrder', 'fdCreate', 'fdUpdate'], [
            ['PHP后端', 1, 1, \common\config\Conf::USER_ENABLE, 6, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')],
            ['Java后端', 1, 1, \common\config\Conf::USER_ENABLE, 5, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')],
            ['美术', 1, 1, \common\config\Conf::USER_ENABLE, 0, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')],
            ['产品', 1, 1, \common\config\Conf::USER_ENABLE, 0, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')],
            ['Web前端', 1, 1, \common\config\Conf::USER_ENABLE, 5, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')],
            ['运维', 1, 1, \common\config\Conf::USER_ENABLE, 4, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')],
            ['测试', 1, 1, \common\config\Conf::USER_ENABLE, 0, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')],
            ['客服', 1, 1, \common\config\Conf::USER_ENABLE, 0, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')],
            ['市场', 1, 1, \common\config\Conf::USER_ENABLE, 0, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropIndex('creatorID', $this->tableName);
        $this->dropIndex('companyID', $this->tableName);
        $this->dropTable($this->tableName);
    }
}
