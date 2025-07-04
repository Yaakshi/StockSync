// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
const firebaseConfig = {
  apiKey: "",
  authDomain: "",
  databaseURL: "",
  projectId: "",
  storageBucket: "",
  messagingSenderId: "",
  appId: ""
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