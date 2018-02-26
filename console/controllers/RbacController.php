<?php
namespace console\controllers;


use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        $adminpermission = $auth->createPermission('/*');
        $adminpermission->description = 'adminpermission';
        $auth->add($adminpermission);

        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        $adminAccess = $auth->createRole('adminAccess');
        $auth->add($adminAccess);
        $auth->addChild($adminAccess, $adminpermission);

        $admin =  $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin,  $adminAccess);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($adminAccess, 1);
    }
}

