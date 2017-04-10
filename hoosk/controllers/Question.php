<?php

class Question extends MY_Controller {

    protected $answerType;
    protected $questionsTable;
    protected $answersTable;
    protected $listingsTable;
    protected $questionListingTable;

    function __construct()
    {
        parent::__construct();

        define("HOOSK_ADMIN",1);

        //Load the Helpers
        $this->load->helper(array('admincontrol', 'url', 'hoosk_admin'));

        //Loading Libraries
        $this->load->library('form_validation');
        $this->questionsTable = 'esic_questions';
        $this->answersTable = 'esic_questions_answers';
        $this->listingsTable = 'esic_listings';
        $this->questionListingTable = 'esic_questions_listings';


        //Check if the user is Logged In or Not.
        Admincontrol_helper::is_logged_in($this->session->userdata('userName'));

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

            $listingIDs = $this->input->post('listing_id');

            $PTable = 'esic_questions Q';

            $selectData = array(
                '
                    `Q`.`id` AS QuestionID,
                    `Question`,
                    `T`.`name` as answerType,
                    `Solution` as Solution,
                    `isPublished` as Active,
                    GROUP_CONCAT(CONCAT(\'<span class="label label-info my-color">\',`L`.`listName`,\'</span>\') SEPARATOR " ") as AssignedTo
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
                    <a href="#" data-target=".delete-modal" data-toggle="modal"><i class="fa fa-trash-o"></i></a>',
                    'QuestionID'
                )
            );
            $groupBy = 'Q.id';

            if(!empty($listingIDs) and $listingIDs !== 'null'){
                $where = 'L.id IN ('.$listingIDs.')';
            }

            $returnedData = $this->Common_model->select_fields_joined_DT($selectData,$PTable,$joins,$where,'','',$groupBy,$addColumns);
            print_r($returnedData);
            return true;
        }


        $this->data['listings'] = $this->_getListings();

        $this->show_admin("admin/questions/list",$this->data);
    }


    //Create New Question.
    public function create(){
        $this->data['title'] = 'New Question';

        $this->data['answer_types'] = $this->_getAnswerTypes();
        $this->data['listings'] = $this->_getListings();

        $this->show_admin("admin/questions/create",$this->data);
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
            Question,
            A.type as AnswerType
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

        $this->data['answer_types'] = $this->_getAnswerTypes();

        $this->data['listings'] = $this->_getListings();

        //Get All the Listings for the selectedQuestion.
        //Get all the Listing Types
        $selectDataQuestionListings= [
            '
            id, question_id, listing_id
            ',
            false
        ];
        $whereQuestion = ['question_id' => $questionID];

        $this->data['questionListings'] = $this->Common_model->select_fields_where($this->questionListingTable,$selectDataQuestionListings,$whereQuestion,false,'','','','','',true);

        //Load the View
        $this->data['title'] = 'Edit Question';
        $this->show_admin("admin/questions/edit",$this->data);
    }

    public function update(){

        $success = false;

        //What we need in update is.
        $questionID = $this->input->post('hiddenQuestionID');
        $question = $this->input->post('question');
        $assignedRoles = $this->input->post('roleAssigned');
        $answerType = $this->input->post('answerType');


        $whereQuestion = ['id' => $questionID];
        $updateData = array(
            'Question' => $question
        );
        //Update the Question its self before moving the assigning question to listings..
        $boolResult = $this->Common_model->update($this->questionsTable,$whereQuestion,$updateData);

        if($boolResult === true){
            $success = true;
        }

        //First We Need to Check if Roles has Already Been Assigned, If Not then just Assign Them.
        $selectData = [
            'id, question_id, listing_id',
            false
        ];

        $where = ['question_id'=>$questionID];
        $params = [
            $this->questionListingTable,
            $selectData,
            $where,
            false,
            '',
            '',
            '',
            '',
            '',
            true
        ];
        $listings = $this->Common_model->select_fields_where(...$params);
        if(!empty($listings) and is_array($listings)){
            $this->db->trans_start();
            $listingIDs = array_column($listings,'listing_id');


            //To Remove items which are not necessary.
            $toRemoveFromDBArray = array_diff($listingIDs,$assignedRoles);
            if(!empty($toRemoveFromDBArray)){
                $toRemoveFromDBIDs = implode(',',$toRemoveFromDBArray);
                $whereDelete='question_id = '.$questionID.' AND listing_id IN ('.$toRemoveFromDBIDs.')';
                $this->Common_model->delete($this->questionListingTable,$whereDelete);
            }

            //we need only values that are not currently present in database, and we need to add them
            $toAddInDBArray = array_diff($assignedRoles,$listingIDs);
            if(!empty($toAddInDBArray)){
                foreach($toAddInDBArray as $item){
                    $arrayToInsert = [
                        'question_id' => $questionID,
                        'listing_id' => $item
                    ];
                    $this->Common_model->insert_record($this->questionListingTable,$arrayToInsert);
                }
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE)
            {
               //Perform SomeThing.
                $success = false;
            }
        }else{
            //Listing returned is Empty, Means We Need to do the new insertions..
            //So Just Do the Insertions.
            $this->db->trans_start();
            foreach($assignedRoles as $assignedRole){
                $arrayToInsert = [
                    'question_id' => $questionID,
                    'listing_id' => $assignedRole
                ];
                $this->Common_model->insert_record($this->questionListingTable,$arrayToInsert);
            }//End of foreach
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE)
            {
                //Perform SomeThing on Failure.
                $success = false;
            }
        }

        //Lets Also Update the Type in Questions Answers Table if type is of specific.
        if(!empty($answerType) and is_numeric($answerType)){
            //First check if this answer type exists in database.
            $whereSelect = ['questionID' => $questionID];
            $result = $this->Common_model->select_fields_where($this->answersTable,['COUNT(1) as TotalFound, id', false],$whereSelect,true);

            if(intval($result->TotalFound) === 0){
                //This Means The Answer Exist for the Question, We Only Need to Update Rather Than Insert.
                $insertData = [
                    'questionID' => $questionID,
                    'type' => $answerType
                ];
                $result = $this->Common_model->insert_record($this->answersTable,$insertData);
                if($result > 0){
                    $success = true;
                }else{
                    $success = false;
                }
            }elseif(intval($result->TotalFound) > 0){
                $updateData = [
                    'type' => $answerType
                ];
                $whereUpdateData = [
                    'id' => $result->id
                ];
                $result = $this->Common_model->update($this->answersTable,$whereUpdateData,$updateData);
                if($result === true){
                    $success = true;
                }elseif($result['code'] == 0){
                    $success = true;
                }else{
                    $success = false;
                }
            }//End of Elseif
        }//End of Main If Statment.

        if($success === true){
            $this->session->set_flashdata('notification','OK::Record Successfully Updated::success');
        }else{
            $this->session->set_flashdata('notification','FAIL::Record could not be updated::error');
        }
        //After Everything. Just return the user back to the listings.
        redirect('admin/questions/index');

    }//End of update() function

    public function update_question_roles(){

        $questionID = $this->input->post('qID');
        $assignedRoles = $this->input->post('roles');
        $success = false;

        if(empty($questionID) || !is_numeric($questionID)){
            echo 'FAIL::Please Add the Question Before Assigning the Roles to Question.::error';
            return false;
        }


        //First We Need to Check if Roles has Already Been Assigned, If Not then just Assign Them.
        $selectData = [
            'id, question_id, listing_id',
            false
        ];

        $where = ['question_id'=>$questionID];
        $params = [
            $this->questionListingTable,
            $selectData,
            $where,
            false,
            '',
            '',
            '',
            '',
            '',
            true
        ];
        $listings = $this->Common_model->select_fields_where(...$params);
        if(!empty($listings) and is_array($listings)){
            $this->db->trans_start();
            $listingIDs = array_column($listings,'listing_id');

            //To Remove items which are not necessary.
            $toRemoveFromDBArray = array_diff($listingIDs,$assignedRoles);
            if(!empty($toRemoveFromDBArray)){
                $toRemoveFromDBIDs = implode(',',$toRemoveFromDBArray);
                $whereDelete='question_id = '.$questionID.' AND listing_id IN ('.$toRemoveFromDBIDs.')';
                $this->Common_model->delete($this->questionListingTable,$whereDelete);
            }

            //we need only values that are not currently present in database, and we need to add them
            $toAddInDBArray = array_diff($assignedRoles,$listingIDs);
            if(!empty($toAddInDBArray)){
                foreach($toAddInDBArray as $item){
                    $arrayToInsert = [
                        'question_id' => $questionID,
                        'listing_id' => $item
                    ];
                    $this->Common_model->insert_record($this->questionListingTable,$arrayToInsert);
                }
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE)
            {
                //Perform SomeThing.
                $success = false;
            }else{
                $success = true;
            }
        }else{
            //Listing returned is Empty, Means We Need to do the new insertions..
            //So Just Do the Insertions.
            $this->db->trans_start();
            foreach($assignedRoles as $assignedRole){
                $arrayToInsert = [
                    'question_id' => $questionID,
                    'listing_id' => $assignedRole
                ];
                $this->Common_model->insert_record($this->questionListingTable,$arrayToInsert);
            }//End of foreach
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE)
            {
                //Perform SomeThing on Failure.
                $success = false;
            }else{
                $success = true;
            }
        }

        if($success === true){
            echo 'OK::Record Successfully Updated::success';
        }else{
            echo 'FAIL::Record could not be updated::error';
        }
    }

    public function update_answer_types()
    {
        $questionID = $this->input->post('qID');
        $answerType = $this->input->post('type');

        if(empty($questionID) || !is_numeric($questionID)){
            return false;
        }

        if(empty($answerType) || !is_numeric($answerType)){
            return false;
        }

        $where = ['questionID' => $questionID];
        //First Check if any record for this question exist in answers table.
        $result = $this->Common_model->select_fields_where($this->answersTable, ['COUNT(1) as TotalFound',false],$where,true);

        if(intval($result->TotalFound) === 0){
            //Do the Insertions
            $insertData = [
                'type' => $answerType,
                'questionID' => $questionID
            ];
            $lastID = $this->Common_model->insert_record($this->answersTable,$insertData);
            if($lastID > 0){
                echo 'OK::Answer Type Successfully added for the question::success';
            }else{
                echo 'OK::Could not add the Answer Type for this question::success';
            }
        }else{
            //Do the Update.
            $whereUpdate = [
                'questionID' => $questionID
            ];

            $updateData = [
                'type' => $answerType
            ];

            $boolResult = $this->Common_model->update($this->answersTable,$whereUpdate,$updateData);
            if($boolResult === true){
                echo 'OK::Answer Type successfully updated::success';
            }else{
                echo 'FAIL::Answer Type could not be updated::error';
            }
        }//End of Else Statement
        return;
    }

    public function store(){
        $question = $this->input->post('question');
        $questionID = $this->input->post('qID');

        //question
        if(empty($question)){
            return false;
        }



        $insertData = [
            'Question' => $question,
            'isPublished' => 1
        ];

        if(empty($questionID)){
            $insertID = $this->Common_model->insert_record('esic_questions',$insertData);
            if($insertID > 0){
                echo 'OK::Record Successfully Added::success::'.$insertID;
            }else{
                echo 'FAIL::Could not add new record::error';
            }
        }
        else{
            $whereQuestion = [
                'id' => $questionID
            ];
            $updateData = [
                'Question' => $question
            ];
            $result = $this->Common_model->update('esic_questions',$whereQuestion,$updateData);
            if($result === true){
                echo 'OK::Record Successfully Updated::success';
            }else{
                echo 'FAIL::Could not update the question::error';
            }
        }
    }

    public function trashQuestion(){
        $questionID = $this->input->post('qID');
        if(empty($questionID) and !is_numeric($questionID)){
            return false;
        }

        $this->db->trans_start();

        //Delete in QuestionsTable
        $whereDeleteQuestion = ['id' => $questionID];
        $this->Common_model->delete($this->questionsTable,$whereDeleteQuestion);

        //Delete the Answer for this Question.
        $whereDeleteAnswer = ['questionID' => $questionID];
        $this->Common_model->delete($this->answersTable,$whereDeleteAnswer);

        //Delete the Assigned Listings for this Question.
        $whereDeleteQuestionListings = ['question_id' => $questionID];
        $this->Common_model->delete($this->questionListingTable,$whereDeleteQuestionListings);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE){
            echo 'FAIL::Could Not Remove the Question::error';
        }else{
            echo 'OK::Successfully Removed the Question::success';
        }
    }

    public function fetchAnswerTemplate(){
        //if its not an ajax request, means someone is messing with my app, and he/she does not need to get any response.
        if(!$this->input->is_ajax_request()){
            return false;
        }

        //Lets Fetch Some Records
        $layout = $this->input->post('layout');

        //This will depend, if a question id has been provided. will look for existing answers for this. if not. then :(
        $questionID = $this->input->post('qID');

        if(empty($layout) || !is_numeric($layout)){
            return false;
        }

        if(empty($questionID) || !is_numeric($questionID)){
            return false;
        }

        // 1. Checkbox, 2. SelectBox, 3.Radio Buttons
        $layoutPath= '';

        switch ($layout){
            case 1:
                $layoutPath = 'admin/questions/templates/checkbox.php';
                break;
            case 2:
                $layoutPath = 'admin/questions/templates/select.php';
                break;
            case 3:
                $layoutPath = 'admin/questions/templates/radio.php';
                break;
            case 4:
                $layoutPath = 'admin/questions/templates/textbox.php';
                break;
            case 5:
                $layoutPath = 'admin/questions/templates/textarea.php';
                break;
            default:
                $layoutPath;
        }//End of switch

        $data = [];


            //Lets Fetch the Answer for that question.
            $selectData = [
                '   
                    id,
                    Solution,
                    type
                ',
                false
            ];

            $where = [

                'type' => $layout,
                'questionID' => $questionID

            ];

            //Fetch the Record if Exist
            $data['Solution'] = $this->Common_model->select_fields_where('esic_questions_answers',$selectData, $where,true);
            $data['question_ID'] = $questionID;

        //Load the view and pass data to the view.
        $this->load->view($layoutPath,$data);


    }

    public function updateAnswer_radio(){
        //To Update answer in to an existing one, we first need to fetch an existing answer.
        $questionID = $this->input->post('q');
        $radioValue = $this->input->post('v');
        $radioText = $this->input->post('t');
        $radioID = $this->input->post('rID');

        $answersTable = 'esic_questions_answers';
        $this->answerType = 3;

        //Lets Fetch the Answer for that question.
        $selectData = [
            '
            id,
            Solution,
            type as SolutionType
            ',
            false
        ];

        $where = [
            'questionID' => $questionID
        ];

        //Fetch the Record if Exist
        $result = $this->Common_model->select_fields_where($answersTable,$selectData, $where,true);
        if(!empty($result) and !empty($result->Solution)){
            // This means we have the record, we need to know if we can update the record partially, or fully.
            if(intval($result->SolutionType) === $this->answerType){
                //We have to to partial Update.
                $solutionData = json_decode($result->Solution,true);
                $arrayToPush = [
                    'id' => $radioID,
                    'value' => $radioValue,
                    'text' => $radioText,
                    'dateAdded' => date('Y-m-d H:i:s')
                ];
                //Add Date Updated also to the solution Data Updated row.
                $solutionData['dataUpdated'] = date('Y-m-d H:i:s');
                //Finally Push it to the Array.
                array_push($solutionData['data'],$arrayToPush);
                //Finally Just Encode Data back.
                $solutionDataJSON = json_encode($solutionData);
            }//End of If Statement
            else{
                //We have to do Full Solution Update
                $solutionData = [
                    'type' => 'radios',
                    'hasChildren' => 0,
                    'dateAdded' => date('Y-m-d H:i:s'),
                    'data' => [
                        [
                            'id' => $radioID,
                            'value' => $radioValue,
                            'text' => $radioText,
                            'dateAdded' => date('Y-m-d H:i:s')
                        ]
                    ]
                ];

                $solutionDataJSON = json_encode($solutionData);
            }//End of Else Statement


            $whereUpdate = [
                'questionID' => $questionID
            ];
            $updateData = [
                'Solution' => $solutionDataJSON
            ];
            //Now just run an update query to the database.
           $result =  $this->Common_model->update($answersTable,$whereUpdate,$updateData);

           if($result === true){
               echo 'OK::Record Successfully Updated::success';
           }else{
               if($result['code'] === 0){
                   echo 'FAIL::Record with same details Already Exists::error';
               }else{
                   echo 'FAIL::Record Could Not Be Updated.::error';
               }
           }

           return true;
        }//End of Main If Statement for Update.
        else{
            //Need to Create a New Answer Record for the Question.
            $solutionData = [
                'type' => 'radios',
                'hasChildren' => 0,
                'dateAdded' => date('Y-m-d H:i:s'),
                'data' => [
                    [
                        'id' => $radioID,
                        'value' => $radioValue,
                        'text' => $radioText,
                        'dateAdded' => date('Y-m-d H:i:s')
                    ]
                ]
            ];

            $solutionDataJSON = json_encode($solutionData);

            $insertData = [
                'questionID' => $questionID,
                'Solution' => $solutionDataJSON,
                'type' => $this->answerType
            ];

            $result = $this->Common_model->insert_record($answersTable,$insertData);
            if($result > 0){
                //Means we are getting the Inserted ID and Insert was Successful.
                echo 'OK::Record Successfully Added::success::Success::'.$result;
            }else{
                echo 'FAIL::Fail to Insert New Record, Please for further assistance contact the system administrator.::error::FAIL Insertion';
            }
            exit;
        }
    }
    public function updateAnswer_removeRadio(){
        if(!$this->input->is_ajax_request()){
            return false;
        }

        $questionID = $this->input->post('qID');
        $radioID = $this->input->post('rID');
        $answersTable = 'esic_questions_answers';
        $radioArr = explode('_',$radioID);
        $radioKey = end($radioArr);

        $selectData = [
            'id,Solution',
            false
        ];

        $where = [
            'questionID' => $questionID
        ];

        //Fetch the Record if Exist
        $result = $this->Common_model->select_fields_where($answersTable,$selectData, $where,true);
        $Solution = json_decode($result->Solution,true);

        foreach($Solution['data'] as $key=>$value){
            if($value['id'] === $radioID){
                unset($Solution['data'][$key]);
            }
        }

        $result = $this->_updateSolution(json_encode($Solution),$result->id);

        if($result === true){
            echo 'OK::Radio Successfully Trashed::success::TRASHED';
        }else{
            if($result['code'] === 0){
                echo 'OK::Record Already Trashed::warning';
            }else{
                echo 'FAIL::Radio Could Not Be Trashed::error::TRASH FAILED';
            }
        }
    }

    public function updateAnswer_checkbox(){
        //To Update answer in to an existing one, we first need to fetch an existing answer.
        $questionID = $this->input->post('q');
        $checkboxName = $this->input->post('n');
        $checkboxText = $this->input->post('t');
        $checkboxID = $this->input->post('cID');

        $this->answerType = 1;

        //Lets Fetch the Answer for that question.
        $selectData = [
            '
            id,
            Solution,
            type as SolutionType
            ',
            false
        ];

        $where = [
            'questionID' => $questionID
        ];

        //Fetch the Record if Exist
        $result = $this->Common_model->select_fields_where($this->answersTable,$selectData, $where,true);


        if(!empty($result) and !empty($result->Solution)){
            // This means we have the record, we need to know if we can update the record partially, or fully.
            if(intval($result->SolutionType) === $this->answerType){
                //We have to to partial Update.
                $solutionData = json_decode($result->Solution,true);
                $arrayToPush = [
                    'id' => $checkboxID,
                    'name' => $checkboxName,
                    'text' => $checkboxText,
                    'dateAdded' => date('Y-m-d H:i:s')
                ];
                //Add Date Updated also to the solution Data Updated row.
                $solutionData['dataUpdated'] = date('Y-m-d H:i:s');
                //Finally Push it to the Array.
                array_push($solutionData['data'],$arrayToPush);
                //Finally Just Encode Data back.
                $solutionDataJSON = json_encode($solutionData);
            }//End of If Statement
            else{
                //We have to do Full Solution Update
                $solutionData = [
                    'type' => 'CheckBoxes',
                    'hasChildren' => 0,
                    'dateAdded' => date('Y-m-d H:i:s'),
                    'data' => [
                        [
                            'id' => $checkboxID,
                            'name' => $checkboxName,
                            'text' => $checkboxText,
                            'dateAdded' => date('Y-m-d H:i:s')
                        ]
                    ]
                ];

                $solutionDataJSON = json_encode($solutionData);
            }//End of Else Statement


            $whereUpdate = [
                'questionID' => $questionID
            ];
            $updateData = [
                'Solution' => $solutionDataJSON
            ];
            //Now just run an update query to the database.
            $result =  $this->Common_model->update($this->answersTable,$whereUpdate,$updateData);

            if($result === true){
                echo 'OK::Record Successfully Updated::success';
            }else{
                if($result['code'] === 0){
                    echo 'FAIL::Record with same details Already Exists::error';
                }else{
                    echo 'FAIL::Record Could Not Be Updated.::error';
                }
            }

            return true;
        }//End of Main If Statement for Update.
        else{
            //Need to Create a New Answer Record for the Question.
            $solutionData = [
                'type' => 'CheckBoxes',
                'hasChildren' => 0,
                'dateAdded' => date('Y-m-d H:i:s'),
                'data' => [
                    [
                        'id' => $checkboxID,
                        'name' => $checkboxName,
                        'text' => $checkboxText,
                        'dateAdded' => date('Y-m-d H:i:s')
                    ]
                ]
            ];

            $solutionDataJSON = json_encode($solutionData);

            $insertData = [
                'questionID' => $questionID,
                'Solution' => $solutionDataJSON,
                'type' => $this->answerType
            ];

            $result = $this->Common_model->insert_record($this->answersTable,$insertData);
            if($result > 0){
                //Means we are getting the Inserted ID and Insert was Successful.
                echo 'OK::Record Successfully Added::success::Success::'.$result;
            }else{
                echo 'FAIL::Fail to Insert New Record, Please for further assistance contact the system administrator.::error::FAIL Insertion';
            }
            exit;
        }//End of Else Statement
    } //End of Function
    public function updateAnswer_removeCheckbox(){
        if(!$this->input->is_ajax_request()){
            return false;
        }

        $questionID = $this->input->post('qID');
        $checkboxID = $this->input->post('cID');
        $radioArr = explode('_',$checkboxID);
        $radioKey = end($radioArr);

        $selectData = [
            'id,Solution',
            false
        ];

        $where = [
            'questionID' => $questionID
        ];

        //Fetch the Record if Exist
        $result = $this->Common_model->select_fields_where($this->answersTable,$selectData, $where,true);
        $Solution = json_decode($result->Solution,true);

        foreach($Solution['data'] as $key=>$value){
            if($value['id'] === $checkboxID){
                unset($Solution['data'][$key]);
            }
        }

        $result = $this->_updateSolution(json_encode($Solution),$result->id);

        if($result === true){
            echo 'OK::Radio Successfully Trashed::success::TRASHED';
        }else{
            if($result['code'] === 0){
                echo 'OK::Record Already Trashed::warning';
            }else{
                echo 'FAIL::Radio Could Not Be Trashed::error::TRASH FAILED';
            }
        }
    }

    private function _updateSolution($solution,$id){
        $whereUpdate = [
            'id' => $id
        ];
        $updateData = [
            'Solution' => $solution
        ];
        $result = $this->Common_model->update($this->answersTable,$whereUpdate,$updateData);
        return $result;
    }
    private function _getListings(){

        $givenArguments = func_get_args(); //Can be used later for further Queries.

        //Get all the Listing Types
        $selectDataAnswerType= [
            '
            id, listName, tableName
          ',
            false
        ];
        $whereAnswerType = ['isActive' => 1];

        return $this->Common_model->select_fields_where($this->listingsTable,$selectDataAnswerType,$whereAnswerType);
    }
    private function _getAnswerTypes(){
        //Get all the Answer Types.
        $selectDataAnswerType= [
            '
            id, name
            ',
            false
        ];
        $whereAnswerType = ['isTrashed' => 0];
        return $this->Common_model->select_fields_where('esic_question_types',$selectDataAnswerType,$whereAnswerType);
    }
}
