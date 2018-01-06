<?php
/**
 * Created by PhpStorm.
 * User: NoSkilz
 * Date: 5.1.2018
 * Time: 20:35
 */

namespace App\Controller;
use App\Entity\Product;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class AjaxController extends Controller
{
    public function loadMore(Request $request)
    {
        $products = $this->getDoctrine()->getRepository(Product::class)->findNewest($request->request->get('offset', 8));
        $data = [];
        $id = 0;
        foreach ($products as $product) {
            $id++;
            $description = mb_strimwidth($product->getDescription(), 0, 200) . '...';
            $temp = ['product_name' => $product->getProductName(),
                    'platform_name' => $product->getPlatformName(),
                    'price' => $product->getPrice(),
                    'description' => $description,
                    'picture' => $product->getPicture()];
            $data[$id] = $temp;
        }
        return new JsonResponse($data);
    }
}