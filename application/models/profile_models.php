<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Profile_models extends CI_Model{
        private $_table_name =  'user';


        public function update(){

            $data =  array(
                'no_hp' => $this->input->post('email'),
                'username' => $this->input->post('username'),
            );

            if (!empty($_FILES["image"]["name"])) {
				$data['foto'] = $this->_uploadImage();
			} else {
				$data['foto'] = $this->input->post("gambar_lama");
			}

            $run =  $this->db->where('id_user', $this->input->post('id'))->update($this->_table_name, $data);
            return $run;
        }

        public function update_password()
        {
            $data = array(
                'id_user' => $this->input->post('idUser'),
                'password' => md5($this->input->post('oldPwd'))
            );
            $query = $this->db->get_where('user', $data, 1);
            if($query->num_rows() < 1){
                return false;
            }else{
                $update = array(
                    'password' => md5($this->input->post('newPwd'))
                );
                return $this->db->where('id_user', $this->input->post('id'))->update($this->_table_name, $update);
            }
        }
        
        private function _uploadImage(){
			$post = $this->input->post();
			$config['upload_path']          = './assets/images';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['file_name']            = 'profile-'.$this->input->post('username');
			$config['overwrite']			= true;
			$config['max_size']             = 5000; // 1MB
			// $config['max_width']            = 1024;
			// $config['max_height']           = 768;

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('image')) {
				return $this->upload->data("file_name");
			}
			return $post["gambar_lama"];

        }

        public function showById($id){
            $data =  array(
                'id_user'=>$id
            );
            return $this->db->get_where($this->_table_name, $data)->row();
        }
        

        public function rulesUpdate(){
			return[
				['field' => 'email',
				'label' => 'No telepon',
				'rules' => 'required',
				'errors' =>[
					'required' => 'Kolom %s harus diisi.',
					]                
				],

				['field' => 'username',
				'label' => 'Username',
				'rules' => 'required',
				'errors' =>[
					'required' => 'Kolom %s harus diisi.',
					]                
				],
			];

		}
 
        public function rulesPassword(){
			return[
				['field' => 'oldPwd',
				'label' => 'Password lama',
				'rules' => 'required',
				'errors' =>[
					'required' => 'Kolom %s harus diisi.',
					]                
				],

				['field' => 'newPwd',
				'label' => 'Password baru',
				'rules' => 'required',
				'errors' =>[
					'required' => 'Kolom %s harus diisi.',
					]                
				],

				['field' => 'newPwdConf',
				'label' => 'Konfirmasi password baru',
				'rules' => 'required|matches[newPwd]',
				'errors' =>[
                    'required' => 'Kolom %s harus diisi.',
                    'matches' => 'Konfirmasi password tidak sama.'
					]                
				],
			];

		}

    }