<?php

namespace App\Services\Datatables;

use App\Services\BaseServices;
use Illuminate\Support\Facades\DB;
use Exception;

class Datatables extends BaseServices {

    public $sql;
    public $_table;
    public $order = [];
    public $search = [];
	private $modifyCB;

    public function __construct($tb="") {
        parent::__construct();
        if($tb) {
            $this->_table = $tb;
            $this->sql = DB::table($tb);
        }
    }

    public function table($tb=""){
        $this->_table = $tb;
        $this->sql = DB::table($tb);
        return $this;
    }

	public function search($search) {
		if (is_array($search)) {
			$this->search = $search;
		} else {
			$preprocessing = strtolower($search);
			$preprocessing = preg_replace('/\s+/', ',', $search);
			$arr = explode(',', $preprocessing);
			$this->search = array_values(array_filter($arr));
		}
		
		return $this;
	}

	public function order($order) {
		$this->order = $order;
		return $this;
	}

	private function isAllowSearch($str="") {
		$pattern = "/avg\((.+?)\)|count\((.+?)\)|distinct\((.+?)\)|max\((.+?)\)|min\((.+?)\)|sum\((.+?)\)/";
		return !preg_match($pattern, $str);
	}

	public function modifyResult($callback) {
		$this->modifyCB = $callback;
		return $this;
	}

    public function __call($method, $arguments) {
        if (method_exists($this->sql, $method)) {
            return call_user_func_array([$this->sql, $method], $arguments);
        }

        throw new \BadMethodCallException("Method {$method} does not exist on the query builder.");
    }

    public function renderResult($data=[]){
        $request = request();
		$draw = $request->post('draw') ?: '0';
		$length = $request->post('length') ?: '10';
		$start = $request->post('start') ?: '0';
		$order = $request->post('order');

        if(!$this->search) {
			$search = [];
			$QSelect = is_array($this->sql->columns) ? $this->sql->columns : [];
			foreach ($QSelect as $key => $value) {
				if(strpos($value, ' as ')) {
					$search[] = substr($value, 0, strpos($value, ' as '));
				} else {
					$search[] = $value;
				}
			}
			$this->search = $search;
		}

		if (is_array($this->search)) {
			$this->order = $this->order ?: $this->search;
			$search = $request->post('search');
			if ($search['value']) {
				$searchValue = $search['value'];
                $searchList = $this->search;

                $this->sql->where(function($query) use ($searchValue, $searchList){
                    foreach ($searchList as $col) {
                        $query->orWhere($col, "LIKE", "%{$searchValue}%");
                    }
                });
			}
		}

		if(is_array($this->order) && $order) {
			$this->orderBy($this->order[$order['0']['column']], $order['0']['dir'], false);
		}

        $this->sql->whereRaw("{$this->_table}.deleted_at is null");
        $totalResult = $this->sql->count();
        $this->sql->offset($start);
        $this->sql->limit($length);
        $result = $this->sql->get()->toArray();

        if($this->modifyCB) {
			$result = array_map($this->modifyCB, $result);
		}

        $result = array_merge([
            "draw" => $draw ?? 0,
            "recordsTotal" => $totalResult ?? 0,
            "recordsFiltered" => $totalResult ?? 0,
            "data" => $result ?? [],
        ], $data);
        return response($result);
    }

}