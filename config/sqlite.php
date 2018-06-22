<?php
//SQLLITE数据库
//D:\data\www\dev\yii2\basic\source\sqlite\job
return array(
    'class' => 'yii\db\Connection',
    'dsn' => 'sqlite:@app/source/sqlite/job',
    'charset' => 'utf8',
    'slaveConfig' => [
        'username' => '',
        'password' => '',
        'charset' => 'utf8',
    ],
//配置两个从库试一下
//    'slaves' => [
//        ['test' => 'sqlite:@app/source/sqlite/job_news'],
//    ]
);