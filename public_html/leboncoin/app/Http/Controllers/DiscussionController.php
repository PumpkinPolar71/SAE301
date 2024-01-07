<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiscussionController extends Controller
{
    //_______________________________________________.Redirection.___________________________________________________//
        public function mes_messages()
        {
            return redirect('/Discussion/mes_messages');            #DiscussionFolder
        }
    //
}
