<?php
namespace UserBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\Post;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RegistrationController extends Controller {

    /**
     * 
     * @return JsonResponse
     * @Post("/register/", name="messages_conversations")
     */
    public function registerAction(Request $request) {
        $form = $this->container->get('fos_user.registration.form');
        $formHandler = $this->container->get('fos_user.registration.form.handler');
        $confirmationEnabled = $this->container->getParameter('fos_user.registration.confirmation.enabled');
        $code = 200;
        $process = $formHandler->process($confirmationEnabled);
        if (true == $process["transctions"]) {
            $user = $form->getData();

            $authUser = false;

            if ($confirmationEnabled) {
                $this->container->get('session')->set('fos_user_send_confirmation_email/email', $user->getEmail());
                $route = 'fos_user_registration_check_email';
            } else {
                $authUser = true;
                $route = 'fos_user_registration_confirmed';
            }
            $this->setFlash('fos_user_success', 'registration.flash.user_created');
            $response = ['valid' => true];
            
            //return $this->render('UserBundle:Registration:email.txt.twig', array('user' => $user,'confirmationUrl'=> 'https://www.google.co.ve/?gws_rd=ssl'));
            return new JsonResponse($response);
            //return $response;
        } else {
            $code = 400;
        }

        $response = $process;

        $return = new JsonResponse($response, $code);
        //return $this->render('UserBundle:Registration:checkEmail.html.twig', array('user' => $user, 'rol' => implode(";", $user->getRoles()) ,'confirmationUrl'=> 'https://www.google.co.ve/?gws_rd=ssl'));
        return $return;
        // return $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:register.html.'.$this->getEngine(), array(
//            'form' => $form->createView(),
//        ));
    }

    /**
     * Tell the user to check his email provider
     */
    public function checkEmailAction() {
        $email = $this->container->get('session')->get('fos_user_send_confirmation_email/email');
        $this->container->get('session')->remove('fos_user_send_confirmation_email/email');
        $user = $this->container->get('fos_user.user_manager')->findUserByEmail($email);
        if (null === $user) {
            throw new NotFoundHttpException(sprintf('The user with email "%s" does not exist', $email));
        }
        return $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:checkEmail.html.' . $this->getEngine(), array('user' => $user,));
    }

    /**
     * Receive the confirmation token from user email provider, login the user
     */
    public function confirmAction($token) {


       

        $user = $this->container->get('fos_user.user_manager')->findUserByConfirmationToken($token);
        $em = $this->getDoctrine()->getManager();

        if (null === $user) {

            throw new NotFoundHttpException(sprintf('The user with confirmation token "%s" does not exist', $token));
        }

        $user->setConfirmationToken(null);
        $user->setEnabled(true);
        $user->setLastLogin(new \DateTime());
        $user->setUsername($user->getEmail());
//        $user>setUsernameCanonical($user->getEmail());
        $em->flush();
        $em->persist($user);

        $response = new RedirectResponse($this->getParameter('front_end_point') . 'html/login/check.html');

        return $response;
    }

    /**

     * @param string $action
     * @param string $value
     */
    protected function setFlash($action, $value) {
        $this->container->get('session')->getFlashBag()->set($action, $value);
    }

    protected function getEngine() {
        return $this->container->getParameter('fos_user.template.engine');
    }

}
