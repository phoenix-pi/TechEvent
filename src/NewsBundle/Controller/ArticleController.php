<?php

namespace NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\DataUriNormalizer;
use TechEventBundle\Entity\Article;
use TechEventBundle\Entity\Domain;

class ArticleController extends Controller
{
    public function addAction(Request $request)
    {
        if ($request->isMethod('post')) {
            $article=new Article();
            $article->setTitle_Article($request->get('title'));
            $article->setContent_Article($request->get('content'));
            $article->setDomain($this->getDoctrine()->getRepository(Domain::class)->find($request->get('domain')));
            $article->setViews_Number(0);
            $article->setDate_Of_Publish(new \DateTime());
            $article->setImage($request->get('imageUpload'));
            $em=$this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();
            $article=$this->getDoctrine()->getRepository(Article::class)->find($article->getId_Article());
            return $this->render('@News/Article/article.html.twig', array(
                'article'=>$article
            ));

        }
        $domains = $this->getDoctrine()->getRepository(Domain::class)->findAll();
        return $this->render('@News/Article/add.html.twig', array(
            'domains'=>$domains
        ));
    }

    public function showAction() {
        $articles=$this->getDoctrine()->getRepository(Article::class)->findAll();
        $domains=$this->getDoctrine()->getRepository(Domain::class)->findAll();
        return $this->render('@News/Article/show.html.twig', array(
            'articles'=>$articles,
            'domains'=>$domains
        ));
    }

    public function showOneAction($id) {
        $article=$this->getDoctrine()->getRepository(Article::class)->find($id);
        return $this->render('@News/Article/article.html.twig', array(
            'article'=>$article
        ));
    }

    public function deleteAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $article_del=$em->getRepository(Article::class)->find($id);
        if ($request->isMethod('POST')) {
            $em->remove($article_del);
            $em->flush();
            return $this->redirectToRoute("news_article_show");
        }
        return $this->render('@News/Article/article.html.twig',array(
            'article' => $article_del,
            'confirm' => 1
        ));
    }

    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository(Article::class)->find($id);
        if ($request->isMethod('POST')) {
            $article->setTitle_Article($request->get('title'));
            $article->setContent_Article($request->get('content'));
            $article->setDomain($this->getDoctrine()->getRepository(Domain::class)->find($request->get('domain')));
            $article->setImage($request->get('imageUpload'));
            $em->flush();
            return $this->render('@News/Article/article.html.twig', array(
                'article'=>$article
            ));
        }
        $domains = $this->getDoctrine()->getRepository(Domain::class)->findAll();
        return $this->render('@News/Article/update.html.twig',array(
            'article' => $article,
            'domains'=>$domains
        ));
    }

    public function searchAction(Request $request) {
        $articles=$this->getDoctrine()->getRepository(Article::class)->findAll();
        if($request->isMethod('post')) {
            $domain=$request->get('domain');
            $orderBy=$request->get('orderBy');
            $keyword=$request->get('keyword');
            $articles=$this->getDoctrine()->getRepository(Article::class)->Search($domain, $keyword, $orderBy);
        }
        $domains = $this->getDoctrine()->getRepository(Domain::class)->findAll();
        return $this->render('@News/Article/show.html.twig', array(
            'articles'=>$articles,
            'domains'=>$domains
        ));

    }
}
