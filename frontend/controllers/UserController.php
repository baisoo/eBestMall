<?php
/**
 * HongYuKeJi
 * ============================================================================
 * Copyright © 2016-2017 HongYuKeJi.Co.Ltd. All rights reserved.
 * Http://www.hongyuvip.com
 * ----------------------------------------------------------------------------
 * 仅供学习交流使用，如需商用请购买商用版权。
 * 堂堂正正做人，踏踏实实做事。
 * ----------------------------------------------------------------------------
 * Author: Shadow  QQ: 1527200768  Time: 2017/7/18 11:21
 * E-mail: admin@hongyuvip.com
 * ============================================================================
 */


namespace frontend\controllers;

use common\models\LoginForm;
use common\models\User;
use common\models\UserInfo;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class UserController extends BaseController
{
    public $layout = 'main-user';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'order'],
                'rules' => [
                    [
                        'actions' => [''],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index', 'order'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    '*' => ['post', 'get'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $model = new User();
        $user = $model->find()->joinWith(['info'])->where(['{{%user}}.id' => Yii::$app->user->identity->getId()])->asArray()->one();
        return $this->render('index', ['model' => $user]);
    }

    public function actionOrder()
    {
        return $this->render('order');
    }

}