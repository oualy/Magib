<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/post", name="post")
     */
    public function index()
    {
        return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController',
        ]);
    }

    /**
     * @Route("/posts/{id}", name="post_show")
     */
    public function show($id)
    {
        // get a Post object - e.g. query for it
        $post = "ROLE_SUPER_ADMIN";

        // check for "view" access: calls all voters
        $this->denyAccessUnlessGranted('view', $post);

        // ...
    }

    /**
     * @Route("/posts/{id}/edit", name="post_edit")
     */
    public function edit($id)
    {
        // get a Post object - e.g. query for it
        $post = "ROLE_SUPER_ADMIN" ;

        // check for "edit" access: calls all voters
        $this->denyAccessUnlessGranted('edit', $post);

        // ...
    }
}
