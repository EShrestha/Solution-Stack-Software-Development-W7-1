// const server = "http://10.0.0.28";
const server = "http://10.10.15.37";
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

///////////////////////

// Getting parameters if exists from the inputs
const getParams = (includeLim) => {
    let p = "";
    if (id.value) { p += `ID=${id.value}`;}
    if (fName.value) { if (id.value) { p+="&";} p += `fName=${fName.value}`;}
    if (lName.value) { if (p != "") { p+="&";} p += `lName=${lName.value}`;}
    if (address.value) { if (p != "") { p+="&";} p += `address=${address.value}`;}
    if (city.value) { if (p != "") { p += "&"; } p += `city=${city.value}`; }
    if (includeLim) {
        if (limit.value) { if (p != "") { p += "&"; } p += `limit=${limit.value}`; }
    }
    
    return p;
}

const readAllBtn = document.getElementById("readAllBtn").addEventListener('click', () => {
    sendRequest("GET", "GetPages.php", outputGetAll);
});
const getByCityBtn = document.getElementById("getByCityBtn").addEventListener('click', (e) => {
    console.log("Sending:", `GetRecordsWithOptions.php?${getParams()}`);
    sendRequest("GET", `GetRecordsWithOptions.php?${getParams(true)}`, outputGetAll);
});
const addBtn = document.getElementById("addBtn").addEventListener("click", (e) => {
    sendRequest("POST", `Add.php`, outputGetAll, `${getParams()}`);
    //sendRequest("POST", `Add.php`, outputGetAll, `ID=2&fName=Jane&lName=Doe&address=springfield&city=Denver`);
});
const updateBtn = document.getElementById("updateBtn").addEventListener("click", (e) => {
    sendRequest("POST", `Update.php`, outputGetAll, `${getParams()}`);
});
const removeBtn = document.getElementById("removeBtn").addEventListener("click", (e) => {
    sendRequest("POST", "DeleteByID.php", outputGetAll, `ID=${id.value}`);
});

// Print response from server to screen
const outputGetAll = (e) => {
    let res = req.responseText;
    try {
        populateOutput(JSON.parse(res));
    } catch (e) {
        outputDiv.innerHTML = `<p class='outputText'>${res}</p>`;
    }
}


const removeSingleFromOutput = (element, id) => {
    console.log("HERE", id);
    element.remove();
    sendRequest("POST", "DeleteByID.php", outputGetAll, `ID=${id}`);
}

// Formats JSON data from the server and add it to the screen
const populateOutput = (data) => {
    outputDiv.innerHTML = "";
    let records = data["result"];
    records.forEach(r => {
        let div = document.createElement("div");
        div.className = "singleResult";
        let btn = document.createElement("button");
        btn.className = "outputBtn";
        btn.textContent = "X";
        btn.addEventListener("click", () => {
            removeSingleFromOutput(div, r.ID);
        });
        
        
        div.innerHTML = `<p class="outputText">ID: ${r.ID}, ${r.fName} ${r.lName} from ${r.address} ${r.city}</p> `;
        div.appendChild(btn);
        outputDiv.appendChild(div);
        console.log("R:", r);
    });
}




