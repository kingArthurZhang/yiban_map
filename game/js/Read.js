function post(URL, PARAMS) {
    var temp = document.createElement("form");
    temp.action = URL;
    temp.method = "post";
    temp.style.display = "none";
    var opt = document.createElement("textarea");
    opt.name = 'info';
    opt.value = PARAMS;
    temp.appendChild(opt);
    document.body.appendChild(temp);
    temp.submit();
}
