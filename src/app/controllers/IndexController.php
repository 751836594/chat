<?php
use tools\Demo;
class IndexController extends ControllerBase
{

    public function indexAction()
    {
        echo Demo::instance()->a();
        exit();
    }

}

