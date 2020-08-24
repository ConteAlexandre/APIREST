<?php
/*
 * Created at 8/24/20, 9:50 AM
 * For the project APIREST
 * For Alexandre CONTE
 */

namespace App\Controller;


use App\EntityManager\UserManager;
use App\Form\FormUser\RegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormInterface;

/**
 * Class RegisterController
 * @package App\Controller
 *
 * @Route("/user", name="user_")
 *
 * @author CONTE Alexandre <pro.alexandre.conte@gmail.com>
 */
class RegisterController extends AbstractController
{
    /**
     * @Route("/register", name="register", methods={"POST"})
     *
     * @param UserManager $userManager
     * @param Request $request
     * @return null|FormInterface
     */
    public function register(UserManager $userManager, Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $user = $userManager->create();
        $form = $this->createForm(RegisterType::class, $user);
        $form->submit($data);

//        if (!$form->isValid()) {
//            return $form;
//        }

        $userManager->save($user);

        return null;
    }
}