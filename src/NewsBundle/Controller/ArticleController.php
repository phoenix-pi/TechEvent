<?php

namespace NewsBundle\Controller;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use TechEventBundle\Entity\Article;
use TechEventBundle\Entity\Domain;
use TechEventBundle\Entity\Saved;

class ArticleController extends Controller
{
    public function addAction(Request $request)
    {
        $article = new Article();
        $form = $this->createFormBuilder($article)
            ->add('titleArticle', TextType::class)
            ->add('ContentArticle', TextareaType::class)
            ->add('image', FileType::class)
            ->add('domain', EntityType::class, array(
                'class'=>'TechEventBundle:Domain',
                'choice_label'=>'name_domain',
                'multiple'=>false
            ))
            ->add('save', SubmitType::class, ['label' => 'Submit'])
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $article->getImage();
            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
            try {
                $file->move($this->getParameter('uploads_directory'), $fileName);
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }
            $article->setViewsNumber(0);
            $article->setDateOfPublish(new \DateTime());
            $article->setImage($fileName);
            $em=$this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();
            return $this->render('@News/Article/article.html.twig', array(
                'article'=>$article
            ));
        }

        return $this->render('@News/Article/add.html.twig', [
            'form' => $form->createView(),
        ]);

    }


    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }


    public function showAction() {
        $Allarticles=$this->getDoctrine()->getRepository(Article::class)->findAll();
        $Allarticles=array_reverse($Allarticles);
        $Alldomains=$this->getDoctrine()->getRepository(Domain::class)->findAll();
        return $this->render('@News/Article/show.html.twig', array(
            'articles'=>$Allarticles,
            'domains'=>$Alldomains
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
        $article=$this->getDoctrine()->getRepository(Article::class)->find($id);
        $article->setImage(new File($this->getParameter('uploads_directory').'/'.$article->getImage()));
        $form = $this->createFormBuilder($article)
            ->add('titleArticle', TextType::class)
            ->add('ContentArticle', TextareaType::class)
            ->add('image', FileType::class)
            ->add('domain', EntityType::class, array(
                'class'=>'TechEventBundle:Domain',
                'choice_label'=>'name_domain',
                'multiple'=>false
            ))
            ->add('save', SubmitType::class, ['label' => 'Update'])
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $article->getImage();
            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
            try {
                $file->move($this->getParameter('uploads_directory'), $fileName);
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }
            $article->setViewsNumber(0);
            $article->setDateOfPublish(new \DateTime());
            $article->setImage($fileName);
            $em=$this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();
            return $this->render('@News/Article/article.html.twig', array(
                'article'=>$article
            ));
        }

        return $this->render('@News/Article/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function searchAction(Request $request) {
        $articles=$this->getDoctrine()->getRepository(Article::class)->findAll();
        if($request->isMethod('post')) {
            $domain=$request->get('domain');
            $orderBy=$request->get('orderBy');
            $keyword=$request->get('keyword');
            $articles=$this->getDoctrine()->getRepository(Article::class)->findByDomainKeywordAndOrderBy($domain, $keyword, $orderBy);
        }
        $domains = $this->getDoctrine()->getRepository(Domain::class)->findAll();
        return $this->render('@News/Article/show.html.twig', array(
            'articles'=>$articles,
            'domains'=>$domains
        ));

    }

    public function showfrontAction() {
        $articles=$this->getDoctrine()->getRepository(Article::class)->findAll();
        $articles=array_reverse($articles);
        $domains=$this->getDoctrine()->getRepository(Domain::class)->findAll();
        return $this->render('@News/Article/front/show.html.twig', array(
            'articles'=>$articles,
            'domains'=>$domains
        ));
    }

    public function showOneFrontAction($id) {
        $article=$this->getDoctrine()->getRepository(Article::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $article->setViewsNumber($article->getViewsNumber()+1);
        $addToBookmark=array();
        if($this->getUser()) {
            $addToBookmark=$this->getDoctrine()->getRepository(Saved::class)->IAddedItBefore($id, $this->getUser()->getId());
        }
        $em->flush();
        return $this->render('@News/Article/front/article.html.twig', array(
            'article'=>$article,
            'added'=>sizeof($addToBookmark)
        ));
    }

    public function searchFrontAction(Request $request) {
        $articles=$this->getDoctrine()->getRepository(Article::class)->findAll();
        if($request->isMethod('post')) {
            $domain=$request->get('domain');
            $orderBy=$request->get('orderBy');
            $keyword=$request->get('keyword');
            $articles=$this->getDoctrine()->getRepository(Article::class)->findByDomainKeywordAndOrderBy($domain, $keyword, $orderBy);
        }
        $domains = $this->getDoctrine()->getRepository(Domain::class)->findAll();
        return $this->render('@News/Article/front/show.html.twig', array(
            'articles'=>$articles,
            'domains'=>$domains
        ));

    }
}
