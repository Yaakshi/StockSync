// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
const firebaseConfig = {
  apiKey: "AIzaSyByVjqlwwg5TcaVPk_j6n9crpi1NEzWLQ4",
  authDomain: "stocksync-20554.firebaseapp.com",
  databaseURL: "https://stocksync-20554-default-rtdb.firebaseio.com",
  projectId: "stocksync-20554",
  storageBucket: "stocksync-20554.firebasestorage.app",
  messagingSenderId: "238345348111",
  appId: "1:238345348111:web:25e40e1bbe988a8786af7a"
};

// Initialize Firebase
firebase.initializeApp(firebaseConfig);
const auth = firebase.auth();

// gmail sign up
var provider = new firebase.auth.GoogleAuthProvider();

const glogin = document.getElementById("gmail-btn");
glogin.addEventListener("click",function(){
  
  firebase.auth()
  .signInWithPopup(provider)
  .then((result) => {
    
    /** @type {firebase.auth.OAuthCredential} */
    var credential = result.credential;
    var token = credential.accessToken;
    var user = result.user;

    user.getIdToken().then((idToken) => {
        // Send token to server to set session
        fetch('gmailsession.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ idToken: idToken })
        })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            // Redirect to dashboard
            window.location.href = "dash.php";
          } else {
            alert("Session error: " + data.message);
          }
        });
      });

  
  }).catch((error) => {

    var errorCode = error.code;
    var errorMessage = error.message;
    var email = error.email;
    var credential = error.credential;

    if(errorCode){
      alert(errorCode);
    }
    else if(errorMessage){
      alert(errorMessage);
    }
    else if(email){
      alert(email);
    }
    else if(credential){
      alert(credential);
    }
    else{
      alert("Unknown error. Try again!");
    }

  });
})