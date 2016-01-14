class InputDate extends Date {
	toString() {
		return `${this.getFullYear()}-${this.getCalendarMonth()}-${this.getDate()}`;
	}
	getCalendarMonth() {
		if (super.getMonth() < 9) {
			return `0${super.getMonth() + 1}`;
		} else {
			return `${super.getMonth() + 1}`;
		}
	}
}
