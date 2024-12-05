<?php

namespace App\Services\Tags;

use App\Services\BaseServices;
use Exception;

class Tags extends BaseServices {

    public $model;
    protected $primary_key;

    public function __construct() {
        parent::__construct();
        $this->model = model("TagsModel");
        $this->primary_key = "tags.id";
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
        } else if (is_numeric($filter)) {
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

    public function getList(){
        $tg = $this->findAll([
            ["select", "name"]
        ]);
        $tags = array_column($tg->toArray(), "name");
        return $tags;
    }

}