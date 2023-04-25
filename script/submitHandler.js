export function submitHandler() {
    const nama = document.querySelector("[name='Nama']")
    const harga = document.querySelector("[name='No_hp']")
    const stock = document.querySelector("[name='Shif']")
    const stock_part = document.querySelector("[name='Alamat']")
    const file = document.querySelector("[type='file']")


    if(nama.value == false | harga.value == false | stock_part == false|  stock.value == false | file.value == false){
        alertify.alert("error","kamu belum mengisi semua form nii 🧐, isi ulang yaa 😃")
        return;
    }

    document.forms[0].submit();
}