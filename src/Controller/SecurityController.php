<?php
/**
 * Created by PhpStorm.
 * User: NoSkilz
 * Date: 31.12.2017
 * Time: 23:09
 */

namespace App\Controller;
use App\Entity\User;
use App\Form\Register;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;


class SecurityController extends Controller implements LogoutSuccessHandlerInterface
{
    public function login(Request $request, AuthenticationUtils $authUtils)
    {
        $referer = $request->server->get('HTTP_REFERER');
        return $this->redirect($referer);
    }
    public function logout(Request $request)
    {
        $referer = $request->server->get('HTTP_REFERER');
        return $this->redirect($referer);
    }
    public function onLogoutSuccess(Request $request)
    {
        $referer = $request->headers->get('referer');
        return $this->redirect($referer);
    }
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();
        $form = $this->createForm(Register::class, $user, [
                'action' => $this->generateUrl('register'),
                'method' => 'POST']
        );
        $referer = $request->server->get('HTTP_REFERER');
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $user->setAdmin(0);
            $user->setIsActive(1);
            $user->setRole('user');
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $this->addFlash('success','Byl jste úspěšně registrován.');
            return $this->redirect($referer);
        }
        else
        {
            $form_err = $form->getErrors();
            //$this->addFlash('errors',(string)$form->getErrors(true, false));
            foreach ($form as $fieldName => $formField)
            {
                foreach ($formField->getErrors(true) as $error)
                {
                    $this->addFlash('errors',$error->getMessage());
                }
            }
            /*foreach($form_err as $error)
            {
                $this->addFlash('errors',$error->getMessage());
            }*/
            //return var_dump($form->getErrors(true,true));
            /*foreach($errors as $message)
            {
                $this->addFlash('errors',$message);
            }*/
            return $this->redirect($referer);
        }
    }
}