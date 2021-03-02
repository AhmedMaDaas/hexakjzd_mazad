<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\StoreLink;
use App\Models\AdvertisingPhoto;

use App\Rules\PhoneNumber;

use Storage;
use Up;
use DB;

class SettingsController extends Controller
{
    public function show(){
        $title = trans('admin.settings');
        $settings = settings();
        $storeLinks = StoreLink::orderBy('id', 'desc')->get();

        return view('admin.settings.show', ['title' => $title, 'settings' => $settings, 'storeLinks' => $storeLinks]);
    }

    public function updateBaseInfo($id){
        $settings = Setting::with('addPhotos')->find($id);
        if(!isset($settings)) return back();

        $voiceRequired = isset($settings->welcome_voic_message) && Storage::has($settings->welcome_voic_message) ? 'sometimes|nullable' : 'required';
        $logoRequired = isset($settings->site_logo) && Storage::has($settings->site_logo) ? 'sometimes|nullable' : 'required';

        $data = $this->validate(request(), [
            'welcome_text_message' => 'required|string',
            'auction_name' => 'required|string',
            'site_logo' => 'sometimes|nullable|image|mimes:jpg,jpeg,gif,png,svg',
            'welcome_voic_message' => $voiceRequired . '|mimes:mp3,wav,wma,wv,nmf,msv',
            'advertising_photo' => 'sometimes|nullable|array',
            'advertising_photo.*' => 'sometimes|nullable|image|mimes:jpg,jpeg,gif,png,svg',
            'whatsapp_number' => ['sometimes', 'nullable', new PhoneNumber()],
        ]);

        if(request()->hasFile('site_logo')){
            $data['site_logo'] = $this->upload('site_logo', 'settings', $settings->site_logo);
        }

        if(request()->hasFile('welcome_voic_message')){
            $data['welcome_voic_message'] = $this->upload('welcome_voic_message', 'settings', $settings->welcome_voic_message);
        }

        if(request()->has('advertising_photo')){
            $this->storeAddPhotos(request()->file('advertising_photo'), $settings->id, $settings->addPhotos);
            $this->deletePhotos($settings->addPhotos);
        }

        $settings->update($data);

        session()->flash('success', trans('admin.record_updated_successfully'));
        return redirect('admin/settings');
    }

    public function updateLiveInfo($id){
        $settings = Setting::find($id);
        if(!isset($settings)) return back();

        $voiceBeforeLiveRequired = isset($settings->voic_before_live) && Storage::has($settings->voic_before_live) ? 'sometimes|nullable' : 'required';
        $data = $this->validate(request(), [
            'whatsapp_number' => ['required', new PhoneNumber()],
            'voic_before_live' => $voiceBeforeLiveRequired . '|mimes:mp3,wav,wma,wv,nmf,msv',
        ]);

        unset($data['voic_before_live']);
        if(request()->hasFile('voic_before_live')){
            $data['voic_before_live'] = $this->upload('voic_before_live', 'settings', $settings->voic_before_live);
        }

        $settings->update($data);

        session()->flash('success', trans('admin.record_updated_successfully'));
        return redirect('admin/settings');
    }

    public function addStoreLink(){
        $data = $this->validate(request(), [
            'image' => 'required|image|mimes:jpg,png,gif,jpeg',
            'name' => 'required|string',
            'link' => 'sometimes|nullable|url'
        ]);

        $data['image'] = $this->upload('image', 'store_links', '');

        $storeLink = StoreLink::create($data);

        if(request()->ajax()){
            return view('admin.plugins.store_link', ['storeLink' => $storeLink, 'hidden' => 'hidden'])->render();
        }

        session()->flash('success', trans('admin.record_added_successfully'));
        return redirect('admin/settings');
    }

    public function updateStoreLink(){
        $data = $this->validate(request(), [
            'id' => 'required|numeric',
            'image' => 'sometimes|nullable|image|mimes:jpg,png,gif,jpeg',
            'name' => 'sometimes|nullable|string',
            'link' => 'sometimes|nullable|url'
        ]);

        $storeLink = StoreLink::find($data['id']);

        if(!isset($storeLink)) return back();

        if(request()->hasFile('image')) $data['image'] = $this->upload('image', 'store_links', $storeLink->image);

        $data = $this->filterData($data);
        $storeLink->update($data);

        if(request()->ajax()){
            return view('admin.plugins.store_link', ['storeLink' => $storeLink, 'hidden' => ''])->render();
        }

        session()->flash('success', trans('admin.record_updated_successfully'));
        return redirect('admin/settings');
    }

    public function deleteStoreLink(){
        $data = $this->validate(request(), [
            'id' => 'required|numeric'
        ]);

        $storeLink = StoreLink::find($data['id']);

        if(!isset($storeLink)) return back();

        Up::deleteFile($storeLink->image);
        $storeLink->delete();

        if(request()->ajax()){
            return response()->json(['status' => trans('admin.record_deleted_successfully')]);
        }

        session()->flash('success', trans('admin.record_deleted_successfully'));
        return redirect('admin/settings');
    }

    public function addAdvertisement(){
        $this->validate(request(), [
            'sId' => 'required|numeric',
            'addPhoto' => 'required|image|mimes:jpeg,jpg,png,gif',
        ]);

        $photo = $this->upload('addPhoto', 'settings/add_photos', '');
        $addPhoto = AdvertisingPhoto::create([
            'photo' => $photo,
            'setting_id' => request('sId'),
        ]);

        return $addPhoto->id;
    }

    public function updateAdvertisement(){
        $this->validate(request(), [
            'id' => 'required|numeric',
        ]);

        $addPhoto = AdvertisingPhoto::find(request('id'));
        if(isset($addPhoto)){
            Storage::delete($addPhoto->photo);
            $addPhoto->delete();
        }
    }

    public function uploadFile(){
        if(request()->hasFile('file'))
            return trans('admin.uploaded');
        return null;
    }

    private function upload($file, $path, $deleteFile){
        return Up::upload([
            'file' => $file,
            'path' => $path,
            'deleteFile' => $deleteFile
        ]);
    }

    private function storeAddPhotos($array, $settingsId, $addPhotos){
        $data = [];
        foreach ($array as $key => $value) {
            $photo = $this->upload($value, 'settings/add_photos', '');
            $data[] = ['photo' => $photo, 'setting_id' => $settingsId];
        }
        DB::table('advertising_photos')->insert($data);
    }

    private function deletePhotos($addPhotos){
        $ids = [];
        foreach ($addPhotos as $key => $photo) {
            Storage::delete($photo->photo);
            $ids[] = $photo->id;
        }
        AdvertisingPhoto::whereIn('id', $ids)->delete();
    }

    private function filterData($data){
        foreach ($data as $key => $value) {
            if($value == null ) unset($data[$key]);
        }
        return $data;
    }
}
