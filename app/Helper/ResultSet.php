<?php
namespace App\Helper;
class ResultSet{
	private $question = '';
	private $answer = '';
	private $correct_answer = '';

	public function __construct($question,$answer, $correct_answer){
		$this->question	= $question;
		$this->answer = $answer;
		$this->correct_answer = $correct_answer;
	}

	public function setQuestion($question){
		$this->question = $question;
	}

	public function getQuestion(){
		return $this->question;
	}

	public function setAnswer($answer){
		$this->answer = $answer;
	}

	public function getAnswer(){
		return $this->answer;
	}

	public function setCorrectAnswer($answer){
		$this->correct_answer = $answer;
	}

	public function getCorrectAnswer(){
		return $this->correct_answer;
	}
}