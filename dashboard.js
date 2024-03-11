// Toggle clubs' details by arrow click======>
/*=============== ACCORDION ===============*/
const accordion = document.getElementsByClassName("singleClub");
for (let i = 0; i < accordion.length; i++) {
    accordion[i].addEventListener("click", function() {
        this.classList.toggle("active");
    });
}

// SCRIPT TO TOGGbLE BETWEEN NEWS AND TRANSFERS......

const btns = document.querySelectorAll(".newsBtn");
const newsType = document.querySelectorAll(".singlePost");

// Add active class(Background to the button) ===============>
for (let l = 0; l < btns.length; l++) {
    btns[l].addEventListener("click", function() {
        for (let w = 0; w < btns.length; w++) {
            btns[w].classList.remove("activeBtn");
        }
        this.classList.add("activeBtn");

        let dataFilter = this.getAttribute("data-filter");
        for (let y = 0; y < newsType.length; y++) {
            newsType[y].classList.add("hide");
            newsType[y].classList.remove("live");
            if (
                newsType[y].getAttribute("data-item") == dataFilter ||
                dataFilter == "all"
            ) {
                newsType[y].classList.remove("hide");
                newsType[y].classList.add("live");
            }
        }
    });
}

// SCRIPT TO TOGGbLE BETWEEN NEWS AND TRANSFERS......

const settingsButtons = document.querySelectorAll(".settingButton");
const toggleDivs = document.querySelectorAll(".toggleDiv");

// Add active class(Background to the button) ===============>
for (let sb = 0; sb < settingsButtons.length; sb++) {
    settingsButtons[sb].addEventListener("click", function() {
        for (let a = 0; a < settingsButtons.length; a++) {
            settingsButtons[a].classList.remove("activeBtn");
        }
        this.classList.add("activeBtn");

        let dataFilter = this.getAttribute("data-filter");
        for (let h = 0; h < toggleDivs.length; h++) {
            toggleDivs[h].classList.add("hide");
            toggleDivs[h].classList.remove("live");
            if (toggleDivs[h].getAttribute("data-item") == dataFilter) {
                toggleDivs[h].classList.remove("hide");
                toggleDivs[h].classList.add("live");
            }
        }
    });
}


// Function to show create Cards
const singleCards = document.getElementsByClassName("cardTitle");
const tbhDivs = document.getElementsByClassName("tbh");

for (let i = 0; i < singleCards.length; i++) {
    singleCards[i].addEventListener("click", function() {
        for (let t = 0; t < tbhDivs.length; t++) {
            if (t === i) {
                tbhDivs[t].classList.toggle("active");
            } else {

                tbhDivs[t].classList.remove("active");
            }
        }
    });
}