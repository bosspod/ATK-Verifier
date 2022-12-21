var pastTime = <?php echo $EndTime;?>; 

function mycountdown(){ 
      if(pastTime > 0) { 
            pastTime -= 1; 
            document.getElementById('timer').innerHTML = pastTime; 
      } 
if(pastTime < 1) { 
            window.location = "/eng/index.php" 
      } 
} 
	if(pastTime >0){
		setInterval(mycountdown,1000); 
	}