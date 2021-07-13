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
const inputRoom = document.querySelector('#inputRoom');
const inputLink = document.querySelector('#inputLink');
const inputCrew = document.querySelector('#crewmember-search');
const listCrew = document.querySelector('#crewmember-answer');
const listTraining = document.querySelector('#trainingList');

let elementsCrew = [];
let elementsLessons = [`<option value="">Choisissez un cours</option>`];
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
    const searchedCrew = inputCrew.value;
    if(searchedCrew.length > 2){
      axios.get(firebaseURL)
      .then(personnel => {
        personnel.data.documents.forEach(member => {
          memberName = member.fields.prenom.stringValue.toLowerCase() + " " + member.fields.nom.stringValue.toLowerCase();
          if(memberName.includes(searchedCrew.toLowerCase())){
            elementsCrew = [...elementsCrew , `<li class="crewname" data-name="${memberName}" data-link="${member.name}" data-room="${member.fields.salle.stringValue}" style="text-transform: capitalize">${memberName}</li>`];
            inputLink.value = member.name;
            inputRoom.value = member.fields.salle.stringValue;
          }
        });
        listCrew.innerHTML = elementsCrew.join('');
        elementsCrew = []
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
      inputLink.value = clickedTarget.getAttribute('data-link');
      inputRoom.value = clickedTarget.getAttribute('data-room');
    }
  })
}

/* display all trainings */
const displayLessons = (firebaseURL) => {
  let date = new Date();
  let today = date.getFullYear() + "-" + String(date.getMonth() + 1).padStart(2, '0') + "-" + date.getDate(); 
  //!! january is 0, not 1;
  
  axios.get(firebaseURL)
  .then(dataCours => {
    const allCours = dataCours.data.documents;
    allCours.forEach(cours => {
      if(cours.fields.debut.stringValue === today){
        axios.get("https://firestore.googleapis.com/v1/"+cours.fields.cours.referenceValue)
        .then(targetCoursInfos => {
          console.log(targetCoursInfos)
          coursName = targetCoursInfos.data.fields.label.stringValue;
          elementsLessons = [...elementsLessons, `<option id="${coursName}" value="${coursName}" data-link="${targetCoursInfos.data.name}" data-room="${cours.fields.salle.stringValue}">${coursName}</option>`];
          console.log(elementsLessons);
          listTraining.innerHTML = elementsLessons;
        })
      }
    })
  })
}

/* change value input hidden when select lesson */
listTraining.addEventListener('change', e => {
  targetSelect = e.target;
  choice = targetSelect.value;
  const option = document.querySelector("#"+targetSelect.value)
  inputLink.value = option.getAttribute('data-link');
  inputRoom.value = option.getAttribute('data-room')
})
}

