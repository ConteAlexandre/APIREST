<?php
/*
 * Created at 8/21/20, 4:07 PM
 * For the project APIREST
 * For Alexandre CONTE
 */

namespace App\Form\FormUser;


use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class RegisterType
 * @package App\Form\FormUser
 *
 * @author CONTE Alexandre <pro.alexandre.conte@gmail.com>
 */
class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class)
            ->add('password', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class
        ]);
    }
}