<?php
namespace App\Helper;
class Question{

	private $question_temp_id = '';
	private $question_id = '';
	private $question = '';
	private $question_type = '';
	private $difficulty_level = '';
	private $options_list = [];
	private $correct_answer = [];

	public function __construct(){
		//Default constructor
	}

	public function setQuestionTempID($tempID){
		$this->question_temp_id = $tempID;
	}

	public function getQuestionTempID(){
		return $this->question_temp_id;
	}

	public function setQuestion($qsn){
		$this->question = $qsn;
	}
	public function getQuestion(){
		return $this->question;
	}
	public function setQuestionType($type){
		$this->question_type=$type;
	}
	public function getQuestionType(){
		return $this->question_type;
	}

	//This method will set the question difficulty level
	public function setDifficultyLevel($level){
		$this->difficulty_level = $level;
	}

	//This method will return the question difficulty level
	public function getDifficultyLevel(){
		return $this->difficulty_level;
	}

	public function addOption($option){
		//$this->options_list[sizeof($this->options_list)] = $option;
		array_push($this->options_list, $option);
	}
	public function addCorrectAnswer($answer){
		//$this->correct_answer[sizeof($this->correct_answer)] = $answer;
		array_push($this->correct_answer, $answer);
	}

	public function getOptionList(){
		return $this->options_list;
	}

	public function getCorrectAnswer(){
		return $this->correct_answer;
	}

	public function setQuestionID($id){
		$this->question_id = $id;
	}

	public function getQuestionID(){
		return $this->question_id;
	}

}