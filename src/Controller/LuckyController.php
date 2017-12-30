<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LuckyController
 *
 * @author NoSkilz
 */
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Psr\Log\LoggerInterface;
use App\Entity\Comments;

class LuckyController extends Controller
{
    public function number($max, LoggerInterface $logger)
    {
        if(!$max)
        {
            throw new \Exception('Something went wrong!');
        }
        else
        {
            $comments = $this->getDoctrine()->getRepository(Comments::class)->findAll();
            $logger->info('Im logging.');
            $number = mt_rand(0, $max);
            //return new Response("<html><body>Lucky number:$number</body></html>");
            return $this->render('lucky/number.html.twig', array(
                'number' => $number,
                'comment' => $comments)
            );
        }
    }
}
