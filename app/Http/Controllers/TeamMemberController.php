<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    /**
     * Get team member list
     */

    public function getTeamMemberList() {
        $array = [
            ['id' => '1',  'position'=> 'Design Manager', 'name'=> 'RiJang', 'created'=> '2018/06/28', 'email'=> 'rj52@gmail.com', 
                'avatar' => '/assets/images/avatars/rj.jpg', 'phone' => '+12 554 545 9521' ],
            ['id' => '2',  'position'=> 'Recruiting Manager', 'name'=> 'Tyson', 'created'=> '2015/03/28', 'email'=> 'Tyson@gmail.com', 
                'avatar' => '/assets/images/avatars/Tyson.jpg', 'phone' => '+01 124 583 2118' ],
            ['id' => '3',  'position'=> 'Recruiting Manager', 'name'=> 'Boyle', 'created'=> '2018/06/28', 'email'=> 'Boyle@gmail.com', 
                'avatar' => '/assets/images/avatars/Boyle.jpg', 'phone' => '+02 123 548 2244' ],
            ['id' => '4',  'position'=> 'Electrical Engineer', 'name'=> 'Jane', 'created'=> '2018/06/28', 'email'=> 'Jane@gmail.com', 
                'avatar' => '/assets/images/avatars/jane.jpg', 'phone' => '+86 150 0154 5485' ],
            ['id' => '5',  'position'=> 'Actuary', 'name'=> 'Nora', 'created'=> '2018/06/28', 'email'=> 'Nora@gmail.com', 
                'avatar' => '/assets/images/avatars/Nora.jpg', 'phone' => '+81 154 5498 2156' ],
            ['id' => '6',  'position'=> 'Programmer Analyst', 'name'=> 'Lily', 'created'=> '2018/06/28', 'email'=> 'Lily@gmail.com', 
                'avatar' => '/assets/images/avatars/Lily.jpg', 'phone' => '+12 554 545 9521' ],
            ['id' => '7',  'position'=> 'Nurse Practicioner', 'name'=> 'Christy', 'created'=> '2018/06/28', 'email'=> 'Christy@gmail.com', 
                'avatar' => '/assets/images/avatars/Christy.jpg', 'phone' => '+12 554 545 9521' ],
            ['id' => '8',  'position'=> 'Help Desk', 'name'=> 'Katina', 'created'=> '2018/06/28', 'email'=> 'Katina@gmail.com', 
                'avatar' => '/assets/images/avatars/Katina.jpg', 'phone' => '+12 554 545 9521' ],
            ['id' => '9',  'position'=> 'Internal Auditor', 'name'=> 'Barrera', 'created'=> '2018/06/28', 'email'=> 'Barrera@gmail.com', 
                'avatar' => '/assets/images/avatars/Barrera.jpg', 'phone' => '+12 554 545 9521' ],
            ['id' => '10', 'position'=> 'Quality Control', 'name'=> 'Joyce', 'created'=> '2018/06/28', 'email'=> 'Joyce@gmail.com', 
                'avatar' => '/assets/images/avatars/joyce.jpg', 'phone' => '+12 554 545 9521' ],
            ['id' => '11', 'position'=> 'Electrical Engineer', 'name'=> 'Mai', 'created'=> '2018/06/28', 'email'=> 'Mai@gmail.com', 
                'avatar' => '/assets/images/avatars/Mai.jpg', 'phone' => '+12 554 545 9521' ],
            ['id' => '12', 'position'=> 'Director of Sales', 'name'=> 'Nancy', 'created'=> '2018/06/28', 'email'=> 'Nancy@gmail.com', 
                'avatar' => '/assets/images/avatars/Nancy.jpg', 'phone' => '+12 554 545 9521' ],
            ['id' => '13', 'position'=> 'Office Assistant', 'name'=> 'Arnold', 'created'=> '2018/06/28', 'email'=> 'Arnold@gmail.com', 
                'avatar' => '/assets/images/avatars/Arnold.jpg', 'phone' => '+12 554 545 9521' ],
          ];
        return response(array('data' => $array));
    }
}
