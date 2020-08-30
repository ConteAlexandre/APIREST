<?php
/*
 * Created at 8/24/20, 9:50 AM
 * For the project APIREST
 * For Alexandre CONTE
 */

namespace App\Controller;


use App\Manager\UserManager;
use App\Form\FormUser\RegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class RegisterController
 * @package App\Controller
 *
 * @Route("/register", name="register_")
 *
 * @author CONTE Alexandre <pro.alexandre.conte@gmail.com>
 */
class RegisterController extends AbstractController
{
    /**
     * @Route("/user", name="user", methods={"POST"})
     *
     * @param UserManager $userManager
     * @param Request $request
     *
     * @throws \Exception
     *
     * @return JsonResponse
     */
    public function register(UserManager $userManager, Request $request, ValidatorInterface $validator)
    {
        $data = json_decode($request->getContent(), true);

        $user = $userManager->create();
        $form = $this->createForm(RegisterType::class, $user);
        $form->submit($data);

        $violation = $validator->validate($user);

        if (0 !== count($violation)) {
            foreach ($violation as $error) {
                return new JsonResponse($error->getMessage(), Response::HTTP_BAD_REQUEST);
            }
        }

        $userManager->save($user);

        return null;
    }
}