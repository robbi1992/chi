function progressColor(value){
	if(value >= 96 && value <= 100) {
		bg = 'progress-bar-aqua';
	}
	else if(value >= 85 && value <= 95) {
		bg = 'progress-bar-green';
	}
	else if(value >= 75 && value < 85) {
		bg = 'progress-bar-yellow';
	}
	else if(value >= 0 && value < 75) {
		bg = 'progress-bar-red';
	}
	else {
		bg = 'progress-bar-aqua';
	}
	return bg;
}