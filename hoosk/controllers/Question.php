<?php

class Question extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        //Loading Libraries
        $this->load->library('form_validation');
    }

    public function index($param = NULL){
        //Apparently i need to set the Page Title Custom as my page is custom, unless other wise.
        $this->data['title'] = 'Questions & Answers';

        $userRole = $this->session->userdata('userRole');

        //Three Modules Will Be Listed Down.
        // 1. Esic - user
        // 2. Investor - esic_investors
        // 3. Accelerators - esic_accelerators

        //Lets Load the Questions First.
        if($param == 'listing'){

            $PTable = 'esic_questions Q';

            $selectData = array(
                '
                    `Q`.`id` AS QuestionID,
                    `Question`,
                    GROUP_CONCAT(`Solution`) as Solution,
                    `isPublished` as Active,
                    GROUP_CONCAT(`L`.`listName`) as AssignedTo
                ',
                false
            );

            $joins = array(
                [
                    'table' => 'esic_questions_answers A',
                    'condition' => 'A.questionID = Q.id',
                    'type' => 'LEFT'
                ],
                [
                    'table' => 'esic_question_types T',
                    'condition' => 'T.id = A.type',
                    'type' => 'LEFT'
                ],
                [
                    'table' => 'esic_questions_listings QL',
                    'condition' => 'QL.question_id = Q.id',
                    'type' => 'LEFT'
                ],
                [
                    'table' => 'esic_listings L',
                    'condition' => 'L.id = QL.listing_id',
                    'type' => 'LEFT'
                ]
            );

            $addColumns = array(
                'ViewEditActionButtons' => array(
                    '<a href="'.base_url("admin/questions/edit/$1").'"><span aria-hidden="true" class="glyphicon glyphicon-edit text-green "></span></a> 
                    &nbsp; 
                    <a href="#" data-target=".approval-modal" data-toggle="modal"><i class="fa fa-check"></i></a>
                     &nbsp;
                    <a href="#" data-target=".delete-modal" data-toggle="modal"><i class="fa fa-trash-o"></i></a>',
                    'QuestionID'
                )
            );
            $groupBy = 'Q.id';
            $returnedData = $this->Common_model->select_fields_joined_DT($selectData,$PTable,$joins,'','','',$groupBy,$addColumns);
            print_r($returnedData);
            return true;
        }

        $this->show_admin("admin/questions/list",$this->data);
    }


    //Create New Question.
    public function create(){
        $this->data['title'] = 'New Question';
        $this->show_admin("admin/questions/create");
    }

    public function edit($questionID){

        //If Not defined Just Return False.
        if(!isset($questionID) || empty($questionID)){
            redirect(previousURL());
        }

        $PTable = 'esic_questions Q';
        //Get the Question.
        $selectData = array('
            Q.id AS QuestionID,
            Question
        ',false);

        $joins = [
            [
                'table' => 'esic_questions_answers A',
                'condition' => 'Q.id = A.questionID',
                'type' => 'LEFT'
            ]
        ];
        $where = ['Q.`id`' => $questionID];
        $this->data['question'] = $this->Common_model->select_fields_where_like_join($PTable,$selectData,$joins,$where,TRUE,'','','','','',false);


        //Get all the Answer Types.
        $selectDataAnswerType= [
          '
            id, name
          ',
          false
        ];

        $whereAnswerType = ['isTrashed' => 0];

        $this->data['answer_types'] = $this->Common_model->select_fields_where('esic_question_types',$selectDataAnswerType,$whereAnswerType);

        //Load the View
        $this->data['title'] = 'Edit Question';
        $this->show_admin("admin/questions/edit",$this->data);
    }

    public function update(){
        echo 'update Method Accessed.';
    }

    public function selectors(){

    }
}
