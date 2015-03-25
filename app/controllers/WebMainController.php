<?php

class WebMainController extends \BaseController {
    public function index(){
        return View::make('website.index');
    }
}
