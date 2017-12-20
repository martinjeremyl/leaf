<?php
/**
 * Created by PhpStorm.
 * User: jeremy martin
 * Date: 20/12/2017
 * Time: 23:33
 */

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    /**
     * @Route("/home", name="home")
     */
    public function home(Request $request)
    {
        return $this->render('home.html.twig');
    }
}