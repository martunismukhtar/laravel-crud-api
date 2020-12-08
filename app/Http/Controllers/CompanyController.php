<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Companies;

class CompanyController extends Controller {
    
    function index() {
        $data = Companies::select('*')->get();
        
        return response()->json([
            'status' => 'success',
            'msg' => 'success',
            'data' => $data,
        ]);
    }
    
    public function store(Request $request) {
        
        $validatedData = $this->validate($request, 
            [
                'name' => 'required|string|unique:users|max:255',
                'email' => 'sometimes|nullable',
                'website' => 'sometimes|nullable',
                'logo' => 'sometimes|nullable',
            ]
        );
        
       
        $record = Companies::create($validatedData);

        if(!empty($validatedData['logo'])) {
            $record->addMedia($validatedData['logo'])->toMediaCollection('logo');
            
            $media = $record->getFirstMedia('logo');//->getUrl();
            
            Companies::where('id', $record->id)
                ->update(
                    ['logo'=>$media->getUrl(), 'logo_url'=>$media->getFullUrl()]
                );
            
        }
        
        if ($record) {
            return response()->json([
                'status' => 'success',
                'msg' => 'success',
                'data' => $record,
            ]);
        }
        return response()->json([
            'status' => 'error',
            'msg' => '',
        ]);
    }
    
    public function update(Request $request, $id) {
        
        $validatedData = $this->validate($request, 
            [
                'name' => 'required|string|unique:users|max:255',
                'email' => 'sometimes|nullable',
                'website' => 'sometimes|nullable'
            ]
        );
        
        $record = Companies::where('id', $id)
            ->update(
                $validatedData
            );

        if(!empty($validatedData['logo'])) {
            
            
            
            $record->addMedia($validatedData['logo'])->toMediaCollection('logo');
            
            $media = $record->getFirstMedia('logo');//->getUrl();
            
            Companies::where('id', $record->id)
                ->update(
                    ['logo'=>$media->getUrl(), 'logo_url'=>$media->getFullUrl()]
                );
            
        }
        
        if ($record) {
            return response()->json([
                'status' => 'success',
                'msg' => 'success',
                'data' => $record,
            ]);
        }
        return response()->json([
            'status' => 'error',
            'msg' => '',
        ]);
    }
    
    function destroy($id) {
        $data = Companies::find($id);

        if(!empty($data->getMedia('logo'))) {
            $data->getMedia('logo')[0]->delete();
        }
        
        $data->delete();
        
        return response()->json([
            'status' => 'success',
            'msg' => 'success',
            'data' => $data,
        ]);
    }
}
