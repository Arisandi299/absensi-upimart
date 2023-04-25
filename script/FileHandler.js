const upload_btn = document.querySelector(".upload");
const upload_file = document.querySelector("#file");
const preview = document.querySelector(".preview")


export function FileHandler() {

upload_btn.addEventListener("click", e => {
    e.preventDefault()
    upload_file.click()
})

upload_file.onchange = e => {
    preview.style.backgroundImage = "";
    const file = upload_file.files[0];
    if(checkfile(file)) {
        const reader = new FileReader();
        reader.onload = (e) => { 
            preview.style.backgroundImage = `url(${e.target.result})`;
            }
        reader.readAsDataURL(file);
    }
}
}




 function checkfile(file) {
    const type = file.type.split("/")
    console.log(upload_file)
    if(type[0] != "image" && type[1] != "png" | type[1] != "jpg"){
        upload_file.value = "";
         alertify.alert("Format file tidak support atau file bukan gambar 🧐","coba file yang bertipe gambar yakk, contoh png, jpeg, jpg ok ;)")
         return false;
    }
    if(file.size > 2000000){
         upload_file.value = "";
         alertify.alert("file terlalu besar !! max : 2 MB 🧐", "Kompress ukuran file sampai di bawah 2 Mb yak kaks ;)")
         return false;
    }


    

    return true;
}
