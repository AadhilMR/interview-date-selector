import { db } from "./firebase_config.js";
import { collection, query, where, getDocs, addDoc } from "https://www.gstatic.com/firebasejs/11.1.0/firebase-firestore.js";

export async function isEmailAlreadyRegistered(email) {
    const querySnapshot = await getDocs(collection(db, "users"));

    for (const doc of querySnapshot.docs) {
        if (doc.data().email == email) {
            return true;
        }
    }
    return false;
}

export async function isDateTimeAlreadyRegistered(datetime) {
    const querySnapshot = await getDocs(collection(db, "timeslots"));

    for (const doc of querySnapshot.docs) {
        if (doc.data().datetime == datetime) {
            return true;
        }
    };
    return false;
}

export async function isUserAssignedToTimeslot(email) {
    const userId = await getUserID(email);

    const timeslotsSnapshot = await getDocs(query(collection(db, "timeslots"), where("user_id", "==", userId)));

    if(timeslotsSnapshot.size > 0) {
        return true;
    }
    return false;
}

async function getUserID(email) {
    // Get User ID
    const usersSnapshot = await getDocs(query(collection(db, "users"), where("email", "==", email)));
    
    let userId = null;
    usersSnapshot.forEach((doc) => {
        userId = doc.id;
    });
    
    return userId;
}

export async function addNewTimeslot(datetime, email) {
    const user_id = await getUserID(email);
    
    const timeslotData = {
        datetime: datetime,
        user_id: user_id,
    }
    
    try {
        await addDoc(collection(db, "timeslots"), timeslotData);
        return true;
    } catch(error) {
        return false;
    }

}

export async function getTimeslots() {
    const timeslots = [];

    const querySnapshot = await getDocs(collection(db, "timeslots"));

    querySnapshot.forEach((doc) => {
        timeslots.push(doc.data().datetime);
    });

    return timeslots;
}