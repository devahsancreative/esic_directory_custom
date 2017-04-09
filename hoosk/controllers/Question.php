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
        //Loading Libraries
        $this->load->library('form_validation');
        $this->questionsTable = 'esic_questions';
        $this->answersTable = 'esic_questions_answers';
        $this->listingsTable = 'esic_listings';
        $this->questionListingTable = 'esic_questions_listings';
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
                    GROUP_CONCAT(CONCAT(\'<span class="label label-info">\',`L`.`listName`,\'</span>\') SEPARATOR " ") as AssignedTo
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


        //Get all the Answer Types.
        $selectDataAnswerType= [
          '
            id, name
          ',
          false
        ];
        $whereAnswerType = ['isTrashed' => 0];
        $this->data['answer_types'] = $this->Common_model->select_fields_where('esic_question_types',$selectDataAnswerType,$whereAnswerType);

        //Get all the Listing Types
        $selectDataAnswerType= [
            '
            id, listName, tableName
          ',
            false
        ];
        $whereAnswerType = ['isActive' => 1];

        $this->data['listings'] = $this->Common_model->select_fields_where($this->listingsTable,$selectDataAnswerType,$whereAnswerType);

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

        if($success === true){
            $this->session->set_flashdata('notification','OK::Record Successfully Updated::success');
        }else{
            $this->session->set_flashdata('notification','FAIL::Record could not be updated::error');
        }

        //After Everything. Just return the user back to the listings.
        redirect('admin/questions/index');

    }//End of update() function

    public function selectors(){

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
}
