<?php

class Question extends MY_Controller {

    protected $answerType;
    protected $questionsTable;
    protected $answersTable;
    protected $listingsTable;
    protected $questionListingTable;
    protected $userAnswersTable;

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
        $this->userAnswersTable = 'esic_question_users_answers';
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
        if(!empty($result)){
            // This means we have the record, we need to know if we can update the record partially, or fully.
            if(intval($result->SolutionType) === $this->answerType && !empty($result->Solution)){
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


        if(!empty($result)){
            // This means we have the record, we need to know if we can update the record partially, or fully.
            if(intval($result->SolutionType) === $this->answerType && !empty($result->Solution)){
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

    public function update_selectBox(){
        $updateType = $this->input->post('type');
        $questionID = $this->input->post('qID');

        //First we need to check if answer for this question exist or not.
        $selectData= [
            'id, Solution, type',false
        ];
        $where = [
            'questionID' => $questionID
        ];

        $result = $this->Common_model->select_fields_where($this->answersTable,$selectData,$where,true);

        $newSolution=false;

        if(!empty($result) and $result->type == '2'){
            //Need to Fetch the Solution if the type also matches.
            $CurrentSolution = $result->Solution;
            if(empty($CurrentSolution)){
                $newSolution = true;
            }else{
                $solutionData =  json_decode($CurrentSolution,true);
                $solutionData['dateUpdated'] = date('Y-m-d');
                //Only if List Is being updated. Then remove the previous ones. as the new ones will be populated from the submitted data.
                if($updateType === 'list'){
                    unset($solutionData['data']);
                    $solutionData['data'] = []; //Empty the Previous Data, So that we can Add the New Data back again.
                }
            }
        }else{
                $newSolution = true;
        }

        if($newSolution === true){
            $solutionData = [
                'type' => 'SelectBox',
                'hasChildren' => 0,
                'dateAdded' => date('Y-m-d'),
                'data' => []
            ];
        }


        $success =false;

        switch ($updateType){
            case 'list':
                $selectItems = $this->input->post('items');
                foreach($selectItems as $item){
                    $itemToPush = [
//                        'value' => str_replace(' ','_',$item),
                        'value' => $item,
                        'text' => $item
                    ];
                    array_push($solutionData['data'],$itemToPush);
                }
                break;
            case 'text':
                $textBoxText = $this->input->post('text');
                if(isset($solutionData['textBoxText'])){
                    unset($solutionData['textBoxText']);
                }
                $solutionData['textBoxText'] = $textBoxText;
                break;
            case 'checkbox':
                $checkboxStatus = $this->input->post('isMulti');
                if(isset($solutionData['isMulti'])){
                    unset($solutionData['isMulti']);
                }
                $solutionData['isMulti'] = $checkboxStatus;
                break;
            default:
                $noUpdate=true;
                null;
        } //End of Switch Statement


        //Now Finally Update/Insert the Record
        if(empty($result) and !$noUpdate){
            $insertListData = [
                'questionID' => $questionID,
                'Solution' => json_encode($solutionData),
                'type' => 2
            ];

            $lastInsertedID = $this->Common_model->insert_record($this->answersTable,$insertListData);
            if($lastInsertedID > 0){
                $success = true;
            }
        }else{
            $updateListData=[
                'type' => 2,
                'Solution' => json_encode($solutionData)
            ];
            $whereUpdate = [
                'id' => $result->id
            ];

            $updateListData = $this->Common_model->update($this->answersTable,$whereUpdate,$updateListData);

            if($updateListData === true){
                $success = true;
            }
        }

        if($success === true){
            echo 'OK::Record Updated successfully::success';
        }else{
            echo 'FAIL::Record Could not be updated::error';
        }
        return;

    } //End of Update SelectBox Function

    public function update_textBox(){
        //First Lets get all the inputs.
//        $questionID = $this->input->post('qID');
        $textBoxID = $textBoxName = $this->input->post('textBoxID');
        $divID = $this->input->post('dID');
        $textBoxLabel = $this->input->post('value');
        $textBoxType = $this->input->post('type');

        if(empty($textBoxID) || empty($divID) || empty($textBoxType)){
            return false;
        }



        $explodedDivID = explode('_',$divID);
        $questionID = $explodedDivID[0];

        //First we need to find out if there is any solution to this question already exist or not.
        $selectData = ['id, Solution, `type`',false];
        $whereSelect =['questionID' => $questionID];
        $result = $this->Common_model->select_fields_where($this->answersTable,$selectData,$whereSelect,true);

        //TextBoxes Shall Not have the Children Option.
        $solutionNewJSON = [
            'type' => 'textBoxes',
            'dateAdded' => date('Y-m-d'),
            'data' => []
        ];


        $arrayToPush = [
            'dateAdded' => date('Y-m-d'),
            'divID' => $divID
        ];

        switch ($textBoxType){
            case 'labelTextBox':
                //Create or Update data for for label
                $arrayToPush[$textBoxType]['textBoxID'] = $textBoxID;
                $arrayToPush[$textBoxType]['textBoxName'] = $textBoxID;
                $arrayToPush[$textBoxType]['label'] = $textBoxLabel;
                break;
            case 'grid':
                $arrayToPush[$textBoxType]['textBoxID'] = $textBoxID;
                $arrayToPush[$textBoxType]['textBoxName'] = $textBoxID;
                $arrayToPush[$textBoxType]['grid_size'] = $textBoxLabel;
                break;
        }

        if(empty($result)){
            //just insert the data
            $total = array_push($solutionNewJSON['data'],$arrayToPush);
            if($total>0){

                $insertData = [
                    'Solution' => json_encode($solutionNewJSON),
                    'questionID' => $questionID,
                    'type' => 4
                ];

                //Now Just Do the Insertion.
                $lastInsertedID = $this->Common_model->insert_record($this->answersTable, $insertData);
                if($lastInsertedID > 0){
                    echo 'OK::Record Successfully Added::success';
                }else{
                    echo 'FAIL::Record Could not be Added::error';
                }
            }//End of If Statement.
        }else{
            $Solution = $result->Solution;

            //means $result is not Empty.
            //Then We Need to Know if we have to update the whole row or just the solution Column.
            if(intval($result->type) === 4 && !empty($Solution)){
                //Means We Only Need to Update.
                $Solution = json_decode($Solution,true);
                $SolutionData = $Solution['data'];
                if(isset($Solution['dateUpdated'])){
                    unset($Solution['dateUpdated']);
                }
                //Add the Date Updated
                $Solution['dateUpdated'] = date('Y-m-d');

                $arrayToUpdateAndPushAgain = [];
                $foundKey=false;
                foreach($SolutionData as $key=> $textBoxRow){
                    if(in_array($divID,$textBoxRow)){
                        $arrayToUpdateAndPushAgain = $SolutionData[$key];
                        $foundKey = $key;
                        unset($SolutionData[$key]);
                    }
                }

                if(is_numeric($foundKey)){
//                    echo 'i am inside';
                    //Means We have a new born to add..
                    //Unset the Old Previous Record.
                    if(array_key_exists($textBoxType,$arrayToUpdateAndPushAgain)){
                        unset($arrayToUpdateAndPushAgain[$textBoxType]);
                    }
                    //Unset the DateUpdated Also
                    if(array_key_exists('dateUpdated',$arrayToUpdateAndPushAgain)){
                        unset($arrayToUpdateAndPushAgain['dateUpdated']);
                    }
                    if(!empty($arrayToUpdateAndPushAgain)){
                        //Only Add Date Updated if we are updating, If new record is being added, then just we only need Date Added and that is already being given before.
                        $arrayToUpdateAndPushAgain['dateUpdated'] = date('Y-m-d');
                    }

                    //Finally Merge the Record
                    $mergedArrayToPush = array_merge($arrayToPush,$arrayToUpdateAndPushAgain);
//                    echo '<pre>';
//                    print_r($mergedArrayToPush);
//                    echo '</pre>';
                    //Add Back the Record to the Original Solution Data.
                    $SolutionData[intval($foundKey)] = $mergedArrayToPush;
                }else{
                    //We have to update the old child.
                    array_push($SolutionData,$arrayToPush);
                }

                //Well as now the Data has been Updated, Just Replace it with the Old One.
                if(isset($Solution['data'])){
                    unset($Solution['data']);
                }
                //Sort it Back..
                asort($SolutionData);
                $Solution['data'] = $SolutionData;

                //Just Run Update Query Here Also.
                $whereUpdate = ['id' => $result->id];
                $updateData = ['Solution' => json_encode($Solution)];
//                print_r($updateData);
                $boolResult = $this->Common_model->update($this->answersTable,$whereUpdate,$updateData);
                if($boolResult === true){
                    echo 'OK::Record has been successfully Updated::success';
                }else{
                    echo 'FAIL::Record could not be Updated::error';
                }
                return null;
            }else{
                //Will have to Update he Whole row.
                $rowID = $result->id;
                $total = array_push($solutionNewJSON['data'],$arrayToPush);
                if($total>0){

                    $updateData = [
                        'Solution' => json_encode($solutionNewJSON),
                        'type' => 4
                    ];
                    $whereUpdate = [
                        'id' => $rowID
                    ];

                    //Now Just Do the Insertion.
                    $boolResult = $this->Common_model->update($this->answersTable, $whereUpdate, $updateData);
                    if($boolResult === true){
                        echo 'OK::Record Successfully Updated::success';
                    }else{
                        echo 'FAIL::Record Could not be Updated::error';
                    }
                }//End of If Statement.
            }
        }
    }
    public function trash_textBox(){
        $divID = $this->input->post('divID'); //DivID to be Removed
        if(empty($divID)){
            echo 'FAIL::Something went wrong with the POST, Please contact System Administrator for the further assistance.::error';
            return false;
        }
        //Need a question ID.
        $explodedDivID = explode('_',$divID);
        $questionID = $explodedDivID[0];

        //Get the Current Solution Array from the DB.
        //First we need to find out if there is any solution to this question already exist or not.
        $selectData = ['id, Solution, `type`',false];
        $whereSelect =['questionID' => $questionID];
        $questionSolution = $this->Common_model->select_fields_where($this->answersTable,$selectData,$whereSelect,true);

        if(empty($questionSolution)){
            echo 'FAIL::No Record Found::error';
            return false;
        }

        $Solution = json_decode($questionSolution->Solution,true);
        foreach($Solution['data'] as $key => $textBox){
            if($textBox['divID'] === $divID){
                //Remove the Damn Row from the DB.
                unset($Solution['data'][$key]);
            }
        }

        //Now as we have removed our desired value array, we can update the db with the updated json.
        //Encode in JSON
        $SolutionJSON = json_encode($Solution);
        //Finally Update the Record in the DB.
         $whereUpdate= ['id' => $questionSolution->id];
         $updateData = ['Solution' => $SolutionJSON];

        $boolResult = $this->Common_model->update($this->answersTable,$whereUpdate, $updateData);
        if($boolResult===true){
            echo 'OK::Record Successfully Removed::success';
        }else{
/*            echo $this->db->last_query();
            echo $boolResult;*/
            echo 'FAIL::Could not remove the record from the DB::error';
        }
        return null;
    }


    //Code For Ordering
    public function order(){
        $listingID = $this->input->post('listingID');

        if(!empty($listingID) and is_numeric($listingID)){
            $this->data['QASorting'] = $this->_getQAnswers($listingID);
        }else{
            $this->data['QASorting'] = $this->_getQAnswers();
        }

        $this->data['listing'] = $this->_getListings();

        $this->data['title'] = 'Sort the Questions Order';
        $this->show_admin("admin/questions/sorting_order",$this->data);
    }
    public function getQuestionsList(){
        $listID = $this->input->post('listID');

        if(empty($listID) and is_numeric($listID)){
            return false;
        }

        $data['QASorting'] = $this->_getQAnswers($listID);
        $this->load->view('admin/questions/templates/sorted_questions',$data);
    }
    public function getTextboxTemplate(){

        $questionID = $this->input->post('qID');
        $totalCurrentDivs = $this->input->post('total');

        if(empty($questionID) || empty($totalCurrentDivs)){
            return false;
        }

        if(!is_numeric($questionID) || !is_numeric($totalCurrentDivs)){
            return false;
        }

        $this->data['questionID'] = $questionID;
        $this->data['totalCurrentDivs'] = $totalCurrentDivs;

        $this->load->view('admin/questions/templates/textbox.php',$this->data);
    }

    //Updating the Sorting for Order.
    public function sort(){
//        $orderArray = $this->input->post('question');
        $orderArray = $this->input->post('order');

        if(!empty($orderArray) and is_array($orderArray)){
            $this->db->trans_start();
            $count = 1;
            foreach ($orderArray as $questionOrder){
                echo $questionOrder;
                $explodedValue = explode('_',$questionOrder);
                $whereUpdate = [
                    'id' => $explodedValue[0]
                ];
                $updateData = [
                    'order' => $count
                ];
                $this->Common_model->update($this->questionListingTable,$whereUpdate,$updateData);
                $count++;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE)
            {
                echo 'FAIL::Records Could Not Be Updated::error';
            }else{
                echo 'OK::Record Successfully Updated::success';
            }
        }

    }

    public function updateUserAnswer(){
        $questionID = $this->input->post('qID');
        $userID = $this->input->post('userID');
        $listingID = $this->input->post('listingID');
        $type = $this->input->post('type');

        if(empty($questionID) || empty($userID) || empty($listingID)){
            echo 'FAIL::Something went wrong with the post, Please contact System Administrator for further assistance.';
            return false;
        }

        //We Need to Store the Answer for the User Against his/her question.

        //For That first We Need to fetch the Possible Answers for that question and match it.
        $selectAnswerData = [
            'id,Solution,type',false
        ];
        $whereSelectAnswer = [
            'questionID' => $questionID
        ];
        $resultAnswer = $this->Common_model->select_fields_where($this->answersTable,$selectAnswerData,$whereSelectAnswer,true);

        //We Can Only Update the Ansewr In Database for the User if we have the available answer/solution for the question.
        if(empty($resultAnswer)){
            echo 'FAIL::something went wrong, please contact System Administrator for further assistance.::error';
            return false;
        }

        $Solution = $resultAnswer->Solution;

        if(empty($Solution)){
            echo 'FAIL::something went wrong, please contact System Administrator for further assistance.::error';
            return false;
        }else{
            $Solution = json_decode($Solution,true);
            $SolutionData = $Solution['data'];
        }


        $updateUserAnswerData = [
            'answer_id' => $resultAnswer->id,
            'user_id' => $userID,
            'listing_id' => $listingID
        ];



        $updateUserAnswerData['answer'] = [];

        switch ($type){
            case 'radio':
                $selectedValue = $this->input->post('selectedRadioValue');
                $selectedRadioID = $this->input->post('radioID');
                $arrayToUpdate = [
                    'type'=>'radio',
                    'selectedValue' => $selectedValue,
                    'selectedRadioID' => $selectedRadioID
                ];
                break;
            case 'checkbox':
                $checkBoxID = $this->input->post('checkBoxID');
                $checkBoxValue = $this->input->post('checkBoxValue');
                $hasCheck = $this->input->post('hasCheck');
                $arrayToUpdate = [
                    'type'=>'checkbox',
                    'selectedCheckBoxes' => []
                ];
                $selectedUserAnswerData=['id, answer',false];
                $whereUserAnswer=[
                    'answer_id' => $resultAnswer->id,
                    'user_id' => $userID,
                    'listing_id' => $listingID
                ];
                //First Need to Fetch The Existing Answer, If there is any against this..
                $currentAnswer = $this->Common_model->select_fields_where($this->userAnswersTable,$selectedUserAnswerData,$whereUserAnswer,true);
/*                echo '<pre>';
                var_dump($currentAnswer);
                echo '</pre>';
                exit;*/
                if(empty($currentAnswer)){
                    //Means There is No Answer Currently for This User and For this Selected Listing.
                    $insertAnswerData = $updateUserAnswerData;
                    if($hasCheck==='Yes'){
                        $arrayToUpdate['selectedCheckBoxes'][] = [
                            'checkBoxID' => $checkBoxID,
                            'checkBoxValue' => $checkBoxValue
                        ];
                    }else{
                        $arrayToUpdate['selectedCheckBoxes'][] = [];
                    }

                    //Finally Update it.
                    $insertAnswerData['answer'] = json_encode($arrayToUpdate);
                    $lastInsertedID = $this->Common_model->insert_record($this->userAnswersTable,$insertAnswerData);
                    if($lastInsertedID > 0){
                        echo 'OK::Record Successfully Added::success';
                        return true;
                    }else{
                        echo 'OK::Recod could not be Added::error';
                        return false;
                    }
                }else{
                    //This User has Selected The Answer, We Only Need to Update It.
                    //As We are in Checkbox, we will update the CheckBox.
                    $answer = json_decode($currentAnswer->answer,true);
                    $answerData = $answer['selectedCheckBoxes'];
/*                    var_dump($answer);
                    exit;*/
                    if($hasCheck==='Yes'){
                        if(empty($answerData)){
                            $answerData = [];
                        };
                        //ok There can be a situation, where this record might already be there.
                        //For that lets first check before pushing it there..
                        $push=true;
                        if(!empty($answerData)){
                            foreach($answerData as $key=>$array){
                                if(in_array($checkBoxID,$array) and $array['checkBoxValue']===$checkBoxValue){
                                    $push=false;
                                }
                            }
                        }
                        if($push === true){
                            $arrayToPush=[
                                'checkBoxID' => $checkBoxID,
                                'checkBoxValue' => $checkBoxValue
                            ];
                            array_push($answerData,$arrayToPush);
                        }else{
                            echo 'FAIL::Record Already Present in DB::warning';
                            return false;
                        }
                    }elseif($hasCheck==='No'){
                        //Means we need to pop out the record from current list.
                        foreach($answerData as $key=>$array){
                            if(in_array($checkBoxID,$array)){
                                //Remove the Item from array.
                                unset($answerData[$key]);
                            }
                        }
                    }
                    unset($answer['selectedCheckBoxes']);
                    $answer['selectedCheckBoxes'] = $answerData;
                    $userAnswerUpdateData = ['answer' => json_encode($answer)];
                    $whereUserAnswerUpdate = ['id'=>$currentAnswer->id];
                    $updateBoolResult = $this->Common_model->update($this->userAnswersTable,$whereUserAnswerUpdate,$userAnswerUpdateData);
                    if($updateBoolResult === true){
                        echo 'OK::Record Successfully Updated::success';
                        return true;
                    }else{
                        echo 'FAIL::Record could not be updated::error';
                        return false;
                    }
                }
                break;
            case 'select':
                $selectedValue = $this->input->post('selectedValue');
                break;
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
    private function _getQAnswers($listingID = NULL){

        if($listingID === NULL || !is_numeric($listingID)){
            $listingID = 1;
        }

        $selectData2 = array('        
                    EQ.Question as Question,
                    EQ.id as questionID,
                    QPS.Solution as PossibleSolutions,
                    QL.order as QuestionOrder,
                    QL.id as ListItemID
            ',false);//ES.Score as points

        $where = [
            'EQ.`isPublished`' => 1,
            'QL.listing_id' => $listingID
        ];
        $joins2 = array(
            array(
                'table' => 'esic_questions_listings QL',
                'condition' => 'QL.question_id = EQ.id',
                'type' => 'LEFT'
            ),
            array(
                'table' => 'esic_questions_answers QPS',
                'condition' => 'QPS.questionID = EQ.id',
                'type' => 'LEFT'
            ),
            array(
                'table' => 'esic_question_users_answers UA',
                'condition' => 'UA.answer_id = QPS.id',
                'type' => 'LEFT'
            )
        );
        $groupBy = ['EQ.id'];
        $orderBy = 'QL.order';
        $result =  $this->Common_model->select_fields_where_like_join('esic_questions EQ',$selectData2,$joins2,$where,FALSE,'','',$groupBy,$orderBy);
//        echo $this->db->last_query();
        return $result;

    }
}
