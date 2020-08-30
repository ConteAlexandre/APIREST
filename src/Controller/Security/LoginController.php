<?php
/*
 * Created at 8/24/20, 3:31 PM
 * For the project APIREST
 * For Alexandre CONTE
 */

namespace App\Controller\Security;


use App\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class LoginController
 * @package App\Controller\Security
 *
 * @author CONTE Alexandre <pro.alexandre.conte@gmail.com>
 *
 * @Route("/login", name="login_")
 */
class LoginController extends AbstractController
{
    /**
     * @Route()
     */
    public function login()
    {

    }
}