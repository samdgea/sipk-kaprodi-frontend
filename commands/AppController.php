<?php

namespace app\commands;

use app\models\User;
use Yii;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * Initialize SIPK Application.
 *
 * Initialize required basic configuration to application
 *
 * @author Abdilah Sammi <ask@abdilah.id>
 * @since 1.0
 */
class AppController extends Controller
{
    private $permission = [
        'viewUserManagement',
        'createUserManagement',
        'updateUserManagement',
        'deleteUserManagement',
    ];

    private $role = [
        'super-admin',
        'staff',
    ];

    private $assign = [
        'super-admin' => [
            'viewUserManagement',
            'createUserManagement',
            'updateUserManagement',
            'deleteUserManagement',
        ],
        'staff' => [
            'viewUserManagement'
        ]
    ];

    /**
     * Initialize role 
     * @return int Exit code
     */
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        $manageUserMan = $auth->createPermission('manageUserManagement');
        $manageUserMan->description = "User can access User Management Module";
        $auth->add($manageUserMan);

        $viewUserMan = $auth->createPermission('viewUserManagement');
        $viewUserMan->description = "User can view user detail on User Management Module";
        $auth->add($viewUserMan);

        $createUserMan = $auth->createPermission('createUserManagement');
        $createUserMan->description = "User can create new user on User Management Module";
        $auth->add($createUserMan);

        $updateUserMan = $auth->createPermission('updateUserManagement');
        $updateUserMan->description = "User can update user on User Management Module";
        $auth->add($updateUserMan);

        $deleteUserMan = $auth->createPermission('deleteUserManagement');
        $deleteUserMan->description = "User can delete user on User Management Module";
        $auth->add($deleteUserMan);

        $staffRole = $auth->createRole('staff');
        $auth->add($staffRole);
        $auth->addChild($staffRole, $manageUserMan);
        $auth->addChild($staffRole, $viewUserMan);

        $adminRole = $auth->createRole('super-admin');
        $auth->add($adminRole);
        $auth->addChild($adminRole, $createUserMan);
        $auth->addChild($adminRole, $updateUserMan);
        $auth->addChild($adminRole, $deleteUserMan);
        $auth->addChild($adminRole, $staffRole);

        echo "Done!";
        return ExitCode::OK;
    }

    /**
     * Assign role to user.
     * @param integer $user_id User ID.
     * @param string $role Role name
     * @return int Exit code
     */
    public function actionAssign($user_id, $role) 
    {
        $user = User::findOne($user_id);
        $auth = Yii::$app->authManager;

        if (!empty($user) && ($roleClass = $auth->getRole($role))) {
            $auth->assign($roleClass, $user->id);

            echo "Success!";
            return ExitCode::OK;
        }

        echo "Failed!";
        return ExitCode::DATAERR;
    }
}