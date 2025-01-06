import { initializeApp } from "https://www.gstatic.com/firebasejs/11.1.0/firebase-app.js";
import { getFirestore } from "https://www.gstatic.com/firebasejs/11.1.0/firebase-firestore.js";
import { getAnalytics } from "https://www.gstatic.com/firebasejs/11.1.0/firebase-analytics.js";

const firebaseConfig = {
    apiKey: "AIzaSyAZI2CDNkxs_uppeu6XR_8LgIReuNrk2cs",
    authDomain: "interview-registration.firebaseapp.com",
    databaseURL: "https://interview-registration-default-rtdb.firebaseio.com",
    projectId: "interview-registration",
    storageBucket: "interview-registration.firebasestorage.app",
    messagingSenderId: "354524580567",
    appId: "1:354524580567:web:21cac9ab140cc778a3fe92",
    measurementId: "G-S04DVW2DGG"
};

const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);
const db = getFirestore(app);

export { db };