<?php

namespace CommentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TechEventBundle\Entity\Comment;
use TechEventBundle\Entity\Event;
use Ob\HighchartsBundle\Highcharts\Highchart;

class GrapheController extends Controller
{

    public function statAction(){
        $allevents=$event=$this->getDoctrine()->getRepository(Event::class)->findAll();
        $array=array();
        $index=0;
        foreach ( $allevents as $ev) {
            $myevent = $this->getDoctrine()->getRepository(Event::class)->find($ev);
            $comment = $this->getDoctrine()->getRepository(Comment::class)->findByEvent($myevent);

            $array[$index]=sizeof($comment);
            $index++;
        }
        $series = array(
            array("name" => "number of comments According to the Events", "data" => $array)
        );
        $ob = new Highchart();
        $ob->chart->renderTo('linechart'); // #id du div où afficher le graphe
        $ob->title->text('Statistic Comment Graph');
        $ob->xAxis->title(array('text' => "Events "));
        $ob->yAxis->title(array('text' => "Comments "));
        $ob->series($series);
        return $this->render('@Comment/Graphe/graphe.html.twig', array(
            'chart' => $ob
        ));
    }



}
