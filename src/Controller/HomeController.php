<?php
/**
 * Created by PhpStorm.
 * User: NoSkilz
 * Date: 30.12.2017
 * Time: 22:36
 */

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Platform;
use App\Entity\Genre;
use App\Entity\Product;

class HomeController extends Controller
{
    public function default()
    {
        $platforms = $this->getDoctrine()->getRepository(Platform::class)->findAll();
        $genres = $this->getDoctrine()->getRepository(Genre::class)->findAll();
        $products = $this->getDoctrine()->getRepository(Product::class);
        $newest = $products->findNewest();
        $best = $products->findBest(0);
        return $this->render('home/default.html.twig', [
                'newest' => $newest,
                'best' => $best]
        );
    }
}