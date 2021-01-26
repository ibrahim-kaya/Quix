let tabHeader = document.getElementsByClassName("tab-baslik")[0];
let tabIndicator = document.getElementsByClassName("tab-indicator")[0];
let tabBG = document.getElementsByClassName("tab-bg")[0];
let tabsPane = tabHeader.getElementsByTagName("div");
let sayfalar = document.getElementsByClassName("posts");

const pp = document.getElementById("profil-resmi");
const cover = document.getElementById("kapak-resmi");

for(let i=0;i<tabsPane.length;i++){
    tabsPane[i].addEventListener("click",function(){
        tabHeader.getElementsByClassName("aktif")[0].classList.remove("aktif");
        tabsPane[i].classList.add("aktif");
        tabIndicator.style.left = `calc(calc(100% / 2) * ${i})`;
        tabBG.style.left = `calc(calc(100% / 2) * ${i})`;

        for(let a=0;a<sayfalar.length;a++){
            if(sayfalar[a].style.opacity !== '0')
            {
                sayfalar[a].style.opacity = '0';
                setTimeout(function(){
                    sayfalar[a].style.height = "0";
                    sayfalar[i].style.height = 'auto';
                    sayfalar[i].style.opacity = '1';
                }, 400);
            }

        }
    });
}
