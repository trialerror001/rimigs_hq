<?php

namespace App\Http\Controllers;

use App\Quest;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestController extends Controller
{
    public function form(){
        return view ('quests.questform');
    }

    public function addQuest(){
        $quest = new Quest();

        $quest->title = request('questTitle');
        $quest->desc = request('questDesc');
        $quest->exp = request('exp');
        $quest->level = request('level');
        $quest->max_player = request('maxPlayer');
        $quest->id_subject = request('subject');
        $quest->status = "Active";

        $quest->save();

        $subjects = Subject::findOrFail($quest->id_subject);

        return redirect()->route('showQuest',$subjects->subject_name)->with('success','Quest Added Successfully');
    }

    public function showQuest($subject){
        //$quests = Quest::orderBy('level','asc')->findOrFail($subjectId)->get();
        $quests = DB::table('quests')
            ->select('quests.*','subjects.subject_name')
            ->join('subjects','subjects.id','=','quests.id_subject')
            ->where('subjects.subject_name','=',$subject)
            ->orderBy('quests.level','asc')
            ->get();
        return view('quests.showquest', compact('quests'));
    }

    public function editQuest($id){
        $quests = Quest::findOrFail($id);
        $subjects = Subject::all();
        $selectedSubject = Subject::findOrFail($quests->id_subject);
        return view('quests.editquest', compact(['quests', 'subjects','selectedSubject']));
    }

    public function updateQuest(Request $request, $id){
        $this->validate($request,[
            'questTitle' => 'required',
            'questDesc' => 'required',
            'exp' => 'required',
            'level' => 'required',
            'maxPlayer' => 'required',
            'subject' => 'required'
        ]);

        $quests = Quest::findOrFail($id);
        $quests->title = $request->questTitle;
        $quests->desc = $request->questDesc;
        $quests->exp = $request->exp;
        $quests->level = $request->level;
        $quests->max_player = $request->maxPlayer;
        $quests->id_subject = $request->subject;

        $subjectName = Subject::findOrFail($quests->id_subject);

        $quests->save();
        return redirect()->route('showQuest',$subjectName->subject_name)->with('success','Quest Updated Successfully');
    }

    public function destroyQuest($id){
        $quests = Quest::findOrFail($id);
        $subjectName = Subject::findOrFail($quests->id_subject);
        $quests->delete();
        return redirect()->route('showQuest',$subjectName->subject_name)->with('success','Quest Deleted Successfully');
    }

}
