const server = "http://10.0.0.5";
// const server = "http://10.10.15.37";
const req = new XMLHttpRequest();

// Helper function to make sending requests easier
const sendRequest = (method, url, onload, params) => {
    req.open(method, `${server}/${url}`);
    req.onload = onload;
    if (params) {
        console.log("Sending with params:", params);
        req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        req.send(params);
    } else {
        req.send();
    }
}



///////////////////////
const id = document.getElementById("id");
const title = document.getElementById("title");
const body = document.getElementById("body");
const footer = document.getElementById("footer");
const belongsTo = document.getElementById("belongsTo");
const isVisible = document.getElementById("isVisible");

///////////////////////

// Getting parameters if exists from the inputs
const getParams = (includeBelongsTo) => {
    let p = "";
    if (title.value) { if (p != "") { p+="&";} p += `title=${title.value}`;}
    if (body.value) { if (p != "") { p+="&";} p += `body=${body.value}`;}
    if (footer.value) { if (p != "") { p += "&"; } p += `footer=${footer.value}`; }
    if (isVisible.checked) { if (p != "") { p += "&"; } p += `isVisible=1`; }
    else if (!isVisible.checked) { if (p != "") { p += "&"; } p += `isVisible=0`; }
    if (includeBelongsTo) {
        if (belongsTo.value) { if (p != "") { p += "&"; } p += `belongsTo=${belongsTo.value}`; }
    }
    
    return p;
}

const getAllPages = document.getElementById("getAllPages").addEventListener('click', () => {
    sendRequest("GET", "GetAllPages.php", outputGetAll);
});
const getAllSubPages = document.getElementById("getAllSubPages").addEventListener('click', () => {
    sendRequest("GET", "GetAllSubPages.php", outputGetAll);
});

const addBtn = document.getElementById("addBtn").addEventListener("click", (e) => {
    if (belongsTo.value == '') {
        sendRequest("POST", `AddPage.php`, outputGetAll, `${getParams()}`);
    } else {
        sendRequest("POST", `AddSubPage.php`, outputGetAll, `${getParams(true)}`);
        
    }
});

// Print response from server to screen
const outputGetAll = (e) => {
    let res = req.responseText;
    try {
        populateOutput(e, JSON.parse(res));
    } catch (e) {
        outputDiv.innerHTML = `<p class='outputText'>${res}</p>`;
    }
}


const removeSingleFromOutput = (element, id, isSub) => {
    console.log("HERE", id);
    element.remove();
    let sub = isSub ? '&isSub=1' : '';
    sendRequest("POST", "DeletePage.php", outputGetAll, `pageID=${id}${sub}`);
}

let x;
// Formats JSON data from the server and add it to the screen
const populateOutput = (evt, data) => {
    x = evt;
    console.log("EVT:",evt);
    outputDiv.innerHTML = "";
    let records = data["result"];
    records.forEach(r => {
        let div = document.createElement("div");
        div.className = "singleResult";
        let btn = document.createElement("button");
        btn.className = "outputBtn";
        btn.textContent = "X";
        btn.addEventListener("click", () => {

            removeSingleFromOutput(div, r.ID, evt.target.responseURL.includes('AllSub'));
          
         
        });
        
        if (!r.belongsTo) {
            div.innerHTML = `<p class="outputText">ID: ${r.ID}, isVisible:${r.isVisible === "1" ? "Y" : "N"}, Title: ${r.title.substring(0,20)}, Body: ${r.body.substring(0,20)}, Footer: ${r.footer.substring(0,20)}</p> `;
            
        } else {
            div.innerHTML = `<p class="outputText">ID: ${r.ID}, isVisible:${r.isVisible === "1" ? "Y" : "N"}, Belongs to: ${r.belongsTo}, Title: ${r.title.substring(0,20)}, Body: ${r.body.substring(0,20)}, Footer: ${r.footer.substring(0,20)}</p> `;
            
        }
        div.appendChild(btn);
        outputDiv.appendChild(div);
        console.log("R:", r);
    });
}




