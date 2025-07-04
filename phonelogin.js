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

// recaptcha in phone login page
window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');

recaptchaVerifier.render().then((widgetId) => {
  window.recaptchaWidgetId = widgetId;
});

function sendotp(){
  var mobile = document.getElementById("mobile").value;
  var mobilenumber = "+91"+mobile;
  if(mobile.length<10){
    window.alert("Invalid mobile number.")
  }
  else{
    firebase.auth().signInWithPhoneNumber(mobilenumber,recaptchaVerifier).then(
      function(confirmResult){
        window.confirmResult=confirmResult;
        codeResult=confirmResult;
        console.log(codeResult);
      }
    )
  }
};