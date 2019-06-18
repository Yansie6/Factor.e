<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Video;
use App\Project;
use App\Note;
use App\Video_note;
use App\Company;

class API extends Controller
{

    /** ----------------------------------------------------
     * Get
     *
     * @param $type
     * @param $linkedId
     * @return string
     */
    public function get($type, $linkedId = false) {

        $typeVariables = $this->_getTypeVariables($type);

        if($typeVariables['valid']){
            if ($linkedId && $type !== 'company') {
                $items = $typeVariables['model']::where($typeVariables['linkedTable'], $linkedId)->get();
            } else {
                $items = $typeVariables['model']::all();
            }

            $message = 'Success';
            $data = $items;
            $httpResponseCode = 200;
        } else {
            $message = 'Not Found';
            $data = '';
            $httpResponseCode = 404;
        }

        return response()->json([
            'message' => $message,
            'data' => $data
        ], $httpResponseCode);
    }

    /** ----------------------------------------------------
     * Create
     *
     * @param $request
     * @param $type
     * @return string
     */
    public function create(Request $request, $type) {

        $typeVariables = $this->_getTypeVariables($type);

        if($typeVariables['valid']){
            $isValid = $this->_checkIfValid($request->all(), $typeVariables['fields']);

            if ($isValid) {
                $item = $typeVariables['model']::create($request->all());
                if(!empty($item->id)) {
                    $message = 'Successfully added ' . $type . ' with id '.$item->id;
                    $data = $item;
                    $httpResponseCode = 201;
                } else {
                    $message = 'Failed uploading data in database.';
                    $data = '';
                    $httpResponseCode = 500;
                }
            } else {
                $message = 'Did not pass validator.';
                $data = '';
                $httpResponseCode = 400;
            }
        } else {
            $message = 'Not Found';
            $data = '';
            $httpResponseCode = 404;
        }

        return response()->json([
            'message' => $message,
            'data' => $data
        ], $httpResponseCode);
    }

    /** ----------------------------------------------------
     * Update
     *
     * @param $request
     * @param $type
     * @param $id
     * @return string
     */
    public function update(Request $request, $type ,$id) {

        $typeVariables = $this->_getTypeVariables($type);

        if($typeVariables['valid']){
            $isValid = $this->_checkIfValid($request->all(), $typeVariables['fields']);

            if ($isValid) {
                if (intval($id) === 0) {
                    $message = 'Invalid argument.';
                    $data = '';
                    $httpResponseCode = 400;
                } else {
                    $item = $typeVariables['model']::find($id);

                    if (!empty($item)) {
                        foreach ($typeVariables['fields'] as $key => $field){
                            $item->$key= $request->get($key);
                        }
                        $item->save();

                        $message = 'Successfully updated note with id ' . $item->id;
                        $data = $item;
                        $httpResponseCode = 201;
                    } else {
                        $message = $type.' with ID ' . $id . ' not found.';
                        $data = '';
                        $httpResponseCode = 404;
                    }
                }
            } else {
                $message = 'Did not pass validator.';
                $data = '';
                $httpResponseCode = 400;
            }
        } else {
            $message = 'Not Found';
            $data = '';
            $httpResponseCode = 404;
        }

        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $httpResponseCode);
    }

    /** ----------------------------------------------------
     * Delete
     *
     * @param $type
     * @param $id
     * @return string
     */
    public function delete($type, $id) {
        $typeVariables = $this->_getTypeVariables($type);

        if($typeVariables['valid']){
            if (intval($id) === 0) {
                $message = 'Invalid argument.';
                $data = '';
                $httpResponseCode = 400;
            } else {
                $item = $typeVariables['model']::find($id);

                if (!empty($item)) {
                    $item->delete();

                    $message = 'Succesfully removed '.$type.' with id ' . $id;
                    $data = '';
                    $httpResponseCode = 200;
                } else {
                    $message = $type.' with ID ' . $id . ' not found.';
                    $data = '';
                    $httpResponseCode = 404;
                }
            }
        } else {
            $message = 'Not Found';
            $data = '';
            $httpResponseCode = 404;
        }

        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $httpResponseCode);

    }

    /** ----------------------------------------------------
     * _checkIfValid
     *
     * @param $data
     * @param $fields
     * @return bool
     */
    private function _checkIfValid($data, $fields){

        $validator = Validator::make($data, $fields);

        if ($validator->fails()) {
            $returnValue = false;
        } else {
            $returnValue = true;
        }

        return $returnValue;
    }

    /** ----------------------------------------------------
     * _getTypeVariables
     *
     * @param $type
     * @return array
     */
    private function _getTypeVariables($type){

        $returnArray = [];
        $returnArray['valid'] = true;

        switch ($type) {
            case 'video':
                $returnArray['model'] = Video::class;
                $returnArray['linkedTable'] = 'project_id';
                $returnArray['fields'] = [
                    'project_id' => 'required|int',
                    'name' => 'required|string|max:255',
                    'link' => 'required|string|max:255',
                    'test_person' => 'required|string|max:255'
                ];
                break;

            case 'project':
                $returnArray['model'] = Project::class;
                $returnArray['linkedTable'] = 'company_id';
                $returnArray['fields'] = [
                    'company_id' => 'required|int',
                    'name' => 'required|string|max:255',
                    'status' => 'required|int|max:11',
                    'last_updated_by' => 'required|int|max:11'
                ];
                break;

            case 'note':
                $returnArray['model'] = Note::class;
                $returnArray['linkedTable'] = 'project_id';
                $returnArray['fields'] = [
                    'project_id' => 'required|int',
                    'title' => 'required|string|max:255',
                    'content' => 'required|string'
                ];
                break;

            case 'video-note':
                $returnArray['model'] = Video_note::class;
                $returnArray['linkedTable'] = 'video_id';
                $returnArray['fields'] = [
                    'video_id' => 'required|int',
                    'content' => 'required|string',
                    'timestamp' => 'required',
                    'type' => 'required|int'
                ];
                break;

            case 'company':
                $returnArray['model'] = Company::class;
                $returnArray['linkedTable'] = '';
                $returnArray['fields'] = [
                    'name' => 'required|string|max:255',
                    'address' => 'required|string|max:255',
                    'phone' => 'required|string|max:255',
                    'email' => 'required|string|max:255',
                    'image' => 'required|string|max:255'
                ];
                break;

            default:
                $returnArray['valid'] = false;

        }

        return $returnArray;

    }
}