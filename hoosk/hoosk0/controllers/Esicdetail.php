<?php

class Esicdetail extends MY_Controller{
    protected $perPage;
    public function __construct()
    {
        parent::__construct();
 


    }
    public function getdetails($id){
    
 
            $selectData = array(
                '
                    user.id as userID,
                    concat(firstName, " ", lastName) as FullName,
                    email as Email,
                    company as Company,
                    business as Business,
                    businessShortDescription as BusinessShortDesc,
                    score as Score,
                    logo as Logo,
                    website as Web,
                    thumbsUp as thumbsUp,
                    CASE WHEN user.status = 1 THEN CONCAT("<span class=\"featured-red\">",ES.status,"</span>") WHEN user.status = 2 THEN CONCAT("<span class=\"featured-yellow\">",ES.status,"</span>") WHEN user.status = 3 THEN CONCAT("<span class=\"featured-green\">",ES.status,"</span>") ELSE "" END as Status
                    ',
                false
            );

            $where = '';
            if(!empty($secSelect)){
                $where .= "user.sectorID =".$secSelect;
            }
            $joins = array(
                array(
                    'table' => 'esic_status ES',
                    'condition' => 'ES.id = user.status',
                    'type' => 'LEFT'
                )
            );
            $usersResult = $this->Common_model->select_fields_where_like_join('user',$selectData,$joins,$where,FALSE,'','','','',$limit,true);
            $result="";
            
           if(!empty($usersResult) && is_array($usersResult)){
                $count=0;
                foreach($usersResult as $key=>$user){
                    $count++;
                    $status='';
                    $web='';
                    $desc='';
                    $img ='';
                    if(!empty($user['Status'])){
                        $status = $user['Status'];
                    }
                    if(!empty($user['Web'])){
                        $web = '<a target="_blank" href="http://'.$user['Web'].'" class="website">'.$user['Web'].'</a>';
                    }
                    if(!empty($user['BusinessShortDesc'])){
                        if(strlen($user['BusinessShortDesc']) > 200){
                            $desc =  substr($user['BusinessShortDesc'],0,200).'...';
                        }else{
                            $desc =   $user['BusinessShortDesc'];
                        }
                    }
                    if(isset($user['Logo']) and !empty($user['Logo']) and is_file(FCPATH.'/'.$user['Logo'])){
                        $img = base_url($user['Logo']);
                    }else{
                        $img = base_url('pictures/defaultLogo.png');
                    }
                   
                    $result .= '<div class="list-item hcard-search member_level_5">';
                    $result .= '<div class="img-container">';
                    $result .= '<a href="#" class="permalink" data-link= "'.$user['id'].'"">';
                    $result .= '<img src="'.$img.'" alt="" class="left">';
                    $result .= '</a>';
                    $result .= '</div>';
                    $result .= '<div class="status-container">'.$status.'</div>';
                    $result .= '<div class="name-container">';
                    $result .= '<a href="#" class="permalink" data-link= "'.$user['id'].'"">';
                    $result .= '<h3>'.$user['FullName'].'</h3>';
                    $result .= '</a>';
                    $result .= '</div><div class="clear"></div>';
                    $result .= '<div class="product-details">';
                    $result .= '<p class="info-type">'.$user['Company'].'</p>';
                    $result .= '</div>';
                    $result .= '<div class="product-details">';
                    $result .= '<span class="price-funded"></span>';
                    $result .= '<span class="price-assuarance">';
                    $result .= $web;
                    $result .= '</span>';
                    $result .= '<p>';
                    $result .= $desc ;
                    $result .= '</p>';
                    $result .= "<br />";
                    $result .= '</div></div>';
                }
                   
            }
                
        return $result;//.$this->db->last_query();

    }
}