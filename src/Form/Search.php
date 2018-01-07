<?php
/**
 * Created by PhpStorm.
 * User: NoSkilz
 * Date: 7.1.2018
 * Time: 22:56
 */

namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class Search extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('search_query', TextType::class);
    }
}