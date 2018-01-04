<?php
/**
 * Created by PhpStorm.
 * User: jeremy martin
 * Date: 20/12/2017
 * Time: 23:33
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserController extends Controller
{
    /**
     * @Route("/profile", name="profile")
     */
    public function home(Request $request,SessionInterface $session)
    {

        $success = $session->get('success') ? $session->get('success') : null;
        $error = $session->get('error') ? $session->get('error') : null;
        $session->clear();
        return $this->render('profile.html.twig',array("success"=>$success,"error"=>$error));
    }

    /**
     * @Route("/updateProfile", name="updateProfile")
     */
    public function updateProfile(Request $request,SessionInterface $session)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        if ($request->get('_email') != $user->getEmail()) {
            if ($em->getRepository(User::class)->findOneByEmail($request->get('_email')) == null) {
                $user->setEmail($request->get('_email'));
            } else {
                $session->set('error','Ce mail est déjà utilisé !');
                return $this->redirectToRoute('profile');
            }
        }
        $user->setPoste($request->get('_poste'));
        $user->setPrenom($request->get('_prenom'));
        $user->setNom($request->get('_nom'));
        $user->setSociete($request->get('_societe'));
        $user->setAdresse($request->get('_adresse'));
        $user->setVille($request->get('_ville'));
        $user->setPays($request->get('_pays'));
        $user->setCp($request->get('_cp'));
        $user->setDescription($request->get('_description'));

        if (isset($_FILES) and $_FILES['_photo']['name'] != "") {
            $fileInfo = new \SplFileInfo($_FILES['_photo']['name']);
            $newPath = $_SERVER['DOCUMENT_ROOT'].'/profilePictures/' .basename($_FILES['_photo']['name']);
            copy($_FILES['_photo']['tmp_name'],$newPath);
            $user->setPhoto($_FILES['_photo']['name']);
        }
        $em->persist($user);
        $em->flush();
        $session->set('success','Votre profil à bien été mis à jour !');
        return $this->redirectToRoute('profile');
    }
}