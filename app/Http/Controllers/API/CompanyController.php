<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Company;

class CompanyController extends Controller
{
    /** ----------------------------------------------------
     * GetAllCompanies
     * - Gets all companies from the companies table
     *
     * @return String
     */
    public function getAllCompanies() {

        $companies = Company::all();

        return response()->json([
            'message' => 'Success',
            'data' => $companies
        ], 200);
    }

    /** ----------------------------------------------------
     * createCompany
     * - Adds company to the companies table
     *
     * @param $request
     * @return string
     */
    public function createCompany(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|max:255',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Did not pass validator.'
            ], 400);
        } else {
            $company = Company::create($request->all());

            if(!empty($company->id)) {
                return response()->json([
                    'message' => 'Successfully created company with id '.$company->id,
                    'data' => $company
                ], 201);
            } else {
                return response()->json([
                    'message' => 'Failed uploading data in database.'
                ], 500);
            }
        }
    }

    /** ----------------------------------------------------
     * UpdateCompany
     * - updates project with the correct id in the projects table
     *
     * @param $request
     * @param $companyId
     * @return string
     */
    public function updateCompany(Request $request, $companyId) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|max:255',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Did not pass validator.'
            ], 400);
        } else {

            if (intval($companyId) === 0) {
                return response()->json([
                    'message' => 'Invalid argument.'
                ], 400);
            } else {
                $company = Company::find($companyId);

                if(!empty($company)){
                    $company->name = $request->get('name');
                    $company->address = $request->get('address');
                    $company->phone = $request->get('phone');
                    $company->email = $request->get('email');
                    $company->save();

                    return response()->json([
                        'message' => 'Successfully updated company with id '.$company->id,
                        'data' => $company
                    ], 201);
                } else {
                    return response()->json([
                        'message' => 'Project with ID ' . $companyId . ' not found.'
                    ], 404);
                }
            }
        }
    }

    /** ----------------------------------------------------
     * deleteCompany
     * - deletes company with the given id
     *
     * @param $companyId
     * @return string
     */
    public function deleteCompany($companyId) {
        if(intval($companyId) === 0) {
            return response()->json([
                'message' => 'Invalid argument.'
            ], 400);
        } else {
            //check if record exists
            $company = Company::find($companyId);

            if(!empty($company)){
                $company->delete();
                return response()->json([
                    'message' => 'Succesfully removed company with id ' . $company->id
                ], 201);
            } else {
                return response()->json([
                    'message' => 'Project with ID ' . $companyId . ' not found.'
                ], 404);
            }

        }
    }
}
