<?php


namespace app\core;


class View
{
    function generate($content_view, $template_view, $data = null)
    {
        include 'app/templates/'.$template_view;
    }
}