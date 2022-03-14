<?php

use App\Services\Router;
use App\Controllers\Auth;
use App\Controllers\Questionnaire;

Router::page('/login' , 'login');
Router::page('/register' , 'register');
Router::page('/' , 'home');
Router::page('/profile' , 'profile');
Router::page('/relationship' , 'relationship');
Router::page('/aboutus' , 'aboutus');
Router::page('/successabout' , 'successabout');

Router::post('/auth/register' , Auth::class , 'register' , true, true);
Router::post('/auth/login' , Auth::class , 'login' , true);
Router::post('/auth/logout' , Auth::class , 'logout');
Router::post('/send/addQuestionnaire' , Questionnaire::class , 'addQuestionnaire', true);





Router::enable();