
function getResolution() {
    alert("Your screen resolution is: " + screen.width * devicePixelRatio + 
    "x" + screen.height * devicePixelRatio);
}
function getBreedAge()  {
    let breedCreateDate = 1989;
    let date = new Date();
    let todayYear = date.getFullYear();
    return(todayYear - breedCreateDate);
}


