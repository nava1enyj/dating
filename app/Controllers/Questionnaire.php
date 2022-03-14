<?php

namespace App\Controllers;
use App\Services\ValidationCheck;

class Questionnaire
{

    public function addQuestionnaire($data){

        $errorFields = [];
        $hobbies = $data['hobbies'];
        $about = ValidationCheck::protectionAgainstXss($data['about']);
        $search = ValidationCheck::protectionAgainstXss($data['id']);





        if($about === '' || strlen($about) < 2){
            $errorFields[] =  'about';
        }

        if(empty($hobbies)){
            $errorFields[] =  'inter';
        }


        if(!empty($errorFields)){
            $response = [

                'status' => false,
                'type' => 1, //валидация плохая
                'massage' => 'УПС! Проверьте правильность полей',
                'fields' => $errorFields

            ];

            echo json_encode($response);


            die();
        }

        $questionnaireUpd = \R::findOne('questionnaire' , 'iduser = ?', [$_SESSION['user']['id']]);


        if($questionnaireUpd){
            $questionnaireUpd->hobby = $hobbies;
            $questionnaireUpd->about = $about;
            $questionnaireUpd->search = $search;
            \R::store($questionnaireUpd);
        }
        else{
            $questionnaire = \R::dispense('questionnaire');

            $questionnaire->iduser = $_SESSION['user']['id'];
            $questionnaire->hobby = $hobbies;
            $questionnaire->about = $about;
            $questionnaire->search = $search;
            \R::store($questionnaire);

        }
        $response = [
            'status' => true
        ];

        echo json_encode($response);

        die();


    }

}