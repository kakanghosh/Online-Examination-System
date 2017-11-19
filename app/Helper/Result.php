<?php
namespace App\Helper;
class Result{
	private $totalQuestion = 0;
	private $answeredQuestion = 0;
	private $score = 0;
	
	public function __construct($totalQuestion, $answeredQuestion,$score){
		$this->totalQuestion = $totalQuestion;
		$this->answeredQuestion = $answeredQuestion;
		$this->score = $score;
	}

	public function setTotalQuestion($total){
		$this->totalQuestion = $total;
	}

	public function getTotalQuestion(){
		return $this->totalQuestion;
	}

	public function setAnsweredQuestion($number){
		$this->answeredQuestion = $number;
	}

	public function getAnsweredQuestion(){
		return $this->answeredQuestion;
	}

	public function setScore($score){
		$this->score = $score;
	}

	public function getScore(){
		return $this->score;
	}

	public function getAverageResult(){
		return  ( $this->getScore() / $this->getTotalQuestion() ) * 100;
	}
}