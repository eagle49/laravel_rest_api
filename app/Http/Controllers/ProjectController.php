<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    //
    public function getProjectList() {
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
        $array = [
            [ 'id' => '1', 'name' => 'Folder1'],
            [ 'id' => '2', 'name' => 'Folder2'],
            [ 'id' => '3', 'name' => 'Folder3'],
            [ 'id' => '4', 'name' => 'Folder4'],
            [ 'id' => '5', 'name' => 'Folder5'],
        ];

        return response(array('data' => $array));
    }
}
