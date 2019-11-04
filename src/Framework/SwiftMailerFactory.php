<?php
namespace Framework;

use DI\Container;

class SwiftMailerFactory
{
    public function __invoke(Container $container): \Swift_Mailer
    {
        if ($container->get('env') === 'production') {
            //Mode production -> envoyer avec un no_reply de l'enseignement
            $transport = new \Swift_SendmailTransport();
        } else {
            //Mode dev -> envoie depuis le server smtp de google
            $transport = (new \Swift_SmtpTransport('smtp.googlemail.com', 465, 'ssl'))
                ->setUsername('ensfea.mailer')
                ->setPassword('ensfea123');
        }
        return new \Swift_Mailer($transport);
    }
}
