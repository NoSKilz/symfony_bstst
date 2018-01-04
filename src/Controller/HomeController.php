<?php
/**
 * Created by PhpStorm.
 * User: NoSkilz
 * Date: 30.12.2017
 * Time: 22:36
 */

namespace App\Controller;
use App\Entity\User;
use App\Entity\Platform;
use App\Entity\Genre;
use App\Entity\Product;
use App\Form\Register;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class HomeController extends Controller
{
    public function default(AuthenticationUtils $authUtils)
    {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(Register::class, $user, [
                'action' => $this->generateUrl('register'),
                'method' => 'POST']
        );
        $platforms = $this->getDoctrine()->getRepository(Platform::class)->findAll();
        $genres = $this->getDoctrine()->getRepository(Genre::class)->findAll();
        $products = $this->getDoctrine()->getRepository(Product::class);
        $newest = $products->findNewest();
        $best = $products->findBest(0);
        $error = $authUtils->getLastAuthenticationError();
        $lastUsername = $authUtils->getLastUsername();
        return $this->render('home/default.html.twig', [
                'newest' => $newest,
                'best' => $best,
                'platforms' => $platforms,
                'genres' => $genres,
                'register_form' => $form->createView(),
                'error' => $error,
                'lastUsername' => $lastUsername]
        );
    }
}