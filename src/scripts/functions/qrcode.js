/* create qr code */
if(document.body.getAttribute('data-page') === 'infos'){
  const qrcodeDOM = document.querySelector('#qrcode');
  const qrcodeContent = document.querySelector('#id_visit').getAttribute('data-id');


  /* qrcode dependencie https://www.npmjs.com/package/qrcode */
  let QRCode = require('qrcode');
  QRCode.toCanvas(qrcodeDOM, qrcodeContent);

}

/* read qrcode */
if(document.body.getAttribute('data-page') === 'scan'){
  /* https://github.com/schmich/instascan */
  const scannerVideo = document.querySelector('#scanPreview');
  const scanStartBtn = document.querySelector('#scanStartBtn');
  const inputId = document.querySelector('#inputId');
  const frontcamBtn = document.querySelector('#frontcamBtn');
  const backcamBtn = document.querySelector('#backcamBtn');

  frontcamBtn.addEventListener('click', e => {
    e.preventDefault();
  })
  backcamBtn.addEventListener('click', e => {
    e.preventDefault();
  })

  scanStartBtn.addEventListener('click', e => {
    e.preventDefault();
    /* check if camera exists */
    scannerVideo.classList.remove('invisible');

    if (navigator.mediaDevices.getUserMedia) {
      navigator.mediaDevices.getUserMedia({ video: true })
        .then(stream => {
          scannerVideo.srcObject = stream;

          var scanner = new Instascan.Scanner({ video: scannerVideo, scanPeriod: 5, mirror: false });
          scanner.addListener('scan',function(content){
            /* if code insert here commands */
            console.log(content)
            inputId.value = content;
          });

          Instascan.Camera.getCameras().then(function (cameras){
            console.log(cameras)
              if(cameras.length>0){
                  scanner.start(cameras[0]);
                  console.log(frontcamBtn)
                  frontcamBtn.addEventListener('click', e => {
                    console.log(e)
                    e.preventDefault();
                    scanner.start(cameras[0]);
                  })
                  backcamBtn.addEventListener('click', e => {
                    e.preventDefault();
                    scanner.start(cameras[1]);
                  })
              }else{
                  console.error('No cameras found.');
              }
          }).catch(function(e){
              console.error(e);
          });
        })
        .catch(error => console.log(error));
    }
  })
}

/* if(cameras.length === 2){
                  scanner.start(cameras[1]);
                } else {
                  scanner.start(cameras[0]);
                }  */

                /* $('[name="options"]').on('change',function(){
                      if(this.val()==1){
                          if(cameras[0]!=""){
                             
                          }else{
                              alert('No Front camera found!');
                          }
                      }else if(this.val()==2){
                          if(cameras[1]!=""){
                              scanner.start(cameras[1]);
                          }else{
                              alert('No Back camera found!');
                          }
                      }
                  }); */