const navlist = document.getElementById('navlist');
const sublist = document.getElementById('sublist');
const login_element = document.getElementById('login-element');
const space_element = document.getElementById('space');
const admin_element = document.getElementById('admin-element');

const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const page_id = urlParams.get('id');

var isAdmin = false;

async function checkLogin(){
    const response = await fetch(`${server}/GetUserInfo.php`);
    const json = await response.json();

    const isLoggedIn = json.username != null;

    if(isLoggedIn){
        login_element.innerText = 'Logout';
        login_element.addEventListener("click", async() => {
            await fetch(`${server}/Logout.php`).then(result => {
                window.location.replace("index.html");
            });
    });
        console.log(json);
        if(json.isAdmin === '1'){
            console.log('hello world');
            admin_element.style.display = 'block';
            isAdmin = true;
        }else{
            admin_element.style.display = 'none';
        }
    }
    else{
        login_element.href = 'Login.html';
        login_element.innerText = 'Login';
        admin_element.style.display = 'none';
    }
    
    renderNavbar();
}


function addPagesToNav(pages){
    pages.forEach(page => {
        //if(page is visible || session = isadmin)
        if(page.isVisible == '1' || isAdmin){
            let li = document.createElement('li');
            let a = document.createElement('a');
            a.href = `Template.html?id=${page.ID}`;
            a.innerText = page.title;
            li.appendChild(a);
            //navlist.appendChild(li);
            navlist.insertBefore(li, space_element);
        }
    });
}

function addSubPagesToNav(subpages){
    subpages.forEach(subpage => {
        if(subpage.belongsTo == page_id){
            //if(page is visible || session = isadmin)
            if(subpage.isVisible == '1' || isAdmin){
                let li = document.createElement('li');
                let a = document.createElement('a');
                a.href = `Template.html?id=${subpage.ID}&subpage=1`;
                a.innerText = subpage.title;
                li.appendChild(a);
                sublist.appendChild(li);
            }
        }
    });
}

async function renderNavbar(){
    let page_response = await fetch(`${server}/GetAllPages.php`);
    let pages = await page_response.json();
    addPagesToNav(pages.result);

    let subpage_response = await fetch(`${server}/GetAllSubPages.php`);
    let subpages = await subpage_response.json();
    addSubPagesToNav(subpages.result);
}

checkLogin();
