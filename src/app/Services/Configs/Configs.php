<?php

namespace App\Services\Configs;

use App\Services\BaseServices;
use Exception;

class Configs extends BaseServices {

    public $model;
    protected $primary_key;

    public function __construct() {
        parent::__construct();
        $this->model = model("ConfigsModel");
        $this->primary_key = "configs.id";
    }

    public function findOne($filter="") {
        $db = null;
        if (is_array($filter)) {
            foreach ($filter as $value) {
                $params = $value;
                unset($params[ 0 ]);
                if(is_null($db)) {
                    $db = $this->model->{$value[ 0 ]}(...$params);
                } else {
                    $db->{$value[ 0 ]}(...$params);
                }
            }
        } else if (is_string($filter)) {
            $db = $this->model->where($this->primary_key, $filter);
        }
        
        if(is_null($db)) {
            return $this->model->first();
        } else {
            return $db->first();
        }
    }

    public function findAll($filter="") {
        $db = null;
        if (is_array($filter)) {
            foreach ($filter as $value) {
                $params = $value;
                unset($params[ 0 ]);
                if(is_null($db)) {
                    $db = $this->model->{$value[ 0 ]}(...$params);
                } else {
                    $db->{$value[ 0 ]}(...$params);
                }
            }
        }

        if(is_null($db)) {
            return $this->model->get();
        } else {
            return $db->get();
        }
    }

    public function create($data) {
        $data = (object) $data;

        if(($data->created_by ?? "")==="") {
            $data->created_by = userId();
        }

        $db = $this->model->create((array) $data);
        return $db->id;
    }

    public function update($filter, $data) {
        $data = (object) $data;
        $db = null;

        if(($data->updated_by ?? "")==="") {
            $data->updated_by = userId();
        }

        if(is_array($filter)){
            foreach ($filter as $value) {
                $params = $value;
                unset($params[ 0 ]);
                if(is_null($db)) {
                    $db = $this->model->{$value[ 0 ]}(...$params);
                } else {
                    $db->{$value[ 0 ]}(...$params);
                }
            }
            $db->update((array) $data);
        } else if(is_numeric($filter)) {
            $db = $this->model->where($this->primary_key, $filter);
            $db->update((array) $data);
        }
    }

    public function delete($filter) {
        $data = new \stdClass();
        $db = null;
        if(($data->deleted_by ?? "")==="") {
            $data->deleted_by = userId();
        }

        $this->update($filter, $data);
        
        if(is_array($filter)){
            foreach ($filter as $value) {
                $params = $value;
                unset($params[ 0 ]);
                if(is_null($db)) {
                    $db = $this->model->{$value[ 0 ]}(...$params);
                } else {
                    $db->{$value[ 0 ]}(...$params);
                }
            }
            $db->delete();
        } else if(is_numeric($filter)) {
            $db = $this->model->where($this->primary_key, $filter);
            $db->delete();
        }
    }

    public function getConfigs($params=[]){
        $configs = $this->findAll($params);
        $data = new \stdClass();
        foreach ($configs as $config) {
            json_decode($config->value);
            if (json_last_error() === JSON_ERROR_NONE){
                $value = json_decode($config->value);
            } else {
                $value = $config->value;
            }
            $data->{$config->key} = $value;
        }
        return $data;
    }
    
    public function getConfig($key, $valueOnly = true){
        $config = getenv($key);
        $v = null;
        if (!empty($config)){
            return $config;
        }
        $config = $this->findOne([
            ["where", "key", $key]
        ]);
        $value = json_decode($config->value);
        if (json_last_error() === JSON_ERROR_NONE){
            $v = $value;
        } else {
            $v = $config->value;
        }
        if ($valueOnly){
            return $v;
        }
        $config->value = $v;
        return $config;
    }
    
    public function getConfigByGroup($group){
        $configs = $this->findAll([
            ["where", "group", $group]
        ]);
        $data = new \stdClass();
        foreach ($configs as $config) {
            json_decode($config->value);
            if (json_last_error() === JSON_ERROR_NONE){
                $value = json_decode($config->value);
            } else {
                $value = $config->value;
            }
            $data->{$config->key} = $value;
        }
        return $data;
    }

    public function updateConfig($key, $value) {
        $userId = userId();
        $this->update([
            ["where", "key", $key]
        ], [
            "value" => $value,
            "updated_by" => $userId
        ]);
    }

    public function write_officedata(){
        $this->office = $this->getConfigByGroup("office");
        return $this;
    }

    public function officedata($key){
        if($key) {
            return $this->office->{$key};
        } else {
            return $this->office;
        }
    }

}