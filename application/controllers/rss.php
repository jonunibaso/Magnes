<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rss extends CI_Controller {

    function index()
    {//Constructor

    }

    function feed()
    {

        $this->load->model('release_model');
        $datos['posts'] = $this->release_model->get_last_entries(20,0);


        $datos['titulo'] = 'The Magnes RSS Feed: Direct Download Best Releases';
        $datos['feed_url'] = base_url().'rss';
        $datos['description'] = 'The Magnes is a FREE open community for music sharing by direct downloads.';
        $fecha = $datos['posts'][0];

        list($date, $time) = explode(' ', $fecha->insertedDate);
        list($year, $month, $day) = explode('-', $date);
        list($hour, $minute, $second) = explode(':', $time);

        $timestamp = mktime($hour, $minute, $second, $month, $day, $year);
        $fecha =  date('r', $timestamp);

        $datos['pubdate']= $fecha;

        $this->load->view('feed', $datos);
    }
}
?>
