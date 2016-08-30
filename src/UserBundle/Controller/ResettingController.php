<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace UserBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccountStatusException;
use FOS\UserBundle\Model\UserInterface;
use FOS\RestBundle\Controller\Annotations\Post;
use Symfony\Component\HttpFoundation\JsonResponse;
/**
 * Controller managing the resetting of the password
 *
 * @author Thibault Duplessis <thibault.duplessis@gmail.com>
 * @author Christophe Coevoet <stof@notk.org>
 */
class ResettingController extends ContainerAware {

    const SESSION_EMAIL = 'fos_user_send_resetting_email/email';

    /**
     * Request reset user password: show form
     */
    public function requestAction() {
        return $this->container->get('templating')->renderResponse('FOSUserBundle:Resetting:request.html.' . $this->getEngine());
    }

    /**
     * Request reset user password: submit form and send email
     */

    /**

     * Request reset user password: submit form and send email
     * @Post("/reset-password", name="resetting_password_request")
     */
    //
    //
    
    public function sendEmailAction(Request $request) {
        $data = array();
        $code = 200;
//        $em = $this->getDoctrine()->getManager();
        $username = $this->container->get('request')->request->get('username');
        /** @var $user UserInterface */
        $user = $this->container->get('fos_user.user_manager')->findUserByUsernameOrEmail($username);
//        $user = $user = $em->getRepository('AppBundle:User')->findUserByEmail($username);
        if (null === $user) {
            $data["status"] = 0;
            $data["message"] = 'El usuario no existe';
            $code = 401;
            //return $this->container->get('templating')->renderResponse('FOSUserBundle:Resetting:request.html.'.$this->getEngine(), array('invalid_username' => $username));
        } elseif ($user->isPasswordRequestNonExpired($this->container->getParameter('fos_user.resetting.token_ttl'))) {
            $data["status"] = 0;
            $code = 401;
            $data["message"] = 'Ya ha realizado una solicitud de cambio de clave!';
            //return $this->container->get('templating')->renderResponse('FOSUserBundle:Resetting:passwordAlreadyRequested.html.'.$this->getEngine());
        } elseif (null === $user->getConfirmationToken()) {
            /** @var $tokenGenerator \FOS\UserBundle\Util\TokenGeneratorInterface */
            $tokenGenerator = $this->container->get('fos_user.util.token_generator');
            $user->setConfirmationToken($tokenGenerator->generateToken());
        }
        if (200 == $code) {
            $this->container->get('session')->set(static::SESSION_EMAIL, $this->getObfuscatedEmail($user));
            $this->container->get('fos_user.mailer')->sendResettingEmailMessage($user);
            $user->setPasswordRequestedAt(new \DateTime());
            $this->container->get('fos_user.user_manager')->updateUser($user);
            $data["status"] = 1;
            $data["message"] = 'Se ha enviado un correo a ' . $user->getEmail() . ' con informaci&oacute;n para la recuperacion de su clave !';
        }
        return new JsonResponse($data, 200);
        //return new RedirectResponse($this->container->get('router')->generate('fos_user_resetting_check_email'));
    }

    /**
     * * Tell the user to check his email provider
     */
    public function checkEmailAction() {
        $session = $this->container->get('session');
        $email = $session->get(static::SESSION_EMAIL);
        $session->remove(static::SESSION_EMAIL);
        if (empty($email)) {
            return new RedirectResponse($this->container->get('router')->generate('fos_user_resetting_request'));
        }
        return $this->container->get('templating')->renderResponse('FOSUserBundle:Resetting:checkEmail.html.' . $this->getEngine(), array(
                    'email' => $email,
        ));
    }

    public function resetAction($token) {
        $user = $this->container->get('fos_user.user_manager')->findUserByConfirmationToken($token);
        if (null === $user) {
            $data["status"] = 0;
            $data["message"] = 'El usuario no existe';
            $code = 401;
        } elseif (!$user->isPasswordRequestNonExpired($this->container->getParameter('fos_user.resetting.token_ttl'))) {
            $data["status"] = 0;
            $code = 401;
            $data["message"] = 'Ya ha realizado una solicitud de cambio de clave!';
        }
        $response = new RedirectResponse($this->getParameter('front_end_point') . 'html/login/reset-password.html?tk=' . $token);
        return $response;
    }

    /**
     * Reset user password
     * @Post /resetpasswords/{token}
     */
    public function resetpasswordsAction($token) {
        $user = $this->container->get('fos_user.user_manager')->findUserByConfirmationToken($token);
        $data = array();
        $code = 200;
        $data["status"] = 1;
        $data["message"] = 'Cambio de clave satisfactorio';
        if (null === $user) {
            $data["status"] = 0;
            $data["message"] = 'El usuario con el token proporcionado no existe';
            $code = 401;
        } elseif (!$user->isPasswordRequestNonExpired($this->container->getParameter('fos_user.resetting.token_ttl'))) {
            $data["status"] = 0;
            $data["message"] = 'Ya ha realizado una solicitud de cambio de clave!';
            $code = 401;
        } else {
            $form = $this->container->get('fos_user.registration.form');
            $formHandler = $this->container->get('fos_user.resetting.form.handler');
            $process = $formHandler->process($user);

            if ($process["transctions"]) {
                $this->setFlash('fos_user_success', 'resetting.flash.success');
                $response = new RedirectResponse($this->getRedirectionUrl($user));
                $this->authenticateUser($user, $response);
            } else {
                $data["status"] = 0;
                $data["message"] = 'ERROR';
                $data["error"] = $process["errors"];
            }
        }
        return new JsonResponse($data, $code);
    }

    /**
     * * Authenticate a user with Symfony Security
     * * @param \FOS\UserBundle\Model\UserInterface 
     *  $user
     * * @param \Symfony\Component\HttpFoundation\Response $response
     */
    protected function authenticateUser(UserInterface $user, Response $response) {
        try {
            $this->container->get('fos_user.security.login_manager')->loginUser(
                    $this->container->getParameter('fos_user.firewall_name'), $user, $response);
        } catch (AccountStatusException $ex) {
            
        }
    }

    /**
     * * Generate the redirection url when the resetting is completed.
     * * @param \FOS\UserBundle\Model\UserInterface $user
     *  @return string
     */
    protected function getRedirectionUrl(UserInterface $user) {
        return $this->container->get('router')->generate('fos_user_profile_show');
    }

    /**
     * * Get the truncated email displayed when requesting the resetting.
     * *
     * * The default implementation only keeps the part following @ in the address.
     * *
     * * @param \FOS\UserBundle\Model\UserInterface $user
     * * @return string
     */
    protected function getObfuscatedEmail(UserInterface $user) {
        $email = $user->getEmail();
        if (false !== $pos = strpos($email, '@')) {
            $email = '...' . substr($email, $pos);
        }
        return $email;
    }

    /**
     * * @param string $action
     * * @param string $value
     */
    protected function setFlash($action, $value) {
        $this->container->get('session')->getFlashBag()->set($action, $value);
    }

    protected function getEngine() {
        return $this->container->getParameter('fos_user.template.engine');
    }

}
