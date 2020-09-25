<?php
/**
 * Created by PhpStorm
 * User: shadowluffy
 * Date: 9/24/20
 * Time: 7:27 AM
 */

namespace App\Controller;

use App\Manager\UserManager;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserController
 * @package App\Controller
 *
 * @Route("/users", name="users_")
 *
 * @author CONTE Alexandre <pro.alexandre.conte@gmail.com>
 */
class UserController extends AbstractController
{
    /**
     * @Route("/getall", name="getall", methods={"GET"})
     *
     * @param UserManager $userManager
     * @Rest\View(serializerGroups={"test"})
     *
     * @return JsonResponse
     */
    public function getAllUser(UserManager $userManager)
    {
        $users = $userManager->getAllUser();
        return $users;
    }
}