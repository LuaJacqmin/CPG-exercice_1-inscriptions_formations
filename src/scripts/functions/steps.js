/* display step 2 of form or send user info */
if(document.body.getAttribute('data-page') === "form"){
  const alertBox = document.querySelector('#alertbox');
  const nextStep = document.querySelector('#nextStep');
  const formStep1 = document.querySelector('#form-step-1');
  const formStep2 = document.querySelector('#form-step-2');

  const inputsStep1 = document.querySelectorAll('.input--step1');
  
  const inputIsEmpty = (element) => element.value.length > 0
  //inputIsEmpty(input)

  nextStep.addEventListener('click', e => {
    e.preventDefault();

    formStep1.classList.add('invisible');
    formStep2.classList.remove('invisible');

    /* validation */
    // if(inputsStep1.every(input => input === "potat")){
    //   console.log('true')
    // } else {
    //   input.style.color = "red";
    //   alertBox.innerHTML = "Vous n'avez pas rempli tous les champs";
    // }
  })


  /* add validation when submit */

  // const submitForm = document.querySelector('#submitForm');

  // submitForm.addEventListener('click', e => {
  //   e.preventDefault();
  //   console.log(e);
  //   console.log(e.target.formAction);

  //   window.location.href="infos.php"
  // })
}

