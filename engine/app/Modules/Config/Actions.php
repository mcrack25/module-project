<?php

namespace App\Modules\Config;


class Actions{

    private $default_filename = 'config.php';
    private $file_name;
    private $file_path;

    private function setFile($mass=[]){

        if(!isset($mass['file_name'])){
            $file_name = $this->default_filename;
        } else {
            $file_name = $mass['file_name'];
        }

        $this->file_name = $file_name;
        $this->file_path = module_path('config', 'Configs/'. $file_name);

        if(!file_exists($this->file_path)){
            die('Ошибка! Не найден конфигурационный файл - ' . $file_name);
        }

    }

    public function getAll($mass = []){
        $this->setFile($mass);
        $content = @file_get_contents($this->file_path);
        if($content){
            return json_decode($content, true);
        } else {
            return [];
        }
    }

    public function getOne($mass = []){
        $this->setFile($mass);
        $content = @file_get_contents($this->file_path);
        if($content){
            $all = json_decode($content, true);

            if(isset($mass['item'])){
                $item = $mass['item'];
                if(isset($all[$item])){
                    return $all[$item];
                } elseif(isset($mass['or'])){
                    return $mass['or'];
                }
            } elseif(isset($mass['or'])){
                return $mass['or'];
            }
        }

        return '';
    }

    public function delete($mass = []){
        $this->setFile($mass);
        $content = @file_get_contents($this->file_path);
        if($content){
            $all = json_decode($content, true);

            if(isset($mass['items'])){
                $items = $mass['items'];

                if(is_array($items)){
                    foreach($items as $item){
                        unset($all[$item]);
                    }
                } else {
                    unset($all[$items]);
                }
            }

            $json = json_encode($all);
            file_put_contents($this->file_path, $json);

            return true;
        } else {
            return false;
        }
    }

    public function set($mass = []){
        $this->setFile($mass);
        $content = @file_get_contents($this->file_path);
        $mass_config = json_decode($content, true);

        if(isset($mass['items'])){
            $mass_set = $mass['items'];
            $result_mass = array_replace_recursive($mass_config, $mass_set);

            $json_string = json_encode($result_mass);
            file_put_contents($this->file_path, $json_string);
            return true;
        } else {
            return false;
        }
    }

}