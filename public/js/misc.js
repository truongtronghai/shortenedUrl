function copyToClipboard(el){
    let tmpInput = document.createElement('input');
    
    tmpInput.value = document.getElementById(el).innerText;
    document.body.appendChild(tmpInput);
    tmpInput.focus();
    tmpInput.select();
    tmpInput.setSelectionRange(0, 99999); /*For mobile devices*/
    document.execCommand('copy');
    console.log(tmpInput.value);
    document.body.removeChild(tmpInput);
}

function checkUrlValid(url){
    let tmp;

    if(url.length==0){
        document.getElementById('txtMessageWarningWrong').className = 'd-none';
        tmp = document.getElementById('txtMessageWarningEmpty');
        tmp.style.color = 'red';
        tmp.className = 'd-inline';
        return false;
    }

    let urlPattern = new RegExp(/(https?):\/\/(\w[-\w]*\.)+([a-zA-Z]{2,9})(:\d{1,4})?([-\w\/#~:.?+=&%@]*)/);
    
    if (!urlPattern.test(url)){
        document.getElementById('txtMessageWarningEmpty').className = 'd-none';     
        tmp = document.getElementById('txtMessageWarningWrong');
        tmp.style.color = 'red';
        tmp.className = 'd-inline';
        return false;
    }

    return true;
}

/**
 * when user scrolls down number of pixels from top of document, showing the button
 */
function showScrollToTopButton(btnTop,pixels=20){
    btnTop.style.display = (document.body.scrollTop > pixels || document.documentElement.scrollTop > pixels)?'block':'none';
}

/**
 * when user clicks button to go to top
 */
function scrollToTop(){
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}

// when window scrolling
window.onscroll = () => showScrollToTopButton(document.getElementById('scrollToTop'));

/**
 * Canvas and QR image
 */
function saveQrImage(){
    const canvas = document.createElement('canvas');
    const img = document.getElementById('qrResultImage');
    canvas.width=img.width;
    canvas.height=img.height;
    const context = canvas.getContext('2d');
    context.drawImage(img,0,0);
    
    document.getElementById('qrResultSave').href = canvas.toDataURL('image/png');
}