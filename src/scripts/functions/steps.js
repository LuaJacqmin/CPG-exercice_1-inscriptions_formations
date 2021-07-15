/* display step 2 of form or send user info */
/* display image when user upload a image file */
if(document.body.getAttribute('data-page') === "form"){

  //get dom element + declare var + functions
  const alertBox = document.querySelector('#alertbox');
  const nextStep = document.querySelector('#nextStep');
  const formStep1 = document.querySelector('#form-step-1');
  const formStep2 = document.querySelector('#form-step-2');
  const inputImg = document.querySelector('#imageInput');
  const imgCanvas = document.querySelector('#imageReturn');

  /* get all element input */
  const inputs1 = document.querySelectorAll('.input--step1');
  let emptyInputs1 = [];

  /* first step*/
  nextStep.addEventListener('click', e => {
    //cancel button action
    e.preventDefault();

    //check if each input is filled
    inputs1.forEach(input => {
      //if not, turn it red
      if(input.value.length === 0){
        emptyInputs1.push(input.name);
        input.style.border = "1px solid red";
      }
      else{
        input.style.border = "1px solid black";
      }
    })

    if(emptyInputs1.length !== 0){
      alertBox.innerHTML = "Vous n'avez pas rempli tous les champs obligatoires"
    } else {
      alertBox.innerHTML = ""
      formStep1.classList.add('invisible');
      formStep2.classList.remove('invisible');
    }
    emptyInputs1 = [];
  })

  /* listen to change on input file */
  inputImg.addEventListener('change', e =>{
    const file = inputImg.files[0];
    imgCanvas.classList.remove('invisible')
    imgCanvas.setAttribute('src', URL.createObjectURL(file));
    inputImg.filename = URL.createObjectURL(file);
  })
}

