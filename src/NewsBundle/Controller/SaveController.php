<?php

namespace NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TechEventBundle\Entity\Article;
use TechEventBundle\Entity\Domain;
use TechEventBundle\Entity\Saved;

class SaveController extends Controller
{
    public function addBookmarkAction($id) {
        $article=$this->getDoctrine()->getRepository(Article::class)->find($id);
        $user=$this->getUser();
        $save=new Saved();
        $save->setUser($user);
        $save->setArticle($article);
        $save->setDate_Save(new \DateTime());
        $em = $this->getDoctrine()->getManager();
        $em->persist($save);
        $em->flush();
        return $this->render('@News/Article/front/article.html.twig', array(
            'article'=>$article
        ));
    }

    public function showBookmarksAction() {
        $articles=$this->getDoctrine()->getRepository(Saved::class)->findSavedByUserId($this->getUser()->getId());
        $domains=$this->getDoctrine()->getRepository(Domain::class)->findAll();
        return $this->render('@News/Article/front/show.html.twig', array(
            'articles'=>$articles,
            'domains'=>$domains,
            'bookmark'=>1
        ));
    }

    public function searchFrontBookmarkAction(Request $request) {
        $articles=$this->getDoctrine()->getRepository(Article::class)->findAll();
        if($request->isMethod('post')) {
            $domain=$request->get('domain');
            $orderBy=$request->get('orderBy');
            $keyword=$request->get('keyword');
            $articles=$this->getDoctrine()->getRepository(Saved::class)->findByDomainKeywordAndOrderBy($domain, $keyword, $orderBy, $this->getUser()->getId());
        }
        $domains = $this->getDoctrine()->getRepository(Domain::class)->findAll();
        return $this->render('@News/Article/front/show.html.twig', array(
            'articles'=>$articles,
            'domains'=>$domains
        ));
    }

    public function removeBookmarkAction(Request $request, $id){
        $saved=$this->getDoctrine()->getRepository(Saved::class)->IAddedItBeforeObj($id, $this->getUser()->getId());
        $em = $this->getDoctrine()->getManager();
        $em->remove(current($saved));
        $em->flush();
        $article=$this->getDoctrine()->getRepository(Article::class)->find($id);
        $addToBookmark=$this->getDoctrine()->getRepository(Saved::class)->IAddedItBefore($id, $this->getUser()->getId());
        return $this->render('@News/Article/front/article.html.twig', array(
            'article'=>$article,
            'added'=>$addToBookmark[0]
        ));
    }
}
