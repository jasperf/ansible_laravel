function storeContent() {
    if (content !== textarea.value) {
        // Text area value has changed.
        var temp = textarea.value;
        var request = new XMLHttpRequest();
        request.open('POST', window.location.href, true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        request.setRequestHeader('X-CSRF-TOKEN', [...document.getElementsByName("csrf-token")][0].getAttribute('content'));
        request.onload = function () {

            if (request.readyState === 4) {

                // Request has ended, check again after 1 second.
                content = temp;
                setTimeout(storeContent, 1000);
            }
        }

        request.onerror = function () {

            // On connection error, try again after 1 second.
            setTimeout(storeContent, 1000);
        }

        // Send the request.
        request.send("t=" + encodeURIComponent(temp));

        // Make the content available to print.
        printable.removeChild(printable.firstChild);
        printable.appendChild(document.createTextNode(temp));
    } else {

        // Content has not changed, check again after 1 second.
        setTimeout(storeContent, 1000);
    }
}

var textarea = document.getElementById('content');
var printable = document.getElementById('printable');
var content = textarea.value;

// Make the content available to print.
printable.appendChild(document.createTextNode(content));

textarea.focus();

storeContent();
