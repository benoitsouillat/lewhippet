
function getResolution() {
    alert("Your screen resolution is: " + screen.width * devicePixelRatio + 
    "x" + screen.height * devicePixelRatio);
}
function getBreedAge()  {
    let breedCreateDate = 1988;
    let date = new Date();
    let todayYear = date.getFullYear();
    return(todayYear - breedCreateDate);
}
/* function displayBreedAge() {
    let old = document.querySelector("header div h2");
    let new_balise = document.createElement("h2");
    let new_text = document.createTextNode("Elevage Passion du Whippet depuis " + getBreedAge() + " ans !!");

    return(new_text);
}  */


