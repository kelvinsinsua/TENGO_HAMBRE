<?php

namespace AppBundle\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Core\User\UserInterface;
use AppBundle\Repository\AppMenuRepositories;
/**
 * JWTResponseListener
 *
 * @author Gregorio Escalona <gescalona@arawato.com.ve>
 */
class JWTResponseListener
{
    /**
     * Add public data to the authentication response
     *
     * @param AuthenticationSuccessEvent $event
     */
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {
        $data = $event->getData();
        $user = $event->getUser();
        //$em = $this->getDoctrine()->getManager();
        if (!$user instanceof UserInterface) {
            return;
        }
        
        //$menu = $em->getRepository('AppBundle:AppMenu')->findByRole('INVERSOR');
        
        $data['data'] = array(
            'username' => $user->getUsername(),
            'roles'    => $user->getRoles(),
            'user_iri' => $event->getRequest()->getBaseUrl()."/api/users/".$user->getId(),
            //'menu'     => $userMenu,
                
        );
        $event->setData($data);
    }
}
