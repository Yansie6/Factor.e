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
    public function getAllProjects($companyId = false) {

        if(!empty($companyId)){
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
     * addProject
     * - Adds project to the projects table
     *
     * @param Request $request
     * @return string
     */
    public function addProject(Request $request) {

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
                    'message' => 'Successfully added project note with id '.$project->id,
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
     * @param $project_id
     * @return string
     */
    public function updateProject(Request $request, $project_id) {

        $validator = Validator::make($request->all(), [
            'project_id' => 'required|int',
            'name' => 'required|string|max:255',
            'link' => 'required|string|max:255'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Did not pass validator.'
            ], 400);
        } else {

            if (intval($project_id) === 0) {
                return response()->json([
                    'message' => 'Invalid argument.'
                ], 400);
            } else {
                $project = Project::find($project_id);

                $project->project_id = $request->get('project_id');
                $project->name = $request->get('name');
                $project->link = $request->get('link');

                $project->save();

                return response()->json([
                    'message' => 'Successfully updated project with id '.$project->id,
                    'data' => $project
                ], 201);
            }
        }
    }

    /** ----------------------------------------------------
     * deleteProject
     * - deletes project with the given id
     *
     * @param $project_id
     * @return string
     */
    public function deleteProject($project_id) {
        if(intval($project_id) === 0) {
            return response()->json([
                'message' => 'Invalid argument.'
            ], 400);
        } else {
            //check if record exists
            $project = Project::find($project_id);

            if(!empty($project)){
                Project::find($project_id)->delete();
                return response()->json([
                    'message' => 'Succesfully removed project with id ' . $project->id
                ], 201);
            } else {
                return response()->json([
                    'message' => 'Project with ID ' . $project_id . ' not found.'
                ], 404);
            }

        }
    }
}
