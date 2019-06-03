<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Project;

class ProjectController extends Controller
{
    /** ----------------------------------------------------
     * GetAllProjects
     * - Gets all projects from the projects table
     *
     * @param $companyId
     * @return String
     */
    public function getAllProjects($companyId = null) {

        if($companyId){
            $projects = Project::where('company_id', $companyId)->get();
        } else {
            $projects = Project::all();
        }

        return response()->json([
            'message' => 'Success',
            'data' => $projects
        ], 200);
    }

    /** ----------------------------------------------------
     * createProject
     * - Adds project to the projects table
     *
     * @param $request
     * @return string
     */
    public function createProject(Request $request) {

        $validator = Validator::make($request->all(), [
            'company_id' => 'required|int',
            'name' => 'required|string|max:255'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Did not pass validator.'
            ], 400);
        } else {
            $project = Project::create($request->all());

            if(!empty($project->id)) {
                return response()->json([
                    'message' => 'Successfully created project note with id '.$project->id,
                    'data' => $project
                ], 201);
            } else {
                return response()->json([
                    'message' => 'Failed uploading data in database.'
                ], 500);
            }
        }
    }

    /** ----------------------------------------------------
     * UpdateProject
     * - updates project with the correct id in the projects table
     *
     * @param $request
     * @param $projectId
     * @return string
     */
    public function updateProject(Request $request, $projectId) {

        $validator = Validator::make($request->all(), [
            'company_id' => 'required|int',
            'name' => 'required|string|max:255',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Did not pass validator.'
            ], 400);
        } else {

            if (intval($projectId) === 0) {
                return response()->json([
                    'message' => 'Invalid argument.'
                ], 400);
            } else {
                $project = Project::find($projectId);

                if(!empty($project)){
                    $project->company_id = $request->get('company_id');
                    $project->name = $request->get('name');

                    $project->save();


                    return response()->json([
                        'message' => 'Successfully updated project with id '.$project->id,
                        'data' => $project
                    ], 201);
                } else {
                    return response()->json([
                        'message' => 'Project with ID ' . $projectId . ' not found.'
                    ], 404);
                }
            }
        }
    }

    /** ----------------------------------------------------
     * deleteProject
     * - deletes project with the given id
     *
     * @param $projectId
     * @return string
     */
    public function deleteProject($projectId) {
        if(intval($projectId) === 0) {
            return response()->json([
                'message' => 'Invalid argument.'
            ], 400);
        } else {
            //check if record exists
            $project = Project::find($projectId);

            if(!empty($project)){
                $project->delete();
                return response()->json([
                    'message' => 'Succesfully removed project with id ' . $project->id
                ], 201);
            } else {
                return response()->json([
                    'message' => 'Project with ID ' . $projectId . ' not found.'
                ], 404);
            }

        }
    }
}
