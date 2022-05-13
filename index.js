const firebaseConfig = {
    apiKey: "AIzaSyAzr965rYdg33teclT2U4YjeeT1uW34qOI",
    authDomain: "ge400project.firebaseapp.com",
    databaseURL: "https://ge400project-default-rtdb.europe-west1.firebasedatabase.app",
    projectId: "ge400project",
    storageBucket: "ge400project.appspot.com",
    messagingSenderId: "259900272488",
    appId: "1:259900272488:web:21ea1807714b7bbfccf0dd",
    measurementId: "G-CZ4M5EFJCR"
  };

// Initialize Firebase
//const app = initializeApp(firebaseConfig);
firebase.initializeApp(firebaseConfig);
//const analytics = getAnalytics(app);
const auth = firebase.auth();
const database = firebase.database();

let signOutLink = document.getElementById('signOutLink');
var currentUser = null;
//Login function
function login() {
    var keepLoggedIn = document.getElementById('loggedIn').checked;
    email = document.getElementById('email').value
    password = document.getElementById('password').value
    if (validate_email(email) == false || validate_password(password) == false) {
        alert('Email or Password is entered incorrectly!')
        return
    }
    auth.signInWithEmailAndPassword(email, password)
    .then(function () {
            alert('inside auth')
            var user = auth.currentUser
            var database_ref = database.ref()
            var user_data = {
                last_login: Date.now()
            }
            database_ref.child('users/' + user.uid).update(user_data)
            alert('User logged in')
            if (!keepLoggedIn) {
                sessionStorage.setItem('user', JSON.stringify(user));
                window.location = "index.html"
            } else {
                localStorage.setItem('user', JSON.stringify(user));
                localStorage.setItem('keepLoggedIn', 'yes');
                window.location = "index.html";
            }
        })
        .catch(function (error) {
            var error_code = error_code
            var error_message = error_message
            alert(error_message)
        })
}
function register(){
    email = document.getElementById('email').value;
    password = document.getElementById('password').value;
    if(validate_email(email) == false || validate_password('password') == false){
        alert('Email or password is not correct');
        return;
    }
    auth.createUserWithEmailAndPassword(email, password)
    .then(function(){
        var user = auth.curretUser;
        var database_ref = database.ref();
        var user_data = {
            email:email,
            last_login : Date.now()
        }
        database_ref.child('users/' + user.uid).set(user_data);
        alert('User created');
    })
    .catch(function(error){
        var error_code = error_code;
        var error_message = error_message;
        alert(error_message);
    })
}
//Validate functions
function validate_email(email) {
    expression = /^[^@]+@\w+(\.\w+)+\w$/
    if (expression.test(email) == true) {
        return true
    } else {
        return false
    }
}
function validate_password(password) {
    if (password < 6) {
        return false
    } else {
        return true
    }
}
function signOut() {
    auth.signOut();
    sessionStorage.removeItem('user');
    localStorage.removeItem('user');
    localStorage.removeItem('keepLoggedIn');
    window.location = "index.html";
    alert("Signed Out");
}
auth.onAuthStateChanged(function(user) {
    if (user) {
        window.location = "index.html";
        alert("Active user " + email);
    } else {
        alert("No active user");
    }
});
function getUsername() {
    let keepLoggedIn = localStorage.getItem('keepLoggedIn');
    if (keepLoggedIn == "yes") {
        currentUser = JSON.parse(localStorage.getItem('user'));
    } else {
        currentUser = JSON.parse(sessionStorage.getItem('user'));
    }
}
window.onload = function () {
    getUsername();
    if (currentUser == null) {
        //signOutlink.innerText="Login";
        //signOutLink.classList.replace("nav-link", "btn");
        //signOutLink.classList.add("btn-success");
        //signOutLink.href = "login.html";
    } else {

    }
}