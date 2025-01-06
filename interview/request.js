import {
    isEmailAlreadyRegistered,
    isDateTimeAlreadyRegistered,
    isUserAssignedToTimeslot,
    addNewTimeslot,
    getTimeslots
} from "./firebase.js";
import { EmailValidator } from "./EmailValidator.js";

const loader = document.getElementById("loader");
const errMsgContainer = document.getElementById("toastErrMsg");

// Toasts
const toastSuccess = document.getElementById("liveToast2");
const toastInstanceSuccess = bootstrap.Toast.getOrCreateInstance(toastSuccess);
const toastError = document.getElementById("liveToast3");
const toastInstanceError = bootstrap.Toast.getOrCreateInstance(toastError);

// Register to a timeslot
export async function submitRegistration() {
    if (!isAgreed()) {
        errMsgContainer.innerText = "Please check the acknowledgement boxes.";
        toastInstanceError.show();
        return;
    }

    const selectedDateTime = getSelectedDateTime();

    if (selectedDateTime == null) {
        errMsgContainer.innerText = "Please select a time slot.";
        toastInstanceError.show();
        return;
    }

    const email = document.getElementById("email").value;

    var emailResult = await isEmailAlreadyRegistered(email);

    if (!emailResult) {
        errMsgContainer.innerText = "Your email is not registered. Please reply to the email you received to register.";
        toastInstanceError.show();
        return;
    }

    var userAssigned = await isUserAssignedToTimeslot(email);

    if (userAssigned) {
        errMsgContainer.innerText = "You are already assigned to a timeslot. You can't select another timeslot.";
        toastInstanceError.show();
        return;
    }

    var datetime = convertDateTime(selectedDateTime);

    if (datetime == false) {
        errMsgContainer.innerText = "An error occurred while processing the selected time slot. Please try again.";
        toastInstanceError.show();
        return;
    } else {
        var datetimeResult = await isDateTimeAlreadyRegistered(datetime);

        if (datetimeResult) {
            errMsgContainer.innerText = "The time slot you selected is already taken. Please select another time slot.";
            toastInstanceError.show();
            return;
        }

        setOnSubmission();

        // Register the user to a timeslot
        var result = await addNewTimeslot(datetime, email);

        setDefaultSubmit();

        if (result) {
            toastInstanceSuccess.show();
            document.getElementById("email").value = "";
            selectTimeSlot();
        } else {
            errMsgContainer.innerText = "An error occurred while registering you to the timeslot. Please try again.";
            toastInstanceError.show();
        }
    }

    // var form = new FormData();
    // form.append("email", document.getElementById("email").value);
    // form.append("date", selectedDateTime.date);
    // form.append("time", selectedDateTime.time);

    // const request = new XMLHttpRequest();
    // request.onreadystatechange = function() {
    //     if (this.readyState == 4) {
    //         const obj = JSON.parse(this.responseText);

    //         setDefaultSubmit();

    //         if(obj.responseCode == "200") {
    //             toastInstanceSuccess.show();
    //             document.getElementById("email").value = "";
    //             selectTimeSlot();
    //         } else {
    //             errMsgContainer.innerText = obj.message;
    //             toastInstanceError.show();
    //         }
    //     } else {
    //         setOnSubmission();
    //     }
    // };
    // request.open("POST", "src/registrationProcess.php", true);
    // request.send(form);
}

// Validate User
export async function validateUser() {
    // Get token from URL
    const urlParams = new URLSearchParams(window.location.search);
    const token = urlParams.get("token");

    if(token == null || token == "") {
        errMsgContainer.innerText = "Invalid request!";
        toastInstanceError.show();
        return false;
    }

    // Validate the token and get the email
    const emailValidator = new EmailValidator(token);
    const email = await emailValidator.validateToken();

    if(email == false) {
        errMsgContainer.innerText = "Invalid request!";
        toastInstanceError.show();
        return false;
    }

    // Check if the email is already registered
    var emailResult = await isEmailAlreadyRegistered(email);
    
    if (!emailResult) {
        errMsgContainer.innerText = "Your email is not registered. Please reply to the email you received to register.";
        toastInstanceError.show();
        return false;
    }

    document.getElementById("email").value = email;
    return true;
}

// Load Registered Timeslots
export async function loadTimeSlots() {
    const timeslots = await getTimeslots();

    if(timeslots.length == 0) {
        return;
    }

    timeslots.forEach((datetime) => {
        const [date, time] = datetime.split(" ");
        const hour = parseInt(time.split(":")[0]);
        let formattedTime = hour > 12 ? (hour - 12).toString().padStart(2, '0') + " PM" : hour.toString().padStart(2, '0') + " AM";

        const slotDate = document.querySelector(`.slot-date[data-date="${date}"]`);
        const parentRow = slotDate.closest(".row");
        const slotTime = parentRow.querySelector(`.slot-time[data-time="${formattedTime}"]`);

        slotTime.classList.add("selected");
    });
}

// Utility Functions
function setDefaultSubmit() {
    loader.classList.add("d-none");
}

function setOnSubmission() {
    loader.classList.remove("d-none");
}

function isAgreed() {
    const aggr1 = document.getElementById("aggr-1");
    const aggr2 = document.getElementById("aggr-2");

    if (aggr1.checked && aggr2.checked) {
        return true;
    }
    return false;
}

function getSelectedDateTime() {
    const selectedTimeSlot = document.querySelector(".slot-time.selection");
    if (!selectedTimeSlot) {
        return null;
    }

    const parentRow = selectedTimeSlot.closest(".row");
    const selectedDateSlot = parentRow.querySelector(".slot-date");

    if (!selectedDateSlot) {
        return null;
    }

    const date = selectedDateSlot.textContent.trim();
    const time = selectedTimeSlot.textContent.trim();

    return { date, time };
}

function convertTo24HourFormat(time) {
    const [hour, meridian] = time.split(" ");

    if (meridian === "PM" && hour < 12) {
        hour = parseInt(hour) + 12;
    } else if (meridian === "AM" && hour == 12) {
        hour = 0;
    }

    return `${String(hour).padStart(2, "0")}:00`;
}

function convertDateTime(selectedDateTime) {
    const dateTimeString = selectedDateTime.date + " " + convertTo24HourFormat(selectedDateTime.time);
    const dateTime = new Date(dateTimeString);

    if (isNaN(dateTime.getTime())) {
        return false;
    }

    const year = dateTime.getFullYear();
    const month = String(dateTime.getMonth() + 1).padStart(2, '0');
    const day = String(dateTime.getDate()).padStart(2, '0');
    const hours = String(dateTime.getHours()).padStart(2, '0');
    const minutes = String(dateTime.getMinutes()).padStart(2, '0');
    const seconds = String(dateTime.getSeconds()).padStart(2, '0');

    return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
}

function selectTimeSlot() {
    const selectedTimeSlot = document.querySelector(".slot-time.selection");

    if (selectedTimeSlot) {
        selectedTimeSlot.classList.remove("selection");
        selectedTimeSlot.classList.add("selected");
    }
}