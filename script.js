
function uploadContent() {

    
    if (content !== textarea.value) {
        var temp = textarea.value;
        var request = new XMLHttpRequest();
        request.open('POST', window.location.href, true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        request.send('text=' + encodeURIComponent(temp));
        request.onload = function() {
            if (request.readyState === 4) {

                
                content = temp;
                setTimeout(uploadContent, 1000);
            }
        }

        request.onerror = function() {

            
            setTimeout(uploadContent, 1000);
        }

        
        printable.removeChild(printable.firstChild);
        printable.appendChild(document.createTextNode(temp));
    }
    else {

        
       setTimeout(uploadContent, 1000);
    }
}
var textarea = document.getElementById('content');
var printable = document.getElementById('printable');
var content = textarea.value;
printable.appendChild(document.createTextNode(content));
textarea.focus();
uploadContent();
