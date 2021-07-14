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
  const visiteID = document.querySelector('#visiteID');
  const listTraining = document.querySelector('#trainingList');

  let elementsCrew = [];
  let elementsLessons = [`<option value="">Choisissez un cours</option>`];
  let visitType;

  //listen if user chooses an option
  visitOptions.addEventListener('change', e =>{
    visitType = e.target.value;

    switch(visitType){
      // If training, display available training
      case "training":
        trainingOption.classList.remove('invisible');
        meetingOption.classList.add('invisible');
        displayLessons(url+"/planning")
        break;

      // If meeting display an input text 
      case "meeting":
        meetingOption.classList.remove('invisible');
        trainingOption.classList.add('invisible');
        displayCrew(url+"/personnel");
        addCrewValue()
        break;

      // hide all options
      default:
        meetingOption.classList.add('invisible');
        trainingOption.classList.add('invisible');
    }
  });


  /* display crew members name when user search them */
  const displayCrew = (firebaseURL) => {
    //listen if user write somthing
    inputCrew.addEventListener('input', e => {
      const searchedCrew = inputCrew.value;
      // if at least 2 char are written
      if(searchedCrew.length >= 2){
        //make axios request
        axios.get(firebaseURL)
        .then(personnel => {
          //for each member
          personnel.data.documents.forEach(member => {
            memberName = member.fields.prenom.stringValue.toLowerCase() + " " + member.fields.nom.stringValue.toLowerCase();
            //if value of input is contained in the name or firstname of person
            if(memberName.includes(searchedCrew.toLowerCase())){
              //add an li element with information about the person
              elementsCrew = [...elementsCrew , `<li class="crewname" data-id="${member.name}" data-name="${memberName}" style="text-transform: capitalize">${memberName}</li>`];
              visiteID.value = "https://firestore.googleapis.com/v1/" + member.name;
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
    //when user clicks on name of the person
    window.addEventListener('click', e => {
      const clickedTarget = e.target;
      //input value turns into their name
      if(clickedTarget.classList.contains("crewname")){
        visiteID.value = "https://firestore.googleapis.com/v1/" + clickedTarget.getAttribute('data-id');
        inputCrew.value = clickedTarget.getAttribute('data-name');
      }
    })
  }

  /* display all trainings */
  const displayLessons = (firebaseURL) => {
    //get the date of the day to display onlye lesson that starts today
    let date = new Date();
    let today = date.getFullYear() + "-" + String(date.getMonth() + 1).padStart(2, '0') + "-" + date.getDate(); 
    //!! january is 0, not 1;

    //axios request
    axios.get(firebaseURL)
    .then(dataCours => {
      //get informations we need 
      const allCours = dataCours.data.documents;
      // for each lessons, test if starts day is today
      allCours.forEach(cours => {
        if(cours.fields.debut.stringValue === today){
          //if so, axios request on the lesson
          axios.get("https://firestore.googleapis.com/v1/"+cours.fields.cours.referenceValue)
          .then(targetCoursInfos => {
            coursName = targetCoursInfos.data.fields.label.stringValue;
            //create an li with all information needed
            elementsLessons = [...elementsLessons, `<option value="${"https://firestore.googleapis.com/v1/"+cours.name}">${coursName}</option>`];
            listTraining.innerHTML = elementsLessons;
          })
        }
      })
    })
  }
}
