<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\Question;
use App\Helper\ResultSet;
use App\Helper\Result;
use Validator;
use DB;


class QuizController extends Controller
{
    //
    public function createQuestion(Request $request){

        if (!$request->session()->has('quiztitle')) {
    	   return view('quiz.createquestion');
        }else{
            return redirect()->route('Quiz.setQuizQuestion');
        }
    }

    public function setQuestionTitle(Request $request){
        //return $request->question_title;
        //TODO
        //Save Question Title
        //Validate
        $validator = Validator::make($request->all(),[
        	'question_title' => 'required'
        ]);
        if (!$validator->fails()) {
        	//This session will contain the title of the Quiz 
            //What the quiz is really describe
            $request->session()->put('quiztitle',$request->question_title);
            //This session is for maintaing the question in tempory period
            $request->session()->put('question_temp_id',1);

        	return redirect()->route('Quiz.setQuizQuestion');
        }else{
        	return redirect()->route('Quiz.createQuestion')
        			->withErrors($validator);
        }

    }

    public function setQuizQuestion(Request $request){
        if ($request->session()->has('quiztitle')) {
            return view('quiz.setquizquestion');
        }else{
            return redirect()->route('User.index');
        }
    }


    public function saveQuestionLocally(Request $request){

        $validator = Validator::make($request->all(),[
                'qsn' => 'required',
                'opt.*' => 'required',
                'correct_ans' => 'required'
        ]);
    
        if ($validator->fails()) {
            $request->session()->flash('error','Field is can not be empty');
            return redirect()->route('Quiz.setQuizQuestion')
                                ->withErrors($validator);
        }

        if ($request->option_type == 'MC') {
            if (!isset($request->opt)) {
                $request->session()->flash('MC','Multiple Choice Question need option');
                return redirect()->route('Quiz.setQuizQuestion');
            }
        }else if($request->option_type == 'TF'){
            //TODO
            //Check correct answer value is true / false
            //If Not generate an error flash message
            if (strtoupper($request->correct_ans) != 'TRUE' && strtoupper($request->correct_ans) != 'FALSE' ) {
                # code...
                $request->session()->flash('TF','True/False  Question Correct answer should be true / False');
                return redirect()->route('Quiz.setQuizQuestion');
            }
        }

        //Created New Question Obj
        //Set the value
        $qsn = new Question();
        $qsn->setQuestionTempID( $request->session()->get('question_temp_id'));
        $qsn->setQuestion($request->qsn);
        $qsn->setQuestionType($request->option_type);
        $qsn->setDifficultyLevel($request->difficulty_level);
        if (isset($request->opt)) {
            //IF multple choice
            if ($request->option_type == 'MC') {
                foreach ($request->opt as $option) {
                    $qsn->addOption($option);
                }
            }
        }else if($request->option_type == 'TF'){
                $qsn->addOption('true');
                $qsn->addOption('false');
        }

        $qsn->addCorrectAnswer($request->correct_ans);
            
        if ($request->session()->has('questionset')) {
            $request->session()->push('questionset',$qsn);
        }else{
            $request->session()->put('questionset',[$qsn]);
        }
        $temp_id = $request->session()->get('question_temp_id') + 1;
        //echo $request->session()->get('question_temp_id');
        $request->session()->put('question_temp_id',$temp_id);
        //echo $request->session()->get('question_temp_id');
        return redirect()->route('Quiz.setQuizQuestion');
    }

    public function deleteQuestion(Request $request,$temp_id){
         if ($request->session()->has('questionset')) {
            $questionSet = $request->session()->get('questionset'); //Get all the Questions

            foreach($questionSet as $key => $eachQuestion) { 
                if ($eachQuestion->getQuestionTempID() == $temp_id) { //Checking for matching with delete question ID
                    unset($questionSet[$key]); // Unset the variable from the array
                    break;
                }
            }
            if (sizeof($questionSet) == 0) {
                /*
                   If Array size is 0 then remove the session 
                    variable
                */
                $request->session()->forget('questionset');
            }else{
                //If question set array size is not 0
                //then update the session variable
                $request->session()->put('questionset',$questionSet);
            }
            //After redirect to question set page
            return redirect()->route('Quiz.setQuizQuestion');
         }
    }


    public function finishCreatingQuiz(Request $request){
        $minimumQues = 2;
        $userid = $request->session()->get('userid');
        //return $userid;
        if ($request->session()->has('questionset')) {
           
            $questions = $request->session()->get('questionset');

            /*echo "<pre>";
            print_r($questions);
            echo "</pre>";
            return;*/
           
           //Checking for minimum question in set
            if (sizeof($questions) >= $minimumQues) {
                $title = $request->session()->get('quiztitle');
                $question_set_id = DB::table('questions_set_table')
                                ->insertGetId([
                                    'question_set_title' => $title,
                                    'user_id' => $userid,
                                    'date_time' => date("Y-m-d h:i:s")
                                ]); 
                //Inserting all the question of a question set                    
                foreach ($questions as $question) {

                   $question_id = DB::table('questions_details_table')->insertGetId([
                                    'question_set_id' => $question_set_id,
                                    'question' => $question->getQuestion(),
                                    'option_type' => $question->getQuestionType(),
                                    'difficulty_level' => $question->getDifficultyLevel(),
                                    'correct_answer' => $question->getCorrectAnswer()[0]
                                ]);
                   //Insert all the option for a particular question
                    for ($opt=0; $opt < sizeof($question->getOptionList()); $opt++) { 
                    
                        DB::table('questions_options_table')->insert([
                            'question_id' => $question_id,
                            'options' => $question->getOptionList()[$opt]
                        ]);
                    }
                }
                $request->session()->forget('quiztitle');
                $request->session()->forget('questionset');
            }else{
                return 'Minimum number of question not full fill : minimum '.$minimumQues;
            }
           
        }
        return redirect()->route('User.index');
    }


    public function cancelQuizQuestion(Request $request){
        if ($request->session()->has('quiztitle')) {
            $request->session()->forget('quiztitle');
        }
        if ($request->session()->has('questionset')) {
            $request->session()->forget('questionset');
        }
        return redirect()->route('User.index');
        
    }



    public function showAllExams(Request $request){
        $questoin_set = DB::table('questions_set_table')
                        ->where('user_id',$request->session()->get('userid'))
                        ->get();
        /*  
            Arrays Representation
            Array key is the question set ID
            index [0] = Question set title
            index [1] = No of Question
            index [2] = Question set status // status = 1 (Active)
                                            // status = 0 (Deactive)
        */
        $question_arr = [];


        foreach ($questoin_set as  $qsn) {
        	$no_of_question = sizeof( 
        						DB::table('questions_details_table')
        				 		->where('question_set_id',$qsn->question_set_id)
        				 		->get()
        					);
        	//Insert value in the array
            $question_arr[$qsn->question_set_id] = [

                $qsn->question_set_title,
                $no_of_question,
                $qsn->status
            ];
        }

        return view('quiz.exams')
                ->withExams($question_arr);
    }

    public function updateQuestionStatus(Request $request){
        if (isset($request->questionid) && isset($request->status)) { 
            if( $request->status == 'active'){
                DB::table('questions_set_table')
                    ->where('question_set_id',$request->questionid)
                    ->update([
                        'status' => 1
                    ]);
            }else if( $request->status == 'deactive'){
                DB::table('questions_set_table')
                    ->where('question_set_id',$request->questionid)
                    ->update([
                        'status' => 0
                    ]);
            }
        }
    }



    public function showResultHistory(Request $request,$exam_title, $question_set_id){
        $result_set = [];
        $userid = $request->session()->get('userid');
        $resultHistory = DB::table('results_table')
                         ->where('question_set_id',$question_set_id)
                         ->get();
        /*echo "<pre>";
        print_r($resulthistory);
        echo "</pre>";*/
        foreach ($resultHistory as $key => $value) {
            //echo "<pre>";
            $user = DB::table('users_table')
                    ->where('user_id',$value->user_id)
                    ->first();
            $fullname =  $user->first_name.','.$user->last_name;
            $result = $value->result;
            array_push($result_set, [$fullname,$result]);
        }

        //echo "<pre>";
        //print_r($result_set);
        //echo "</pre>";
        return view('quiz.showresulthistory')
                ->withResultset($result_set)
                ->withExamtitle($exam_title);
    }  



    public function startExam(Request $request, $examtitle, $examid){

        //First Check that the question set status is active or not
        $qsn = DB::table('questions_set_table')
                    ->where('question_set_id',$examid)
                    ->first();
    	
        //Is not active then 0
        if($qsn->status == 0){
            return redirect()->route('User.index');
        }

        //Or the rest of the work
        $request->session()->put('examtitle',$examtitle);
    	
        $question_array = [];
    	
        $question_set = DB::table('questions_set_table')
    					->join('questions_details_table','questions_set_table.question_set_id','questions_details_table.question_set_id')
    					->where('questions_set_table.question_set_id',$examid)
    					->get();
    	
    	foreach ($question_set as $question) {

    		$each_question = new Question();
    		$each_question->setQuestionID($question->question_id);
    		$each_question->setQuestion($question->question);
    		$each_question->setQuestionType($question->option_type);

    		$options = DB::table('questions_options_table')
    					->where('question_id',$question->question_id)
    					->get();
    		foreach ($options as $option) {
    			$each_question->addOption($option->options);
    		}
    		array_push($question_array, $each_question);
    	} 
    	return view('quiz.startexam')
    			->withQuestions($question_array)
                ->withExamtitle($examtitle);
    }


    public function finishQuiz(Request $request, $examtitle, $examid){
    	//Take the answer 
    	//Compare with the correct answer
    	//Create result sheet

    	$allQuestions = $request->session()->get('allquestions');
    	/*echo "<pre>";
    	print_r($allQuestions);
    	echo "</pre>";	
    	return;*/
    	$no_of_question =  sizeof($allQuestions);
    	$no_question_answered = 0;
    	$score = 0;
    	echo '<pre>';
    	$result_set_array = [];
    	//Evalute question answer
    	foreach ($_POST as $questionid => $answer) {
    		//Ignore other two data
    		if ($questionid == '_token' || $questionid == 'submit') {
    			continue;
    		}
    		$no_question_answered += 1; //Counting how many answer given

    		//Get the correct answer according to the question ID
     		$correct_ans = DB::table('questions_details_table')
     						->where('question_id',$questionid)
     						->first()->correct_answer;
    		//echo 'Your Answer: '.$answer.' <br/>Correct answer: '.$correct_ans.'<br/><br/>';
    		$resultset = new ResultSet($this->getQuestionTitle($allQuestions,$questionid),$answer,$correct_ans);
    		array_push($result_set_array, $resultset);
    		if ($answer == $correct_ans) {
    			$score += 1;
    		}
    	}

    	$result = new Result($no_of_question,$no_question_answered,$score);
    	/*echo '</pre>';
    	//$scoreInPercentage = ($score/$no_of_question)*100;
    	echo 'Total Question: '.$no_of_question.'<br/>';
    	echo 'Answered Question number: '.$no_question_answered.'<br/>';
    	echo 'Your Score: '.$scoreInPercentage.' %<br/>'; */
    	/*
    	echo '<pre>';
    	print_r($result_set_array);
    	echo '</pre>';

    	echo '<pre>';
    	print_r($result);
    	echo $result->getAverageResult();
    	echo '</pre>'; */
    	$request->session()->put('resultset',$result_set_array);
    	$request->session()->put('result',$result);
    	DB::table('results_table')->insert([
    			'question_set_id' => $examid,
    			'user_id' => $request->session()->get('userid'),
    			'result' => $result->getAverageResult()
    		]);
    	return redirect()->route('Quiz.showResult');
    }

    public function showResult(){
    	
    	return view('quiz.showresult');
    }



    private function getQuestionTitle($allQuestion, $questionID){
    	foreach ($allQuestion as $question) {
    		if ($question->getQuestionID() == $questionID) {
    			return $question->getQuestion();
    		}
    	}
    }

}
