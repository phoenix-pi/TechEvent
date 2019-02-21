<?php
/**
 * Created by PhpStorm.
 * User: mbare
 * Date: 2/20/2019
 * Time: 7:57 PM
 */

namespace ClubBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TechEventBundle\Entity\Theme;

class ThemeController extends Controller
{
    public function createAction(Request $request)
    {
        if($request->isMethod('POST')) {
            $theme = new Theme();
            $theme->setTheme_Name($request->get('name'));
            $em=$this->getDoctrine()->getManager();
            $em->persist($theme);
            $em->flush();
        }
        $themes = $this->getDoctrine()->getRepository(Theme::class)->findAll();
        return $this->render('@Club/Theme/CreateTheme.html.twig',array(
            'themes'=>$themes
        ));
    }
    public function deleteAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $theme_del=$em->getRepository(Theme::class)->find($id);
        if ($request->isMethod('POST')) {
            $em->remove($theme_del);
            $em->flush();
            return $this->redirectToRoute("Theme_create");
        }
        $theme = $this->getDoctrine()->getRepository(Theme::class)->findAll();
        return $this->render('@Club/Theme/CreateTheme.html.twig',array(
            'theme_del' => $theme_del,
            'themes'=>$theme
        ));
    }
    public function updateAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $theme_ed=$em->getRepository(Theme::class)->find($id);
        if ($request->isMethod('POST')) {
            $theme_ed->setTheme_Name($request->get('name'));
            $em->flush();
            return $this->redirectToRoute('Theme_create');
        }
$th = $this->getDoctrine()->getRepository(Theme::class)->findAll();
return $this->render('@Club/Theme/CreateTheme.html.twig',array(
    'theme_ed' => $theme_ed,
    'themes'=>$th
));
}


}