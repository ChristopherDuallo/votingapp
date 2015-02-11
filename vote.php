<?php 
if(!isset($_SESSION)){
	session_start();
}
$name = $_SESSION['name'];
$fbid = $_SESSION['fbid'];
date_default_timezone_set('Africa/Nairobi');
$date = date('Y-m-d H:i:s', time());
class vote{

	function __construct($fbid){
		$this->fbid=$fbid;
	}

	function check_votes_today(){
		$fbid = $_SESSION['fbid'];
		try {
			include('connection.php');
			$query = $dbh->prepare('SELECT votes_today FROM fblogin WHERE fbid=?');
			$query->execute(array($fbid));

			while($row = $query->fetch()){
				$votes_today = $row['votes_today'];
				return $votes_today;
			}
			
			
			
		} 
		catch (PDOException $e) {
			echo $e->getMessage();
		}
	}


	function votes_today(){
		$votes_today = $this->check_votes_today();
		$votes_today+=1;
		return $votes_today;
	}


	function can_vote_today(){
		$votes_today = $this->check_votes_today();
		if($votes_today<3){
			return true;
		}
		else{
			return false;			
		}
	}



	function record_vote(){
		try {
			$votes_today = $this->votes_today();
			$fbid = $_SESSION['fbid'];
			include('connection.php');
			$last_voted = date('Y-m-d H:i:s', time());
			$fruit = $_POST['fruit'];
			$query = $dbh->prepare('INSERT INTO votes(fbid, fruit) VALUES(:fbid, :fruit)');
			$query->execute(array(':fbid'=>$fbid, ':fruit'=>$fruit));

			$query2= $dbh->prepare('UPDATE fblogin SET last_voted=?, votes_today=? WHERE fbid=?');
			$query2->execute(array($last_voted, $votes_today, $fbid));
			if($query && $query2){
				header("location:result.php");
				$left = 3-$votes_today;
				echo'You have '.$left.' vote(s) left to cast today';
			}
		} 
		catch (PDOException $e) {
			echo $e-> getMessage();
		}

	}

	function daily_reset(){
		$timenow = date('Y-m-d H:i:s', time());
		$timenow = new DateTime();
		$votes_today = $this->check_votes_today();
		if($votes_today ==3){
			echo'Resetting daily vote...<br>';
			try {
					include('connection.php');
					$fbid = $_SESSION['fbid'];
					$query = $dbh->prepare('SELECT last_voted FROM fblogin WHERE fbid=?');
					$query->execute(array($fbid));

					while($row = $query->fetch()){
						$last_voted = $row['last_voted'];
						$last_voted = new DateTime();
						$diff = $timenow->diff($last_voted);
						$hours = $diff->h;
						$hours = $hours + ($diff->days*24);
						if($hours <24){
							return false;
						}
						else{
							$query = $dbh->prepare('UPDATE fblogin SET votes_today=0 WHERE fbid=?');
							$query->execute(array($fbid));
							if($query){
							return true;
							}
						}

					}
				} 
			catch (PDOException $e) {
					echo $e->getMessage;	
			}
		}	
	}


	function vote_tally(){
		include 'connection.php';
		try {
			$query = $dbh->prepare('SELECT fruit FROM votes');
			$query->execute();
			
			$resultArray = array();
			while($row = $query->fetch()){
				$resultArray[] = $row;
			}

			$apple = array();
			$mango = array();
			$grape = array();

			foreach($resultArray as $fruit){
				if(in_array('apple', $fruit)){
					array_push($apple, $fruit);
				}
				else if(in_array('mango', $fruit)){
					array_push($mango, $fruit);
				}
				else{
					array_push($grape, $fruit);
				}

			}

			$total = sizeof($resultArray);
			$appleTally = sizeof($apple);
			$mangoTally = sizeof($mango);
			$grapeTally = sizeof($grape);

			$applevotes = ($appleTally/$total)*100;
			$applevotes = round($applevotes,2);

			$mangovotes = ($mangoTally/$total)*100;
			$mangovotes = round($mangovotes,2);

			$grapevotes = ($grapeTally/$total)*100;
			$grapevotes = round($grapevotes,2);

			echo '<u>RESULTS</u><br>';
			echo 'Grapes '.$grapevotes.'%'.'<br><br>';
			echo 'Apples '.$applevotes.'%'.'<br><br>';
			echo 'Mangoes '.$mangovotes.'%'.'<br><br>';


		} 
		catch (PDOException $e) {
			echo $e->getMessage();
		}

	}

}

?>