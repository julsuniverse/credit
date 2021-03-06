<?php

namespace common\bootstrap;

use src\services\auth\SignupService;
use src\services\contact\ContactService;
use yii\base\BootstrapInterface;
use yii\mail\MailerInterface;

class SetUp implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->language = 'en-US';
        $container = \Yii::$container;

        $container->setSingleton(MailerInterface::class, function() use ($app)
        {
            return $app->mailer;
        });

        $container->setSingleton(ContactService::class, [], [
            $app->params['adminEmail'],
        ]);

        $container->setSingleton(SignupService::class, [], [
        ]);
    }
}