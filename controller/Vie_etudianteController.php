<?php
class Vie_etudianteController extends Controller{

    function index(){
        $this->loadModel('Vie_etudiante');
    }

    function  service_rendu(){
        $this->loadModel('Vie_etudiante');
    }
}