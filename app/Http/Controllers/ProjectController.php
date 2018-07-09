<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Folder;
use App\Project;
use App\User;

class ProjectController extends Controller
{
    /**
     * Create new Project
     */
    public function addProject(Request $request) {
        $project = Project::create([
            'title'         => $request['title'],
            'folder_id'     => $request['folder_id'],
            'description'   => $request['description'],
            'assigner'      => $request['assigner'],
            'type'          => $request['type'],
            'budget'        => $request['budget'],
        ]);

        if( $project ) {
            return response(array( 'status' => STATUS_SUCCESS, 'id' => $project['id'] ));
        }
    }
    //
    public function getProjectList(Request $request) {
        $folder_id = $request['folder_id'];
        $projects = Project::where('folder_id', '=', $folder_id)->get();

        for($i=0; $i<count($projects); $i++) {
            $assigner_id = $projects[$i]['assigner'];

            // Set the Project Number(Position)
            $projects[$i]['position'] = $i+1;

            //Get Assigner Name, Avatar in User Table
            $assigner = User::find($assigner_id);
            if ( $assigner && $assigner['photo_image'] ) {
                $projects[$i]['assigner'] = [ 'name' => $assigner['name'], 'photo' => $assigner['photo_image'] ];
            } else {
                $projects[$i]['assigner'] = [ 'name' => $assigner['name'], 'photo' => 'assets/images/avatars/profile.jpg' ];
            }

            // Set the Projects Team // field: team_members => [user_id, user_id, ...]
            $projects[$i]['team'] = [];
            $team_members = $projects[$i]['team_members'];
            $arr_members = [];  // temp json array for $project[$i]['team']
            $arr_member = explode(',', $team_members);
            for( $j=0; $j<count($arr_member); $j++ ) {
                $t_member = User::find($arr_member[$j]);
                if ( $t_member ) {
                    array_push($arr_members, array(
                        'id' => $t_member['id'], 
                        'name' => $t_member['name'], 
                        'photo' => $t_member['photo_image'] == '' ? 'assets/images/avatars/profile.jpg' : $t_member['photo_image']
                    ));
                }
            }
            $projects[$i]['team'] = $arr_members;
        }
        return response(array('data' => $projects, 'folder_id'=> $folder_id ));

        $array = [
            ['id' => '1', 'position'=> 1, 'name'=> 'Project1', 'created'=> '2018/06/28', 'type'=> 'Excel', 'team'=> 
                    [
                        ['id'=>'1', 'name'=>'RJ', 'photo'=>'/assets/images/avatars/rj.jpg'],
                        ['id'=>'2', 'name'=>'Alice', 'photo'=>'/assets/images/avatars/alice.jpg'],
                        ['id'=>'3', 'name'=>'Lily', 'photo'=>'/assets/images/avatars/Lily.jpg']
                    ],
                    
                    'filer' => 'RJ,Alice,Lily',
                    'assigner' => ['name' => 'Lily', 'photo' => '/assets/images/avatars/Lily.jpg'],
            ],
            ['id' => '2', 'position' => 2, 'name' => 'Project2', 'created' => '2018/06/25', 'type' => 'Todo', 'team' => 
                    [
                        ['id'=>'5', 'name'=>'Tyson', 'photo'=>'/assets/images/avatars/Tyson.jpg'],
                        ['id'=>'8', 'name'=>'Jane', 'photo'=>'/assets/images/avatars/jane.jpg'],
                        ['id'=>'4', 'name'=>'Boyle', 'photo'=>'/assets/images/avatars/Boyle.jpg']
                    ],
                    'filter' => 'Tyson,Jane,Boyle',
                    'assigner' => ['name' => 'Boyle', 'photo' => '/assets/images/avatars/Boyle.jpg'],
            ],
            ['id' => '3', 'position' => 3, 'name' => 'Project3', 'created' => '2017/12/24', 'type' => 'Excel', 'team' => 
                    [
                        ['id'=>'3', 'name'=>'Lily', 'photo' => '/assets/images/avatars/Lily.jpg'],
                        ['id'=>'15', 'name'=>'Nora', 'photo' => '/assets/images/avatars/Nora.jpg'],
                        ['id'=>'8', 'name'=>'Jane', 'photo' => '/assets/images/avatars/jane.jpg']
                    ],
                    'filer' => 'Lily,Nora,Jane',
                    'assigner' => ['name' => 'Nora', 'photo' => '/assets/images/avatars/Nora.jpg'],
            ],
            ['id' => '4', 'position' => 4, 'name' => 'Project4', 'created' => '2018/04/15', 'type' => 'Scrum', 'team' => 
                    [
                        ['id'=>'8', 'name'=>'Jane', 'photo' => '/assets/images/avatars/jane.jpg'],
                        ['id'=>'1', 'name'=>'RJ', 'photo' => '/assets/images/avatars/rj.jpg'],
                    ],
                    'filer' => 'Jane,RJ',
                    'assigner' => ['name' => 'RJ', 'photo' => '/assets/images/avatars/rj.jpg'],
            ],
            ['id' => '5', 'position' => 5, 'name' => 'Project5', 'created' => '2017/01/15', 'type' => 'Todo', 'team' => 
                    [
                        ['id'=>'2', 'name'=>'Lily', 'photo' => '/assets/images/avatars/Lily.jpg'],
                        ['id'=>'15', 'name'=>'Alice', 'photo' => '/assets/images/avatars/alice.jpg'],
                        ['id'=>'19', 'name'=>'Christy', 'photo' => '/assets/images/avatars/Christy.jpg'],
                        ['id'=>'18', 'name'=>'Katina', 'photo' => '/assets/images/avatars/Katina.jpg'],
                    ],
                    'filer' => 'Lily,Alice,Christy',
                    'assigner' => ['name' => 'Katina', 'photo' => '/assets/images/avatars/Katina.jpg'],
            ],
            ['id' => '6', 'position' => 6, 'name' => 'Project6', 'created' => '2018/08/12', 'type' => 'Excel', 'team' => 
                    [
                        ['id'=>'5', 'name'=>'Tyson', 'photo' => '/assets/images/avatars/Tyson.jpg'],
                    ],
                    'filer' => 'Tyson',
                    'assigner' => ['name' => 'Tyson', 'photo' => '/assets/images/avatars/Tyson.jpg'],
            ],
            ['id' => '7', 'position' => 7, 'name' => 'Project7', 'created' => '2017/1/24', 'type' => 'Excel', 'team' => 
                    [
                        ['id'=>'19', 'name'=>'Christy', 'photo' => '/assets/images/avatars/Christy.jpg'],
                        ['id'=>'1', 'name'=>'RJ', 'photo' => '/assets/images/avatars/rj.jpg'],
                    ],
                    'filer' => 'Cristy,RJ',
                    'assigner' => ['name' => 'RJ', 'photo' => '/assets/images/avatars/rj.jpg'],
            ],
            ['id' => '8', 'position' => 8, 'name' => 'Project8', 'created' => '2017/05/02', 'type' => 'Scrumb', 'team' => 
                    [
                        ['id'=>'7', 'name'=>'Barrera', 'photo' => '/assets/images/avatars/Barrera.jpg'],
                        ['id'=>'9', 'name'=>'Joyce', 'photo' => '/assets/images/avatars/joyce.jpg'],
                    ],
                    'filer' => 'Barrera, Joyce',
                    'assigner' => ['name' => 'Barrera', 'photo' => '/assets/images/avatars/Barrera.jpg'],
            ],
            ['id' => '9', 'position' => 9, 'name' => 'Project9', 'created' => '2018/04/18', 'type' => 'Todo', 'team' => 
                    [
                        ['id'=>'8', 'name'=>'Jane', 'photo' => '/assets/images/avatars/jane.jpg'],
                        ['id'=>'4', 'name'=>'Boyle', 'photo' => '/assets/images/avatars/Boyle.jpg'],
                    ],
                    'filer' => 'Jane,Boyle',
                    'assigner' => ['name' => 'Boyle', 'photo' => '/assets/images/avatars/Boyle.jpg'],
            ],
          ];
        return response(array('data' => $array));
    }

    public function getFolderList() {

        $folders = Folder::all();
        return response(array('data' => $folders));
    }

    /**
     * Add new folder
     * 
     * @param name = 'New Folder'(default)
     */
    public function addFolder(Request $request) {
        $name = $request['name'];
        $folder = Folder::create([
            'name' => $name,
        ]);

        if( $folder ) {
            return response(array( 'status' => STATUS_SUCCESS, 'id' => $folder['id'] ));
        }
    }

    /**
     * Delete folder
     * 
     * @param folder_id
     */
    public function deleteFolder(Request $request) {
        $folder_id = $request['folder_id'];
        $folder = Folder::find($folder_id);
        if ( $folder ) {
            $folder->delete();
        }
        return response(array( 'status' => STATUS_SUCCESS, 'folder_id' => $folder_id ));
    }

    /**
     * Get Folder
     * 
     * @param folder_id
     */
    public function getFolder(Request $request) {
        $folder_id = $request['folder_id'];
        $folder = Folder::find($folder_id);
        if ( $folder ) {
            return response(array( 'status' => STATUS_SUCCESS, 'data' => json_encode($folder) ));
        } else {
            return response(array( 'status' => STATUS_ERROR, 'data' => json_encode('{}') ));
        }
    }

    /**
     * Update folder
     * 
     * @param folder_id, folder_name
     */
    public function updateFolder(Request $request) {
        $folder_id   = $request['folder_id'];
        $folder_name = $request['folder_name'];
        $folder = Folder::find($folder_id);
        if ( $folder ) {
            $folder->name = $folder_name;
            $folder->save();
        }

        return response(array( 'status' => STATUS_SUCCESS ));
    }
}
