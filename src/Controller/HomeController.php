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
use App\Form\Search;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    public function default(Request $request, AuthenticationUtils $authUtils)
    {
        $user = new User();
        $register_form = $this->createForm(Register::class, $user, [
                'action' => $this->generateUrl('register'),
                'method' => 'POST']
        );
        $search_form = $this->createForm(Search::class, NULL, [
                'action' => $this->generateUrl('home'),
                'method' => 'POST']
        );
        $search_form->handleRequest($request);
        if($search_form->isSubmitted())
        {
            $query = $search_form->get('search_query')->getData();
            return $this->redirectToRoute('search', ['query' => $query]);
        }
        $platforms = $this->getDoctrine()->getRepository(Platform::class)->findAll();
        $genres = $this->getDoctrine()->getRepository(Genre::class)->findAll();
        $products = $this->getDoctrine()->getRepository(Product::class);
        $newest = $products->findNewest(0);
        $best = $products->findBest();
        $error = $authUtils->getLastAuthenticationError();
        $lastUsername = $authUtils->getLastUsername();
        return $this->render('home/default.html.twig', [
                'newest' => $newest,
                'best' => $best,
                'platforms' => $platforms,
                'genres' => $genres,
                'register_form' => $register_form->createView(),
                'search_form' => $search_form->createView(),
                'error' => $error,
                'lastUsername' => $lastUsername]
        );
    }
}