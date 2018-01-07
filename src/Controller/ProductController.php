<?php
/**
 * Created by PhpStorm.
 * User: NoSkilz
 * Date: 6.1.2018
 * Time: 22:06
 */

namespace App\Controller;
use App\Entity\Product;
use App\Entity\Platform;
use App\Entity\Genre;
use App\Form\Register;
use App\Entity\User;
use App\Form\Search;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class ProductController extends Controller
{
    public function showGames(Request $request, $platform, $genre)
    {
        $user = new User();
        $form = $this->createForm(Register::class, $user, [
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
        $find = $products->findByPlatformGenre($platform, $genre);
        $newest = $products->findNewest(0);
        $best = $products->findBest();
        $authUtils = $this->get('security.authentication_utils');
        $error = $authUtils->getLastAuthenticationError();
        $lastUsername = $authUtils->getLastUsername();
        return $this->render('product/showgames.html.twig', [
                'newest' => $newest,
                'best' => $best,
                'platforms' => $platforms,
                'genres' => $genres,
                'register_form' => $form->createView(),
                'search_form' => $search_form->createView(),
                'products' =>  $find,
                'error' => $error,
                'lastUsername' => $lastUsername]
        );
    }
    public function show(Request $request, $id)
    {
        $user = new User();
        $form = $this->createForm(Register::class, $user, [
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
        $find = $products->find($id);
        $newest = $products->findNewest(0);
        $best = $products->findBest();
        $authUtils = $this->get('security.authentication_utils');
        $error = $authUtils->getLastAuthenticationError();
        $lastUsername = $authUtils->getLastUsername();
        return $this->render('product/show.html.twig', [
                'newest' => $newest,
                'best' => $best,
                'platforms' => $platforms,
                'genres' => $genres,
                'register_form' => $form->createView(),
                'search_form' => $search_form->createView(),
                'product' =>  $find,
                'error' => $error,
                'lastUsername' => $lastUsername]
        );
    }
    public function search(Request $request, $query)
    {
        $user = new User();
        $form = $this->createForm(Register::class, $user, [
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
        $find = $products->findSearch($query);
        $newest = $products->findNewest(0);
        $best = $products->findBest();
        $authUtils = $this->get('security.authentication_utils');
        $error = $authUtils->getLastAuthenticationError();
        $lastUsername = $authUtils->getLastUsername();
        return $this->render('product/search.html.twig', [
                'newest' => $newest,
                'best' => $best,
                'platforms' => $platforms,
                'genres' => $genres,
                'register_form' => $form->createView(),
                'search_form' => $search_form->createView(),
                'products' =>  $find,
                'error' => $error,
                'lastUsername' => $lastUsername]
        );
    }
}