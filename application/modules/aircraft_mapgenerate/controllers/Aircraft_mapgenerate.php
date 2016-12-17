<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Aircraft_mapgenerate extends MX_Controller {

    var $data;
	function __construct()
	{
		parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
		$this->load->library(array('form_validation'));
		$this->load->helper(array('form','captcha'));
		$this->load->model(   array( 
                                    'AircraftType_model',
                                    'AircraftReg_model',
                                    'CabinItems_model',
                                    'AircraftTemplateH_model',
                                    'AircraftTemplateD_model'
                            ));
		$this->page->use_directory();

	}
    
    public function index() {
        
        $data['add'] = $this->page->base_url('/add');
        $data['act'] = $this->page->base_url("/list_search");
        $data['data_acType']  = $this->AircraftType_model->all();
        $data['data_acReg']  = $this->AircraftReg_model->all();
        $data['data_CabItm']  = $this->CabinItems_model->all();
		//print_r($data); exit();
        $this->page->view('aircraft_mapgenerate', $data);
        
	}
    
    public function list_template() {
        
        $data['heading'] = 'List Map Cabin Air Craft';
        $data['add'] = base_url('/aircraft_mapgenerate/');
        $data['act'] = $this->page->base_url("/list_search");
        $data['data_acType']  = $this->AircraftType_model->all();
        $data['data_acReg']  = $this->AircraftReg_model->all();
        $data['data_CabItm']  = $this->CabinItems_model->all();
		$this->page->view('listTemplateAcMapGenerate', $data);
        
	}
    
    public function get_data(){
		$list = $this->AircraftTemplateH_model->get_data();
        
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $grid) {			
			$no++;
            //$data_acType  = $this->AircraftReg_model->find($grid->aircraft_reg_fk,'id');
            $data_acReg  = $this->AircraftReg_model->find($grid->aircraft_reg_fk,'id');
            $data_acType  = $this->AircraftType_model->find($data_acReg['id_aircraft_type_fk'],'id');
            //print_r($data_acType); exit();
            $data_cabinItm  = $this->CabinItems_model->find($grid->cabinItem,'id');                  
			$cabincode = str_replace(' ', '-', $data_cabinItm['name_type']);
            $row = array();
			$row[] = $no;
			$row[] = $data_acType['name_aircraft'] . '_' . $data_acReg['name_ac_reg'] . '_' .$cabincode;
			$row[] = $data_cabinItm['name_type'];
			$row[] = '<div style="width:100%;text-align:center;">
                        <a class="btn btn-xs btn-flat btn-info" href="'.site_url('/aircraft_mapgenerate/view/'.$grid->id).'" title="Update Data">View</a> &nbsp;
                    </div>';
			$data[] = $row;
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->AircraftTemplateH_model->count_all(),
			"recordsFiltered" 	=> $this->AircraftTemplateH_model->count_filtered(),
			"data" 				=> $data,
		);
		echo json_encode($output);
	}
    
    public function view($id) {
        $data['act'] = '';
        
        //$data['data_acType']  = $this->AircraftType_model->all();
        //$data['data_acReg']  = $this->AircraftReg_model->all();
        //$data['data_CabItm']  = $this->CabinItems_model->all();
        $data['data_acTemplateH']   = $this->AircraftTemplateH_model->find($id,'id');
        $where_acTemplateD = " AND id_cabin_ac_template_fk = " . $data['data_acTemplateH']['id'] . "";
        $data['data_acTemplated']   = $this->AircraftTemplateD_model->all($where_acTemplateD);
        //$data_acType  = $this->AircraftType_model->find($data['data_acTemplateH']['acType_fk'],'id');
        $data_acReg  = $this->AircraftReg_model->find($data['data_acTemplateH']['aircraft_reg_fk'],'id');
        $data_acType = $this->AircraftType_model->find($data_acReg['id_aircraft_type_fk'], 'id');
        $data_cabin =  $this->CabinItems_model->find($data['data_acTemplateH']['cabinItem'], 'id');
        //head data
        $data['ac_type_selected'] = $data_acType['name_aircraft'];
        $data['ac_reg_selected'] = $data_acReg['name_ac_reg'];
        $data['cabin_selected'] = $data_cabin['name_type'];
        //end head data
        //$data['heading'] = 'Map Cabin Air Craft - ' . $data_acReg['name_ac_reg'];
        //print_r($data); exit();
		$this->page->view('viewTemplateAcMapGenerate', $data);        
	}
    
    public function plane_cabin() {
        $data['act'] = '';
        
		$this->page->view('template_plane', $data);
        
	}
    
    public function insert_mapgenerator(){
        
        if($this->input->post(NULL, TRUE)){
            $input_post = $this->input->post(NULL, TRUE);
            die(json_encode($input_post));
        }
        
    }
    
    public function upload_image(){           
         if($this->input->post(NULL, TRUE)){
            
            if(!empty($_FILES['imgInp']['tmp_name'])){
            
                ini_set('max_execution_time', 1800);
                ini_set('memory_limit', '1024M');
                
                $acType = $this->input->post('acType');
                $AcReg = $this->input->post('AcReg');
                $CabItms = $this->input->post('CabItms');
                
                $data_acType  = $this->AircraftType_model->find($acType,'id');
                $data_acReg  = $this->AircraftReg_model->find($AcReg,'id');
                $data_CabItm  = $this->CabinItems_model->find($CabItms,'id');
                
                $coordsItem = $this->input->post('coordsItem');
                
                $nameAcType = url_title($data_acType['name_aircraft'], 'underscore', TRUE);
                $nameAcReg = url_title($data_acReg['name_ac_reg'], 'dash', TRUE);
                $nameCabinItm = url_title($data_CabItm['name_type'], 'dash', TRUE);
            
                $ext = $_FILES['imgInp']['name'];
                $ext = pathinfo($ext, PATHINFO_EXTENSION);
                $name_unic = $nameAcType . '-' . $nameAcReg . '-' . $nameCabinItm . '-' . date('dmy') . '.' . $ext ;
                
                $path = './assets/upload_cabin/';
                if (!is_dir($path)) 
                {                        
                    mkdir($path, 0777, true);                                  
                }
                $pathImage = $path . $name_unic;
                if (file_exists($pathImage)) {
                    @unlink($pathImage);
                }
                
                $img_data = array();
                $config['upload_path'] = $path;  
                $config['file_name'] = $name_unic;              
                $config['allowed_types'] = 'jpeg|jpg|png';
                $config['max_size'] = '3000000';
                $this->load->library('upload');
    
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('imgInp')) {
                    $message =  array('message' => $this->upload->display_errors());
                    die(json_encode($message));                                
                    redirect('/Aircraft_mapgenerate', 'refresh');                    
                } else {
                    
                    $data_postH = array(
                                        /*'acType_fk'     => $acType,
                                        'acReg_fk'      => $AcReg,*/
                                        'aircraft_reg_fk' => $acType,
                                        'cabinItem'     => $CabItms,
                                        'FileImage'     => $name_unic
                                    );
                                    
                    $insertH = $this->AircraftTemplateH_model->add($data_postH);
                    
                    foreach($coordsItem as $rowItem){
                    
                        $Coord_ItemNo = explode(',',$rowItem);
                        $CoordX = $Coord_ItemNo[0];
                        $CoordY = $Coord_ItemNo[1];
                        $CoordRadius = $Coord_ItemNo[2];
                        
                        $Coordinate = $CoordX . ',' . $CoordY . ',' . $CoordRadius;
                        $ItemNo = $Coord_ItemNo[3];
                        
                        $data_postD = array(
                                            'noItem'     => $ItemNo,
                                            'coordinate'      => $Coordinate,
                                            'id_cabin_ac_template_fk'    => $insertH
                                        );
                                        
                        $this->AircraftTemplateD_model->add($data_postD);    
                        
                    }
                        
                    redirect('/Aircraft_mapgenerate/list_template', 'refresh');
                    
                }
                
            }else{
                   
                    ini_set('max_execution_time', 1800);
                    ini_set('memory_limit', '1024M');
                    
                    $acType = $this->input->post('acType');
                    $AcReg = $this->input->post('AcReg');
                    $CabItms = $this->input->post('CabItms');
                    
                    $data_acType  = $this->AircraftType_model->find($acType,'id');
                    $data_acReg  = $this->AircraftReg_model->find($AcReg,'id');
                    $data_CabItm  = $this->CabinItems_model->find($CabItms,'id');
                    
                    $coordsItem = $this->input->post('coordsItem');
                    $ac_templateH = $this->input->post('ac_templateH');
                    
                    $data_postH = array(
                                        'acType_fk'     => $acType,
                                        'acReg_fk'      => $AcReg,
                                        'cabinItem'    => $CabItms
                                    );
                                    
                    $this->AircraftTemplateH_model->update($ac_templateH,$data_postH,"id");
                    
                    $this->db->where('id_cabin_ac_template_fk',$ac_templateH)->delete('m_cabin_ac_template_detail');
                    
                    foreach($coordsItem as $rowItem){
                    
                        $Coord_ItemNo = explode(',',$rowItem);
                        $CoordX = $Coord_ItemNo[0];
                        $CoordY = $Coord_ItemNo[1];
                        $CoordRadius = $Coord_ItemNo[2];
                        
                        $Coordinate = $CoordX . ',' . $CoordY . ',' . $CoordRadius;
                        $ItemNo = $Coord_ItemNo[3];
                        
                        $data_postD = array(
                                            'noItem'     => $ItemNo,
                                            'coordinate'      => $Coordinate,
                                            'id_cabin_ac_template_fk'    => $ac_templateH
                                        );
                                        
                        $this->AircraftTemplateD_model->add($data_postD);    
                        
                    }
                    
                    redirect('/Aircraft_mapgenerate/list_template', 'refresh');
                    
            }
            
        }else{
            redirect('/Aircraft_mapgenerate', 'refresh');
        }
        
    }
    
    public function select_data(){
        if($this->input->post(NULL, TRUE)){
            $data_format = array();
            $dataType = $this->input->post('dataType');
            if($dataType == 'AAA'){
                $manuf = $this->input->post('manuf');
                $custom_where = ' AND id_aircraft_manufacture_fk = ' . $manuf . '';
                $data  = $this->AircraftReg_model->all($custom_where);
                
                foreach($data as $row){
                    $data_format[] = array(
                                        'id' => $row['id'],
                                        'name' => $row['name_ac_reg']
                                    );    
                } 
            }
            
            if(!empty($data_format)){
                
                die(json_encode($data_format));
                
            }else{
                
                die(json_encode(array('respone'=>0)));
                
            }
            
        } else {
            echo "error";
        }   
    }
    
}
