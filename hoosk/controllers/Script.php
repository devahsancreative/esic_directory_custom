<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Script extends MY_Controller{
    public $tables = array(
        'esic',
        'esic_lawyers',
        'esic_acceleration',
        'esic_accelerators',
        'esic_grantconsultant',
        'esic_investors',
        'esic_rndconsultasnt',
        'esic_rndpartner',
        'esic_institution'
        );
    function __construct(){
        parent::__construct();
    }
    public function makeSlug(){
        print_r($this->data);
        $Esic = $this->Common_model->select('esic','id,name');
        echo 'Esic';
        foreach ($Esic as $key => $value) {
            echo '<br>';
            echo $value->id.' - ';
            echo $value->name.' - ';
            $slug = getAlias($value->name);
            $where = array('id' => $value->id);
            $updateData = array('slug' => $slug);
            $this->Common_model->update('esic',$where , $updateData);

        }
        $Esic = $this->Common_model->select('esic_lawyers','id,name');
        echo 'esic_lawyers';
        foreach ($Esic as $key => $value) {
            echo '<br>';
            echo $value->id.' - ';
            echo $value->name.' - ';
            $slug = getAlias($value->name);
            $where = array('id' => $value->id);
            $updateData = array('slug' => $slug);
            $this->Common_model->update('esic_lawyers',$where , $updateData);
        }
        $Esic = $this->Common_model->select('esic_acceleration','id,Member');
        echo 'esic_acceleration';
        foreach ($Esic as $key => $value) {
            echo '<br>';
            echo $value->id.' - ';
            echo $value->Member.' - ';
            $slug = getAlias($value->Member);
            $where = array('id' => $value->id);
            $updateData = array('slug' => $slug);
            $this->Common_model->update('esic_acceleration',$where , $updateData);
        }
        $Esic = $this->Common_model->select('esic_accelerators','id,name');
        echo 'esic_accelerators';
        foreach ($Esic as $key => $value) {
            echo '<br>';
            echo $value->id.' - ';
            echo $value->name.' - ';
            $slug = getAlias($value->name);
            $where = array('id' => $value->id);
            $updateData = array('slug' => $slug);
            $this->Common_model->update('esic_accelerators',$where , $updateData);
        }
        $Esic = $this->Common_model->select('esic_grantconsultant','id,name');
        echo 'esic_grantconsultant';
        foreach ($Esic as $key => $value) {
            echo '<br>';
            echo $value->id.' - ';
            echo $value->name.' - ';
            $slug = getAlias($value->name);
            $where = array('id' => $value->id);
            $updateData = array('slug' => $slug);
            $this->Common_model->update('esic_grantconsultant',$where , $updateData);
        }
        $Esic = $this->Common_model->select('esic_investors','id,name');
        echo 'esic_investors';
        foreach ($Esic as $key => $value) {
            echo '<br>';
            echo $value->id.' - ';
            echo $value->name.' - ';
            $slug = getAlias($value->name);
            $where = array('id' => $value->id);
            $updateData = array('slug' => $slug);
            $this->Common_model->update('esic_investors',$where , $updateData);
        }
        $Esic = $this->Common_model->select('esic_rndpartner','id,name');
        echo 'esic_rndpartner';
        foreach ($Esic as $key => $value) {
            echo '<br>';
            echo $value->id.' - ';
            echo $value->name.' - ';
            $slug = getAlias($value->name);
            $where = array('id' => $value->id);
            $updateData = array('slug' => $slug);
            $this->Common_model->update('esic_rndpartner',$where , $updateData);
        }
        $Esic = $this->Common_model->select('esic_institution','id,institution');
        echo 'esic_institution';
        foreach ($Esic as $key => $value) {
            echo '<br>';
            echo $value->id.' - ';
            echo $value->institution.' - ';
            $slug = getAlias($value->institution);
            $where = array('id' => $value->id);
            $updateData = array('slug' => $slug);
            $this->Common_model->update('esic_institution',$where , $updateData);
        }
        $Esic = $this->Common_model->select('esic_rndconsultant','id,name');
        echo 'rndconsultant';
        foreach ($Esic as $key => $value) {
            echo '<br>';
            echo $value->id.' - ';
            echo $value->name.' - ';
            $slug = getAlias($value->name);
            $where = array('id' => $value->id);
            $updateData = array('slug' => $slug);
            $this->Common_model->update('esic_rndconsultant',$where , $updateData);
        }
    }
}