<?php

use App\Services\Router;
use App\Controllers\Auth;
use App\Controllers\Questionnaire;

Router::page('/login' , 'login');
Router::page('/register' , 'register');
Router::page('/' , 'home');
Router::page('/profile' , 'profile');
Router::page('/relationship' , 'relationship');
Router::page('/chats' , 'chats');
Router::page('/successabout' , 'successabout');
Router::page('/chatsFrom' , 'chatsFrom');
Router::page('/chatsTo' , 'chatsTo');

Router::post('/auth/register' , Auth::class , 'register' , true, true);
Router::post('/auth/login' , Auth::class , 'login' , true);
Router::post('/auth/logout' , Auth::class , 'logout');
Router::post('/send/addQuestionnaire' , Questionnaire::class , 'addQuestionnaire', true);

Router::get('/chat' , 'chat' );



Router::enable();