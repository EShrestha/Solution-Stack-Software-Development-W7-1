const server = 'http://PI-BOrtiz';

async function loadStyle(){
    const response = await fetch(`${server}/GetStyle.php`);
    const stylesheet = (await response.text()).trim();

    console.log(stylesheet);

    var link = document.createElement('link');
    link.rel = 'stylesheet';
    link.type = 'text/css';
    link.href = stylesheet;

    document.head.appendChild(link);
}

loadStyle();