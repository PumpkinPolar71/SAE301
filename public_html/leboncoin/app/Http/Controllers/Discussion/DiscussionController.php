<?php

namespace App\Http\Controllers\Discussion;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class DiscussionController extends Controller
{
    //_______________________________________________.Redirection.___________________________________________________//
        public function mes_messages()
        {
            return redirect('discussion/mes_messages');    
        }
    //
}
