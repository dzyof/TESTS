<?php
use common\models\User;
use mdm\admin\components\DbManager;
use yii\db\Migration;

/**
 * Class m180208_144003_create_role_admin
 */
class m180208_144003_create_role_admin extends Migration
{
    protected $permissions = [
        'admin.article.reset-filter' => [User::ROLE_MODERATOR],
        'admin.article.batch-publish' => [User::ROLE_MODERATOR],
        'admin.article.batch-unpublish' => [User::ROLE_ADMIN]
    ];

    protected function getAuthManager()
    {
        $authManager = Yii::$app->getAuthManager();
        if ($authManager instanceof yii\rbac\DbManager || $authManager instanceof DbManager) {
        } else {
            throw new \yii\base\InvalidConfigException('You should configure "authManager" component to use database before executing this migration.');
        }
        return $authManager;
    }

    public function up()
    {
        $authManager = $this->getAuthManager();

        foreach ($this->permissions as $permissionName => $roles) {
            if (!$authManager->getPermission($permissionName)) {
                $permission = $authManager->createPermission($permissionName);
                $authManager->add($permission);
            } else {
                $permission = $authManager->getPermission($permissionName);
            }
            foreach ($roles as $role) {
                if (!$authManager->hasChild($authManager->getRole($role), $permission)) {
                    $authManager->addChild($authManager->getRole($role), $permission);
                }
            }
        }
    }

    public function down()
    {
        $authManager = $this->getAuthManager();

        foreach ($this->permissions as $permissionName => $roles) {
            if ($permission = $authManager->getPermission($permissionName)) {
                foreach ($roles as $role) {
                    if ($authManager->getRole($role) && $permission) {
                        $authManager->removeChild($authManager->getRole($role), $permission);
                    }
                }
                $authManager->remove($permission);
            }
        }
    }
}
