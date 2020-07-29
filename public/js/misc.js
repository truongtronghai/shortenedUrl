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
        tmp.className = 'd-block';
        return false;
    }else{
        document.getElementById('txtMessageWarningEmpty').className = 'd-none';
    }

    let urlPattern = new RegExp(/(https?):\/\/(\w[-\w]*\.)+([a-zA-Z]{2,9})(:\d{1,4})?([-\w\/#~:.?+=&%@]*)/);
    
    if (!urlPattern.test(url)){
        document.getElementById('txtMessageWarningEmpty').className = 'd-none';     
        tmp = document.getElementById('txtMessageWarningWrong');
        tmp.style.color = 'red';
        tmp.className = 'd-block';
        return false;
    }else{
        document.getElementById('txtMessageWarningWrong').className = 'd-none';
    }

    return true;
}

function checkCustomStringValid(s){
    let tmp = document.getElementById('txtMessageWarningWrongCustomStringPattern');
    let valid = false; // khoi tao bien valid se chua ket qua kiem tra
    if(s.length===0){
        tmp.className = 'd-none';
        valid=true; // khong su dung chuoi custom string nen khong can xet
    }

    let patt = new RegExp(/^[a-zA-Z0-9]*$/); // chi chap nhan AlphaNummeric
    
    if(patt.test(s)){
        tmp.className = 'd-none';
        valid = true;
    }else{
        tmp.className = 'd-block';
        tmp.style.color = 'red';
        valid = false;  
    }
    
    return valid;
}

function watchCustomString(s){
    if(checkCustomStringValid(s)){
        document.getElementById('customStringResult').innerText = s.length?('rut.xyz/'+s):'';
        document.getElementById('customStringLength').innerText = s.length?(s.length+8):'';
    }else{
        document.getElementById('customStringResult').innerText = '';
        document.getElementById('customStringLength').innerText = '';
    }
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