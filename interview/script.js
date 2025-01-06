const timeSlots = document.querySelectorAll(".slot-time");
const toastWarn = document.getElementById("liveToast");
const toastInstanceWarn = bootstrap.Toast.getOrCreateInstance(toastWarn);

timeSlots.forEach((slot) => {
    slot.addEventListener('click', (evt) => {
        onClickTimeSlot(evt);
    });
});

function onClickTimeSlot(evt) {
    const target = evt.target;

    if(isSelected(target)) {
        toastInstanceWarn.show();
        return;
    }

    toggleSelection(target);
}

// Toggle time slot button upon selection - start
function toggleSelection(target) {
    if(isSelection(target)) {
        removeSelection(target);
    } else {
        removeOtherSelection();
        addSelection(target);
    }
}

function addSelection(target) {
    target.classList.add("selection");
}

function removeSelection(target) {
    target.classList.remove("selection");
}
// Toggle time slot button upon selection - end

// Remove selection on currently selected time slot
function removeOtherSelection() {
    timeSlots.forEach((slot) => {
        if(slot.classList.contains("selection")) {
            slot.classList.remove("selection");
        }
    });
}

// Check the time slot is selected already by another person
function isSelected(target) {
    return target.classList.contains("selected");
}

// Check the time slot is currently selected by the user
function isSelection(target) {
    return target.classList.contains("selection");
}