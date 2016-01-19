<?php
/*
	logic : Taking suduku board is of 9X9 rows and column
	
	every row should have 1,2,3,4,5,6,7,8,9 or sumation = 45, function checkColumnAndRowSummation()
	every column should have sumation = 45, function checkColumnAndRowSummation()
	every (3X3) box should have sumation = 45 function checkBoxSummation()
*/


class checkSuduku{
	public $rowArr = array();
	public function __construct($file_name){
		$inputs = file_get_contents('./'.$file_name);
		$this->rowArr = preg_split('/\n/', trim(file_get_contents('./'.$file_name)));
		for($r=0; $r<count($this->rowArr); $r++){
			$this->rowArr[$r] = trim(strval($this->rowArr[$r]));
		}
	}
	
	
	public function checkValid(){
		$this->checkColumnAndRowSummation();
		if(!$this->checkValidInput() || !$this->checkColumnAndRowSummation() || !$this->checkBoxSummation()){  //if any return of the three function return 0 output 0
			echo 0;
		} else { //else output 1
			echo 1;
		}
	}
	
	//suduku board every column sum is 45
	//suduku board every row sum is 45
	private function checkColumnAndRowSummation(){
		for($r=0; $r<9; $r++){ 
			$rowSum = 0;
			$columnSum = 0; 
			for($c=0; $c<9; $c++){ 
				$rowSum += intval($this->rowArr[$r][$c]); //sum of row 1,2,3 ....
				$columnSum += intval($this->rowArr[$c][$r]); //sum of column 1,2,3 ...
			}
			if($rowSum != 45 || $columnSum !=45){ //if sum of each row or column is not 45, Output 0 and no more excution 
				return 0;
			}
		}
		return 1; //if all row and column sum is 45
	}


	//suduku board 3X3 boxes digits sum is 45
	private function checkBoxSummation(){
		$boxSum1 = $boxSum2 = $boxSum3 = 0;
		for($r=0; $r<9; $r++){ 
			for($c=0; $c<3; $c++){ //taking first 3 column 
				$boxSum1 += $this->rowArr[$r][$c];
			}
			for(; $c<6; $c++){ //taking second 3 column 
				$boxSum2 += $this->rowArr[$r][$c];
			}
			for(; $c<9; $c++){ //taking third 3 column 
				$boxSum3 += $this->rowArr[$r][$c];
			}
			if($r%3==2){ //If box is compleated with 3 rows
				if($boxSum1!=45 || $boxSum2!=45 || $boxSum3!=45){
					return 0;
				}
				$boxSum1 = $boxSum2 = $boxSum3 = 0; //set sum 0 to inisiate next box will start
			}
		}
		return 1; //if all box are sum of 45
	}
	
	
	
	private function checkValidInput(){ 
		//9 column exist check
		if(count($this->rowArr)!=9){ //if there is not excact 9 row, return 0 and no more excution.
			return 0;
		} 
		
		//9 row check
		for($r=0; $r<count($this->rowArr); $r++){
			if(strlen($this->rowArr[$r])!=9){ //if there is not excact 9 row, return 0 and no more excution.
				return 0;
			}
		}
		return 1;  //if 9 row and 9 column are there return 1
	}
}

$x = new checkSuduku('input.txt');
$x->checkValid();


?>