<?php

namespace App\Services\Blogs;

use App\Services\BaseServices;
use Exception;

class Blogs extends BaseServices {

    public $model;
    protected $primary_key;

    public function __construct() {
        parent::__construct();
        $this->model = model("BlogsModel");
        $this->primary_key = "blogs.id";
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
        return $db->first();
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
        return $db->get();
    }

    public function paginate($length, $filter=[]){
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
        return $db->paginate($length);
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

    // custom functions

    public function getCategories(){
        $cat = $this->findAll([
            ["selectRaw", "DISTINCT category"]
        ]);
        $categories = array_column($cat->toArray(), "category");
        return $categories;
    }

}