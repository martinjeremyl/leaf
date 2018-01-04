<?php
/**
 * Created by PhpStorm.
 * User: jeremy martin
 * Date: 04/01/2018
 * Time: 17:51
 */

namespace App\Controller;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Form\UserType;
use App\Entity\User;

class FileController extends Controller
{
    /**
     * @Route("/files", name="files")
     */
    public function files(Request $request)
    {
        return $this->render('file.html.twig',array("path"=>$_SERVER['DOCUMENT_ROOT'].'/rootDirectory/'));
    }

    /**
     * @Route("/checkFile", name="checkFile")
     */
    public function checkFile(Request $request)
    {
        $file = $_FILES['file'];
        $response = new JsonResponse();
        $response->setStatusCode(200,"OK");
        return $response;
    }
}