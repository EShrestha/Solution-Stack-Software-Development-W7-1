const title = document.getElementsByClassName('title');
const body = document.getElementById('body');
const footer = document.getElementById('footer');

async function loadPage(){
    let url = `${server}/GetPage.php?pageID=${page_id}`;
    
    if(urlParams.has('subpage')){
        url += "&isSub=1";
    }
    
    const response = await fetch(url);
    const page_json = (await response.json()).result[0];

    console.log(page_json);

    title[0].innerText = page_json.title;
    title[1].innerText = page_json.title;
    body.innerText = page_json.body;
    footer.innerText = page_json.footer;
}

loadPage();