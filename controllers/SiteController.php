<?php

namespace controllers;

use core\Controller;
use core\Template;
use models\Event;
use models\News;

class SiteController extends Controller
{
    public function actionIndex()
    {
        $news = News::getAllNews();
        $events = Event::getAllEvents();
        return $this->render(null, ['news' => $news,'events' => $events]);
    }

}