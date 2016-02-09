export default class extends Date {
	toString() {
		return this.asDateString();
	}
	asDateString() {
		return `${this.getFullYear()}-${this.getMonth()}-${this.getDate()}`;
	}
	asDateTimeString() {
		return `${this.asDateString()}T${this.getHours()}-${this.getMinutes()}`;
	}
	getMonth() {
		if (super.getMonth() < 9) {
			return `0${super.getMonth() + 1}`;
		} else {
			return `${super.getMonth() + 1}`;
		}
	}
	incrementYear(by = 1) {
		this.setFullYear(this.getFullYear() + by);
		return this;
	}
	incrementMonth(by = 1) {
		this.setMonth(parseInt(this.getMonth()) + by);
		return this;
	}
	incremetDate(by = 1) {
		this.setDate(this.getDate() + by);
		return this;
	}
	incrementHours(by = 1) {
		this.setHours(this.getHours() + by);
		return this;
	}
	incrementMinutes(by = 1) {
		this.setMinutes(this.getMinutes() + by);
		return this;
	}
	incrementSeconds(by = 1) {
		this.setSeconds(this.getSeconds() + by);
		return this;
	}
}
