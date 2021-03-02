<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Rules\ValidatKyes;
use App\Rules\Timer;

use App\Models\Live;

use Batch;

class LiveController extends Controller
{
	protected $livePaginate = 5;

	public function allLives(){
		$title = trans('admin.all_lives');
		$lives = Live::orderBy('id', 'desc')->paginate($this->livePaginate);

		$pagesNumber = ceil($lives->total()/$this->livePaginate);

        $page = request('page') == null ? 1 : request('page');

		return view('admin.live.index', ['title' => $title, 'lives' => $lives, 'pagesNumber' => $pagesNumber, 'page' => $page]);
	}

    public function currentLive(){
        $title = trans('admin.current_live');
        
        return view('admin.live.current', ['title' => $title]);
    }

    public function newLive(){
        $title = trans('admin.new_live');
        return view('admin.live.new', ['title' => $title]);
    }

    public function update(){
    	$idValidate = 'required|numeric|min:0';
    	$this->validate(request(), [
    		'live_start' => ['sometimes', 'nullable', 'array', new ValidatKyes()],
    		'live_start.*' => 'required|array|max:1|min:1',
    		'live_start.*.*' => 'required|date',
            'description' => ['sometimes', 'nullable', 'array', new ValidatKyes()],
            'description.*' => 'required|array|max:1|min:1',
            'description.*.*' => 'required|string',
			'timer' => ['sometimes', 'nullable', 'array', new ValidatKyes()],
			'timer.*' => 'required|array|max:1|min:1',
			'timer.*.*' => ['required', new Timer()],
			'cheat_views' => ['sometimes', 'nullable', 'array', new ValidatKyes()],
			'cheat_views.*' => 'required|array|max:1|min:1',
			'cheat_views.*.*' => 'required|numeric|min:0',
			'min_value' => ['sometimes', 'nullable', 'array', new ValidatKyes()],
			'min_value.*' => 'required|array|max:1|min:1',
			'min_value.*.*' => 'required|numeric|min:0',
			'cheat_likes' => ['sometimes', 'nullable', 'array', new ValidatKyes()],
			'cheat_likes.*' => 'required|array|max:1|min:1',
			'cheat_likes.*.*' => 'required|numeric|min:0',
            'bargaining_value' => ['sometimes', 'nullable', 'array', new ValidatKyes()],
            'bargaining_value.*' => 'required|array|max:1|min:1',
            'bargaining_value.*.*' => 'required|numeric|min:0',
    	]);

    	$data = $this->getData([
            'live_start',
    		'description',
			'timer',
			'cheat_views',
			'min_value',
            'cheat_likes',
			'bargaining_value',
    	]);

    	$index = 'id';
        Batch::update(new Live, $data, $index);

        session()->flash('success', trans('admin.records_updated_successfully'));
        return redirect('admin/lives');
    }

    public function create(){
    	$data = $this->validate(request(), [
            'live_start' => 'required|date',
    		'description' => 'required|string',
			'houres' => 'required|numeric|min:0',
			'minutes' => 'required|numeric|min:0|max:59',
			'cheat_views' => 'required|numeric|min:0',
			'min_value' => 'required|numeric|min:0',
            'cheat_likes' => 'required|numeric|min:0',
			'bargaining_value' => 'required|numeric|min:0',
    	]);

    	$data['timer'] = $this->getTimer($data['houres'], $data['minutes']);
    	$data['live_start'] = $this->convertDate($data['live_start']);

    	unset($data['houres']);
    	unset($data['minutes']);
    	unset($data['url']);

    	Live::create($data);

    	return redirect('admin/lives');
    }

    public function deleteLive(){
    	$this->validate(request(), [
    		'id' => 'required|numeric',
    	]);

    	$live = Live::find(request('id'));
    	if(isset($live)) $live->delete();

    	if(request()->ajax()){
    		return response()->json(['status' => trans('admin.record_deleted_successfully')]);
    	}

    	session()->flash('success', trans('admin.record_deleted_successfully'));
    	return redirect('admin/lives');
    }

    private function getTimer($houres, $minutes){
    	$houres = $houres < 10 ? '0' . $houres : $houres;
    	$minutes = $minutes < 10 ? '0' . $minutes : $minutes;
    	return $houres . ':' . $minutes . ':' . '00';
    }

    private function convertDate($date){
    	$data = str_replace("T", " ", $date) . ':00';
    	return $data;
    }

    private function getData($arrays){
    	$data = [];
    	foreach (request($arrays) as $key => $array) {
    		foreach ($array as $id => $values) {
    			$data[] = [
    				'id' => $id,
    				$key => $key == 'live_start' ? $this->convertDate($values[0]) : $values[0],
    			];
    		}
    	}
    	return $data;
    }
}
