/* IMPORT - axios */
const axios = require('axios').default;

/* base url for firebase requests */
url = "https://firestore.googleapis.com/v1/projects/ingrwf09/databases/(default)/documents";

/* if displayed body is form */
if(document.body.getAttribute('data-page') === "form"){
/* show searchbar or lessons options after visit type */
//get DOM elements + declare variables
const visitOptions = document.querySelector('#visitOptions');
const trainingOption = document.querySelector('#trainingOption');
const meetingOption = document.querySelector('#meetingOption');
const inputCrew = document.querySelector('#crewmember-search');
const listCrew = document.querySelector('#crewmember-answer');
const listTraining = document.querySelector('#trainingList');
let elementsCrew = [];
let elementsLessons = [];
let visitType;

//listen if user chooses an option
visitOptions.addEventListener('change', e =>{
  visitType = e.target.value;

  switch(visitType){
    case "training":
      trainingOption.classList.remove('invisible');
      meetingOption.classList.add('invisible');
      displayLessons(url+"/planning")
      break;

    case "meeting":
      meetingOption.classList.remove('invisible');
      trainingOption.classList.add('invisible');
      displayCrew(url+"/personnel");
      addCrewValue()
      break;

    default:
      meetingOption.classList.add('invisible');
      trainingOption.classList.add('invisible');
  }
});


/* display crew members name when user search them */
//listen if user write smt
const displayCrew = (firebaseURL) => {
  inputCrew.addEventListener('input', e => {
    elementsCrew = [];
    const searchedCrew = inputCrew.value;
    if(searchedCrew.length > 2){
      axios.get(firebaseURL)
        .then(personnel => {
          personnel.data.documents.forEach(member => {
            memberName = member.fields.prenom.stringValue;
            if(memberName.includes(searchedCrew)){
              elementsCrew = [...elementsCrew , `<li class="crewname" data-name="${memberName}">${memberName}</li>`];
            }
          });
          listCrew.innerHTML = elementsCrew.join('');
        })
      }
  })
}


/* add value to input when user click on crewmember name */
const addCrewValue = () => {
  window.addEventListener('click', e => {
    const clickedTarget = e.target
    if(clickedTarget.classList.contains("crewname")){
      inputCrew.value = clickedTarget.getAttribute('data-name');
    }
  })
}



/* display all trainings */
const displayLessons = (firebaseURL) => {
    elementsLessons = [ `<option value="">Choisissez un cours</option>`];
    let date = new Date();
    let today = date.getFullYear() + "-" + String(date.getMonth() + 1).padStart(2, '0') + "-" + date.getDate(); 
    //!! january is 0, not 1;
    axios.get(firebaseURL)
      .then(dataCours => {
          const allCours = dataCours.data.documents;
          allCours.forEach(cours => {
            if(cours.fields.debut.stringValue === today){
              axios.get(url+cours.fields.cours.stringValue)
                .then(targetCoursInfos => {
                  coursName = targetCoursInfos.data.fields.label.stringValue;
                  elementsLessons = [...elementsLessons, `<option value="${cours.fields.cours.stringValue}">${coursName}</option>`];
                  console.log(elementsLessons)
                  listTraining.innerHTML = elementsLessons;
                })
            }
          })
        })
      }
}
// 

console.log(process.env.NODE_ENV)